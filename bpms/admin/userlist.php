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
        <h2 class="heading text-primary">User List <i class="fa-solid fa-user"></i></h2>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="table-responsive">
          <table class="table table-hover ">
            <thead>
              <tr>
                <th>S.<br>No.</th>
                <th>User<br>Id</th>
                <th>User<br>Name</th>
                <th>Gardian<br>Name</th>
                <th>Mobile<br>Number</th>
                <th>User<br>Email</th>
                <th>User <br> Age</th>
                <th>User <br> Address</th>
                <th>User <br> City</th>
                <th>User <br> State</th>
                <th>Account<br>Created</th>
                <th>Action <br> Button</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once('../includes/connect.php');
              $sql = "select * from user where `status` = 1";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) == 0) { ?>
                <tr>
                  <td colspan="12" style="color:red; font-size:4vw">No User Found</td>
                </tr>
              <?php }
              $count = 1;
              while ($row = mysqli_fetch_array($result)) {
                $sql = "select name from cities where id = '$row[city]'";
                $temp = mysqli_query($conn, $sql);
                $temp = mysqli_fetch_assoc($temp);
                $row['city'] = $temp['name'];
                $sql = "select name from states where id = '$row[state]'";
                $temp = mysqli_query($conn, $sql);
                $temp = mysqli_fetch_assoc($temp);
                $row['state'] = $temp['name'];
                 ?>
                <tr>
                  <th><?php echo $count; ?></th>
                  <td><?php echo $row['userid']; ?></td>
                  <td><?php echo $row['name']; ?></td>
                  <td><?php echo $row['gardian']; ?></td>
                  <td><?php echo $row['mobile']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['age']; ?></td>
                  <td><?php echo $row['address']; ?></td>
                  <td><?php echo $row['city']; ?></td>
                  <td><?php echo $row['state']; ?></td>
                  <td><?php echo date("d/m/Y", strtotime($row['created'])) ?> <br><?php echo date("h:i A", strtotime($row['created'])) ?></td>
                  <td><button data-id="<?= $row['userid'] ?>" type="button" class="btn btn-danger tablebtn dltuserbton">Delete <i class="fa-solid fa-trash"></i></button></td>
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
<?php require_once('../includes/footer.php') ?>