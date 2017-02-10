<?php
include'include/config.php';
$username=$_GET['username'];
$email=$_GET['email'];
$user=mysqli_query($con,"select id from tbl_mobileuser WHERE  email='$email'");
$sel=mysqli_fetch_assoc($user);
if($sel){
    $query=mysqli_query($con,"update tbl_mobileuser set username='$username' WHERE email='$email'");
    if($query){
        $msg="true";
        $jsonmsg[]=array("id"=>$msg);
        echo json_encode($jsonmsg);
    }
    else
    {
        $msg="false";
        $jsonmsg[]=array("id"=>$msg);
        echo json_encode($jsonmsg);
    }
}
else{
    $msg="false";
    $jsonmsg[]=array("id"=>$msg);
    echo json_encode($jsonmsg);
}

?>