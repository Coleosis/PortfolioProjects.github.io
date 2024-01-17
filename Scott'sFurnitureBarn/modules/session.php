<?php
if (isset($_SESSION)) {
} else {
    session_start();
    $_SESSION['LoggedIn'] = false;
}
$_SESSION['userLoginError'] = false;
$_SESSION['adminLoginError'] = false;
$_SESSION['cartCount'] = 0;

// if ($_SESSION['LoggedIn'] = false) {
//     $_SESSION['UserId'] = 0;
// }
