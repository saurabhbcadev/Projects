<?php

session_start();
require_once('../includes/connect.php');
if (!isset($_SESSION['adminid'])) {
  header("Location: ../al.php");
  exit();
}

include('../includes/header1.php');
?>
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
<div class="container-fluid">
  <div class="admindh">
    <div class="row">
      <div class="col-md-3">
        <a href="admindash.php"><button type="button" class="btn btn-success btnmore"><i class="fa-solid fa-circle-left"></i> Back To The Dashboard</button><br></a>
      </div>
      <div class="col-md-6">
        <h2 class="heading"> Appointments <i class="fa-solid text-primary fa-circle-question"></i> <i class="fa-solid text-success fa-circle-check"></i> <i class="fa-solid text-danger fa-circle-xmark"></i></h2>
      </div>
    </div><br>
    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-tabs d-flex justify-content-around" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active bg-warning text-dark text-bold mb-3" id="new-tab" data-toggle="tab" href="#newapp" role="tab" aria-controls="new" aria-selected="true">New Appointments <i class="fa-solid fa-circle-question"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-success text-light text-bold mb-3" id="selected-tab" data-toggle="tab" href="#selectedapp" role="tab" aria-controls="selectedapp" aria-selected="false">Selected Appointments <i class="fa-solid fa-circle-check"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-danger  text-light text-bold mb-3" id="rejected-tab" data-toggle="tab" href="#rejectedapp" role="tab" aria-controls="rejectedapp" aria-selected="false">Rejected Appointments <i class="fa-solid fa-circle-xmark"></i></a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="newapp" role="tabpanel" aria-labelledby="new-tab">
            <br>
            <h2 class='head2 text-dark'>New Appointment <i class="fa-solid fa-circle-question"></i> </h2>
            <div class="table-responsive">
              <table class="table table-hover ">
                <thead>
                  <tr>
                    <th>S.<br>No.</th>
                    <th>Appointment<br>Number</th>
                    <th>Client<br>Name</th>
                    <th>Mobile<br>Number</th>
                    <th>Appointment<br>DateTime</th>
                    <th>Booked <br> Services</th>
                    <th>Total <br> Amount</th>
                    <th>Booking <br> DateTime</th>
                    <th>User <br> Message</th>
                    <th>Action <br> Buttons</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "select * from appointment where status = 'Waiting For Confirmation' order by `id` DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) == 0) { ?>
                    <tr>
                      <td colspan="10" style="color:red; font-size:4vw">No New Appointment</td>
                    </tr>
                  <?php }
                  $count = 1;
                  while ($row = mysqli_fetch_array($result)) {
                    $sql = "select name,mobile from user where userid = '$row[userid]'";
                    $temp = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($temp)) {
                      $temp = mysqli_fetch_assoc($temp);
                      $row['name'] = $temp['name'];
                      $row['mobile'] = $temp['mobile'];
                    } else {
                      $row['name'] = '';
                      $row['mobile'] = '';
                    }
                    $appno = $row['appno']; ?>
                    <tr>
                      <th><?php echo $count; ?></th>
                      <td><?php echo $row['appno']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['mobile']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($row['date'])) ?> <br><?php echo date("h:i A", strtotime($row['time'])) ?></td>
                      <td><?php echo $row['services']; ?></td>
                      <td><?php echo $row['total_amount']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($row['booking_datetime']));
                          echo '<br>';
                          echo date("h:i A", strtotime($row['booking_datetime'])) ?></td>
                      <td><?php echo $row['message'] ?></td>
                      <td><button data-id="<?= $row['appno']; ?>" type="button" class="btn btn-warning tablebtn selectappbtn"> Select <i class="fa-solid text-light fa-circle-check"></i> </button><button data-id="<?= $row['appno']; ?>" type="button" class="btn btn-danger tablebtn rejectappbtn"> Reject <i class="fa-solid text-info fa-circle-xmark"></i> </button></td>
                    </tr>
                  <?php $count = $count + 1;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="selectedapp" role="tabpanel" aria-labelledby="selected-tab">
            <br>
            <h2 class='head2'>Selected Appointment <i class="fa-solid fa-circle-check"></i> </h2>
            <div class="table-responsive">
              <table class="table table-hover ">
                <thead>
                  <tr>
                    <th>S.<br>No.</th>
                    <th>Appointment<br>Number</th>
                    <th>Client<br>Name</th>
                    <th>Mobile<br>Number</th>
                    <th>Appointment<br>DateTime</th>
                    <th>Booked <br> Services</th>
                    <th>Total <br> Amount</th>
                    <th>Booking <br> DateTime</th>
                    <th>User <br> Message</th>
                    <th>Action <br> Buttons</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "select * from appointment where status = 'Selected' order by `id` DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) == 0) { ?>
                    <tr>
                      <td colspan="10" style="color:red; font-size:4vw">No Selected Appointment</td>
                    </tr>
                  <?php }
                  $count = 1;
                  while ($row = mysqli_fetch_array($result)) {
                    $sql = "select name,mobile from user where userid = '$row[userid]'";
                    $temp = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($temp)) {
                      $temp = mysqli_fetch_assoc($temp);
                      $row['name'] = $temp['name'];
                      $row['mobile'] = $temp['mobile'];
                    } else {
                      $row['name'] = '';
                      $row['mobile'] = '';
                    }
                    $appno = $row['appno']; ?>
                    <tr>
                      <th><?php echo $count; ?></th>
                      <td><?php echo $row['appno']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['mobile']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($row['date'])) ?> <br><?php echo date("h:i A", strtotime($row['time'])) ?></td>
                      <td><?php echo $row['services']; ?></td>
                      <td><?php echo $row['total_amount']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($row['booking_datetime']));
                          echo '<br>';
                          echo date("h:i A", strtotime($row['booking_datetime'])) ?></td>
                      <td><?php echo $row['message'] ?></td>
                      <td><button data-id="<?= $row['appno']; ?>" data-toggle="modal" data-target="#model_updateapp" type="button" class="btn btn-warning tablebtn updateappbtn"> Update <i class="fa-solid fa-pen-to-square"></i> </button><a href="invoice.php?appno=<?= $row['appno']; ?>"><button type="button" class="btn btn-primary tablebtn"> Invoice <i class="fa-solid text-dark fa-print"></i> </button></a><button data-id="<?= $row['appno']; ?>" type="button" class="btn btn-danger tablebtn deleteappbtn"> Delete <i class="fa-solid text-light fa-trash"></i> </button></td>
                    </tr>
                  <?php $count = $count + 1;
                  } ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="rejectedapp" role="tabpanel" aria-labelledby="rejected-tab">
            <br>
            <h2 class='head2 text-danger'>Rejected Appointment <i class="fa-solid fa-circle-xmark"></i> </h2>
            <div class="table-responsive">
              <table class="table table-hover ">
                <thead>
                  <tr>
                    <th>S.<br>No.</th>
                    <th>Appointment<br>Number</th>
                    <th>Client<br>Name</th>
                    <th>Mobile<br>Number</th>
                    <th>Appointment<br>DateTime</th>
                    <th>Booked <br> Services</th>
                    <th>Total <br> Amount</th>
                    <th>Booking <br> DateTime</th>
                    <th>User <br> Message</th>
                    <th>Action <br> Buttons</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "select * from appointment where status = 'Rejected' order by `id` DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) == 0) { ?>
                    <tr>
                      <td colspan="10" style="color:red; font-size:4vw">No Rejected Appointment</td>
                    </tr>
                  <?php }
                  $count = 1;
                  while ($row = mysqli_fetch_array($result)) {
                    $sql = "select name,mobile from user where userid = '$row[userid]'";
                    $temp = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($temp)) {
                      $temp = mysqli_fetch_assoc($temp);
                      $row['name'] = $temp['name'];
                      $row['mobile'] = $temp['mobile'];
                    } else {
                      $row['name'] = '';
                      $row['mobile'] = '';
                    }
                    $appno = $row['appno']; ?>
                    <tr>
                      <th><?php echo $count; ?></th>
                      <td><?php echo $row['appno']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['mobile']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($row['date'])) ?> <br><?php echo date("h:i A", strtotime($row['time'])) ?></td>
                      <td><?php echo $row['services']; ?></td>
                      <td><?php echo $row['total_amount']; ?></td>
                      <td><?php echo date("d/m/Y", strtotime($row['booking_datetime']));
                          echo '<br>';
                          echo date("h:i A", strtotime($row['booking_datetime'])) ?></td>
                      <td><?php echo $row['message'] ?></td>
                      <td><button data-id="<?= $row['appno']; ?>" type="button" class="btn btn-danger tablebtn deleteappbtn"> Delete <i class="fa-solid fa-trash"></i> </button></td>
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
  </div>
  <?php require_once('../includes/footer.php') ?>