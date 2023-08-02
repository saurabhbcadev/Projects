<?php
include('includes/header.php');
?>
<div class="container-fluid">
  <div class="row box">
    <div class="col-md-12">
      <h1 class="us text-center">Photos</h1>
      <?php
      require_once('includes/connect.php');
      $sql = "SELECT `image` FROM `gallery` WHERE `status`='1' ORDER BY RAND()";
      $res = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_array($res)) {
        echo "<img class='imgbox rounded srimg' src='image/gallery/$row[0]' alt='$row[0]'>";
      }
      ?>
    </div>
  </div>
</div>
<?php include('includes/footer.php') ?>