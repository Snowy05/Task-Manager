<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include database connection
include 'importphp/database-connection.php';

// Retrieve tasks for the logged-in user from the database
$userID = $_SESSION['user_id']; // Assuming you have stored user ID in session
$query = "SELECT * FROM Tasks WHERE UserID = $userID";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <!-- Include CSS files for styling -->
    <link rel="stylesheet" href="css/desktop.css" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width : 490px)"/>
</head>
<body>
    <?php include 'importphp/menu_logged_in.php'; ?>

    <h1>Task Manager</h1>

    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <li>
                <strong><?php echo $row['Title']; ?></strong>
                <p><?php echo $row['Description']; ?></p>
                <p>Due Date: <?php echo $row['DueDate']; ?></p>
                <p>Status: <?php echo $row['Status']; ?></p>
            </li>
        <?php endwhile; ?>
    </ul>

    <form action="importphp/add_task.php" method="post">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br>
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date" required><br>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="PENDING">Pending</option>
            <option value="IN_PROGRESS">In Progress</option>
            <option value="COMPLETED">Completed</option>
        </select><br>
        <button type="submit">Add Task</button>
    </form>

    <?php include 'importphp/footer.php'; ?>
</body>
</html>
