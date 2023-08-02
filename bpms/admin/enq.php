<?php

session_start();

if (!isset($_SESSION['adminid'])) {
  header("Location: ../al.php");
  exit();
}

include('../includes/header1.php');
?>
<div class="container-fluid"> 
  <div class="admindh">
    <div class="row">
      <div class="col-md-4">
        <a href="admindash.php"><button type="button" class="btn btn-success btnmore"><i class="fa-solid fa-circle-left"></i> Back To The Admin Dashboard</button><br></a>
      </div>
      <div class="col-md-4">
        <h2 class="heading text-primary">User Enquiry <i class="fa-regular fa-comments"></i></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-hover ">
            <thead>
              <tr>
                <th>S.<br>No.</th>
                <th>Enquiry<br>No.</th>
                <th>User<br>Name</th>
                <th>Mobile<br>Number</th>
                <th>User<br>Message</th>
                <th>Enquiry<br>DateTime</th>
                <th>Action <br> Button</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once('../includes/connect.php');
              $sql = "select * from enquiry where status=1 order by enqno";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) == 0) { ?>
                <tr>
                  <td colspan="7" style="color:red; font-size:4vw">No Enquiry Found</td>
                </tr>
              <?php }
              $count = 1;
              while ($row = mysqli_fetch_array($result)) {
                $enqno = $row['enqno']; ?>
                <tr>
                  <th><?php echo $count; ?></th>
                  <td><?php echo $row['enqno']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['mobile']; ?></td>
                  <td><?php echo $row['message']; ?></td>
                  <td><?php echo date("d/m/Y", strtotime($row['date&time'])) ?> <br><?php echo date("h:i A", strtotime($row['date&time'])) ?></td>
                  <td><button data-id="<?= $enqno ?>" type="button" class="btn btn-danger tablebtn deleteenqbtn">Delete <i class="fa-solid fa-trash"></i></button></td>
                </tr>
              <?php
                $count++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once('../includes/footer.php') ?>