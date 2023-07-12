// Get the password and confirm password input elements
var passwordInput = document.getElementById('password');
var confirmPasswordInput = document.getElementById('cpassword');
var signupButton = document.getElementById('signup-button');

// Get the error message element
var errorMessage = document.getElementById('password-error');

// Add an event listener to the confirm password input element
confirmPasswordInput.addEventListener('input', function() {
    var password = passwordInput.value;
    var confirmPassword = confirmPasswordInput.value;

    if (password !== confirmPassword) {
        // Passwords don't match, display error message
        errorMessage.textContent = "Passwords don't match";
        signupButton.disabled = true;
    } else {
        // Passwords match, clear error message
        errorMessage.textContent = "";
        signupButton.disabled = false;
    }
});
