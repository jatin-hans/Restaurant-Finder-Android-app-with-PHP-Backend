<!DOCTYPE html>
<html class="no-js before-run" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Internship">
    <meta name="author" content="Redixbit Software technology">
    <title>Restaurant Admin | Forgot Password</title>
    <link rel="apple-touch-icon" href="uploads/logo.png">
    <link rel="shortcut icon" href="uploads/logo.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="assets/css/site.min.css">
    <link rel="stylesheet" href="assets/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="assets/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="assets/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="assets/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="assets/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="assets/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="assets/css/pages/forgot-password.css">
    <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
    <script src="assets/vendor/media-match/media.match.min.js"></script>
    <script src="assets/vendor/respond/respond.min.js"></script>
    <script src="assets/vendor/modernizr/modernizr.js"></script>
    <script src="assets/vendor/breakpoints/breakpoints.js"></script>
    <script> Breakpoints(); </script>
</head>
<body class="page-forgot-password layout-full" style="background-color:#465055 ;">
<div class="page animsition vertical-align text-center" data-animsition-in="fade-in"
     data-animsition-out="fade-out">
    <div class="page-content vertical-align-middle">
        <h2 class="page-title" style="color: white;">Forgot Your Password ?</h2>
        <p>Input your registered email to reset your password</p>
        <div id="msg1" style="color: greenyellow;"> </div>
        <form class="width-300 margin-top-30 center-block" name="frm" method="post" onsubmit="resetpass()">
            <div class="form-group">
                <input type="email"  class="form-control email" id="inputEmail" name="email" placeholder="Your Email" required="">
            </div>
            <div id="msg" style="color: indianred;"> </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Reset Your Password</button>
            </div>
            <a class="pull-right" href="index.php">Back To Login</a>
        </form>
    </div>
</div>
<?php
if(isset($_POST['submit'])){
    include'include/config.php';
    $email = $_POST['email'];
    $query=mysqli_query($con,"select * from adminlogin where Username='$email'");
    $count=mysqli_fetch_array($query);
    if($count)
    {
        $pass  =  $count['Password'];
        $to = $count['Username'];
        $from = "Restaurant Admin";
        $body  =  "Restaurant Admin password recovery<br>
		-----------------------------------------------<br>
		email Details is : $to;<br>
		Here is your password  : $pass;<br>
		Sincerely,
		Admin";
        $from = "janakharsora40@gmail.com";
        $subject = "Admin Password recovered";
        $headers1 = "From: $from\n";
        $headers1 .= "Content-type: text/html;charset=iso-8859-1\r\n";
        $headers1 .= "X-Priority: 1\r\n";
        $headers1 .= "X-MSMail-Priority: High\r\n";
        $headers1 .= "X-Mailer: Just My Server\r\n";
        $sentmail = mail ( $to, $subject, $body, $headers1 );
       ?>
        <script>
           // alert("ok");
            document.getElementById("msg1").innerHTML="Your Password is Send Us On Your Email Id <?php echo "<font color='#62A8EA'>".$count['Username']."</font>"; ?>";
        </script>
        <?php
    }
    else{
        ?>
        <script>

            document.getElementById("msg").innerHTML="Please Check  And Enter Valid Username !!";
        </script>
        <?php

    }
}
?>
<script src="assets/vendor/jquery/jquery.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.js"></script>
<script src="assets/vendor/animsition/jquery.animsition.js"></script>
<script src="assets/vendor/asscroll/jquery-asScroll.js"></script>
<script src="assets/vendor/mousewheel/jquery.mousewheel.js"></script>
<script src="assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
<script src="assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
<script src="assets/vendor/switchery/switchery.min.js"></script>
<script src="assets/vendor/intro-js/intro.js"></script>
<script src="assets/vendor/screenfull/screenfull.js"></script>
<script src="assets/vendor/slidepanel/jquery-slidePanel.js"></script>
<script src="assets/js/core.js"></script>
<script src="assets/js/site.js"></script>
<script src="assets/js/sections/menu.js"></script>
<script src="assets/js/sections/menubar.js"></script>
<script src="assets/js/sections/sidebar.js"></script>
<script src="assets/js/configs/config-colors.js"></script>
<script src="assets/js/configs/config-tour.js"></script>
<script src="assets/js/components/asscrollable.js"></script>
<script src="assets/js/components/animsition.js"></script>
<script src="assets/js/components/slidepanel.js"></script>
<script src="assets/js/components/switchery.js"></script>
<script>
    (function(document, window, $) {
        'use strict';

        var Site = window.Site;
        $(document).ready(function() {
            Site.run();
        });
    })(document, window, jQuery);
</script>
</body>
</html>