<?php
include("include/config.php");
if(isset($_GET['value'])){
$query=mysqli_query($con,"select restaurant_id,title,image from tbl_offers WHERE restaurant_id='".$_GET['value']."'");
    while($res=mysqli_fetch_assoc($query)){
        $json[]=$res;
    }
    echo json_encode($json);
}
else{
    $query=mysqli_query($con,"select restaurant_id,title,image from tbl_offers ");
    while($res=mysqli_fetch_assoc($query)){
        $json[]=$res;
    }
    echo json_encode($json);
}

?>