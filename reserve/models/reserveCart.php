<?php
if (isset($_SESSION['UserId'])) {
  try {
    include "models/database.php";

    $user = $_SESSION['UserId'];
    $stmt = $db->prepare("SELECT items.ItemId AS `ProductId`, Name, items.Img, Description, CartId, `condition`, Price
    FROM cart
    JOIN items ON cart.ItemId = items.ItemId
    WHERE UserId = :user_id");
    $stmt->bindParam(':user_id', $user);
    $stmt->execute();
    $reservedRows = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (Exception $e) {
    error_log('Error getting reserved items: ' . $e->getMessage());
    echo 'Failed to retrieve reserved items.';
  }
}
