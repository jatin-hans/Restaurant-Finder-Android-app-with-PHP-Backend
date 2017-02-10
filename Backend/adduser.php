<?php
include'include/config.php';
if(isset($_GET['username']) && (isset($_GET['email']))) {
    $username = $_GET['username'];
    $email = $_GET['email'];
    $user = mysqli_query($con, "select * from tbl_mobileuser WHERE email='$email' ");
    $sel = mysqli_fetch_assoc($user);
    if ($sel > 0)
    {
        $json[] = array("id" => $sel['id']);
        echo json_encode($json);
    }
    else
    {
        $query = mysqli_query($con, "insert into tbl_mobileuser (username,email) VALUES ('$username','$email')");
        if ($query)
        {
            $qury = mysqli_query($con, "select id from tbl_mobileuser WHERE username='$username' && email='$email' ");
            while ($res = mysqli_fetch_assoc($qury))
            {
                $array[] = $res;
            }
            echo json_encode($array);
        }
    }
}
else{
    $arr[]=array("id"=>"Required Username And Email !! ");
    $json['Error']=$arr;
    echo json_encode($json);
}
?>