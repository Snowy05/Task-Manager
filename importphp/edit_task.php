<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include 'database-connection.php';

// Check if the edit_task button is clicked
if (isset($_POST['edit_task'])) {
    // Check if task_id is set in the POST request
    if (!isset($_POST['task_id'])) {
        // Redirect back with an error message
        $_SESSION['task_error'] = "Task ID not provided.";
        header("Location: ../manage.php");
        exit();
    }

    // Get task ID from POST request
    $taskID = $_POST['task_id'];

    // Fetch task details from database
    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $taskID);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    // Check if task exists
    if (!$task) {
        $_SESSION['task_error'] = "Task not found.";
        header("Location: ../manage.php");
        exit();
    }

    // Display form for editing task
    // You can populate the form fields with task details here
    // Example:
    ?>

    <form action="update_task.php" method="post">
        <input type="hidden" name="task_id" value="<?php echo $task['TaskID']; ?>">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $task['Title']; ?>" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $task['Description']; ?></textarea><br>
        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" value="<?php echo $task['DueDate']; ?>" required><br>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="PENDING" <?php if ($task['Status'] === 'PENDING') echo 'selected'; ?>>Pending</option>
            <option value="IN_PROGRESS" <?php if ($task['Status'] === 'IN_PROGRESS') echo 'selected'; ?>>In Progress</option>
            <option value="COMPLETED" <?php if ($task['Status'] === 'COMPLETED') echo 'selected'; ?>>Completed</option>
        </select><br>
        <button type="submit" name="update_task">Update Task</button>
    </form>

    <?php
} else {
    // If edit_task button is not clicked, redirect back to manage.php
    header("Location: ../manage.php");
    exit();
}
?>
