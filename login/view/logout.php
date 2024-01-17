<link rel="stylesheet" href="login\styles\loginStyles.css">

<button type="button" class="btn btn-light mx-md-4 mx-sm-1" data-bs-toggle="modal" data-bs-target="#logoutModal">
  Logout
</button>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutTitle" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutTitle">Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center bg-light">
        <h4>Are you sure you want to logout?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <a class="btn btn-primary" href="login/userLogout.php">Logout</a>
      </div>
    </div>
  </div>
</div>