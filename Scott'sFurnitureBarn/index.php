<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
  $_SESSION['adminLoginError'] = false;
  $_SESSION['userLoginError'] = false;
}
?>
<?php if ($_SESSION['adminLoginError'] == true) { ?>
  <script src="admin/adminLogin/scripts/adminLoginError.js">
  </script>
<?php }
if ($_SESSION['userLoginError'] == true) { ?>
  <script src="login/scripts/userLoginError.js">
  </script>
<?php }
$_SESSION['adminLoginError'] = false;
$_SESSION['userLoginError'] = false; ?>
<!DOCTYPE html>
<?php include './modules/head.php'; ?>

<body>
  <?php include './modules/hero.php'; ?>
  <main>
    <div>
      <?php include './modules/header.php'; ?>
    </div>
    <?php include './modules/home.php'; ?>
  </main>
  <footer>
    <?php include './modules/footer.php'; ?>
  </footer>
</body>

</html>