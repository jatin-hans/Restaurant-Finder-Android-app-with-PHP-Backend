<?php
include("config.php");
$id=$_POST['id'];
$query=mysqli_query($con,"delete  from tbl_restourant WHERE id='$id' ");
if($query){
    $query1=mysqli_query($con,"delete from tbl_images WHERE image_id='$id' ");
    if($query1){
        $query2=mysqli_query($con,"delete from tbl_food WHERE food_id='$id' ");
        if($query2){
            echo "delete";
        }
    }
}
?>