var password = document.getElementById("newPasswordInput"),
password_confirm = document.getElementById("confirmNewPasswordInput");

function validatePassword() {
  if(password.value != password_confirm.value) {
    password_confirm.setCustomValidity("Passwords Don't Match");
  } else {
    password_confirm.setCustomValidity(''); 
  }
}

password.onchange = validatePassword;
password_confirm.onchange = validatePassword;

$.ajax({
    url: apiDomain + '/api/addPassword/',
    type: 'POST',
    data: {
      password: $('#newPasswordInput') . val().trim(),
      password_confirm: $('#confirmNewPasswordInput') . val().trim(),
    },
    success: function (data) {

    },
    error: function (e) {

    }
});


      


