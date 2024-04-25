<?php
session_start();
include 'importphp/database-connection.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$hashed_password = hash('sha256', $password);

$query = "SELECT * FROM Users WHERE Email='$email' AND PasswordHash='$hashed_password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    // Valid credentials, start session and redirect to profile page
    $user = mysqli_fetch_assoc($result);
    $_SESSION['logged_in'] = true;
    $_SESSION['user_id'] = $user['UserID'];
    $_SESSION['user_name'] = $user['FirstName']; 
    header("Location: profile.php");
    exit();
} else {
    $_SESSION['login_error'] = "Invalid email or password";
    header("Location: login.php");
    exit();
}
?>
