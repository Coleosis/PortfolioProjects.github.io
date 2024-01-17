<?php
if (isset($_SESSION['UserId'])){
    if (!isset($db))
    {
        $dsn = 'mysql:host=localhost;dbname=scotts_furniture_barn';
        $username = 'root';
        $password = '';
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        // $dsn = 'mysql:host=3.93.31.85;dbname=scotts_furniture_barn';
        // $username = 'phpmyadmin';
        // $password = 'Pa$$w0rd';
        // $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('./errors/db_error_connect.php');
            exit();
        }
    }

  $cartCountUserId = $_SESSION['UserId'];
  $stmt = $db->prepare("SELECT COUNT(ItemId) AS `cartCount`
  FROM cart
  WHERE UserId = :user_id");
  $stmt->bindParam(':user_id', $cartCountUserId);
  $stmt->execute();
  $cartCount = 0;
  $cartCount = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    if ($cartCount != 0) {
        $_SESSION['cartCount'] = ($cartCount[0]);
    }
} else {
    $_SESSION['cartCount'] = 0;
}