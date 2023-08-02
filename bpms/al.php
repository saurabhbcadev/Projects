<?php

session_start();

if (isset($_SESSION['adminid'])) {
  header("Location: admin/admindash.php");
  exit();
}

include('includes/header.php');
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 ">
      <div class="alogin">
        <h3 class='head2'><i class="fa-solid fa-user-gear"></i>Admin Login</h3>
        <img src="image/logo.webp" class="logo1img mx-auto d-block"><br>
        <h2>WELCOME</h2>
        <p class='sr_para text-center'>Login by entering the information below</p>
        <form name="alogin" id="alogin" method="POST">
          <input type='hidden' value='alogin' id='type' name='type'>
          <input name="adminid" type="text" class="form-control form-control-sm" id="adminid" placeholder="Admin Id*"><br>
          <input name="password" type="password" class="form-control form-control-sm" id="password" placeholder="Password*"><br>
          <center><input class="btn mybtn btn-info" type="submit" value="LOGIN"></center>
        </form><br>
      </div>
    </div>
    <div class="col-md-4"></div>
  </div>
</div>
<?php require_once('includes/footer.php') ?>