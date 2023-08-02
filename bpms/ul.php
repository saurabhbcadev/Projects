<?php 

session_start();

if (isset($_SESSION['userid'])) {
   header("Location: user/userdash.php");
   exit();
 } 

include('includes/header.php');
 ?>
 <div class="container-fluid">
   <div class="row">
     <div class="col-md-4"></div>
     <div class="col-md-4 ">
       <div class="login">
         <h3 class='head2'><i class="fa-solid fa-user"></i>User Login</h3>
         <img src="image/logo.webp" class="logo1img mx-auto d-block"><br>
         <h2>WELCOME</h2>
         <p class='sr_para text-center'>Sign in by entering the information below</p>
         <form name="login" id="login" method="POST">
           <input type='hidden' value='ullogin' id='type' name='type'>
           <input name="mobile" type="text" class="form-control form-control-sm" id="mobile" placeholder="Mobile Number*"><br>
           <input name="password" type="password" class="form-control form-control-sm" id="password" placeholder="Password*"><br>
           <center><input class="btn mybtn btn-primary" type="submit" value="SIGN IN"></center>
         </form><br>
         <p>Don't have an account? <br><a style="font-size: 20px;" href="su.php">SIGN UP</a></p>
       </div>
     </div>
     <div class="col-md-4"></div>
   </div>
 </div>
 <?php require_once('includes/footer.php') ?>