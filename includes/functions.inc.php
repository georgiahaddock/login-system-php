<?php

function emptyInputSignUp($name, $email, $password, $passwordrpt, $username){
    $result;
    if(empty($name) || empty($email) || empty($password) || empty($passwordrpt) || empty($username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidUiD($username){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function pwdMatch($password, $passwordrpt){
    $result;
    if($password !== $passwordrpt){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function uIDExists($conn, $username, $email){
    $sql = "SELECT * FROM users WHERE usersId = ? OR email = ?;";
    $statement = mysqli_stmt_init($conn); //create an sql statement
    if(!mysqli_stmt_prepare($statement, $sql)){ //if the sql statement is not prepared correctly
        header("location: ../signup.php?error=stmtfailed");
    exit();
    }
    //now we know the data is ok, we'll prepare the input from the user:
    mysqli_stmt_bind_param($statement, "ss", $username, $email); // "ss" means two strings
    mysqli_stmt_execute($statement);

    $resultData = mysqli_stmt_get_result($statement);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($statement);
}

function createUser($conn, $username, $email, $usersUiD, $password){
    $sql = "INSERT INTO users (username, email, usersUiD, pwd) VALUES (?,?,?,?);"; // each ? will be replaced by input data
    $statement = mysqli_stmt_init($conn); //create an sql statement
    if(!mysqli_stmt_prepare($statement, $sql)){ //if the sql statement is not prepared correctly
        header("location: ../signup.php?error=signupfailed");
        exit();
    }
    //make the pwd anonymous in the database
    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    //now we know the data is ok, we'll prepare the input from the user:
    mysqli_stmt_bind_param($statement, "ssss", $username, $email, $usersUiD, $hashedPwd); // "ssss" means 4 strings

    $resultData = mysqli_stmt_get_result($statement);
    mysqli_stmt_execute($statement);
    mysqli_stmt_close($statement);
    header("location: ../signup.php?error=none");
    exit();
}

function emptyInputLogin($username, $password){
    $result;
    if(empty($password) || empty($username)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $username, $password){
    $uIDExists = uIDExists($conn, $username, $username);

    if($uIDExists == false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uIDExists["pwd"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd == false){
        header("location: ../login.php?error=wrongpassword");
        exit();
    }
    else if($checkPwd == true){
        session_start();
        $_SESSION["usersId"]=$uIDExists["usersId"];
        $_SESSION["username"]=$uIDExists["username"];
        header("location: ../index.php");
        exit();

    }
}
