<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include 'database-connection.php';

// Check if the delete_task button is clicked
if (isset($_POST['delete_task'])) {
    // Check if task_id is set in the POST request
    if (!isset($_POST['task_id'])) {
        // Redirect back with an error message
        $_SESSION['task_error'] = "Task ID not provided.";
        header("Location: ../manage.php");
        exit();
    }

    // Get task ID from POST request
    $taskID = $_POST['task_id'];

    // Prepare and execute delete statement
    $stmt = $conn->prepare("DELETE FROM Tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $taskID);

    if ($stmt->execute()) {
        // Task deleted successfully, redirect back to manage.php
        header("Location: ../manage.php");
        exit();
    } else {
        // Error occurred, redirect back to manage.php with error message
        $_SESSION['task_error'] = "Error deleting task: " . $conn->error;
        header("Location: ../manage.php");
        exit();
    }
} else {
    // If delete_task button is not clicked, redirect back to manage.php
    header("Location: ../manage.php");
    exit();
}
?>
