<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Chat Sidebar</title>
    <meta name="csrf-token" content="YOUR_CSRF_TOKEN_HERE" />
    <style>
        .chat-bar {
            position: fixed;
            bottom: 0;
            width: 100%;
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0,0,0,.2);
        }
        .chat-bar button.move-left {
            margin-right: 320px;
            transition: margin-right .3s;
        }
        .chat-bar ul {
            list-style: none;
            margin: 0;
            padding: 0 20px;
            display: flex;
            justify-content: flex-end;
        }
        .chat-bar button {
            background: #444;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: margin-right .3s;
        }
        .chat-bar button:hover { background: #555; }

        .right-bar {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: fixed;
            bottom: 0;
            right: 0;
            width: 300px;
            max-height: 90%;
            background: #ddd;
            box-shadow: -2px 0 5px rgba(0,0,0,.2);
            padding: 10px;
            overflow-y: auto;
            transition: transform .3s;
            z-index: 9999;
            transform: translateX(100%);
        }
        .hidden { transform: translateX(100%); }
        .visible { transform: translateX(0); }

        .userButton {
            display: block;
            margin: 10px 0;
            padding: 8px 12px;
            width: 100%;
            background: #fff;
            color: #000;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,.1);
            cursor: pointer;
            transition: background .3s, transform .2s;
        }
        .userButton:hover {
            background: #f0f0f0;
            transform: scale(1.05);
        }

        .chat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background: #444;
            color: #fff;
        }
        .chat-history {
            flex: 1;
            padding: 10px;
            background: #f9f9f9;
            overflow-y: auto;
            max-height: 400px;
        }
        .chat-history div {
            margin: 5px 0;
            padding: 5px;
            background: #e6e6e6;
            border-radius: 5px;
        }
        #chatMessage {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
        }
        .send-button {
            background: #44c767;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background .3s;
        }
        .send-button:hover { background: #3ca653; }
    </style>
</head>
<body>

<div class="chat-bar">
    <ul><button id="chatButton">Chat</button></ul>
</div>

<div id="rightBar" class="right-bar hidden">
    <div id="userList"></div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const chatButton   = document.getElementById("chatButton");
        const rightBar     = document.getElementById("rightBar");
        const userList     = document.getElementById("userList");

        const populateUserList = async () => {
            try {
                const res = await fetch("/components/fetch_users.php");
                const users = await res.json();
                userList.innerHTML = "";

                users.forEach(user => {
                    const btn = document.createElement("button");
                    btn.textContent = user.full_name || user.name || user.username || "Unknown User";
                    btn.className   = "userButton";
                    btn.dataset.userId = user.id;
                    btn.onclick = () => fetchChatHistory(user.id, btn.textContent);
                    userList.appendChild(btn);
                });
            } catch (err) {
                userList.innerHTML = `<p>Error loading user list: ${err.message}</p>`;
            }
        };

        const fetchChatHistory = async (userId, userName) => {
            try {
                const res = await fetch(`/api/chat/history?user=${userId}`);
                const data = await res.json();

                userList.innerHTML = "";

                // Header
                const header = document.createElement("div");
                header.className = "chat-header";
                header.innerHTML = `<span>Chat with ${userName}</span>
                          <button class="userButton" style="margin-left:auto;" id="backButton">Back</button>`;
                header.querySelector("#backButton").onclick = populateUserList;
                userList.appendChild(header);

                // History
                const history = document.createElement("div");
                history.className = "chat-history";
                if (data.data && data.data.length) {
                    data.data.forEach(msg => {
                        const div = document.createElement("div");
                        div.textContent = `${msg.user_from === userId ? userName : "You"}: ${msg.message}`;
                        history.appendChild(div);
                    });
                } else {
                    history.textContent = "No messages available.";
                }
                userList.appendChild(history);

                // Input
                const inputWrap = document.createElement("div");
                inputWrap.style.display = "flex";
                inputWrap.style.marginTop = "10px";

                const input = document.createElement("input");
                input.type = "text";
                input.id = "chatMessage";
                input.placeholder = "Type your message...";
                input.style.flex = "1";
                inputWrap.appendChild(input);

                const sendBtn = document.createElement("button");
                sendBtn.className = "send-button";
                sendBtn.textContent = "Send";
                inputWrap.appendChild(sendBtn);

                sendBtn.onclick = async () => {
                    const message = input.value.trim();
                    if (!message) return;

                    try {
                        const postRes = await fetch("/messages/send", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                            },
                            body: JSON.stringify({ user_to: userId, message })
                        });

                        if (!postRes.ok) throw new Error(`Send failed: ${postRes.status}`);

                        const msgDiv = document.createElement("div");
                        msgDiv.textContent = `You: ${message}`;
                        history.appendChild(msgDiv);
                        input.value = "";
                    } catch (err) {
                        console.error("Send error:", err.message);
                    }
                };

                userList.appendChild(inputWrap);
            } catch (err) {
                userList.innerHTML = `<p>Error loading chat: ${err.message}</p>`;
            }
        };

        chatButton.addEventListener("click", () => {
            if (rightBar.classList.contains("visible")) {
                rightBar.classList.remove("visible");
                rightBar.classList.add("hidden");
                chatButton.classList.remove("move-left");
            } else {
                rightBar.classList.remove("hidden");
                rightBar.classList.add("visible");
                chatButton.classList.add("move-left");
                populateUserList();
            }
        });
    });
</script>

</body>

</html>
