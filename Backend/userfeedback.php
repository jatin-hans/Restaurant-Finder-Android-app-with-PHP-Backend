<?php
include'include/config.php';
if(isset($_GET['value'])){
    $sql=mysqli_query($con,"select username,ratting,comment from tbl_userfeedback
    WHERE res_id='".$_GET['value']."' && is_active=1  ORDER BY id DESC  ");
    $sql1=mysqli_query($con,"select username,ratting,comment from tbl_userfeedback
    WHERE res_id='".$_GET['value']."' && is_active=1  ORDER BY id DESC  ");
    $my=mysqli_fetch_array($sql1);
    if($my) {
        while ($row = mysqli_fetch_assoc($sql))
        {
            $json[] = $row;
            $namejson['userfeedback'] = $json;
        }
        echo json_encode($namejson);
    }
    else{
        $a=array("id"=>"Record Not Found");
        $aa['Error']=$a;
        echo json_encode($aa);
    }
}
elseif(isset($_GET['res_id'])&&($_GET['user_id']))
{
    $not=1;
    $active=1;
    $sel=mysqli_query($con,"select * from tbl_mobileuser WHERE id='".$_GET['user_id']."'");
    $user=mysqli_fetch_array($sel);
    if($user){
    $query=mysqli_query($con,"insert into tbl_userfeedback (res_id,username,ratting,comment,is_active,notification)
    VALUES ('".$_GET['res_id']."','".$user['username']."','".$_GET['ratting']."','".$_GET['comment']."','$active','$not')");
    if($query){
        $a=array("id"=>"True");
        $aa['Massage']=$a;
        echo json_encode($aa);
    }
    }
    else{
        $a=array("id"=>"Record Not Found");
        $aa['Error']=$a;
        echo json_encode($aa);
    }
}
else
{
    $sql=mysqli_query($con,"select res_id,username,ratting,comment from tbl_userfeedback WHERE is_active=1 ORDER BY id DESC  ");
    while($row=mysqli_fetch_assoc($sql)){
        $json[]=$row;
        $namejson['userfeedback']=$json;
    }
    echo json_encode($namejson);
}

//restourant/userfeedback.php?res_id="9"&&username=mahi&&ratting=3&&comment=amazing%20app?
?>
