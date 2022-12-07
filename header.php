<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Page</title>
    <link rel="stylesheet" href="./css/reset.css"></link>
    <link rel="stylesheet" href="./css/style.css"></link>
</head>
<body>

    <div class="wrapper" id="topnav">
        <nav>
            <a>Home</a>
            <a href="aboutme.php">About me</a>
            <a href="contact.php">Contact</a>
            <?php
                if(isset($_SESSION["usersId"])){
                    echo "<a href='profile.php'>Profile Page</a>";
                    echo "<a href='logout.php'>Log Out</a>";
                }
                else{
                    echo "<a href='signup.php'>Sign Up</a>";
                    echo "<a href='login.php'>Log In</a>";
                }
            ?>
        </nav>
    </div>
