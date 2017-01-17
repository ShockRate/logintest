<?php
session_start();

?>

<!DOCTYPE>
<html>
    <head>
        
        <title>Welcome to the login screen</title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Ramabhadra" rel="stylesheet">

    </head>
    <body>

        <div class="header">
            <a href="/logintest">Back to Home</a>           
        </div>

        <?php if(isset($_SESSION['user_id'])):?>
        <?php $message = $_SESSION['user_name'] ?>
        <br/>Welcome  <?=$message ?>! You have successfully logged in

        <a href="logout.php">Logout</a>
        <?php else: ?>


            <h1>Log in or Register</h1>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
      <?php endif; ?>
    </body>

</html>