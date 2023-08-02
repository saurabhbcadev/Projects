<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
require_once('connect.php');
$ct = date("Y-m-d H:i:s");
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : 0;
$adminid = isset($_SESSION['adminid']) ? $_SESSION['adminid'] : 0;

if (isset($_POST['type']) && $_POST['type'] == 'enquiry') {
    $msg = str_replace(array('\'', '"', '<', '>'), '', $_POST['message']);
    $sql = "insert into enquiry(name,mobile,message) values('$_POST[name]','$_POST[mobile]','$msg')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'bookapp') {
    $sql = "select * from appointment where userid = '$_SESSION[userid]' AND date = '$_POST[date]'";
    $userdata = mysqli_query($conn, $sql);
    if (mysqli_num_rows($userdata) == 0) {
        $services = NULL;
        $amounts = NULL;
        $ta = 0;
        for ($i = 1; $i <= 50; $i++) {
            if (isset($_POST['service_' . $i])) {
                $data = $_POST['service_' . $i];
                $data = explode("|", $data);
                $services = $services . $data[0] . ', ';
                $amounts = $amounts . $data[1] . ', ';
                $ta = $ta + intval($data[1]);
            }
        }
        $services = substr($services, 0, -2);
        $amounts = substr($amounts, 0, -2);
        $appno = date('d');
        if ($appno < 10) {
            $appno = '0' . $appno;
        }
        $appno .= substr(strval($_SESSION['userid']), -2) . substr(strval(time()), -2);
        $msg = str_replace(array('\'', '"', '<', '>'), '', $_POST['message']);
        $sql = "insert into appointment(appno,userid,date,time,services,message,amounts,total_amount) values('$appno','$_SESSION[userid]','$_POST[date]','$_POST[time]','$services','$msg','$amounts',$ta)";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo 'Appointment Booked For ' . $services . ' Successfully. Your Appointment Number = ' . $appno . ' And Total Amount = ' . $ta . '/-';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo '2';
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'state') {
    $state_id = $_POST["state_id"];
    $result = mysqli_query($conn, "SELECT * FROM states");
?>
    <option value="0">Select State</option>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
    <?php
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'city') {
    $state_id = $_POST["state_id"];
    $result = mysqli_query($conn, "SELECT * FROM cities where state_id = $state_id");
    ?>
    <option value="0">Select City</option>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <option value="<?php echo $row["id"]; ?>"><?php echo $row["name"]; ?></option>
    <?php
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'signup') {
    $userid = time();
    $sql = "select mobile from user where mobile = '$_POST[mobile]' AND status = 1";
    $mob = mysqli_query($conn, $sql);
    $mob = mysqli_fetch_assoc($mob);
    $sql = "select email from user where email = '$_POST[email]' AND status = 1";
    $email = mysqli_query($conn, $sql);
    $email = mysqli_fetch_assoc($email);
    if ($mob) {
        echo "Mobile Number Already Registered!";
    } else if ($email) {
        echo "Email Already Registered!";
    } else {
        $sql = "insert into user(userid,name,gardian,mobile,email,age,address,city,state,password) values( '$userid', '$_POST[name]','$_POST[gardian]','$_POST[mobile]','$_POST[email]','$_POST[age]','$_POST[address]','$_POST[city]','$_POST[state]', md5('$_POST[password]'))";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['userid'] = $userid;
            $_SESSION['username'] = $_POST['name'];
            echo '1';
        } else {
            echo mysqli_error($conn);
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'ullogin') {
    $pass = md5($_POST['password']);
    $sql = "select name,userid,password from user where mobile = '$_POST[mobile]' AND status = 1";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    if ($result) {
        if ($result['password'] == $pass) {
            $_SESSION['userid'] = $result['userid'];
            $_SESSION['username'] = $result['name'];
            if (isset($_SESSION['adminid'])) {
                unset($_SESSION['adminid']);
                unset($_SESSION['admname']);
            }
            echo '1';
        } else {
            echo "Incorrect Password!";
        }
    } else {
        echo "Incorrect Mobile Number or User Not Registered!";
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'alogin') {
    $pass = md5($_POST['password']);
    $sql = "select* from admin where adminid = '$_POST[adminid]'";
    $result = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($result);
    if ($result) {
        if ($result['password'] == $pass) {
            $_SESSION['adminid'] = $result['adminid'];
            $_SESSION['admname'] = $result['name'];
            if (isset($_SESSION['userid'])) {
                unset($_SESSION['userid']);
                unset($_SESSION['username']);
            }
            echo '1';
        } else {
            echo "Incorrect Password!";
        }
    } else {
        echo "Incorrect Admin Id!";
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'logout') {
    if (isset($_SESSION['userid'])) {
        unset($_SESSION['userid']);
    }
    if (isset($_SESSION['adminid'])) {
        unset($_SESSION['adminid']);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'udelete') {
    $sql = "UPDATE user SET `status` = 0, `deleted` = '$ct' WHERE userid = '$_POST[userid]'";
    $res = mysqli_query($conn, $sql);
    if (isset($_SESSION['userid'])) {
        unset($_SESSION['userid']);
        unset($_SESSION['username']);
    }
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'getuserdata') {
    $sql = "SELECT* FROM user WHERE userid = '$_SESSION[userid]'";
    $res = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($res);
    echo json_encode($res);
}

if (isset($_POST['type']) && $_POST['type'] == 'updateuser') {
    $sql = "select mobile from user where mobile = '$_POST[mobile]' AND userid != '$userid' AND status = 1";
    $mob = mysqli_query($conn, $sql);
    $mob = mysqli_num_rows($mob);
    $sql = "select email from user where email = '$_POST[email]' AND userid != '$userid' AND status = 1";
    $email = mysqli_query($conn, $sql);
    $email = mysqli_num_rows($email);
    if ($mob) {
        echo "Mobile Number Already Exist!";
    } else if ($email) {
        echo "Email Already Exist!";
    } else {
        $sql = "UPDATE user SET `name`='{$_POST['name']}', gardian='{$_POST['gardian']}', mobile='{$_POST['mobile']}', email='{$_POST['email']}', age='{$_POST['age']}', `address`='{$_POST['address']}', city='{$_POST['city']}', `state`='{$_POST['state']}', `updated`='{$ct}' WHERE userid='{$userid}'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $_SESSION['username'] = $_POST['name'];
            echo '1';
        } else {
            echo mysqli_error($conn);
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'changeuserpass') {
    $sql = "select password from user where userid = '$userid'";
    $userdata = mysqli_query($conn, $sql);
    $userdata = mysqli_fetch_assoc($userdata);
    if (md5($_POST['opass']) != $userdata['password']) {
        echo 'Incorrect Old Password, Try Again!';
    } else {
        $pass = md5($_POST['npass']);
        $sql = "update user set password='$pass' where userid = '$userid'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo '1';
        } else {
            echo mysqli_error($conn);
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'dltapp') {
    if (isset($_SESSION['userid'])) {
        $sql = "UPDATE appointment SET `status` = 'Deleted User', `status1` = 0  WHERE appno = '$_POST[appid]'";
    } else {
        $sql = "UPDATE appointment SET `status` = 'Deleted admin', `status1` = 0  WHERE appno = '$_POST[appid]'";
    }
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'getapp') {
    $sql = "SELECT `userid`,`date`,`time`,`services` FROM appointment WHERE appno = '$_POST[appno]'";
    $res = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($res);
    echo json_encode($res);
}

if (isset($_POST['type']) && $_POST['type'] == 'updateapp') {
    $sql = "select * from appointment where userid = '$_POST[userid]' AND date = '$_POST[date]' AND date != '$_POST[pdate]' AND ( `status`='Rejected' OR  `status`='Waiting For Confirmation')";
    $userdata = mysqli_query($conn, $sql);
    if (mysqli_num_rows($userdata) == 0) {
        $services = NULL;
        $amounts = NULL;
        $ta = 0;
        for ($i = 1; $i <= 50; $i++) {
            if (isset($_POST['service_' . $i])) {
                $data = $_POST['service_' . $i];
                $data = explode("|", $data);
                $services = $services . $data[0] . ', ';
                $amounts = $amounts . $data[1] . ', ';
                $ta = $ta + intval($data[1]);
            }
        }
        $services = substr($services, 0, -2);
        $amounts = substr($amounts, 0, -2);
        $appno = date('d');
        if ($appno < 10) {
            $appno = '0' . $appno;
        }
        $sql = "UPDATE appointment SET date = '{$_POST['date']}', time = '{$_POST['time']}', services = '{$services}', amounts = '{$amounts}', total_amount = {$ta}, updated_datetime = '{$ct}' WHERE appno = {$_POST['appno']}";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo 'Appointment Updated For ' . $services . ' Successfully. Total Amount = ' . $ta . '/-';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo '2';
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'changeadminpass') {
    $sql = "select password from admin where adminid = '$adminid'";
    $admindata = mysqli_query($conn, $sql);
    $admindata = mysqli_fetch_assoc($admindata);
    if (md5($_POST['opass']) != $admindata['password']) {
        echo 'Incorrect Old Password, Try Again!';
    } else {
        $pass = md5($_POST['npass']);
        $sql = "update admin set password='$pass' where adminid = '$adminid'";
        $res = mysqli_query($conn, $sql);
        if ($res) {
            echo '1';
        } else {
            echo mysqli_error($conn);
        }
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'dltenq') {
    $sql = "UPDATE enquiry SET `status`= 0  WHERE enqno = '$_POST[enqno]'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'selectapp') {
    $sql = "UPDATE appointment SET `status`= 'Selected'  WHERE appno = '$_POST[appno]'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'rejectapp') {
    $sql = "UPDATE appointment SET `status`= 'Rejected'  WHERE appno = '$_POST[appno]'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}

if (isset($_POST['type']) && $_POST['type'] == 'addgallery') {
    $files = $_FILES['images'];
    $fileData = [];
    $destinationPath = '../image/gallery/';
    $sql = "SELECT MAX(id) FROM gallery";
    $result = mysqli_query($conn, $sql);
    $lastid = mysqli_fetch_array($result)[0];
    for ($i = 0; $i < count($files['name']); $i++) {
        $lastid++;
        $file_extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
        $imagename = 'img_' . $lastid .  '.' . $file_extension;
        $tempFilePath = $files['tmp_name'][$i];
        if ($files['size'][$i] < 1048576) {
            $fileData[] = "('$imagename','$_SESSION[admname]')";
            move_uploaded_file($tempFilePath, $destinationPath . $imagename);
        } else {
            echo '2';
        }
    }
    if (!empty($fileData)) {
        $sql = "INSERT INTO `gallery` (`image`, `added_by`) VALUES " . implode(",", $fileData);
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "1";
        } else {
            echo "Uploading Failed.";
        }
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'editgallery') {
    $sql = "SELECT `id`,`image` FROM `gallery` WHERE `status`='1'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_array($res)) {
        echo "<img class='p-1 dltimg' src='../image/gallery/$row[1]' data-id='$row[0]' width='125px'>";
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'dltimg') {
    $sql = "UPDATE gallery SET `status`= '0', `deleted_on` = '$ct', `deleted_by`= '$_SESSION[admname]' WHERE id = '$_POST[id]'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'addservice') {
    $files = $_FILES['image'];
    $destinationPath = '../image/services/';
    $sql = "SELECT MAX(id) FROM `services`";
    $result = mysqli_query($conn, $sql);
    $lastid = mysqli_fetch_array($result)[0];
    $lastid++;
    $file_extension = pathinfo($files['name'], PATHINFO_EXTENSION);
    $imagename = 'service_' . $lastid .  '.' . $file_extension;
    $tempFilePath = $files['tmp_name'];
    if ($files['size'] < 1048576) {
        move_uploaded_file($tempFilePath, $destinationPath . $imagename);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $sql = "INSERT INTO `services`(`title`,`description`,`price`,`image`,`added_by`) values( '$title', '$description','$price','$imagename','$_SESSION[admname]')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo '1';
        } else {
            echo mysqli_error($conn);
        }
    } else {
        echo '2';
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'editservice') {
    $sql = "SELECT `id`,`image`,`title`,`description`,`price` FROM `services` WHERE `status`='1'";
    $res = mysqli_query($conn, $sql);
    $count = 1;
    while ($row = mysqli_fetch_array($res)) {
    ?>
        <tr>
            <th width><?php echo $count; ?></th>
            <td><img src='../image/services/<?= $row['image']; ?>' width='150px'></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <button data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#model_updateservice" type="button" class="btn btn-warning tablebtn updateservicebtn"> Update <i class="fa-solid fa-pen-to-square"></i> </button><br />
                <button data-id="<?= $row['id']; ?>" type="button" class="btn btn-danger tablebtn deleteservicebtn"> Delete <i class="fa-solid text-light fa-trash"></i> </button>
            </td>
        </tr>
<?php
        $count++;
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'deleteservice') {
    $sql = "UPDATE services SET `status`= '0', `deleted_on` = '$ct', `deleted_by`= '$_SESSION[admname]' WHERE id = '$_POST[id]'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'serviceformdata') {
    $sql = "SELECT `id`,`title`,`description`,`price`,`image` FROM `services` WHERE `status`='1' AND `id`=$_POST[id]";
    $res = mysqli_query($conn, $sql);
    $res = mysqli_fetch_assoc($res);
    echo json_encode($res);
}
if (isset($_POST['type']) && $_POST['type'] == 'updateservice') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $files = $_FILES['image'];
        $destinationPath = '../image/services/';
        $rand = rand(10, 10000);
        $file_extension = pathinfo($files['name'], PATHINFO_EXTENSION);
        $imagename = 'update_' . $rand .  '.' . $file_extension;
        $tempFilePath = $files['tmp_name'];
        if ($files['size'] < 1048576) {
            $file = $destinationPath . $imagename;
            if (file_exists($file)) {
                unlink($file);
            }
            move_uploaded_file($tempFilePath, $destinationPath . $imagename);
        } else {
            echo '2';
        }
    } else {
        $imagename = $_POST['img'];
    }
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $sql = "UPDATE `services` SET `title` = '$title', `description` = '$description', `price` = '$price', `image` = '$imagename', `updated_by` = '$_SESSION[admname]',`updated_on` = '$ct'  WHERE `id` = $_POST[id]";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '1';
    } else {
        echo mysqli_error($conn);
    }
}
if (isset($_POST['type']) && $_POST['type'] == 'addadmin') {
    $sql = "select passkey from admin where adminid = $adminid AND status = 1";
    $key = mysqli_query($conn, $sql);
    $key = mysqli_fetch_assoc($key);
    $key = $key['passkey'];
    if ($key == md5($_POST['key'])) {
        $sql = "select adminid from admin where adminid = '$_POST[mobile]' AND status = 1";
        $mob = mysqli_query($conn, $sql);
        $mob = mysqli_fetch_assoc($mob);
        if ($mob) {
            echo "Mobile Number Already Registered!";
        } else {
            $files = $_FILES['image'];
            $destinationPath = '../image/team/';
            $file_extension = pathinfo($files['name'], PATHINFO_EXTENSION);
            $imagename = 'team' . $_POST['mobile'] .  '.' . $file_extension;
            $tempFilePath = $files['tmp_name'];
            if ($files['size'] < 1048576) {
                move_uploaded_file($tempFilePath, $destinationPath . $imagename); 
                $pass = md5($_POST['pass']);
                $sql = "insert into `admin`(`adminid`,`name`,`designation`,`picture`,`password`) values('$_POST[mobile]', '$_POST[name]','$_POST[desg]','$imagename', '$pass')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '1';
                } else {
                    echo mysqli_error($conn);
                }
            } else {
                echo 'Select Image Less Than 1 MB Size';
            }
        }
    } else {
        echo "Incorrect PassKey!";
    }
}
