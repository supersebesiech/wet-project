const passwordInput = document.getElementById('password'); //getting all elements

const showPasswordCheckboxalt = document.getElementById('togglePassword');
const errorAge = document.getElementById('errorAge');
const errorPassword = document.getElementById('errorPassword');
const errorMail = document.getElementById('errorMail');
const errorPasswordCheck = document.getElementById('errorPasswordCheck');
const errorTerms = document.getElementById('errorTerms');
const errorPasswordValidation = document.getElementById('errorPasswordValidation');
const errorEmailValidation = document.getElementById('errorEmailValidation');
const errorResetMail = document.getElementById('errorResetMail');
const submitLogin = document.getElementById('submitLogin');
const submitRegister = document.getElementById('submitRegister');
const submitPasswordReset = document.getElementById('submitPasswordReset');
const date = document.getElementById('date');
const password = document.getElementById('password');
const confirmPassword = document.getElementById('confirmPassword');
const accept = document.getElementById('accept');




showPasswordCheckboxalt.addEventListener('click', ()=>{
  if(passwordInput.type === "password"){
    passwordInput.type = "text";
    showPasswordCheckboxalt.classList.replace("fa-eye", "fa-eye-slash");
    console.log(showPasswordCheckboxalt);
  }else{
    passwordInput.type = "password";
    showPasswordCheckboxalt.classList.replace("fa-eye-slash", "fa-eye");
    console.log(showPasswordCheckboxalt);
  }
});

submitRegister.addEventListener('click', function(e) {
  e.preventDefault();
    const password1 = password.value;
    const password2 = confirmPassword.value;
    const terms = accept.checked;
    const dateOfBirth = new Date(date.value);
    const now = new Date();
    const eighteen = new Date(
        now.getFullYear() - 18,
        now.getMonth(),
        now.getDate()
    );
    if (dateOfBirth > eighteen) 
    {
      errorAge.style.display = "block";  
    } 
    else 
    {
      errorAge.style.display = "none";   
    }

    if (password1 === password2)
    {
      errorPasswordCheck.style.display = "none";
    }
    else 
    {
      errorPasswordCheck.style.display = "block";
    }

    if (/[A-Z]/.test(password1) && /[A-Z]/.test(password2))
    {
      errorPassword.style.display = "none";
    }
    else 
    {
      errorPassword.style.display = "block";
    }

    if (terms)
    {
      errorTerms.style.display = "none";
    }
    else
    {
      errorTerms.style.display = "block";
    }
});

submitLogin.addEventListener('click', function(e) {
  e.preventDefault();
});