<?php
include'include/config.php';
$query=mysqli_query($con,"select name,image from tbl_foodcategories");
while($res=mysqli_fetch_assoc($query))
{ $a[]=$res; } echo json_encode($a);  ?>
