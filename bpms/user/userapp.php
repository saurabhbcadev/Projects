<?php

session_start();

include('../includes/header1.php');
require_once('../includes/connect.php');

if (!isset($_SESSION['userid'])) {
  header("Location: ../ul.php");
  exit();
}
?>
<div class="container-fluid">
  <div class="modal fade" id="model_updateapp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <center>
            <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Update Appointment</h5>
          </center>
          <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
          </button>
        </div>
        <div class="modal-body updateapp">
          <form name="updateapp" id="updateapp">
            <input type='hidden' value='updateapp' id='type' name='type'>
            <input type='hidden' value='' id='appno' name='appno'>
            <input type='hidden' value='' id='userid' name='userid'>
            <input type='hidden' value='' id='pdate' name='pdate'>
            <div class="row barow">
              <div class="col-md-6">
                <label for="date" class="form-label bafld">Select Appointment Date<span class='text-danger'>*</span></label>
                <input name="date" type="date" value='' min="<?= date('Y-m-d'); ?>" max="<?= date('Y-m-d', strtotime(date('Y-m-d') . '+7 day')); ?>" class="form-control form-control-md bafld" id="date"><br>
              </div>
              <div class="col-md-6">
                <label for="time" class="form-label bafld">Select Appointment Time<span class='text-danger'>*</span> <span style="color:rgb(18, 14, 59);">(10:00 AM To 08:00 PM)</span> </label>
                <input name="time" type="time" value='' class="form-control form-control-md bafld " id="time">
              </div>
            </div><br>
            <div class=bind id='servicesContainer'>
              <div class="row p-3">
                <?php
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
            <center><input class="btn mybtn btn-success" type="submit" value=" Update "></center>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="apptab">
    <div class="row">
      <div class="col-md-4">
        <a href="userdash.php"><button type="button" class="btn-rounded btn btn-info btnmore"><i class="fa-solid fa-circle-left"></i> Back To The User Dashboard</button><br></a>
      </div>
      <div class="col-md-4">
        <h2 class="head2 text-bold"><u>Appointment History</u></h2>
      </div>
      <div class="col-md-4" style="text-align: end;">
        <a href="../ba.php"><button type="button" class="btn-rounded btn btn-warning btnmore">Book Another Appointment <i class="fa-solid fa-circle-right"></i></button><br></a>
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table id='userapptable' class="table table-hover">
            <thead>
              <tr>
                <th>S.<br>No.</th>
                <th>Appointment<br>Number</th>
                <th>Appointment<br>DateTime</th>
                <th>Booked <br> Services</th>
                <th>Total <br> Amount</th>
                <th>Booking <br> DateTime</th>
                <th>User <br> Message</th>
                <th>Appointment<br>Status</th>
                <th>Action <br> Buttons</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "select * from appointment where userid = '$_SESSION[userid]' AND `status1`=1 order by booking_datetime ";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) == 0) { ?>
                <tr>
                  <td colspan="9" style="color:red; font-size:5vw">You Have Not Booked Any Appointment Yet</td>
                </tr>
              <?php }
              $count = 1;
              while ($row = mysqli_fetch_array($result)) {
                $appno = $row['appno'];
                if ($row['status'] == 'Waiting For Confirmation') {
                  $isupdate = '1';
                } else {
                  $isupdate = '0';
                }
              ?>
                <tr>
                  <th><?php echo $count; ?></th>
                  <td><?php echo $row['appno']; ?></td>
                  <td><?php echo date("d/m/Y", strtotime($row['date'])); ?><br><?php echo date("h:i A", strtotime($row['time'])); ?></td>
                  <td><?php echo $row['services']; ?></td>
                  <td><?php echo $row['total_amount']; ?></td>
                  <td>
                    <?php echo date("d/m/Y", strtotime($row['booking_datetime'])); ?><br>
                    <?php echo date("h:i A", strtotime($row['booking_datetime'])); ?>
                  </td>
                  <td><?php echo $row['message']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td>
                    <?php
                    if ($isupdate == '1') {
                    ?>
                      <button data-id="<?= $row['appno']; ?>" type="button" data-toggle="modal" data-target="#model_updateapp" class="btn btn-warning tablebtn updateappbtn">Update <i class="fa-solid fa-pen-to-square"></i></button>
                    <?php } ?>
                    <button data-id="<?= $row['appno']; ?>" type="button" class="btn btn-danger tablebtn deleteappbtn">Delete <i class="fa-solid fa-trash"></i></button>
                  </td>
                </tr>
              <?php $count = $count + 1;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php

include('../includes/footer.php');
?>