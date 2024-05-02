<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width : 620px)"/>
    <title>Profile</title>
    <?php include 'importphp/profile_menu.php'; ?>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
</body>
</html>
