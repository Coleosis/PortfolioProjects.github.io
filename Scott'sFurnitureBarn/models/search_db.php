<?php
function search_items($search) {
    global $db;
    $query = 'SELECT * FROM items WHERE MATCH(`Name`, `Description`) AGAINST (:search)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':search', $search);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}