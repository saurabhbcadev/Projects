<?php

session_start();

if (isset($_SESSION['userid'])) {
     $_SESSION['red']='';
   header("Location: user/userdash.php");
   exit();
 }

else if (isset($_SESSION['adminid'])) {
         $_SESSION['red']=''; 
   header("Location: admin/admindash.php");
   exit();
 }

include('includes/header.php');
 ?>
 <div class="container-fluid">
   <div class="signup text-center">
     <h1 class='heading'>Create An Account</h1>
     <img class="logoimg mx-auto d-block" src="image/logo.webp"><br>
     <h2 class='us text-center'>WELCOME</h2>
     <p class="sr_para text-center"> Register by entering the information below</p>
     <form name="signup" id="signup">
       <input type='hidden' value='signup' id='type' name='type'>
       <div class="row">
         <div class="col-md-6">
           <input name="name" type="text" class="form-control form-control-sm fild" id="name" placeholder="Full Name">
         </div>
         <div class="col-md-6">
           <input name="gardian" type="text" class="form-control form-control-sm fild" id="gardian" placeholder="Father's / Husband's Name">
         </div>
       </div>
       <div class="row">
         <div class="col-md-6">
           <input name="mobile" type="text" class="form-control form-control-sm fild" id="mobile" placeholder="Mobile Number (10)">
         </div>
         <div class="col-md-6">
           <input name="email" type="text" class="form-control form-control-sm fild" id="email" placeholder="Email">
         </div>
       </div>
       <div class="row">
         <div class="col-md-6">
           <input name="age" type="text" class="form-control form-control-sm fild" id="age" placeholder="Age">
         </div>
         <div class="col-md-6">
           <input name="address" type="text" class="form-control form-control-sm fild" id="address" placeholder="Address">
         </div>
       </div>
       <div class="row">
         <div class="col-md-6">
           <select name='state' class="form-select fild" id="state">
           </select>
         </div>
         <div class="col-md-6">
           <select name='city' class="form-select fild" id="city">
             <option value="0">Select City</option>
           </select>
         </div>
       </div>
       <div class="row">
         <div class="col-md-6">
           <input type="password" name="password" class="form-control form-control-sm fild" id="password" placeholder="Password">
         </div>
         <div class="col-md-6">
           <input type="password" name="cpassword" class="form-control form-control-sm fild" id="cpassword" placeholder="Confirm Password">
         </div>
       </div><br>
       <div class="row">
         <center>
           <input class="btn mybtn btn-success" value='Register' type="submit" id='submit'> <br><br>
           <p class='sr_para text-center'>Have Already An Account? <a href="ul.php">SIGN IN</a></p>
         </center>
       </div>
     </form>
   </div>
 </div>
 <?php require_once('includes/footer.php') ?>