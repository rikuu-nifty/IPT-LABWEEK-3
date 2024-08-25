<?php
$upload_directory = getcwd() . '/uploads/';
$relative_path = '/uploads/';

// Ensure the uploads directory exists
if (!is_dir($upload_directory)) {
    mkdir($upload_directory, 0777, true);
}

// Handle Text File
if (isset($_FILES['text_file'])) {
    $uploaded_text_file = $upload_directory . basename($_FILES['text_file']['name']);
    $temporary_file = $_FILES['text_file']['tmp_name'];

    if (move_uploaded_file($temporary_file, $uploaded_text_file)) {
        // Display the uploaded PDF file
        $file_contents = file_get_contents($uploaded_text_file);
        echo '<h3>Uploaded Text File:</h3>';
        echo '<textarea rows="30" cols="70">' . htmlspecialchars($file_contents) . '</textarea>';
    } else {
        echo 'Failed to upload Text file';
    }
}


// Handle PDF File
if (isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === UPLOAD_ERR_OK) {
    $uploaded_pdf_file = $upload_directory . basename($_FILES['pdf_file']['name']);
    $temporary_file = $_FILES['pdf_file']['tmp_name'];

    if (move_uploaded_file($temporary_file, $uploaded_pdf_file)) {
        echo '<h3>Uploaded PDF File:</h3>';
        echo '<embed src="' . $relative_path . basename($_FILES['pdf_file']['name']) . '" width="600" height="500" type="application/pdf">';
    } else {
        echo 'Failed to upload PDF file';
    }
}


// Handle Audio File
if (isset($_FILES['audio_file']) && $_FILES['audio_file']['error'] === UPLOAD_ERR_OK) {
    $uploaded_audio_file = $upload_directory . basename($_FILES['audio_file']['name']);
    $temporary_file = $_FILES['audio_file']['tmp_name'];

    if (move_uploaded_file($temporary_file, $uploaded_audio_file)) {
        echo '<h3>Uploaded Audio File:</h3>';
        echo '<audio controls><source src="' . $relative_path . basename($_FILES['audio_file']['name']) . '" type="audio/mpeg">Your browser does not support the audio element.</audio>';
    } else {
        echo 'Failed to upload Audio file';
    }
}

// Handle Image File
if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
    $uploaded_image_file = $upload_directory . basename($_FILES['image_file']['name']);
    $temporary_file = $_FILES['image_file']['tmp_name'];

    if (move_uploaded_file($temporary_file, $uploaded_image_file)) {
        echo '<h3>Uploaded Image File:</h3>';
        echo '<img src="' . $relative_path . basename($_FILES['image_file']['name']) . '" width="600" height="400">';
    } else {
        echo 'Failed to upload Image file';
    }
}

echo '<pre>';
    var_dump($_FILES);
    exit;
?>