<?php  session_start(); if(isset($_SESSION['uname'])){ ?>
    <!DOCTYPE html>
    <html class="no-js before-run" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Internship">
        <meta name="author" content="Redixbit Software technology">
        <title>Restaurant Admin | Json Url List</title>
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
        <!-- Fonts -->
        <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
        <!--[if lt IE 9]>
        <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
        <![endif]-->
        <!--[if lt IE 10]>
        <script src="assets/vendor/media-match/media.match.min.js"></script>
        <script src="assets/vendor/respond/respond.min.js"></script>
        <![endif]-->
        <!-- Scripts -->
        <script src="assets/vendor/modernizr/modernizr.js"></script>
        <script src="assets/vendor/breakpoints/breakpoints.js"></script>
        <script>
            Breakpoints();
        </script>
    </head>
    <body>
    <?php
    include'include/header.php';
    include'include/rightside.php';
    include 'include/service.php';
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
    <script src="assets/vendor/peity/jquery.peity.min.js"></script>
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
    <script src="assets/js/components/peity.js"></script>
    <script>
        (function(document, window, $) {
            'use strict';
            var Site = window.Site;
            $(document).ready(function($) {
                Site.run();
            });
            // Example Peity Default
            // ---------------------
            (function() {
                /* dynamic example */
                var dynamicChart = $("#examplePeityDynamic").peity("line", {
                    width: 64,
                    fill: [$.colors("primary", 200)],
                    stroke: $.colors("primary", 500),
                    height: 22
                });

                setInterval(function() {
                    var random = Math.round(Math.random() * 10);
                    var values = dynamicChart.text().split(",");
                    values.shift();
                    values.push(random);

                    dynamicChart
                        .text(values.join(","))
                        .change();
                }, 1000);
            })();

            // Example Peity Red
            // -------------------
            (function() {
                /* dynamic example */
                var dynamicRedChart = $("#examplePeityDynamicRed").peity("line", {
                    width: 64,
                    fill: [$.colors("red", 200)],
                    stroke: $.colors("red", 500),
                    height: 22
                });

                setInterval(function() {
                    var random = Math.round(Math.random() * 10);
                    var values = dynamicRedChart.text().split(",");
                    values.shift();
                    values.push(random);

                    dynamicRedChart
                        .text(values.join(","))
                        .change();
                }, 1000);
            })();

            // Example Peity Green
            // -------------------
            (function() {
                /* dynamic example */
                var dynamicGreenChart = $("#examplePeityDynamicGreen").peity(
                    "line", {
                        width: 64,
                        fill: [$.colors("green", 200)],
                        stroke: $.colors("green", 500),
                        height: 22
                    });

                setInterval(function() {
                    var random = Math.round(Math.random() * 10);
                    var values = dynamicGreenChart.text().split(",");
                    values.shift();
                    values.push(random);

                    dynamicGreenChart
                        .text(values.join(","))
                        .change();
                }, 1000);
            })();

            // Example Peity Orange
            // --------------------
            (function() {
                /* dynamic example */
                var dynamicOrangeChart = $("#examplePeityDynamicOrange").peity(
                    "line", {
                        width: 64,
                        fill: [$.colors("orange", 200)],
                        stroke: $.colors("orange", 500),
                        height: 22
                    });

                setInterval(function() {
                    var random = Math.round(Math.random() * 10);
                    var values = dynamicOrangeChart.text().split(",");
                    values.shift();
                    values.push(random);

                    dynamicOrangeChart
                        .text(values.join(","))
                        .change();
                }, 1000);
            })();

        })(document, window, jQuery);
    </script>

    </body>

    </html>
    <?php
}
else{
    ?><script>window.location='index.php';</script><?php
}
?>