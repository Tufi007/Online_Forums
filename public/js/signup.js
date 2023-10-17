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


document.addEventListener("DOMContentLoaded", function () {
    // Get a reference to the form and the country_code input
    const form = document.querySelector("form");
    const countryCodeInput = document.getElementById("country_code");

    // Define a regular expression pattern for a valid country code
    // const countryCodePattern = /^\+\d{1,4}$/;
    const countryCodePattern = /^\+(?:[1-9]\d{0,2}|[1-4]\d{3}|[5-9]\d{2}|[1-9]\d{0,2}|[1-4]\d{3}|[5-9]\d{2}|[1-9]\d{0,2}|[1-4]\d{3}|[5-9]\d{2})$/
    ; // Modify the pattern as needed

    // Add a form submission event listener
    form.addEventListener("submit", function (event) {
        // Get the value of the country code input
        const countryCode = countryCodeInput.value;

        // Check if the country code matches the pattern
        if (!countryCodePattern.test(countryCode)) {
            // Display an alert for an invalid country code
            alert("Please enter a valid country code.");
            // Prevent the form from being submitted
            event.preventDefault();
        }
    });
});
