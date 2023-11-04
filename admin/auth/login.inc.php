<?php
if (isset($_POST['submit'])) {

    var_dump($_POST);
    $email = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once '../connect_to_database.php';
    require_once 'functions.inc.php';



    if (emptyInputLogin($username, $pwd) !== false) {

        header("location: /src/login.php?error=empty");
        exit();
    }

    loginUser($conCD, $email, $pwd);
}
