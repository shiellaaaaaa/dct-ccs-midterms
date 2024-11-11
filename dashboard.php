<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$userEmail = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }
        .card {
            margin-top: 20px;
        }
        .btn-primary {
            width: 100%;
        }
        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h3>Welcome to the System: <?php echo htmlspecialchars($userEmail); ?></h3>
        
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add a Subject
                    </div>
                    <div class="card-body">
                        <p>This section allows you to add a new subject in the system. Click the button below to proceed with the adding process.</p>
                        <a href="subject/add.php" class="btn btn-primary">Add Subject</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Register a Student
                    </div>
                    <div class="card-body">
                        <p>This section allows you to register a new student in the system. Click the button below to proceed with the registration process.</p>
                        <a href="student/register.php" class="btn btn-primary">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
