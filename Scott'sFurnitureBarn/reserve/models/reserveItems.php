<?php
session_start();
include "../../models/database.php";
$_SESSION['isReserved'] = false;
$Date = date('Y-m-d');
$_SESSION['ReturnDate'] = date('Y-m-d', strtotime($Date . '+ 5 days'));

$cartId = $_GET['CartId'];


$sql = $db->prepare('SELECT * FROM cart WHERE UserId = ?');
$sql->execute([$_SESSION['UserId']]);

$cart = $sql->fetchAll(PDO::FETCH_ASSOC);

if ($cart && $_SESSION['UserId'] > 0) {
    if (isset($_SESSION['UserId'])) {
        foreach ($cart as $row) {
            $sql = $db->prepare('INSERT INTO reserved (UserId, ItemId, ReservedDate, PickupDate) 
             VALUES (?, ?, ?, ?)');
            $sql->execute([$_SESSION["UserId"], $row['ItemId'], $Date, $_SESSION['ReturnDate']]);
        }


        $user = $_SESSION['UserId'];
        $stmt = $db->prepare("DELETE FROM cart WHERE UserId = :user");
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $_SESSION['cartCount'] = 0;
        $_SESSION["notification"] .= $_SESSION['FirstName'] . ", your item's will be reserved until '" . $_SESSION['ReturnDate'] . "'\n";
    }
} else {
    $_SESSION["notification"] .= "An error occurred. Please contact an administrator for assistance. \n";
}


header('Location: ../../reserve.php');
die();
