<?php
session_start();
include "../../models/database.php";

$cartId = $_GET['CartId'];
$stmt = $db->prepare("DELETE FROM cart WHERE CartId = :cartId");
$stmt->bindParam(':cartId', $cartId);
$stmt->execute();
$_SESSION['cartCount'] -= 1;
$_SESSION["notification"] .= "Item Removed\n";
header("Location: /SWDV280/reserve.php");
exit;
