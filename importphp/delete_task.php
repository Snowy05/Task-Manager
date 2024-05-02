<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'database-connection.php';

if (isset($_POST['delete_task'])) {
    if (!isset($_POST['task_id'])) {
        $_SESSION['task_error'] = "Task ID not provided.";
        header("Location: ../manage.php");
        exit();
    }

    $taskID = $_POST['task_id'];

    $stmt = $conn->prepare("DELETE FROM Tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $taskID);

    if ($stmt->execute()) {
        header("Location: ../manage.php");
        exit();
    } else {
        $_SESSION['task_error'] = "Error deleting task: " . $conn->error;
        header("Location: ../manage.php");
        exit();
    }
} else {
    header("Location: ../manage.php");
    exit();
}
?>
