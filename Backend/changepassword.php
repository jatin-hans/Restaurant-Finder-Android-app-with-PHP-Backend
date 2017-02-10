<?php  session_start(); if(isset($_SESSION['uname'])) { ?>
    <!DOCTYPE html>
    <html class="no-js before-run" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Internship">
        <meta name="author" content="Redixbit Sofware Technology">
        <title>Restaurant Admin | Change Password</title>
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
        <link rel="stylesheet" href="assets/vendor/formvalidation/formValidation.css">
        <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.wallform.js"></script>
        <style> .has-feedback .form-control-feedback {  right: 15px;   }  .summary-errors p,  .summary-errors ul li a {   color: inherit;   }  .summary-errors ul li a:hover {   text-decoration: none;  }  @media (min-width: 768px) {  #exampleFullForm .form-horizontal .control-label {  text-align: inherit;  }  } </style>
        <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
        <script src="assets/vendor/media-match/media.match.min.js"></script>
        <script src="assets/vendor/respond/respond.min.js"></script>
        <script src="assets/vendor/modernizr/modernizr.js"></script>
        <script src="assets/vendor/breakpoints/breakpoints.js"></script>
        <script> Breakpoints(); </script>
    </head>
<body>
    <?php
    include'include/header.php';
    include'include/rightside.php';
    include 'include/changepassword.php';
    include'include/footer.php';
    ?>
    <script>
        $(document).ready(function() {
            $('#photoimg').die('click').live('change', function()			{
                $("#imageform").ajaxForm({target: '#preview',
                    beforeSubmit:function(){
                        console.log('ttest');
                        $("#imageloadstatus").show();
                        $("#imageloadbutton").hide();
                    },
                    success:function(){
                        console.log('test');
                        $("#imageloadstatus").hide();
                        $("#imageloadbutton").show();
                    },
                    error:function(){
                        console.log('xtest');
                        $("#imageloadstatus").hide();
                        $("#imageloadbutton").show();
                    } }).submit();
            });
        });
        </script>
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
        <script src="assets/vendor/formvalidation/formValidation.min.js"></script>
        <script src="assets/vendor/formvalidation/framework/bootstrap.min.js"></script>
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
    <?php include'controler/script_controler.php'; ?>
    </body>
    </html>
    <?php
} else { ?><script>window.location='index.php';</script><?php } ?>