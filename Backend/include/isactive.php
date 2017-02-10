<?php
include'config.php'; $id=$_POST['id']; $isactive=$_POST['act'];
if($isactive == 1)
{
    $query = mysqli_query($con, "update tbl_userfeedback set is_active=0 WHERE id='$id'");
    if ($query) {echo "disable"; }  else{ echo "error"; }
}
else
{
    $query = mysqli_query($con, "update tbl_userfeedback set is_active=1 WHERE id='$id'");
    if ($query) { echo "disable"; }  else{ }
}  ?>