<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

include 'database-connection.php';

if (isset($_POST['edit_task'])) {
    if (!isset($_POST['task_id'])) {
        $_SESSION['task_error'] = "Task ID was not provided.";
        header("Location: ../manage.php");
        exit();
    }

    $taskID = $_POST['task_id'];

    $stmt = $conn->prepare("SELECT * FROM Tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $taskID);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();

    if (!$task) {
        $_SESSION['task_error'] = "Task not found.";
        header("Location: ../manage.php");
        exit();
    }

  
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2; 
}

h1 {
    text-align: center;
    color: #333; 
    margin-top: 20px;
}
form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

form input[type="text"],
form textarea,
form select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

form input[type="date"] {
    width: calc(100% - 22px); 
}

form button[type="submit"] {
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

form button[type="submit"]:hover {
    background-color: #555;
}

        </style>
        <title>Edit Task</title>
    </head>
    <body>
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

    </body>

    </html>

    <?php
} else {
    header("Location: ../manage.php");
    exit();
}
?>
