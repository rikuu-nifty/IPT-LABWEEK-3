document.addEventListener('DOMContentLoaded', function () {
    const agreeCheckbox = document.querySelector('input[name="disagree"]');
    const startQuizButton = document.querySelector('button[type="submit"]');

    // Function to toggle the Start Quiz button
    function toggleButtonState() {
        startQuizButton.disabled = !agreeCheckbox.checked;
    }

    // Add event listener to the checkbox
    agreeCheckbox.addEventListener('change', toggleButtonState);

    // Initial check
    toggleButtonState();
});
