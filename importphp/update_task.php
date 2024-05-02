<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'database-connection.php';

if (isset($_POST['update_task'])) {
    if (!isset($_POST['task_id'])) {
        $_SESSION['task_error'] = "Task ID not provided.";
        header("Location: ../manage.php");
        exit();
    }

    $taskID = $_POST['task_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $dueDate = $_POST['due_date'];
    $status = $_POST['status'];

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
