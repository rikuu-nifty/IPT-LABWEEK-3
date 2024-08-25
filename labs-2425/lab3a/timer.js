document.addEventListener('DOMContentLoaded', function() {
    // Set the countdown time in seconds
    var countdownTime = 60;
    var timerStarted = false; // Flag to check if the timer has started

    // Get the timer element from the DOM
    var timerElement = document.getElementById('timer');
    var options = document.querySelectorAll('input[type="radio"]'); // Select all radio buttons

    // Function to update the countdown timer
    function updateTimer() {
        if (countdownTime <= 0) {
            // Submit the form if time runs out
            document.getElementById('quiz-form').submit(); 
            return;
        }

        // Calculate minutes and seconds
        var minutes = Math.floor(countdownTime / 60);
        var seconds = countdownTime % 60;

        // Update the timer display
        timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
        
        // Decrement the countdown time
        countdownTime--;
    }

    // Function to start the timer
    function startTimer() {
        if (!timerStarted) {
            // Call updateTimer every second (1000 milliseconds)
            setInterval(updateTimer, 1000);

            // Automatically submit the form after 60 seconds
            setTimeout(function() {
                document.getElementById('quiz-form').submit();
            }, 60000); // 60,000 milliseconds = 60 seconds

            timerStarted = true; // Set the flag to true
        }
    }

    // Add event listener to each radio button
    options.forEach(function(option) {
        option.addEventListener('click', startTimer);
    });

    // Optionally, you could start the timer on form load, but make sure it's not interfering
    // startTimer(); 
});
