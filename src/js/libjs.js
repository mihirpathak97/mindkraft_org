// libjs.js - Contains some basic pure JS functions
// Copyright (c) Z-Coders

// Form vlaidation functions

function validateMobileNumber(mobileNumber) {
  var acceptedRegex = /^[0]?[789]\d{9}$/;
  if (acceptedRegex.test(mobileNumber)) {
    return true;
  }
  return false;
}

function validatePassword(password) {
  if (password.length >= 8) {
    return true;
  }
  return false;
}

function validateEmail(email){
  if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)){
    return true;
  }
  return false;
}

function validateName(name) {
  if (name.length >= 1) {
    return true;
  }
  return false;
}

function validateCollegeName(collegeName) {
  if (collegeName.length >= 1) {
    return true;
  }
  return false;
}

function validatePasswords(pass1, pass2) {
  if (pass1 == pass2) {
    return true;
  }
  return false;
}

function validateLoginForm() {
  var mobileNumber = document.getElementsByName('enduser_mobile')[0].value;
  var password = document.getElementsByName('enduser_password')[0].value;
  if (validatePassword(password) && validateMobileNumber(mobileNumber)) {
    return true;
  }
  else if (!validateMobileNumber(mobileNumber)) {
    showModal("Please enter a valid 10 digit mobile number!");
  }
  else if (!validatePassword(password)) {
    showModal("Please enter a valid password!");
  }
}

function validateRegistationForm() {
  name = document.getElementsByName('enduser_mobile')[0].value;
  mobileNumber = document.getElementsByName('enduser_mobile')[0].value;
  email = document.getElementsByName('enduser_email')[0].value;
  collegeName = document.getElementsByName('enduser_college_name')[0].value;
  password = document.getElementsByName('enduser_password')[0].value;
  passwordRetype = document.getElementsByName('password_retype')[0].value;
  if (validatePassword(password) && validatePasswords(password, passwordRetype) && validateMobileNumber(mobileNumber) && validateCollegeName(collegeName) && validateEmail(email) && validateName(name)) {
    return true;
  }
  else if (!validateName(name)) {
    showModal("Name field cannot be empty!");
  }
  else if (!validateMobileNumber(mobileNumber)) {
    showModal("Please enter a valid 10 digit mobile number!");
  }
  else if (!validateEmail(email)) {
    showModal("Please enter a valid E-Mail!");
  }
  else if (!validateCollegeName(collegeName)) {
    showModal("Please enter a valid college name!");
  }
  else if (!validatePassword(password)) {
    showModal("Please enter a valid password (min 8 digits)!");
  }
  else if (!validatePasswords(password, passwordRetype)) {
    showModal("The passwords do not match!");
  }
}

function submitLoginForm() {
  if (validateLoginForm()) {
    var loginForm = document.getElementById('login_form');
    var loginFormData = new FormData(loginForm);
    loginFormData.append('action', 'login');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        showModal(this.responseText);
        if (this.responseText.indexOf('Successfully') == 0) {
          $('#info-modal').on('hidden.bs.modal', function () {
            window.history.back();
          });
        }
      }
    };
    xhttp.open("post", "src/php/authenticate.php", true);
    xhttp.send(loginFormData);
  }
}

function submitRegistrationForm() {
  if (validateRegistationForm()) {
    var registrationForm = document.getElementById('registration_form');
    var registrationFormData = new FormData(registrationForm);
    registrationFormData.append('action', 'register');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        showModal(this.responseText);
        if (this.responseText.indexOf('successfull!') != -1) {
          $('#info-modal').on('hidden.bs.modal', function () {
            window.history.back();
          });
        }
      }
    };
    xhttp.open("post", "src/php/authenticate.php", true);
    xhttp.send(registrationFormData);
  }
}

function showModal(respText) {
  $('#info-body').html(respText);
  $('#info-modal').modal('toggle');
}

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}

// Event registration logic
function register_event(event_id, user_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      showModal(this.responseText);
    }
  };
  xhttp.open("get", "../src/php/event_register.php?event_id="+event_id+"&user_id="+user_id, true);
  xhttp.send();
}