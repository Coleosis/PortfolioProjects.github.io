<?php
session_start();
include "../../models/database.php";

$_SESSION['isReserved'] = false;
$Date = date('Y-m-d');
$ReturnDate = date('Y-m-d', strtotime($Date . '+ 5 days'));

if (isset($_POST['product_id']) && is_numeric($_POST['product_id'])) {

    $productId = (int)$_POST['product_id'];

    $sql = $db->prepare('SELECT * FROM items WHERE ItemId = ?');
    $sql->execute([$productId]);

    $product = $sql->fetch(PDO::FETCH_ASSOC);

    if ($product && $product['ItemId'] == $productId && $_SESSION['UserId'] > 0) {
        if (isset($_SESSION['UserId'])) {
            $_SESSION['isReserved'] = true;
            $sql = $db->prepare('INSERT INTO cart (UserId, ItemId) 
        VALUES (?, ?)');

            $sql->execute([$_SESSION["UserId"], $productId]);
        }
    }
    header('Location: ../../reserve.php');
} else {
    echo "Failed";
}
