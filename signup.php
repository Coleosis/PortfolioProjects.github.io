<?php
session_start();
include('models/database.php');
include('models/users.php');
include('modules/statesSnippet.php');
//$error = '';
if (isset($_POST['create'])) {
    // Trim inputs
    $_POST['firstname'] = trim($_POST['firstname']);
    $_POST['lastname'] = trim($_POST['lastname']);    
    $_POST['account-username'] = trim($_POST['account-username']);
    $_POST['email'] = trim($_POST['email']);
    $_POST['account-password'] = trim($_POST['account-password']);
    $_POST['phone'] = trim($_POST['phone']);
    $_POST['street'] = trim($_POST['street']);
    $_POST['city'] = trim($_POST['city']);
    $_POST['state'] = trim($_POST['state']);
    $_POST['zip'] = trim($_POST['zip']);
    $_POST['birthday'] = trim($_POST['birthday']);


    $firstname = filter_input(INPUT_POST, 'firstname');    
    $lastname = filter_input(INPUT_POST, 'lastname');        
    $username = filter_input(INPUT_POST, 'account-username');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'account-password');
    $phone = filter_input(INPUT_POST, 'phone');
    $street = filter_input(INPUT_POST, 'street');
    $city = filter_input(INPUT_POST, 'city');
    $state = filter_input(INPUT_POST, 'state');
    $zip = filter_input(INPUT_POST, 'zip');
    $birthday = filter_input(INPUT_POST, 'birthday');
    
    $birthday = strtotime($birthday);
    $birthday_insert = date('Y-m-d', $birthday);

    if ($firstname == NULL || $lastname == NULL || $email == NULL || $username == NULL || $password == NULL || $phone == NULL || $street == NULL || $city == NULL || $state == NULL || $zip == NULL) {            
        $_SESSION['notification'] .= "Invalid user data. Check all fields and try again. \n";
    } else {
        $email_check = check_email($email);
        $user_check = check_user($username);
        if($email_check != NULL || $email_check != FALSE || $email_check != 0) {
            $_SESSION['notification'] .= "This email address is already in use. Please try another email address. \n";
        } else if ($user_check != NULL || $user_check != FALSE || $user_check != 0) {
            $_SESSION['notification'] .= "This username is already in use. Please try another username. \n";
        } else {
            // Add item to database
            add_address($street, $city, $state, $zip);
            $last_id = $db->lastInsertId();
            add_user($firstname, $lastname, $email, $phone, $last_id, $username, $password, $birthday_insert);
            unset($_POST);
            $_SESSION['Status Message'] = 'Your account has been successfully created.';   
            
            // This is to actually log in the user after
            $stmt = $db->prepare("SELECT * FROM users WHERE UserName = :username OR Email = :username AND Password = :password");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);  

            if ($row) {
                $_SESSION['LoggedIn'] = true;
                $_SESSION['UserName'] = $row['UserName'];
                $_SESSION['UserId'] = $row['UserId'];
                $_SESSION['FirstName'] = $row['FirstName'];
                $_SESSION['notification'] .= $firstname . " " . $lastname . "'s account has been successfully created. \n";
                header("Location: index.php");
                exit();
            }
            else {
                $_SESSION['notification'] .= "An error has occurred with the server. Please contact support for help creating an account.";
            } 
            
        }
    }
}

?>
<!DOCTYPE html>
<?php include './modules/head.php'; ?>
<link rel="stylesheet" href="scripts/jquery-ui-1.13.2.custom/jquery-ui.min.css">
<body>
  <?php include './modules/hero.php'; ?>
  <main>
    <div>
      <?php include './modules/header.php'; ?>
    </div>
    <div class="container">
        <h3 class="my-2">Sign Up</h3>
        <form action="" method="post" id="account" class="mb-5">
            <div class="my-2 text-start">
                <label for="firstname" class="form-label">First Name</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php if (isset($_POST['firstname'])){ echo $_POST['firstname'];}; ?>">
            </div>            
            <div class="my-2 text-start">
                <label for="lastname" class="form-label">Last Name</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php if (isset($_POST['lastname'])){ echo $_POST['lastname'];}; ?>">
            </div>                  
            <div class="my-2 text-start">
                <label for="account-username" class="form-label">Username</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="account-username" name="account-username" value="<?php if (isset($_POST['account-username'])){ echo $_POST['account-username'];}; ?>">
            </div>
            <div class="my-2 text-start">
                <label for="email" class="form-label">Email</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="email" name="email" value="<?php if (isset($_POST['email'])){ echo $_POST['email'];}; ?>">
            </div>
            <div class="my-2">
                <label for="verify-email" class="form-label">Verify Email</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="verify-email" name="verify-email" value="<?php if (isset($_POST['verify-email'])){ echo $_POST['verify-email'];}; ?>">
            </div>
            <div class="my-2 text-start">
                <label for="account-password" class="form-label">Password</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="account-password" name="account-password" value="<?php if (isset($_POST['account-password'])){ echo $_POST['account-password'];}; ?>">
            </div>
            <div class="my-2">
                <label for="phone" class="form-label">Phone</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="phone" name="phone" aria-describedby="aptPhoneHelp" placeholder="123-456-7890" value="<?php if (isset($_POST['phone'])){ echo $_POST['phone'];}; ?>">
                <div id="aptPhoneHelp" class="form-text">Example: 555-555-5555</div>
            </div>
            <div class="my-2">
                <label for="street" class="form-label">Street Address</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="street" name="street" value="<?php if (isset($_POST['street'])){ echo $_POST['street'];}; ?>">
            </div>
            <div class="my-2">
                <label for="city" class="form-label">City</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="city" name="city" value="<?php if (isset($_POST['city'])){ echo $_POST['city'];}; ?>">
            </div>
            <div class="my-2">
                <label for="state" class="form-label">State</label> <span class="text-danger small ms-3"></span>
                <select name="state" id="state" class="form-select" aria-label="State">>
                <?php foreach($states as $state) {
                    if ($state['name'] == 'Idaho') {
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
            <div class="my-2">
                <label for="zip" class="form-label">Zip</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="zip" name="zip" value="<?php if (isset($_POST['zip'])){ echo $_POST['zip'];}; ?>">
            </div>            
            <div class="my-2">
                <label for="birthday" class="form-label">Birthday</label> <span class="text-danger small ms-3"></span>
                <input type="text" class="form-control" id="birthday" name="birthday" aria-describedby="aptDateHelp" placeholder="12/31/2000" value="<?php if (isset($_POST['birthday'])){ echo $_POST['birthday'];}; ?>">
                <div id="aptDateHelp" class="form-text">Example: 12/31/2000</div>
            </div>
            <button type="submit" class="btn btn-primary mt-3" name="create" id="submit-form">Create Account</button>
        </form>
    </div>
  </main>
    <?php include './modules/footer.php'; ?>
    <script src="scripts/create-account-validator.js"></script>
    <script src="scripts/jquery-ui-1.13.2.custom/jquery-ui.min.js"></script>
    <script>
        $( "#birthday" ).datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
        });
    </script>
</body>

</html>