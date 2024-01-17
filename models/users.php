<?php
function get_user($user_id) {
    global $db;
    $query = 'SELECT UserId, CONCAT_WS(" ", FirstName, LastName) AS Name, Phone, users.AddressId AS userAddressId, UserName, Password, Streetaddress, city, State, Zip FROM users JOIN address ON users.AddressId = address.AddressId
              WHERE UserId = :user_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}

function add_user($firstname, $lastname, $email, $phone, $address_id, $user_name, $password, $birthday) {
    global $db;
    $query = 'INSERT INTO users (FirstName, LastName, Email, Phone, AddressId, UserName, Password, Birthday)
              VALUES (:firstname, :lastname, :email, :phone, :address_id, :user_name, :password, :birthday)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':firstname', $firstname);
        $statement->bindValue(':lastname', $lastname);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':address_id', $address_id);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':birthday', $birthday);
        $statement->execute();
        $statement->closeCursor();

    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}

function update_user($phone, $user_name, $password, $user_id) {
    global $db;
    $query = '
        UPDATE users
        SET 
            Phone = :phone,
            UserName = :user_name,
            Password = :password
        WHERE UserId = :user_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':user_name', $user_name);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function check_email($email) {
    global $db;
    $query = 'SELECT Email FROM users
              WHERE Email = :email';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function check_user($username) {
    global $db;
    $query = 'SELECT UserName FROM users
              WHERE UserName = :username';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
// Add Address to database
// will need get last ID
function add_address($street, $city, $state, $zip) {
    global $db;
    $query = 'INSERT INTO address
                 (Streetaddress, city, State, Zip)
              VALUES
                 (:street, :city, :state, :zip)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':street', $street);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':zip', $zip);
        $statement->execute();
        $last_id = $db->lastInsertId();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
function update_address($street, $city, $zip, $state, $address_id) {
    global $db;
    $query = 'UPDATE address
        SET 
            Streetaddress = :street,
            city = :city,
            Zip = :zip,
            State = :state
        WHERE AddressId = :address_id';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':street', $street);
        $statement->bindValue(':city', $city);
        $statement->bindValue(':zip', $zip);
        $statement->bindValue(':state', $state);
        $statement->bindValue(':address_id', $address_id);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        display_db_error($error_message);
    }
}
?>