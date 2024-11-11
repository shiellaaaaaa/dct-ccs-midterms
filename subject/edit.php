<?php
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

// Initialize error message
$error = '';

// Check if the 'index' parameter is set and valid
if (isset($_GET['index'])) {
    $index = (int) $_GET['index'];

    // Check if the subject exists at the given index in the session
    if (isset($_SESSION['subject_data'][$index])) {
        $subject = $_SESSION['subject_data'][$index]; // Get the subject data
    } else {
        $error = "Subject not found!";
    }
} else {
    $error = "No subject selected for editing!";
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subjectCode = trim($_POST['subject_code']);
    $subjectName = trim($_POST['subject_name']);

    // Validation to ensure both fields are filled
    if (empty($subjectCode) || empty($subjectName)) {
        $error = "Both subject code and subject name are required.";
    } else {
        // Update the subject data in the session
        $_SESSION['subject_data'][$index] = [
            'subject_code' => $subjectCode,
            'subject_name' => $subjectName
        ];

        // Redirect back to the dashboard after updating
        header("Location: ../dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Subject</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Edit Subject</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($subject)): ?>
            <form method="POST" action="edit.php?index=<?php echo $index; ?>">
                <div class="form-group">
                    <label for="subject_code">Subject Code:</label>
                    <input type="text" name="subject_code" class="form-control" value="<?php echo htmlspecialchars($subject['subject_code']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="subject_name">Subject Name:</label>
                    <input type="text" name="subject_name" class="form-control" value="<?php echo htmlspecialchars($subject['subject_name']); ?>" required>
                </div>
   
