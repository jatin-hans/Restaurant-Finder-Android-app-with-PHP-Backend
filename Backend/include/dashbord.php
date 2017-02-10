<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <div class="page-content">
                <div class="example-wrap">
                    <div class="example">
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="pricing-list text-left">
                                    <a class="text-action" href="viewrestourant.php">
                                    <div class="pricing-header bg-blue-grey-600" style="height:185px;background-repeat: no-repeat;  background-image: url('uploads/1.png');">
                                        <div class="pricing-title">Restaurant</div>
                                        <div class="pricing-price">
                                            <span class="pricing-amount"><!--<img src="uploads/1.png" height="80" width="150">--> </span>
                                        </div>
                                    </div>

                                        </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="pricing-list text-left">
                                    <a class="text-action" href="addrestourant.php">
                                    <div class="pricing-header bg-blue-600 " style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/2.png');">
                                        <div class="pricing-title">New Restaurant</div>
                                        <div class="pricing-price">
                                           <!-- <span class="pricing-currency">$</span>-->
                                            <span class="pricing-amount"></span>
                                        <!--    <span class="pricing-period">/ mo</span>-->
                                        </div>
                                    </div>
                                        </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="pricing-list text-left">
                                    <div class="pricing-header bg-red-600" style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/3.png');">
                                        <div class="pricing-title">Total Reataurant</div>
                                        <div class="pricing-price">
                                            <?php
                                            include'include/config.php';
                                            $query=mysqli_query($con,"select * from tbl_restourant ");
                                            $res=mysqli_num_rows($query);
                                            ?>
                                            <span class="pricing-amount"><?php echo $res; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-lg-3">

                                <div class="pricing-list text-left">
                                    <a class="text-action" href="addfoodcategori.php" onclick="">
                                    <div class="pricing-header bg-orange-600" style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/4.png');">
                                        <div class="pricing-title">Total Foods</div>
                                        <div class="pricing-price">
                                            <?php
                                            $daty=mysqli_query($con,"select * from tbl_foodcategories ");
                                            $foo=mysqli_num_rows($daty);
                                            ?>
                                            <span class="pricing-amount"><?php echo $foo; ?></span>
                                        </div>
                                    </div>
                                </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
        <div class="example-wrap">

            <div class="example">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="pricing-list text-left">
                            <a class="text-action" href="addrestaurantimage.php">
                            <div class="pricing-header bg-green-600" style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/5.png');">
                                <div class="pricing-title">images </div>
                                <div class="pricing-price">
                                    <span class="pricing-amount"></span>
                                </div>
                               </div>
                                </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="pricing-list text-left">
                            <a class="text-action" href="viewmobileuser.php">
                            <div class="pricing-header bg-pink-600" style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/6.png');">
                                <div class="pricing-title">Mobile User</div>
                                <div class="pricing-price">
                                    <?php
                                    $mobi=mysqli_query($con,"select * from tbl_mobileuser");
                                    $mobidata=mysqli_num_rows($mobi);
                                    ?>
                                    <span class="pricing-amount"><?php echo $mobidata; ?></span>
                                </div>
                                </div>
                                </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="pricing-list text-left">
                            <a class="text-action" href="viewuserfeedback.php" onclick="nofication()">
                            <div class="pricing-header bg-yellow-600" style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/7.png');">
                                <div class="pricing-title">User Feedback
                                    <?php
                                    $qury=mysqli_query($con,"select * from tbl_userfeedback WHERE notification=1 ");
                                    $not=mysqli_num_rows($qury);
                                    ?>
                                    <div class="site-menu-badge">
                                        <span class="badge badge-danger"><?php echo $not; ?></span>
                                    </div>  </div>
                                <div class="pricing-price">
                                    <?php
                                    $feed=mysqli_query($con,"select * from tbl_userfeedback");
                                    $feeddata=mysqli_num_rows($feed);
                                    ?>
                                    <span class="pricing-amount"><?php echo $feeddata; ?></span>
                                </div>
                               </div>
                                </a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">

                        <div class="pricing-list text-left">
                            <a class="text-action" href="updateoffers.php">
                                <div class="pricing-header bg-indigo-600" style="height:185px; background-repeat: no-repeat;  background-image: url('uploads/8.png');">
                                    <div class="pricing-title">Offers</div>
                                    <div class="pricing-price">
                                        <span class="pricing-amount"></span>
                                    </div>
                                  </div>

                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

</div>
<script>
    function nofication(){
        var id = 002;
        //alert(id);
        $.ajax({
            type: "POST",
            url: "include/notification.php",
            data: "id=" + id,
            cache: false,
            beforeSend: function () {
                $("#login").val('Connecting...');
            },
            success: function (data) {
                if (data == "success") {
                    //alert("ok");
                }
                else {

                    alert("not");
                }
            }
        });
    }
</script>