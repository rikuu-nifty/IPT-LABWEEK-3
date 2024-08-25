<?php

require "helpers.php";

# from the $_SERVER global variable, check if the HTTP method used is POST, if its not POST, redirect to the index.php page
# Reference: https://www.php.net/manual/en/reserved.variables.server.php

// Supply the missing code
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Supply the missing code
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];

// Retrieve questions and correct answers
$questions = retrieve_questions();
$answers = $_POST['answers'] ?? '';

if (!is_string($answers)) {
    $answers = '';
}


// Calculate current question number and options
$current_question = get_current_question($answers);
$current_question_number = get_current_question_number($answers);

$target = 'result.php';

$formatted_answers = implode('', str_split($answers));

$options = get_options_for_question_number($current_question_number);
?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <script src="timer.js" defer></script>

    <style>
    .timer-container {
        display: flex;
        justify-content: center; /* Center horizontally */
        position: fixed; /* Keep it in a fixed position */
        top: 25px; /* Adjust top distance from the top of the page */
        width: 100%; /* Full width to make sure it's centered */
        z-index: 1000; /* Ensure it's on top of other content */
    }
    .timer {
        font-size: 1.5em; /* Adjust size as needed */
        font-weight: bold; /* Optional: make it bold */
    }
    </style>
    
</head>
<body>
<section class="section">
    <h1 class="title">Trivia Quiz</h1>
    <div class="timer-container">
        <div class="timer" id="timer">1:00</div>
    </div>

    
    <!-- <h2 class="subtitle">
        <?php echo $current_question['question']; ?>
    </h2> -->

    <!-- Supply the correct HTTP method and target form handler resource -->

    <form id = "quiz-form" method="POST" action="result.php">
        <input type="hidden" name="complete_name" value="<?php echo $complete_name; ?>" />
        <input type="hidden" name="email" value="<?php echo $email; ?>" />
        <input type="hidden" name="birthdate" value="<?php echo $birthdate; ?>" />
        <input type="hidden" name="contact_number" value="<?php echo $contact_number; ?>" />
        <input type="hidden" name="agree" value="<?php echo $agree; ?>" />
        <input type="hidden" name="answer" value="<?php echo $answer; ?>"/>
        <input type="hidden" name="answers" value="<?php echo $answers; ?>"/>
        <!--
        <input type="hidden" name="answers" />
        -->

        <!-- Display the options -->
        <?php foreach ($questions['questions'] as $index => $question): ?>
        <div class="box">
            <h3 class="title"><?php echo $index + 1 . '. ' . htmlspecialchars($question['question']); ?></h3>
            <?php foreach ($question['options'] as $option): ?>
            <div class="field">
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($option['key']); ?>"
                            <?php echo (isset($answers[$index]) && $answers[$index] === $option['key']) ? 'checked' : ''; ?> />
                        <?php echo htmlspecialchars($option['value']); ?>
                    </label>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

        <!-- Submit button -->
        <button type="submit" class="button">Submit</button>
    </form>
</section>
</body>
</html>