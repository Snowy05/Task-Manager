<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include 'database-connection.php';

// Get form data for task
$userID = $_SESSION['user_id']; // Assuming you have stored user ID in session
$title = mysqli_real_escape_string($conn, $_POST['title']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$dueDate = $_POST['due_date'];
$status = $_POST['status'];

// Insert task into Tasks table
$query = "INSERT INTO Tasks (UserID, Title, Description, DueDate, Status) VALUES ('$userID', '$title', '$description', '$dueDate', '$status')";
if (mysqli_query($conn, $query)) {
    // Task added successfully, redirect back to manage.php
    header("Location: ../manage.php");
    exit();
} else {
    // Error occurred, redirect back to manage.php with error message
    $_SESSION['task_error'] = "Error adding task: " . mysqli_error($conn);
    header("Location: ../manage.php");
    exit();
}

// Handle subtask creation
if (isset($_POST['subtask_title'])) {
    // Get form data for subtask
    $subtaskTitle = mysqli_real_escape_string($conn, $_POST['subtask_title']);
    $subtaskDescription = mysqli_real_escape_string($conn, $_POST['subtask_description']);
    $subtaskDueDate = $_POST['subtask_due_date'];
    $subtaskStatus = $_POST['subtask_status'];
    
    // Insert subtask into Subtasks table
    $subtaskQuery = "INSERT INTO Subtasks (TaskID, Title, Description, DueDate, Status) VALUES ('$taskID', '$subtaskTitle', '$subtaskDescription', '$subtaskDueDate', '$subtaskStatus')";
    if (mysqli_query($conn, $subtaskQuery)) {
        // Subtask added successfully
        // You can redirect or display a success message here if needed
    } else {
        // Error occurred while adding subtask
        // You can handle the error as per your application's requirements
    }
}
?>
