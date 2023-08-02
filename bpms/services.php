<?php
include('includes/header.php');
?>
<div class="container-fluid">
  <div class="ourservices">Our Services</div>
  <div class="row box">
    <?php
    require_once('includes/connect.php'); 
    $sql = "SELECT `image`,`title`,`description`,`price` FROM `services` WHERE `status`='1'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
    ?>
      <div class="col-md-4">
        <div class="service">
          <img class="imgbox rounded" src='image/services/<?= $row['image'] ?>' width="96%">
          <h3><u> <?= $row['title'] ?> </u></h3>
          <p class="sr_para"> <?= $row['description'] ?> </p>
          <div class="d-flex justify-content-around">
            <button type="button" class="btn-rounded btn btn-warning btnsr">Price:- &#8377; <?= $row['price'] ?>/-</button>
            <a href="ba.php">
              <button type="button" class="btn-rounded btn btn-success btnsr">Book Appointment</button>
            </a>
          </div>
        </div>
      </div>
    <?php }
    ?>
  </div>
  <?php include('includes/footer.php') ?>