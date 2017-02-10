<?php
include("config.php");
$id=$_POST['id'];
$qury=mysqli_query($con,"select * from tbl_foodcategories WHERE  id='$id' ");
$i=mysqli_fetch_array($qury);
$ii=$i['image'];
unlink("../uploads/category/".$ii);
$query=mysqli_query($con," Delete  from tbl_foodcategories WHERE id='$id' ");
if($query)
{
   echo "delete";
}
else{
    echo "error";
}
?>