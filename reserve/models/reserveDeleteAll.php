<?php
session_start();
include "../../models/database.php";

$user = $_SESSION['UserId'];
$stmt = $db->prepare("DELETE FROM cart WHERE UserId = :user");
$stmt->bindParam(':user', $user);
$stmt->execute();
$_SESSION['cartCount'] = 0;
$_SESSION["notification"] .= "All Item's Removed\n";
header("Location: /SWDV280/reserve.php");
exit;
