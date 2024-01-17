<?php
session_start();
include "../models/database.php";
$_SESSION['userLoginError'] = false;

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        $_SESSION['userLoginError'] = true;
        $_SESSION["notification"] .= "A Username is required! \n";
        header("Location: ../index.php");
    }
    if (empty($password)) {
        $_SESSION['userLoginError'] = true;
        $_SESSION["notification"] .= "A Password is required! \n";
        header("Location: ../index.php");
    }
    if (empty($username) || empty($password)) {
        exit();
    }

    $stmt = $db->prepare("SELECT * FROM users WHERE UserName = :username AND Password = :password OR Email = :username AND Password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $_SESSION['LoggedIn'] = true;
        $_SESSION['UserName'] = $row['UserName'];
        $_SESSION['UserId'] = $row['UserId'];
        $_SESSION['FirstName'] = $row['FirstName'];
        $_SESSION["notification"] .= $_SESSION['FirstName'] . " has logged in! \n";
        header("Location: " . $_SESSION['redirect']);

        exit();
    } else {
        $_SESSION['userLoginError'] = true;
        $_SESSION["notification"] .= "Username or Password are incorrect. Please ty again. \n";
        header("Location: ../index.php");
        exit();
    }
}
