<?php
function get_items_by_category($cat_id) {
    global $db;
    $query = 'SELECT * FROM items
              WHERE CategoryId = :cat_id
              AND ItemId NOT IN (SELECT ItemId FROM reserved)
              AND ItemId NOT IN (SELECT ItemId FROM cart)
              ORDER BY Name';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':cat_id', $cat_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
// Get items not reserved
function get_items() {
    global $db;
    $query = 'SELECT * FROM items WHERE ItemId NOT IN (SELECT ItemID FROM reserved) ORDER BY Name';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_item($product_id) {
    global $db;
    $query = 'SELECT ItemId, Name, items.Img, items.CategoryId, CategoryType, Description, `condition`, Price
              FROM items
              JOIN category ON items.CategoryId = category.CategoryId
              WHERE ItemId = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
// TODO Add Image - Maybe Timestamp for date added
function add_item($category_id, $name, $description,
        $price) {
    global $db;
    $query = 'INSERT INTO items
                 (CategoryId, Name, Description, Price)
              VALUES
                 (:cat_id, :name, :description, :price,';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $product_id = $db->lastInsertId();
        return $product_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_item($product_id, $description, $price,  $category_id) {
    global $db;
    $query = 'UPDATE items
              SET description = :description,
                  listPrice = :price,
                  CategoryId = :category_id
              WHERE ItemId = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':category_id', $category_id);
        $statement->bindValue(':product_id', $product_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_item($product_id) {
    global $db;
    $query = 'DELETE FROM items WHERE ItemId = :product_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':product_id', $product_id);
        $row_count = $statement->execute();
        $statement->closeCursor();
        return $row_count;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>