<?php

include'include/config.php';

 
$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "select * from tbl_mobileuser where Email='$username' and Password='$password'";
$res = mysqli_query($con,$sql);
 
$check = mysqli_fetch_array($res);
 
if(isset($check)){
echo 'Login Successful';
}else{
echo 'Login failure';
}
 
mysqli_close($con);
?>

