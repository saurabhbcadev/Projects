<?php
session_start();
if (!isset($_SESSION['adminid'])) {
    header("Location: ../al.php");
    exit();
}
include('../includes/header1.php');
require_once('../includes/connect.php');
$sql = "select * from admin where adminid = '$_SESSION[adminid]'";
$admindata = mysqli_query($conn, $sql);
$admindata = mysqli_fetch_assoc($admindata);
?>
<div class="modal fade" id="model_changeadminpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            <div class="modal-body changeadminpass">
                <form name="changeadminpass" id="changeadminpass">
                    <input type='hidden' value='changeadminpass' id='type' name='type'>
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
<div class="modal fade" id="model_addgallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Upload Image</h5>
                </center>
                <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
                </button>
            </div>
            <div class="modal-body p-2 addgallery">
                <form name="addgallery" id="addgallery">
                    <input type='hidden' value='addgallery' id='type' name='type'>
                    <label class='form-label head2'>Select Images<span class='text-danger'>*</span></label>
                    <p class='text-danger'>Image Size > 1 MB</p>
                    <p class='text-danger'>Image Ratio: 1:1 (Square)</p>
                    <input type="file" id="imgaddgallery" class="form-control form-control-md" name="images[]" accept="image/*" multiple>
                    <br>
                    <div class="spin mt-2 text-center text-primary">
                        <span class="spinner-border spinner-border-md"></span>
                    </div>
                    <center><input class="btn mybtn btn-success mt-2" type="submit" value=" Upload "></center>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="model_editgallery" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Edit Image</h5>
                </center>
                <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
                </button>
            </div>
            <div class="modal-body p-2">
                <h4 class="text-danger text-center">Click on the image to delete image</h4>
                <div class="editgallery text-center">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="model_addservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Add Service</h5>
                </center>
                <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
                </button>
            </div>
            <div class="modal-body p-2 addservice">
                <form name="addservice" id="addservice">
                    <input type='hidden' value='addservice' id='type' name='type'>
                    <label class='form-label' style='color:darkorchid'>Select Image(>1 MB & 1:1 )<span class='text-danger'>*</span></label>
                    <input type="file" id="imgaddservice" class="form-control form-control-md" name="image" accept="image/*">
                    <label class='form-label mt-3' style='color:darkorchid'>Title(>20 Character)<span class='text-danger'>*</span></label>
                    <input type="text" id="title" class="form-control form-control-md" name="title">
                    <label class='form-label mt-3' style='color:darkorchid'>Description(Approx 75 Words)<span class='text-danger'>*</span></label>
                    <textarea name="description" id='description' class=" mt-2 form-control rounded" rows="3"></textarea>
                    <label class='form-label mt-3' style='color:darkorchid'>Price<span class='text-danger'>*</span></label>
                    <input type="text" id="price" class="form-control form-control-md" name="price">
                    <br>
                    <div class="spin mt-2 text-center text-primary">
                        <span class="spinner-border spinner-border-md"></span>
                    </div>
                    <center><input class="btn mybtn btn-success mt-2" type="submit" value=" ADD "></center>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="model_addadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Add Admin</h5>
                <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
                </button>
            </div>
            <div class="modal-body p-2 addadmin">
                <form name="addadmin" id="addadmin">
                    <input type='hidden' value='addadmin' id='type' name='type'>
                    <label class='form-label' style='color:darkorchid'>Select Image(>1 MB & 1:1 )<span class='text-danger'>*</span></label>
                    <input type="file" id="imgaddadmin" class="form-control form-control-md" name="image" accept="image/*">
                    <label class='form-label mt-3' style='color:darkorchid'>Admin Name<span class='text-danger'>*</span></label>
                    <input type="text" id="name" class="form-control form-control-md" name="name">
                    <label class='form-label mt-3' style='color:darkorchid'>Mobile Number<span class='text-danger'>*</span></label>
                    <input type="text" id="mobile" class="form-control form-control-md" name="mobile">
                    <label class='form-label mt-3' style='color:darkorchid'>Designation<span class='text-danger'>*</span></label>
                    <input type="text" id="desg" class="form-control form-control-md" name="desg">
                    <label class='form-label mt-3' style='color:darkorchid'>Password<span class='text-danger'>*</span></label>
                    <input type="password" id="pass" class="form-control form-control-md" name="pass">
                    <label class='form-label mt-3' style='color:darkorchid'>Confirm Password<span class='text-danger'>*</span></label>
                    <input type="password" id="cpass" class="form-control form-control-md" name="cpass">
                    <label class='form-label mt-3' style='color:magenta'>PASSKEY<span class='text-danger'>*</span></label>
                    <input type="password" id="key" class="form-control form-control-md" name="key">
                    <br>
                    <div class="spin mt-2 text-center text-primary">
                        <span class="spinner-border spinner-border-md"></span>
                    </div>
                    <center><input class="btn mybtn btn-success mt-2" type="submit" value=" ADD "></center>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="model_editservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="head2 text-bold text-primary" id="exampleModalLabel"> Edit Services</h5>
                </center>
                <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
                </button>
            </div>
            <div class="modal-body editservice">
                <div class="table-responsive">
                    <table class="table table-hover servicetable">
                        <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Buttons</th>
                            </tr>
                        </thead>
                        <tbody class='addservicetab'>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="model_updateservice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class=" modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="head2 text-bold text-primary" id="exampleModalLabel">Update Service</h5>
                </center>
                <button id='closebtn' type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-xmark text-danger"></i></i></span>
                </button>
            </div>
            <div class="modal-body p-2 updateservice">
                <form name="updateservice" id="updateservice">
                    <input type='hidden' value='updateservice' id='type' name='type'>
                    <input type='hidden' value='' id='id' name='id'>
                    <input type='hidden' value='' id='img' name='img'>
                    <label class='form-label' style='color:darkorchid'>Select Image(>1 MB & 1:1 ) <span class='text-dark'>(If you want to replace image then select new image otherwise leave this input blank)</span><span class='text-danger'>*</span></label>
                    <input type="file" id="imgaddservice" class="form-control form-control-md" name="image" accept="image/*">
                    <label class='form-label mt-3' style='color:darkorchid'>Title(>20 Character)<span class='text-danger'>*</span></label>
                    <input type="text" id="title" class="form-control form-control-md" name="title">
                    <label class='form-label mt-3' style='color:darkorchid'>Description(Approx 75 Words)<span class='text-danger'>*</span></label>
                    <textarea name="description" id='description' class=" mt-2 form-control rounded" rows="3"></textarea>
                    <label class='form-label mt-3' style='color:darkorchid'>Price<span class='text-danger'>*</span></label>
                    <input type="text" id="price" class="form-control form-control-md" name="price">
                    <br>
                    <div class="spin mt-2 text-center text-primary">
                        <span class="spinner-border spinner-border-md"></span>
                    </div>
                    <center><input class="btn mybtn btn-success mt-2" type="submit" value=" UPDATE "></center>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <?php
    if (isset($_SESSION['red'])) {
        echo '<h3 class="text-danger address text-center">Redirected... Please Logout Admin Account First</h3>';
        unset($_SESSION['red']);
    } ?>
    <div class="admindh">
        <h3 class="heading text-info mb-4"><i class="fa-solid fa-user-gear"></i> Admin Dashboard</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="admbox text-center">
                    <a href="appointment.php"><button type="button" class=" btn btn-info dashbtn"> Appointments <i class="fa-solid text-primary fa-circle-question"></i> <i class="fa-solid text-success fa-circle-check"></i> <i class="fa-solid text-danger fa-circle-xmark"></i></button></a><br>
                    <a href="userlist.php"><button class=" btn btn-success dashbtn"> Users List <i class="fa-solid fa-user"></i></button></a><br>
                    <a href="enq.php"><button type="button" class=" btn btn-primary dashbtn">User's Enquiries <i class="fa-regular fa-comments"></i></button><br></a>
                    <button id='adminpassbtn' type="button" data-toggle="modal" data-target="#model_changeadminpass" type="button" class=" btn btn-warning  dashbtn">Change Password <i class="fa-solid fa-lock"></i></button><br>
                    <button id='logout' type="button" class=" btn btn-danger dashbtn"> Logout <i class="fa-solid fa-right-from-bracket "></i></button>
                </div>
            </div>
            <div class="col-md-4 admdetail">
                <div class="admbox">
                    <h3 class="head2"><u><b>Admin Details</b></u></h3>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img class='img-thumbnail rounded-circle imgadmin' src='../image/team/<?= $admindata['picture'] ?>' alt='team' title='Team'>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <h5>Name:- </h5>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: orangered;">
                                <?= $admindata['name'] ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <h5>Admin Id:- </h5>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: orangered;">
                                <?= $admindata['adminid'] ?>
                            </h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <h5>Designation:- </h5>
                        </div>
                        <div class="col-md-6">
                            <h5 style="color: orangered;">
                                <?= $admindata['designation'] ?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="admbox text-center">
                    <button id='btnaddgallery' type="button" data-toggle="modal" data-target="#model_addgallery" type="button" class=" btn btn-success dashbtn">Add New Photos <i class="fa-solid fa-plus"></i></button>
                    <button id='btneditgallery' type="button" data-toggle="modal" data-target="#model_editgallery" class=" btn btn-danger dashbtn">Edit Existing Photos <i class="fa-solid fa-pen-to-square"></i></button>
                    <button id='btnaddservice' type="button" data-toggle="modal" data-target="#model_addservice" type="button" class=" btn btn-success  dashbtn">Add New Service <i class="fa-solid fa-plus"></i></button>
                    <button id='btneditservice' type="button" data-toggle="modal" data-target="#model_editservice" class=" btn btn-danger dashbtn">Edit Existing Services <i class="fa-solid fa-pen-to-square"></i></button>
                    <button id='btnaddadmin' type="button" data-toggle="modal" data-target="#model_addadmin" class=" btn btn-primary dashbtn">Add New Admin <i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('../includes/footer.php') ?>