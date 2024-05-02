<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width : 620px)"/>
    <link rel="icon" href="images/webpicture002.jpeg" type="image/png">
    <?php include 'importphp/menu.php'; ?>
    <title>Register</title>
</head>
<body>
<div class='space-wrapper'>
<div class='cred-wrapper'>
<h1>User Registration</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'importphp/database-connection.php';
        
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $hashed_password = hash('sha256', $password); 

            $query = "INSERT INTO Users (FirstName, LastName, Email, PasswordHash) VALUES ('$firstName', '$lastName', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) 
        {
            echo '<div style="background-color: #dff0d8; color: #3c763d; padding: 10px; border-radius: 5px; max-width: 300px; margin: 0 auto; text-align: center;">Registered successfully!</div>';
        } 
         else 
         {
                echo '<div style="background-color: #f2dede; color: #a94442; padding: 10px; border-radius: 5px; max-width: 300px; margin: 0 auto; text-align: center;">Error: ' . mysqli_error($conn) . '</div>';
         }
    }
    ?>
    <div class="credential-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="credential-container-top">
                First Name: <input type="text" name="firstName" required><br>
                Last Name: <input type="text" name="lastName" required><br>
            </div>
            <div class="credential-container-bottom">
                Email: <input type="email" name="email" required><br>
                Password: <input type="password" name="password" required><br>
            </div>
                <div class="submit-bttn">
                    <button type="submit">Register</button>
                </div>
        </form>
    </div>
</div>   
</div>

 <?php include 'importphp/footer.php'; ?>
</body>
</html>