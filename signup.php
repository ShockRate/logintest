<?php
session_start();
if(isset($_SESSION['user_id'])){
  header("Location: /logintest");   
}
require 'db.php';

$message ='';

if (!empty($_POST['uid']) && !empty($_POST['pwd'])): 
    //Enter new user into the database

    $sql = "INSERT INTO users (first_name, last_name, uid, pwd) VALUES (:first_name, :last_name, :uid, :pwd)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':first_name', $_POST['first_name']);
    $stmt->bindParam(':last_name', $_POST['last_name']);
    $stmt->bindParam(':uid', $_POST['uid']);
    $stmt->bindParam(':pwd', password_hash($_POST['pwd'], PASSWORD_BCRYPT));

    if($stmt->execute()): 
        $message='Registered Successfully';
    else:
        $message='Registration Failed. There has been some issue creating your account ';
    endif;

endif;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Signup below</title>
        <meta charset="UTF-8">
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
         <link href="https://fonts.googleapis.com/css?family=Ramabhadra" rel="stylesheet">
    </head>
    <body>

        <div class="header">
            <a href="/logintest">Back to Home</a>           
        </div>

        <?php if (!empty($message)): ?>
            <p> <?=$message ?></P>            
        <?php endif; ?>    

        <h1>Register</h1>
        <span>or <a href="login.php">log in here</a></span>
        
        <form action="signup.php" method ="POST">
            <input type="text" name="first_name" placeholder="First Name">
            <input type="text" name="last_name" placeholder="Last Name">
            <input type="text" name="uid" placeholder="Username">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="conf_pwd" placeholder="Confirm Password">
            <button type="submit">Sign Up</button>
        </form>

    </body>
</html>

<?php

