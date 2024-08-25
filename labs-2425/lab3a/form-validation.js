document.addEventListener('DOMContentLoaded', function () {
    // Get form elements
    const nameInput = document.querySelector('input[name="complete_name"]');
    const emailInput = document.querySelector('input[name="email"]');
    const submitButton = document.querySelector('button[type="submit"]');

    // Function to validate the email address
    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(String(email).toLowerCase());
    }

    // Function to check if the form is valid
    function checkFormValidity() {
        const isNameValid = nameInput.value.trim() !== '';
        const isEmailValid = validateEmail(emailInput.value.trim());
        
        submitButton.disabled = !(isNameValid && isEmailValid);
    }

    // Add event listeners to form fields
    nameInput.addEventListener('input', checkFormValidity);
    emailInput.addEventListener('input', checkFormValidity);

    // Initial check
    checkFormValidity();
});
