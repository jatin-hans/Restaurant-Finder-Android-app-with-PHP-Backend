<?php session_start(); if(isset($_SESSION['uname'])){ include'include/config.php'; ?>
    <!DOCTYPE html>
    <html class="no-js before-run" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="Internship">
        <meta name="author" content="Redixbit Software technology">
        <title>Restaurant Admin | Add Food Category</title>
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
        <link rel="stylesheet" href="assets/vendor/footable/footable.core.css">
        <link rel="stylesheet" href="assets/fonts/web-icons/web-icons.min.css">
        <link rel="stylesheet" href="assets/fonts/brand-icons/brand-icons.min.css">
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
    include 'include/addfoodcat.php';
    include'include/footer.php';
    include'controler/addfood_controler.php';
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
    <script src="assets/vendor/footable/footable.all.min.js"></script>
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
            $(document).ready(function($) {
                Site.run();
            });
            (function() {
                $('#exampleRowToggler').footable();
            })();
            (function() {
                var fooColExp = $('#exampleAccordion');
                fooColExp.footable().trigger('footable_expand_first_row');
                $('#exampleCollapseBtn').on('click', function() {
                    fooColExp.trigger('footable_collapse_all');
                });
                $('#exampleExpandBtn').on('click', function() {
                    fooColExp.trigger('footable_expand_all');
                })
            })();
            (function() {
                $('#exampleFooAccordion').footable().on('footable_row_expanded',
                    function(e) {
                        $('#exampleFooAccordion tbody tr.footable-detail-show').not(
                            e.row).each(function() {
                                $('#exampleFooAccordion').data('footable').toggleDetail(
                                    this);
                            });
                    });
            })();
            (function() {
                $('#examplePagination').footable();
                $('#exampleShow').change(function(e) {
                    e.preventDefault();
                    var pagesize = $(this).find('option:selected').val();
                    $('#examplePagination').data('page-size', pagesize);
                    $('#examplePagination').trigger('footable_initialized');
                });
            })();
            (function() {
                var filtering = $('#exampleFootableFiltering');
                filtering.footable().on('footable_filtering', function(e) {
                    var selected = $('#filteringStatus').find(':selected').val();
                    e.filter += (e.filter && e.filter.length > 0) ? ' ' +
                    selected : selected;
                    e.clear = !e.filter;
                });
                $('#filteringStatus').change(function(e) {
                    e.preventDefault();
                    filtering.trigger('footable_filter', {
                        filter: $(this).val()
                    });
                });
                $('#filteringSearch').on('input', function(e) {
                    e.preventDefault();
                    filtering.trigger('footable_filter', {
                        filter: $(this).val()
                    });
                });
            })();
            (function() {
                var addrow = $('#exampleFooAddRemove');
                addrow.footable().on('click', '.delete-row-btn', function() {
                    var footable = addrow.data('footable');
                    var row = $(this).parents('tr:first');
                    footable.removeRow(row);
                });
                $('#addRemoveSearch').on('input', function(e) {
                    e.preventDefault();
                    addrow.trigger('footable_filter', {
                        filter: $(this).val()
                    });
                });
                $('#addRowBtn').click(function() {
                    var footable = addrow.data('footable');
                    var newRow = '<tr><td><button class="btn btn-icon btn-danger btn-outline btn-round btn-xs demo-delete-btn"><i class="icon wb-close-mini" aria-hidden="true"></i></button></td><td>Adam</td><td>Doe</td><td>Traffic Court Referee</td><td>22 Jun 1972</td><td><span class="label label-table label-success">Active</span></td></tr>';
                    footable.appendRow(newRow);
                });
            })();
        })(document, window, jQuery);
    </script>
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