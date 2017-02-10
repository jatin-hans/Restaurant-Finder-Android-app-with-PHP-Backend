<?php
include'config.php';
if(isset($_POST['id']))
{
$id=$_POST['id']; $query=mysqli_query($con,"update tbl_restourant set is_active=0 WHERE id='$id'");
if($query){  ?><script>alert($id);
            </script><?php
    }  else{ echo "error"; }
}
else
{
    $id=$_POST['id1'];
    $query=mysqli_query($con,"update tbl_restourant set is_active=1 WHERE id='$id'");
    if($query){ echo "update"; }
    else { echo "error"; }
}
?>