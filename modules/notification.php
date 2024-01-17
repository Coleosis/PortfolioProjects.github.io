<?php 
// Verify that $_SESSION["notification"] exists, if it doesn't then set it to ""
if (!isset($_SESSION["notification"])) {
    $_SESSION["notification"] = "";
}

// If the $_SESSION["notification"] is anything other than "",
if (($_SESSION["notification"] != "")) {
?>

<!-- Create the notificationModal, display the notification as the body. -->
<div class="modal fade in" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Notification</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <?php echo $_SESSION["notification"]?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- This could be a seperate js file, but it's so small and specific that it was left here. -->
<script type="text/javascript">
    $(window).on('load',function(){
        $('#notificationModal').modal('show');
    });
</script>
<?php
// clear the notification
$_SESSION["notification"] = "";
}
?>