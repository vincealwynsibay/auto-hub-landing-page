<?php

if (isset($_POST['submit'])) {

    var_dump($_POST);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = "";
    $pwd = $_POST['pwd'];
    $pwdRepeat = $_POST['pwdRepeat'];

    require_once '../connect_to_database.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat) !== false) {
        header("location: /src/signup.php?error=empty");
        exit();
    }

    if (invalidEmail($email) !== false) {

        header("location: /src/signup.php?error=invalidemail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {

        header("location: /src/signup.php?error=passwordsdontmatch");
        exit();
    }

    if (uidExists($conCD, $email) !== false) {
        header("location: /src/signup.php?error=emailtaken");
        exit();
    }

    createUser($conCD, $name, $email, $username, $pwd);
} else {
    var_dump($_POST);
    // header("location: /src/signup.php");
    exit();
}
