<?php session_start(); if(isset($_SESSION['uname'])){ ?>
    <!DOCTYPE html>
    <html class="no-js before-run" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Internship">
        <meta name="author" content="Redixbit Software technology">
        <title>Restaurant Admin | Restaurant Offers</title>
        <link rel="apple-touch-icon" href="uploads/logo.png">
        <link rel="shortcut icon" href="uploads/logo.png">
        <!-- Stylesheets -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/bootstrap-extend.min.css">
        <link rel="stylesheet" href="assets/css/site.min.css">
        <link rel="stylesheet" href="assets/vendor/animsition/animsition.css">
        <link rel="stylesheet" href="assets/vendor/asscrollable/asScrollable.css">
        <link rel="stylesheet" href="assets/vendor/switchery/switchery.css">
        <link rel="stylesheet" href="assets/vendor/intro-js/introjs.css">
        <link rel="stylesheet" href="assets/vendor/slidepanel/slidePanel.css">
        <link rel="stylesheet" href="assets/vendor/flag-icon-css/flag-icon.css">
        <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
        <!-- Inline -->
        <style>
            .example-modal {
                display: block;
                width: 100%;
                padding: 35px 15px;
                background-color: #f3f7f9;
            }
            .example-modal .modal {
                position: relative;
                top: auto;
                right: auto;
                bottom: auto;
                left: auto;
                z-index: 1;
                display: block;
            }

            .example-modal .modal .modal-dialog {
                width: auto;
                max-width: 600px;
                margin: 15px auto;
            }

            .example-modal-top .center {
                top: 0;
                -webkit-transform: translate(-50%, 0px);
                -ms-transform: translate(-50%, 0px);
                -o-transform: translate(-50%, 0px);
                transform: translate(-50%, 0px);
            }

            .example-modal-bottom .center {
                top: auto;
                bottom: 0;
                -webkit-transform: translate(-50%, 0px);
                -ms-transform: translate(-50%, 0px);
                -o-transform: translate(-50%, 0px);
                transform: translate(-50%, 0px);
            }

            .example-modal-sidebar .center {
                top: 0;
                right: 5px;
                left: auto;
                -webkit-transform: none;
                -ms-transform: none;
                -o-transform: none;
                transform: none;
            }
            .color-selector > li {
                margin-right: 20px;
            }
        </style>
        <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
        <script src="assets/vendor/media-match/media.match.min.js"></script>
        <script src="assets/vendor/respond/respond.min.js"></script>
        <script src="assets/vendor/modernizr/modernizr.js"></script>
        <script src="assets/vendor/breakpoints/breakpoints.js"></script>
        <script>
            Breakpoints();
        </script>
        <script src="//code.jquery.com/jquery-latest.min.js"></script>
        <script src="http://malsup.github.io/jquery.form.js"></script>
    </head>
    <body>


    <?php
    include'include/header.php';
    include'include/rightside.php';
    include 'include/editoffers.php';
    include'include/footer.php';
    ?>
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
<?php }  else { ?><script>window.location='index.php';</script><?php }  ?>