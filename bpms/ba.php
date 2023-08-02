<?php

session_start();

if (isset($_SESSION['adminid'])) {
  header("Location: admin/admindash.php");
  $_SESSION['red'] = '';
  exit();
} else if (!isset($_SESSION['userid'])) {
  header("Location: user/popup.php");
  exit();
}

include('includes/header.php');
?>
<div class="container-fluid">
  <div class="bookapp">
    <div class="row barow">
      <div class="col-md-4">
        <a href="user/userapp.php"><button type="button" class="btn-rounded btn btn-dark btnmore"><i class="fa-solid fa-circle-left"></i> Go To The Appointment
            History</button><br></a>
      </div>
      <div class="col-md-4">
        <h2 class="us text-center">Book Appointment</h2><br>
      </div>
      <div class="col-md-3">
        <h4 style=" color: deeppink; padding: 1vw;"><i class="fa-solid fa-user fa-1x"></i>
          <?= isset($_SESSION['username']) ? $_SESSION['username'] : '' ?>
        </h4>
      </div>
    </div>
    <form name="bookapp" id="bookapp">
      <input type='hidden' value='bookapp' id='type' name='type'>
      <div class="row barow">
        <div class="col-md-6">
          <label for="date" class="form-label bafld">Select Appointment Date<span class='text-danger'>*</span></label>
          <input name="date" type="date" min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '+7 day')); ?>" class="form-control form-control-md bafld" id="badate"><br>
          <label for="time" class="form-label bafld">Select Appointment Time<span class='text-danger'>*</span> <span style="color:rgb(18, 14, 59);">(10:00 AM To 08:00 PM)</span> </label>
          <input name="time" type="time" class="form-control form-control-md bafld " id="batime">
        </div>
        <div class="col-md-6">
          <label for="message" class="form-label bafld">Enter Message (Optional)</label><br>
          <textarea style="margin-top: 8px;" maxlength="200" class="form-control bafld" name="message" id="bamessage" cols="40" rows="4"></textarea>
        </div>
      </div><br>
      <div class=bind>
        <div class="row p-3">
          <?php
          require_once('includes/connect.php');
          $sql = "SELECT `id`,`title`,`price` FROM `services` WHERE `status`='1'";
          $res = mysqli_query($conn, $sql);
          while ($row = mysqli_fetch_array($res)) {
          ?>
            <div class="col-md-3 mb-2">
              <input type="checkbox" name="<?php echo 'service_' . $row[0] ?>" value="<?php echo $row[1] . '|' . $row[2] ?>" class="form-check-input" id="<?php echo 'service_' . $row[0] ?>"><label class="form-check-label"><?php echo $row[1] ?> <span class="price">&#8377; <?php echo $row[2] ?>/-</span></label>
            </div>
          <?php } ?>
          <br>
        </div>
      </div>
      <div class="row">
        <center><input class="btn btn-rounded mybtn btn-success" type="submit" value="Book Appointment"></center>
      </div>
    </form>
  </div>
</div>
<?php require_once('includes/footer.php') ?>