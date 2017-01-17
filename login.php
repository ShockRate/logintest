<?php

session_start();

if(isset($_SESSION['user_id'])){
  header("Location: /logintest");   
}

require 'db.php';


if (!empty($_POST['uid']) && !empty($_POST['pwd'])): 
    
    $records = $conn->prepare('SELECT id, first_name, last_name, uid, pwd FROM users WHERE uid = :uid' );
    $records->bindParam(':uid', $_POST['uid']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($results)>0 && password_verify($_POST['pwd'], $results['pwd'])) {
        $_SESSION['user_id'] = $results ['id'];
        $_SESSION['user_name'] = $results ['first_name'];
        header("Location: /logintest");
        
    } else{
        $message = 'Sorry, those credentials do not match';
    }
endif;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login Below</title>
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

        <h1>Login</h1>
        <span>or <a href="signup.php">register here</a></span>

        <form action="login.php" method ="POST">
            <input type="text" name="uid" placeholder="Enter your Username">
            <input type="password" name="pwd" placeholder="Enter your Password">
            <input type="submit" value="Submit"> 
        </form>
    </body>
</html>

