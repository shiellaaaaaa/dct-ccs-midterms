<?php
session_start();

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

// Check if the 'index' parameter is set in the URL
if (isset($_GET['index'])) {
    $index = $_GET['index'];

    // Ensure the index is a valid integer and within the bounds of the array
    if (is_numeric($index) && $index >= 0 && $index < count($_SESSION['subject_data'])) {
        // Remove the subject from the session array
        unset($_SESSION['subject_data'][$index]);

        // Reindex the session array to avoid gaps in the indices
        $_SESSION['subject_data'] = array_values($_SESSION['subject_data']);
    } else {
        // Optionally, you can add an error message here if the index is invalid
        $_SESSION['error'] = "Invalid subject index.";
    }
}

// Redirect back to the dashboard
header("Location: ../dashboard.php");
exit();
