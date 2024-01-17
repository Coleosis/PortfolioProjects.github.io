<?php
session_start();
$oldFirstName = $_SESSION["FirstName"];
$_SESSION['UserId'] = null;
$_SESSION['UserName'] = null;
$_SESSION['loggedIn'] = false;
$_SESSION['isAdmin'] = false;
echo 'logged in: ' . $_SESSION['loggedIn'];
var_dump($_SESSION);
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_unset();
session_destroy();
echo "<br>-----------------------------------------------------<br>";
var_dump($_SESSION);
// Needed to reset session variables
session_start();
$_SESSION['userLoginError'] = false;
$_SESSION['adminLoginError'] = false;
$_SESSION['notification'] = $oldFirstName . " has logged out. \n";
$oldFirstName = "";
header("Location: ../index.php");
