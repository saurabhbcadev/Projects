<?php
$servername = "localhost";
$username = "develope_sk";
$password = "m0BYj6w6(K3r@M";
$db_name = "develope_bpms";
// Create connection
$conn = mysqli_connect($servername, $username, $password);

mysqli_select_db($conn, $db_name);
// Check connection

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
