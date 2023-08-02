<?php

session_start();

include('../includes/header1.php');

if (!isset($_SESSION['userid'])) {
  header("Location: ../ul.php");
  exit();
}

require_once('../includes/connect.php');
$sql = "select * from user where userid = '$_SESSION[userid]'";
$userdata = mysqli_query($conn, $sql);
$userdata = mysqli_fetch_assoc($userdata);
$sql = "select name from cities where id = '$userdata[city]'";
$temp = mysqli_query($conn, $sql);
$temp = mysqli_fetch_assoc($temp);
$userdata['city'] = $temp['name'];
$sql = "select name from states where id = '$userdata[state]'";
$temp = mysqli_query($conn, $sql);
$temp = mysqli_fetch_assoc($temp);
$userdata['state'] = $temp['name'];

mysqli_close($conn);
?>
<!-- Modal -->
<div class="modal fade" id="model_updateuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Update User Data</h5>
        </center>
        <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
        </button>
      </div>
      <div class="modal-body updateuser">
        <form name="updateuser" id="updateuser">
          <input type='hidden' value='updateuser' id='type' name='type'>
          <div class="row">
            <div class="col-md-6">
              <label for="name" class="form-label">Full Name:</label>
              <input name="name" type="text" value="" class="form-control form-control-sm fild" id="name">
            </div>
            <div class="col-md-6">
              <label for="gardian" class="form-label">Father's / Husband's Name:</label>
              <input name="gardian" type="text" value="" class="form-control form-control-sm fild" id="gardian">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="mobile" class="form-label">Mobile Number (10):</label>
              <input name="mobile" type="text" value="" class="form-control form-control-sm fild" id="mobile">
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email:</label>
              <input name="email" type="text" value="" class="form-control form-control-sm fild" id="email">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="age" class="form-label">Age:</label>
              <input name="age" type="text" value="" class="form-control form-control-sm fild" id="age">
            </div>
            <div class="col-md-6">
              <label for="address" class="form-label">Address:</label>
              <input name="address" type="text" value="" class="form-control form-control-sm fild" id="address">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label for="state" class="form-label">State:</label>
              <select name='state' class="form-select fild" id="state"></select>
            </div>
            <div class="col-md-6">
              <label for="city" class="form-label">City:</label>
              <select name='city' class="form-select fild" id="city">
                <option value="0">Select City</option>
              </select>
            </div>
          </div>
          <div class="row">
            <center>
              <input class="btn mybtn btn-success" value=' UPDATE ' type="submit" id='submit'><br>
            </center>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="model_changeuserpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class=" modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <center>
          <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Change Password</h5>
        </center>
        <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
        </button>
      </div>
      <div class="modal-body changeuserpass">
        <form name="changeuserpass" id="changeuserpass">
          <input type='hidden' value='changeuserpass' id='type' name='type'>
          <input name="opass" type="password" class="form-control form-control-sm fild" id="opass" placeholder="Old Password*">
          <input name="npass" type="password" class="form-control form-control-sm fild" id="npass" placeholder="New Password*">
          <input name="cpass" type="password" class="form-control form-control-sm fild" id="cpass" placeholder="Confirm New Password*">
          <br>
          <center><input class="btn mybtn btn-success" type="submit" value=" Change "></center>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid">
  <?php

  if (isset($_SESSION['red'])) {
    echo '<h3 class="text-danger text-bold text-center">Redirected... Please Logout User Account First</h3>';
    unset($_SESSION['red']);
  } ?>
  <div class="usrdash">
    <div class="row">
      <div class="col-md-12 ">
        <h3 class="heading"><i class="fa-solid fa-user"></i>User Dashboard</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <center>
          <button id='updateuserbtn' type="button" data-toggle="modal" data-target="#model_updateuser" class=" btn btn-primary dashbtn"> Edit Profile <i class="fa-solid fa-user-pen"></i></button><br>
          <button id='userpassbtn' type="button" data-toggle="modal" data-target="#model_changeuserpass" class=" btn btn-dark dashbtn"> Change Password <i class="fa-solid fa-lock"></i></button><br>
          <a href="userapp.php"><button type="button" class=" btn btn-info dashbtn">Appointment History</button><br></a>
          <a href="../ba.php"><button type="button" class=" btn btn-success  dashbtn">Book Appointment</button><br></a>
          <button id='logout' type="button" class=" btn btn-warning  dashbtn">Logout <i class="fa-solid fa-right-from-bracket"></i></button><br>
          <button id='udelete' data-id='<?= $_SESSION['userid'] ?>' type="button" class=" btn btn-danger dashbtn">Delete Account <i class="fa-solid fa-trash"></i></button>
        </center>
      </div>
      <div class="col-md-8">
        <div class="imgbox">
          <h3 class="head2"><u><b>User Details</b></u></h3>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Name:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['name'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Gardian Name:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['gardian'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Mobile Number:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['mobile'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Email:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['email'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Age:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['age'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Address:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['address'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>City:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['city'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>State:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= $userdata['state'] ?>
              </h4>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
              <h4>Profile Created:- </h4>
            </div>
            <div class="col-md-7">
              <h4 style="color: orangered;">
                <?= date('d F Y h:i A', strtotime($userdata['created'])); ?>
              </h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once('../includes/footer.php') ?>