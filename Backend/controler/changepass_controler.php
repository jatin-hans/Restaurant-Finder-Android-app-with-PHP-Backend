<?php
if(isset($_POST['submit']))
{
    include'include/config.php';
    $uname=$_SESSION['uname'];
    $old=$_POST['oldpass'];
    $pass=$_POST['pass'];
    $cpass=$_POST['conpass'];
    $query=mysqli_query($con,"Select * from adminlogin WHERE Username='$uname' && Password='$old' ");
    $res=mysqli_fetch_array($query);
    if($res) {
        $qury=mysqli_query($con,"update adminlogin set Password='$cpass' WHERE Username='$uname' && Password='$old' ");
        if($qury) { ?><script>window.location='include/logout.php';</script><?php }  else  {
            ?><script>document.getElementById("msg1").innerHTML="Your Password is Not Update ! try Again  !!";</script><?php
        }
    }  else  { ?><script>document.getElementById("msg1").innerHTML="Invalid Old Password ! Try Again !!";</script><?php }
}  ?>
<script>
    function confirmpass(){
        var pass = $(".pass").val();
        var cpass = $(".cpass").val();
        if(pass == cpass){
            document.getElementById("msg").innerHTML="";
            $('#submit').attr('disabled',false);
        }
        else{
            document.getElementById("msg").innerHTML="invalid Confirm password !!";
            $('#submit').attr('disabled',true);
        }
    }
</script>
