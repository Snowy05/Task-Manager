<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include 'database-connection.php';

// Check if the update_task button is clicked
if (isset($_POST['update_task'])) {
    // Check if task_id is set in the POST request
    if (!isset($_POST['task_id'])) {
        // Redirect back with an error message
        $_SESSION['task_error'] = "Task ID not provided.";
        header("Location: ../manage.php");
        exit();
    }

    // Get task ID and updated details from POST request
    $taskID = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['due_date'];
    $status = $_POST['status'];

    // Update task in the database
    $stmt = $conn->prepare("UPDATE Tasks SET Title = ?, Description = ?, DueDate = ?, Status = ? WHERE TaskID = ?");
    $stmt->bind_param("ssssi", $title, $description, $dueDate, $status, $taskID);

    if ($stmt->execute()) {
        header("Location: ../manage.php");
        exit();
    } else {
        $_SESSION['task_error'] = "Error updating task: " . $conn->error;
        header("Location: ../manage.php");
        exit();
    }
} else {
    header("Location: ../manage.php");
    exit();
}
?>
