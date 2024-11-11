<?php
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

// Initialize an errors array to capture any validation errors
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get subject data from form submission
    $subjectCode = trim($_POST['subject_code']);
    $subjectName = trim($_POST['subject_name']);

    // Basic validation to check if fields are empty
    if (empty($subjectCode) || empty($subjectName)) {
        $errors[] = "Both subject code and name are required.";
    } else {
        // Add the new subject to the session storage
        $_SESSION['subject_data'][] = [
            'subject_code' => $subjectCode,
            'subject_name' => $subjectName
        ];
        // Redirect to dashboard after adding the subject
        header("Location: ../dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Subject</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-5">Add a New Subject</h2>
        <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <?php echo implode('<br>', $errors); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="add.php">
            <div class="form-group">
                <label for="subject_code">Subject Code:</label>
                <input type="text" name="subject_code" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subject_name">Subject Name:</label>
                <input type="text" name="subject_name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Subject</button>
            <a href="../dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
