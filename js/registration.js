// define variables to retreive input data
const username_input = document.getElementById('username_input');
const password_input = document.getElementById('password_input');
const email_input = document.getElementById('email_input');
const date_input = document.getElementById('date_input');

// define variables to output error message
const username_output = document.getElementById('username_error');
const password_output = document.getElementById('password_error');
const email_output = document.getElementById('email_error');
const date_output = document.getElementById('date_error');


function validateForm(){
    //need to call four functions beforehand to show all the error message on the page
    //this is due to the greedy compilation of javascript to compute binary values
    validateUsername();
    validatePassword();
    validateDate();
    validateEmail();
    //check the error of each field
    if (!validateUsername() || !validatePassword() || !validateEmail() || !validateDate()) {
        //stop the submission if error occured
        return false;
    }
    return true;
}

// validate username field
function validateUsername(){
    //check if the field is empty
    if (username_input.value === '' || username_input.value == null){
        //print the error message
        username_output.innerText = "Please fill in the username.";
        //stop the submission and report the error message
        return false;
    }
    //no error detected
    else {
        //set error message box to empty
        username_output.innerText = "";
        //pass the test and let validation proceed to next input
        return true;
    }
}

// validate password field
function validatePassword(){
    //check if the field is empty
    if (password_input.value === '' || password_input.value == null){
        //print the error message
        password_output.innerText = "Please fill in the password.";
        //stop the submission and report the error message
        return false;
    }
    //test if password is at least six character
    else if (password_input.value.length<6){
        //print the error message
        password_output.innerText = "Please enter at least 6 character password.";
        //stop the submission
        return false;
    }
    //test if password includes one upper-case character
    else if (!/[A-Z]/.test(password_input.value)){
        //print the error message
        password_output.innerText = "Please include one upper case character.";
        //stop the submission and report the error message
        return false;
    }
    //test if password includes one digit number
    else if (!/[0-9]/.test(password_input.value)){
        //print the error message
        password_output.innerText = "Please include one digit number.";
        //stop the submission and report the error message
        return false;
    }
    //no error detected
    else {
        //set error message box to empty
        password_output.innerText = "";
        //pass the test and let validation proceed to next input
        return true;
    }
}

// validate email field
function validateEmail(){
    //check if the field is empty
    if (email_input.value === '' || email_input.value == null){
        //print the error message
        email_output.innerText = "Please fill in the email.";
        //stop the submission and report the error message
        return false;
    }
    //test if email input have the right format
    else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email_input.value))){
        //print the err message
        email_output.innerText = "Please enter a valid email.";
        //stop the submission
        return false;
    }
    //no error detected
    else {
        //set error message box to empty
        email_output.innerText = "";
        //pass the test and let validation proceed to next input
        return true;
    }
}


// validate date field
function validateDate(){
    //check if the field is empty
    if (date_input.value === '' || password_input.value == null){
        //print the error message
        date_output.innerText = "Please fill in the date of birth.";
        //stop the submission and report the error message
        return false;
    }
    //test if date input have the right format
    else if (!(/^(18|19|20)\d\d[-/](0[1-9]|1[012])[-/](0[1-9]|[12][0-9]|3[01])$/g.test(date_input.value))){
        //print the error message
        date_output.innerText = "Please enter a valid date.";
        //stop the submission
        return false;
    }
    //no error detected
    else {
        //set error message box to empty
        date_output.innerText = "";
        //pass the test and let validation proceed to next input
        return true;
    }
}