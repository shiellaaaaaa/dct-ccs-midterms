<?php
    session_start();
    $pageTitle = "Edit";
    include '../header.php';
    include '../functions.php';
    //guard();  // Protect the page to ensure only logged-in users can access

    // Retrieve student data using index from session or redirect if not found
    if (isset($_GET['index'])) {
        $index = $_GET['index'];

        // Get the student data by index
        $student = getSelectedStudentData($index);
        if (!$student) {
            header("Location: register.php");  // Redirect if student not found
            exit;
        }
    } else {
        header("Location: register.php");  // Redirect if no index provided
        exit;
    }

    // Handle form submission to update student data
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $updated_data = [
            'student_id' => $_POST['student_id'],
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name']
        ];

        // Update student data in the session
        $_SESSION['student_data'][$index] = $updated_data;
        header("Location: register.php");  // Redirect after updating
        exit;
    }
?>

<main>

<div class="container justify-content-between align-items-center col-8">

    <h3 class=" mt-4">Edit Student</h3>

    <!-- breadcrumb -->
    <div class="w-100 mt-5">
        <div class="container justify-content-between align-items-center bg-light p-2 border r-4 ">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="../dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="register.php">Register Student</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                </ol>
            </nav>
        </div>
    </div>
    
    <div class=" border border-secondary-1 p-5 mt-3" >

        <!-- Edit Student Form -->
        <form method="POST" action="">
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control bg-light" id="student_id" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($student['first_name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo htmlspecialchars($student['last_name']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Student</button>
        </form>
    </div>
</div>
</main>

<?php
    include '../footer.php';
?>
