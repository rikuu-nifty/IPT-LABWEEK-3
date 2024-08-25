<?php
require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];
$answers = $_POST['answers'] ?? '';


if (is_array($answers)) {
    $answers = implode('', $answers); 
}

// Compute the score based on the user's answers
// Convert the $answers string into an array of individual answers
$score = compute_score(str_split($answers));

// Determine the CSS class for the hero section based on the score
// 'is-success' if the score is greater than 2, otherwise 'is-danger'
$hero_class = ($score > 2) ? 'is-success' : 'is-danger';

// Format the birthdate using DateTime
// Convert $birthdate into a DateTime object and format it as 'Month Day, Year'
$date = new DateTime($birthdate);
$formatted_birthdate = $date->format('F j, Y');

// Retrieve questions and correct answers from the trivia JSON file
$questions = retrieve_questions();
$correct_answers = $questions['answers'];

// Convert user answers from a string to an array
// This splits the $answers string into an array of individual answers
$user_answers = str_split($answers);

?>


<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body>
<section class="hero <?php echo $hero_class; ?>">
    <div class="hero-body">
        <p class="title">Your Score: <?php echo $score; ?></p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>

<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Complete Name</td>
                    <td><?php echo htmlspecialchars($complete_name); ?></td>
                </tr>
                <tr class="is-selected">
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo htmlspecialchars($formatted_birthdate); ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo htmlspecialchars($contact_number); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    
    <?php if ($score == 5): ?>
    <canvas id="confetti-canvas"></canvas>
    <script>
    var confettiSettings = {
        target: 'confetti-canvas'
    };
    var confetti = new ConfettiGenerator(confettiSettings);
    confetti.render();
    </script>
    <?php endif; ?>
    
    <h2 class="title" style="font-weight: 900; color: white;" >Quiz Review</h2>
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Your Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions['questions'] as $index => $question): ?>
                <tr>
                    <td><?php echo htmlspecialchars($question['question']); ?></td>
                    <td><?php 
                        // Check if correct answer exists
                        if (isset($correct_answers[$index])) {
                            $correct_answer_key = $correct_answers[$index];
                            $correct_answer = array_filter($question['options'], function($option) use ($correct_answer_key) {
                                return $option['key'] === $correct_answer_key;
                            });
                            echo htmlspecialchars(reset($correct_answer)['value'] ?? 'N/A');
                        } else {
                            echo 'N/A';
                        }
                    ?></td>
                    <td><?php 
                        // Check if user's answer exists
                        if (isset($user_answers[$index])) {
                            $user_answer_key = $user_answers[$index];
                            $user_answer = array_filter($question['options'], function($option) use ($user_answer_key) {
                                return $option['key'] === $user_answer_key;
                            });
                            echo htmlspecialchars(reset($user_answer)['value'] ?? 'N/A');
                        } else {
                            echo 'N/A';
                        }
                    ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
</body>
</html>