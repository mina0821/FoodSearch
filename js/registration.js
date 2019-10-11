// define variables to retreive html elements data
const username = document.getElementById('username_input');
const email = document.getElementById('email_input');
const password = document.getElementById('password_input');


//validate the form
function validateForm(){
    validateUsername();
    validateEmail();
    validatePassword();
}

// validate username field
function validateUsername(){
    //check if the field is empty
    if (username.value === '' || username.value == null){
        alert('Please fill in username.');
    }
}

// validate email format
function validateEmail(){
    if (email.value === '' || email.value == null){
        alert('Please fill in email.');
    }
}

// validate password requirements
function validatePassword(){
    if (password.value === '' || password.value == null){
        alert('Please fill in password.');
    }
}