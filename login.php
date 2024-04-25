<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width : 490px)"/>
    <?php include 'importphp/menu.php'; ?>
</head>
<body>
    <h1>Login</h1>
    <div class="credential-container">
        <form action="login_process.php" method="post">
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <div class="submit-bttn">
                <button type="submit">Login</button>  
             </div>
        </form>
    </div>
    <?php include 'importphp/footer.php'; ?>

</body>
</html>



