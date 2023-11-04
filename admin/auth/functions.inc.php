<?php

function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{

    $result = false;

    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {

        $result = true;
    } else {

        $result = false;
    }

    return $result;
}

function invalidUid($username)
{

    $result = false;

    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {

        $result = true;
    } else {

        $result = false;
    }

    return $result;
}

function invalidEmail($email)
{

    $result = false;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $result = true;
    } else {

        $result = false;
    }

    return $result;
}

function pwdMatch($pwd, $pwdRepeat)
{

    $result = false;

    if ($pwd !== $pwdRepeat) {

        $result = true;
    } else {

        $result = false;
    }

    return $result;
}

function uidExists($conCD, $email)
{

    $sql = "SELECT * FROM tblAdmin WHERE usersEmail = '$email';";

    $result = mysqli_query($conCD, $sql);

    $row = $result->fetch_all(MYSQLI_ASSOC)[0];
    if ($row) {
        return $row;
    } else {

        $result = false;
        return $result;
    }
}

function createUser($conCD, $name, $email, $username, $pwd)
{

    $sql = "INSERT INTO tblAdmin (usersName, usersEmail, usersUid, usersPwd) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conCD);

    if (!mysqli_stmt_prepare($stmt, $sql)) {

        header("location: /src/signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: /src/login.php?error=none");
}

function emptyInputLogin($name, $pwd)
{

    $result = false;

    if (empty($name) || empty($pwd)) {

        $result = true;
    } else {

        $result = false;
    }

    return $result;
}

function loginUser($conCD, $email, $pwd)
{

    $uidExists = uidExists($conCD, $email);

    if ($uidExists == false) {
        header("location: /src/login.php?error=wronglogin");
        exit();
    } else {
        $pwdHashed = $uidExists["usersPwd"];
        $checkPwd = password_verify($pwd, $pwdHashed);

        if ($checkPwd == false) {

            header("location: /src/login.php?error=wronglogin2");
            exit();
        } elseif ($checkPwd == true) {

            session_start();


            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["useruid"] = $uidExists["usersUid"];

            header("location: /admin/admin.php");
            exit();
        }
    }
}

function is_authenticated()
{

    session_start();
    include_once("connect_to_database.php");

    if (isset($_SESSION["userid"])) {

        $userid = $_SESSION["userid"];
        $sql = "SELECT * FROM tblAdmin WHERE usersId = ?";
        $stmt = mysqli_stmt_init($conCD);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $userid);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultData) > 0) {

                return true;
            }
        }
    }

    return false;
}
