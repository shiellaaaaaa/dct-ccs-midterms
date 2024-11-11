<?php
    include 'functions.php';
    guard(); // Protect this page to only allow logged-in users

    echo "<h1>Welcome to the Dashboard</h1>";
    echo "<p>You are logged in as: " . $_SESSION['email'] . "</p>";
    echo "<a href='logout.php' class='btn btn-danger'>Logout</a>";
?>