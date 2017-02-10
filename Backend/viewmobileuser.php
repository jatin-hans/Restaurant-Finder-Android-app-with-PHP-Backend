<?php  session_start(); if(isset($_SESSION['uname'])){ ?>
    <!DOCTYPE html>
    <html class="no-js before-run" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Internship">
        <meta name="author" content="Redixbit Software technology">
        <title>Restaurant Admin | Mobile User</title>
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

        <!-- Plugin -->
        <link rel="stylesheet" href="assets/vendor/datatables-bootstrap/dataTables.bootstrap.css">
        <link rel="stylesheet" href="assets/vendor/datatables-fixedheader/dataTables.fixedHeader.css">
        <link rel="stylesheet" href="assets/vendor/datatables-responsive/dataTables.responsive.css">


        <!-- Fonts -->
        <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

        <!-- Inline -->
        <style>
            @media (max-width: 480px) {
                .panel-actions .dataTables_length {
                    display: none;
                }
            }

            @media (max-width: 320px) {
                .panel-actions .dataTables_filter {
                    display: none;
                }
            }

            @media (max-width: 767px) {
                .dataTables_length {
                    float: left;
                }
            }

            #exampleTableAddToolbar {
                padding-left: 30px;
            }
        </style>
        <!--[if lt IE 9]>
        <script src="assets/vendor/html5shiv/html5shiv.min.js"></script>
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
    <!--[if lt IE 8]>
    <![endif]-->

    <?php
    include'include/header.php';
    include'include/rightside.php';
    include 'include/mobileuser.php';
    include'include/footer.php';
    ?>

    <!-- Page -->

    <!-- End Page -->


    <!-- Footer -->

    <script src="assets/vendor/jquery/jquery.js"></script>
    <script src="assets/vendor/bootstrap/bootstrap.js"></script>
    <script src="assets/vendor/animsition/jquery.animsition.js"></script>
    <script src="assets/vendor/asscroll/jquery-asScroll.js"></script>
    <script src="assets/vendor/mousewheel/jquery.mousewheel.js"></script>
    <script src="assets/vendor/asscrollable/jquery.asScrollable.all.js"></script>
    <script src="assets/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

    <!-- Plugins -->
    <script src="assets/vendor/switchery/switchery.min.js"></script>
    <script src="assets/vendor/intro-js/intro.js"></script>
    <script src="assets/vendor/screenfull/screenfull.js"></script>
    <script src="assets/vendor/slidepanel/jquery-slidePanel.js"></script>

    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
    <script src="assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
    <script src="assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
    <script src="assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>

    <!-- Scripts -->
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
    <script src="assets/js/components/datatables.js"></script>

    <script>
        (function(document, window, $) {
            'use strict';

            var Site = window.Site;

            $(document).ready(function($) {
                Site.run();
            });

            // Fixed Header Example
            // --------------------
            (function() {
                // initialize datatable
                var table = $('#exampleFixedHeader').DataTable({
                    responsive: true,
                    "bPaginate": false,
                    "sDom": "t" // just show table, no other controls
                });

                // initialize FixedHeader
                var offsetTop = 0;
                if ($('.site-navbar').length > 0) {
                    offsetTop = $('.site-navbar').eq(0).innerHeight();
                }
                var fixedHeader = new FixedHeader(table, {
                    offsetTop: offsetTop
                });

                // redraw fixedHeaders as necessary
                $(window).resize(function() {
                    fixedHeader._fnUpdateClones(true);
                    fixedHeader._fnUpdatePositions();
                });
            })();

            // Individual column searching
            // ---------------------------
            (function() {
                $(document).ready(function() {
                    var defaults = $.components.getDefaults("dataTable");

                    var options = $.extend(true, {}, defaults, {
                        initComplete: function() {
                            this.api().columns().every(function() {
                                var column = this;
                                var select = $(
                                    '<select class="form-control width-full"><option value=""></option></select>'
                                )
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function() {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );

                                        column
                                            .search(val ? '^' + val + '$' : '',
                                            true, false)
                                            .draw();
                                    });

                                column.data().unique().sort().each(function(
                                    d, j) {
                                    select.append('<option value="' + d +
                                        '">' + d + '</option>')
                                });
                            });
                        }
                    });

                    $('#exampleTableSearch').DataTable(options);
                });
            })();

            // Table Tools
            // -----------
            (function() {
                $(document).ready(function() {
                    var defaults = $.components.getDefaults("dataTable");

                    var options = $.extend(true, {}, defaults, {
                        "aoColumnDefs": [{
                            'bSortable': false,
                            'aTargets': [-1]
                        }],
                        "iDisplayLength": 5,
                        "aLengthMenu": [
                            [5, 10, 25, 50, -1],
                            [5, 10, 25, 50, "All"]
                        ],
                        "sDom": '<"dt-panelmenu clearfix"Tfr>t<"dt-panelfooter clearfix"ip>',
                        "oTableTools": {
                            "sSwfPath": "assets/vendor/datatables-tabletools/swf/copy_csv_xls_pdf.swf"
                        }
                    });

                    $('#exampleTableTools').dataTable(options);
                });
            })();

            // Table Add Row
            // -------------

            (function() {
                $(document).ready(function() {
                    var defaults = $.components.getDefaults("dataTable");

                    var t = $('#exampleTableAdd').DataTable(defaults);

                    $('#exampleTableAddBtn').on('click', function() {
                        t.row.add([
                            'Adam Doe',
                            'New Row',
                            'New Row',
                            '30',
                            '2015/10/15',
                            '$20000'
                        ]).draw();
                    });
                });
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