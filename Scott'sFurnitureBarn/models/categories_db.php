<?php
function get_categories() {
    global $db;
    $query = 'SELECT * FROM category
              ORDER BY categoryID';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function get_category($cat_id) {
    global $db;
    $query = 'SELECT * FROM category
              WHERE CategoryId = :category_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':category_id', $cat_id);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function add_category($name) {
    global $db;
    $query = 'INSERT INTO categories (CategoryType)
              VALUES (:name)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->execute();
        $statement->closeCursor();

        // Get the last product ID that was automatically generated
        $category_id = $db->lastInsertId();
        return $category_id;
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_category($cat_id, $name) {
    global $db;
    $query = '
        UPDATE categories
        SET CategoryType = :name
        WHERE CategoryId = :cat_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':cat_id', $cat_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function delete_category($cat_id) {
    global $db;
    $query = 'DELETE FROM categories WHERE CategoryId = :cat_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':cat_id', $cat_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function get_product_count($cat_id) {
    global $db;
    $query = 'SELECT COUNT(*) AS productCount
              FROM items
              WHERE CategoryId = :cat_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':cat_id', $cat_id);
    $statement->execute();
    $result = $statement->fetchAll();
    $statement->closeCursor();

    $product_count = $result[0]['productCount'];
    return $product_count;
}

?>