<div class="site-menubar">
    <div class="site-menubar-body">
        <div>
            <div>
                <ul class="site-menu">
                    <li class="site-menu-category">Menu</li>
                    <li class="site-menu-item has-sub">
                        <a  class="animsition-link"  href="master.php" data-slug="dashboard">
                            <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                            <span class="site-menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="site-menu-item has-sub">
                         <a href="javascript:void(0)" data-slug="layout"><i class="site-menu-icon wb-menu" aria-hidden="true"></i> <span class="site-menu-title">Restaurant</span><span class="site-menu-arrow"></span></a>
                         <ul class="site-menu-sub">
                             <li class="site-menu-item">
                                 <a class="animsition-link"  href="viewrestourant.php" data-slug="layout"><span class="site-menu-title">Restaurant Detail</span></a>
                             </li>
                             <li class="site-menu-item">
                                 <a class="animsition-link" href="addrestourant.php"> <span class="site-menu-title">New Restaurant</span></a>
                             </li>
                             <li class="site-menu-item">
                                 <a class="animsition-link" href="addrestaurantimage.php" data-slug="layout"><span class="">Restaurant images</span></a>
                             </li>
                             <li class="site-menu-item">
                                 <a href="addfoodcategori.php" data-slug="layout"><span class="site-menu-title">Food Categories</span></a>
                             </li>
                         </ul>
                     </li>
                    <li class="site-menu-item"></li>
                    <li class="site-menu-item has-sub">
                        <a href="javascript:void(0)" data-slug="layout"><i class="site-menu-icon wb-users" aria-hidden="true"></i><span class="site-menu-title">User</span><span class="site-menu-arrow"></span></a>
                        <ul class="site-menu-sub">
                            <li class="site-menu-item">
                                <a class="animsition-link" href="viewmobileuser.php" data-slug="layout"><span class="site-menu-title">View Mobile User</span></a>
                            </li>
                            <li class="site-menu-item">
                                <a class="animsition-link" onclick="nofication()" href="viewuserfeedback.php" data-slug="layout">
                                    <span class="site-menu-title">View User Feedback</span>
                                    <?php  include'include/config.php';$qury=mysqli_query($con,"select * from tbl_userfeedback WHERE notification=1 ");$not=mysqli_num_rows($qury);
                                    if($not == 0) {  ?>
                                    <?php } else { ?>
                                        <div class="site-menu-badge">
                                        <span class="badge badge-danger"><?php echo $not; ?></span></div>
                                    <?php  } ?>
                                </a>
                            </li>
                        <script>
                            function nofication(){ var id = 002;
                                 $.ajax({ type: "POST",  url: "include/notification.php",  data: "id=" + id,  cache: false,
                                    beforeSend: function () {$("#login").val('Connecting...'); },
                                    success: function (data) { if (data == "success") { }  else { } }
                                }); }
                        </script>
                        </ul>
                    </li>
                    <li class="site-menu-item has-sub">
                        <a class="animsition-link" href="updateoffers.php" data-slug="layout"><i class="site-menu-icon wb-star" aria-hidden="true"></i><span class="site-menu-title">Offers</span></a>
                    </li>
                    <?php  $rit=$_SESSION['uname']; $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'"); $user=mysqli_fetch_array($qur);
                    if($user['right'] == 1 ) { ?>
                    <li class="site-menu-item has-sub">
                        <a class="animsition-link" href="servicelist.php" data-slug="layout"> <i class="site-menu-icon wb-code-working" aria-hidden="true"></i> <span class="site-menu-title">Web Services</span></a>
                    </li>
                    <?php }  else { ?> <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="site-menubar-footer">
        <a href="master.php" class="fold-show" data-placement="top" data-toggle="tooltip" data-original-title="Home">
            <span class="icon wb-home" aria-hidden="true"></span>
        </a>
        <a href="changepassword.php" data-placement="top" data-toggle="tooltip" data-original-title="Change Password">
            <span class="icon wb-edit" aria-hidden="true"></span>
        </a>
        <a href="include/logout.php" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
            <span class="icon wb-power" aria-hidden="true"></span>
        </a>
    </div>
</div>

