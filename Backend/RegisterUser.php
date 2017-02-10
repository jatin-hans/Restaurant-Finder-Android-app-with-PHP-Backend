<?php
include("include/config.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
 $name = $_POST['name'];
 $email = $_POST['email'];
 $mobile = $_POST['mobile'];
 $password = $_POST['password'];
 
 
 if($name == '' || $mobile == '' || $password == '' || $email == ''){
 echo 'please fill all values';
 }else{
 
 $sql = "SELECT * FROM tbl_mobileuser WHERE UName='$name' OR Email='$email'";
 $check = mysqli_fetch_array(mysqli_query($con,$sql));
 
 if(isset($check)){
 echo 'username or email already exist';
 }else{ 
 $sql = "INSERT INTO tbl_mobileuser (UName,Email,Mobile,Password) VALUES('$name','$email','$mobile','$password')";
 if(mysqli_query($con,$sql)){
 echo 'successfully registered';
 }else{
 echo 'oops! Please try again!';
 }
 }
 mysqli_close($con);
 }
}else{
echo 'error';
}
 
?>

