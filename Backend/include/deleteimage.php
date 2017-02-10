<?php
include'config.php';
$id=$_POST['id'];
$id1=$_POST['id1'];
$qury=mysqli_query($con,"select * from tbl_images WHERE id='$id'");
$i=mysqli_fetch_array($qury);
$ii=$i['img_url'];
unlink("../uploads/".$ii);
$query=mysqli_query($con,"delete from tbl_images WHERE id='$id'");
if($query){ echo $id1; }  else{ echo "error"; }
?>