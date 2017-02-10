<?php  include'config.php';
$query=mysqli_query($con,"update tbl_userfeedback set notification=0 WHERE notification=1 ");
if($query){ echo "success"; }  else { echo "not"; }  ?>