<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header("Location: login.php");
    exit();
}

include 'importphp/database-connection.php';

$userID = $_SESSION['user_id']; 
$query = "SELECT * FROM Tasks WHERE UserID = $userID";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width : 620px)"/>
    <link rel="icon" href="images/webpicture002.jpeg" type="image/png">
    <?php include 'importphp/profile_menu.php'; ?>
    <title>Manager</title>
</head>
<body>
    <div class='space-wrapper'>
        <h1>Task Manager</h1>
            
            <div class="manage-content-container">
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <div class="manage-content-item">
                        <strong><?php echo $row['Title']; ?></strong>
                        <p><?php echo $row['Description']; ?></p>
                        <p>Due Date: <?php echo $row['DueDate']; ?></p>
                        <p>Status: <?php echo $row['Status']; ?></p>
                        <form action="importphp/edit_task.php" method="post">
                            <input type="hidden" name="task_id" value="<?php echo $row['TaskID']; ?>">
                            <button type="submit" name="edit_task">Edit</button>
                        </form>
                        <form action="importphp/delete_task.php" method="post" onsubmit="return confirm('Are you sure you want to delete this task?');">
                            <input type="hidden" name="task_id" value="<?php echo $row['TaskID']; ?>">
                            <button type="submit" name="delete_task">Delete</button>
                        </form>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="add-task-container">
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
            </div>
    </div>
                    <?php include 'importphp/footer.php'; ?>

</body>
</html>