<!-- profile.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Include CSS files for styling -->
    <link rel="stylesheet" href="css/desktop.css" />
    <link rel="stylesheet" href="css/mobile.css" media="only screen and (max-width : 640px)"/>
    <link rel="icon" href="images/webpicture002.jpeg" type="image/png">
    <?php include 'importphp/profile_menu.php'; ?>

    <title>Profile</title>
</head>
<body>
<div class='space-wrapper'>

    <h1>Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>

</div>
   

    <?php include 'importphp/footer.php'; ?>
</body>
</html>
