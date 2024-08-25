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
echo '<pre>';
    var_dump($_FILES);
    exit;
?>