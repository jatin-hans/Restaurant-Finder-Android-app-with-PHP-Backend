<?php
session_start(); include("config.php"); $uname=$_POST['username'];$pass=$_POST['password'];
if(isset($uname) && isset($pass))
{
    $query=mysqli_query($con,"select * from adminlogin WHERE Username='$uname' && Password='$pass' ");
    $res=mysqli_fetch_array($query);
    if($res)
    {
        $_SESSION['uname']=$res['Username'];
        echo "logindone";
    }
    else
    {
        echo "loginfail";
    }
}  ?>