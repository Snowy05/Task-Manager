<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/desktop.css">
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width: 620px)">
    <link rel="icon" href="images/webpicture002.jpeg" type="image/png">

    <?php include 'importphp/menu-index.php'; ?>
    <title>Home</title>
</head>
<body>
<div class="space-wrapper">
        <div class="index-container">
                <section class="welcome-section">
                    <h1>Welcome!</h1>
                    <p>Back again?</p>
                    <img class='img-left'src="images/indexpic003.jpeg" alt="Welcome Image">
                    <div class="button-container">
                        <a href="login.php" class="button">Login</a>
                    </div>
                </section>

                <section class="new-here-section">
                    <h2>New Here?</h2>
                    <p>Sign up and get started today!</p>
                    <img class='img-right' src="images/indexpic002.png" alt="Register Image">
                    <div class="button-container">
                        <a href="register.php" class="button">Register</a>
                    </div>
                </section>
            </div>

</div>
    
    <?php include 'importphp/footer.php'; ?>
</body>
</html>

