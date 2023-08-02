<?php

include('../includes/header1.php'); ?>
<div class="container-fluid">
  <!-- Modal -->
  <div class="modal" data-backdrop="static" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" style='background-color:#c8f7f7'>
        <div class="modal-header">
          <h5 class="modal-title us text-center" id="exampleModalLongTitle">You Need To LOGIN or SIGN UP First To Book Your Appointment!</h5>
        </div>
        <div class="modal-body">
          <div class="d-flex justify-content-around gap-3 flex-wrap">
            <a href="../su.php" class="btn btn-success btn-lg">SIGN UP</a>
            <a href="../ul.php" class="btn btn-warning btn-lg">LOGIN</a>
            <a href="../index.php" class="btn btn-info btn-lg">HOME PAGE</a>
          </div>
        </div>
      </div>
    </div> 
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    $('#exampleModalCenter').modal('show'); // Show the modal when the page loads
  });
</script>
</script>
</body>

</html>