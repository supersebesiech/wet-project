const passwordInput = document.getElementById('password'); //getting all elements
const showPasswordCheckbox = document.getElementById('showPassword');

showPasswordCheckbox.addEventListener('change', function() { //event listener for checkbox
  if (this.checked) {
    passwordInput.type = 'text';  //type text
  } else {
    passwordInput.type = 'password'; //type password
  }
});