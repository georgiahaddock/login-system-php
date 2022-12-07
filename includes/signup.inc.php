<?php

if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email= $_POST["email"];
    $password= $_POST["password"];
    $passwordrpt= $_POST["passwordrpt"];
    $username= $_POST["username"];

require_once "dbh.inc.php";
require_once "functions.inc.php";

if(emptyInputSignUp($name, $email, $password, $passwordrpt, $username) !== false){
    header("location: ../signup.php?error=emptyinput");
    exit();
}
if(invalidUiD($username) !== false){
    header("location: ../signup.php?error=invalidusername");
    exit();
}
if(invalidEmail($email) !== false){
    header("location: ../signup.php?error=invalidemail");
    exit();
}
if(pwdMatch($password, $passwordrpt)){
    header("location: ../signup.php?error=passwordsdontmatch");
    exit();
}
if(uIDExists($conn, $username, $email) !== false){
    header("location: ../signup.php?error=usernametaken");
    exit();
}

createUser($conn, $name, $email, $username, $password);

}else{
    header("location: ../signup.php");
    exit();
}
