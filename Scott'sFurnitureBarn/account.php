<?php
session_start();
include './models/database.php';
include './models/users.php';
include('modules/statesSnippet.php');
//var_dump($_SESSION);
// $_SESSION['UserId'] = 1;
// $_SESSION['isAdmin'] = false;
// $_SESSION['LoggedIn'] = true;
$_SESSION['Status Message'] = '';

if ($_SESSION['LoggedIn']) {
$number_test = is_numeric($_SESSION['UserId']);
} else {
$number_test = false;
}

if ($number_test) {
    $user_id = $_SESSION['UserId'];
    $user = get_user($user_id);
    $username = $_SESSION['UserName'];
} else {
    $_SESSION["notification"] .= "That page could not be accessed because you are not logged in. \n";
    echo 'You are not logged in.';
    header('Location: index.php');
    exit();
}

if (isset($_POST['update'])) {
    $_POST['username'] = trim($_POST['username']);
    $_POST['pswd'] = trim($_POST['pswd']);
    $_POST['phone'] = trim($_POST['phone']);
    $_POST['address'] = trim($_POST['address']);
    $_POST['city'] = trim($_POST['city']);
    $_POST['state'] = trim($_POST['state']);
    $_POST['zip'] = trim($_POST['zip']);

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'pswd');
    $phone = filter_input(INPUT_POST, 'phone');
    $address = filter_input(INPUT_POST, 'address');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $zip = filter_input(INPUT_POST, 'zip');
    $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
    $address_id = filter_input(INPUT_POST, 'address_id', FILTER_VALIDATE_INT);

    if ($password == NULL || $phone == NULL) {
        $error = 'Password and phone number are both required.';
        $_SESSION['notification'] .= "Password and phone number are both required. \n";
    } else if ($user_id == NULL || $address_id == NULL) {
        $error = 'The user ID or address ID are missing.';
        $_SESSION['notification'] .= "The user ID or address ID are missing. \n";        
    } else {
        // Update category in database
        update_user($phone, $username, $password, $user_id);
        update_address($address, $city, $zip, $state, $address_id);
        $_POST = [];
        $user = get_user($user_id);
        $_SESSION['Status Message'] = 'User data updated successfully.';
        $_SESSION['notification'] .= "User data updated successfully. \n";
        //header("Refresh: 0");

        //header("Location: account.php");
    }
}

?>
<!DOCTYPE html>
<?php include './modules/head.php'; ?>

<body>
    <?php include './modules/hero.php'; ?> 
    <main>
        <div>
            <?php include './modules/header.php'; ?>
        </div>
        <div class="container">
            <h3 class="my-3">Edit <?php echo $user['Name'] ?>'s profile</h3>
            <?php if ($_SESSION['Status Message']) {
                echo $_SESSION['Status Message'];
                unset($_SESSION['Status Message']);
            } ?>
            <?php if (isset($_GET['error'])) { ?>
            <p class="error"> <?php echo $_GET['error']; ?> </p>
            <?php } ?>
            <form action="" method="post">
            <div class="my-3 text-start">
                    <label class="text-start" for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['UserName']; ?>">
                </div>    
                <div class="my-3 text-start">
                    <label class="text-start" for="pwd">Password</label>
                    <input type="text" class="form-control" id="pwd" name="pswd" value="<?php echo $user['Password']; ?>">
                </div>    
                <div class="my-3 text-start">
                    <label class="text-start" for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $user['Phone']; ?>">
                </div>
                <div class="my-3 text-start">
                    <label class="text-start" for="address">Street Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $user['Streetaddress']; ?>">
                </div>   
                <div class="my-3 text-start">
                    <label class="text-start" for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $user['city']; ?>">
                </div>
                <div class="my-2">
                    <label for="state" class="form-label">State</label> <span class="text-danger small ms-3"></span>
                    <select name="state" id="state" class="form-select" aria-label="State">>
                    <?php foreach($states as $state) {
                        if ($state['code'] == $user['State']) {
                            echo PHP_EOL . <<<EOL
                        <option value="{$state['code']}" selected>{$state['name']}</option>
    EOL;             
                        } else {
                            echo PHP_EOL . <<<EOL
                        <option value="{$state['code']}">{$state['name']}</option>
    EOL;
                        } 
                    } ?>
                    </select>
                </div> 
                <div class="my-3 text-start">
                    <label class="text-start" for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" value="<?php echo $user['Zip']; ?>">
                </div>
                <input type="hidden" name="user_id" value="<?php echo $user['UserId']; ?>">  
                <input type="hidden" name="address_id" value="<?php echo $user['userAddressId']; ?>">  
                <button type="submit" name="update" class="btn btn-primary mb-3">Save Changes</button>
            </form>
        </div>
    </main>
    <footer>
        <?php include './modules/footer.php'; ?>
    </footer>
</body>

</html>