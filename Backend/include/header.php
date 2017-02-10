<nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </button>
        <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-search"
                data-toggle="collapse">
            <span class="sr-only">Toggle Search</span>
            <i class="icon wb-search" aria-hidden="true"></i>
        </button>
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
            <img class="navbar-brand-logo" src="uploads/logo.png" title="Remark" style="border: 1px solid white;border-radius: 20px;">
            <span class="navbar-brand-text"> Restaurant </span>
        </div>
    </div>
    <div class="navbar-container container-fluid" style="background-color:white;">
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <ul class="nav navbar-toolbar">
                <li class="hidden-float" id="toggleMenubar">
                    <a data-toggle="menubar"  href="#" role="button">
                        <i class="icon hamburger hamburger-arrow-left">
                            <span class="sr-only">Toggle menubar</span>
                            <span class="hamburger-bar"></span>
                        </i>
                    </a>
                </li>
            </ul>
            <?php
            include'include/config.php'; $query=mysqli_query($con,"select * from tbl_userfeedback WHERE notification=1"); $d=mysqli_num_rows($query);  ?>
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="dropdown">
                    <a onclick="nofication()" data-toggle="dropdown" href="javascript:void(0)" title="Messages" aria-expanded="false"
                       data-animation="slide-bottom" role="button">
                        <i class="icon wb-bell" aria-hidden="true"></i>
                        <span class="badge badge-info up"><?php echo $d;  ?></span>
                    </a>
                    <script>
                        function nofication(){ var id = 002;
                            $.ajax({
                                type: "POST",
                                url: "include/notification.php",
                                data: "id=" + id,
                                cache: false,
                                beforeSend: function () { $("#login").val('Connecting...'); },
                                success: function (data) { if (data == "success") { }  else { } }
                            });
                        }
                    </script>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media" role="menu">
                        <li class="dropdown-menu-header" role="presentation">
                            <h5>User Review</h5>
                            <span class="label label-round label-info">New <?php echo $d;  ?></span>
                        </li>
                        <li class="list-group" role="presentation">
                            <div data-role="container">
                                <div data-role="content">
                                    <?php while($row=mysqli_fetch_array($query)){ ?>
                                    <a class="list-group-item" href="javascript:void(0)" role="menuitem">
                                        <div class="media">
                                            <div class="media-left padding-right-10">
                                                <div class="media-left">
                                                    <?php  $first = $row['username']; $result = substr($first, 0, 1); $lateer=ucfirst($result); ?>
                                                    <div class="avatar avatar-off">
                                                        <div style="height:50px ;width:50px ;border-radius:
                                             50px;background-color: #62A8EA;text-align: center;font-size: 30px;color: white;"> <?php echo $lateer;  ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php  $n=mysqli_query($con,"select * from tbl_restourant WHERE id='".$row['res_id']."' "); $name=mysqli_fetch_array($n);  ?>
                                            <div class="media-body">
                                                <h6 class="media-heading"><?php echo $row['username']; ?></h6>
                                                <div class="media-meta">
                                                    <time datetime="2015-06-17T20:22:05+08:00">For :<?php echo $name['name']; ?></time>
                                                </div>
                                                <?php if($row['ratting']== 1){ ?>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                    <i class="text-like icon wb-star"></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                <?php } elseif ($row['ratting']== 2) { ?>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                <?php } elseif($row['ratting']== 3){ ?>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                    <i class="text-like icon wb-star" ></i>
                                                <?php } elseif($row['ratting']== 4){ ?>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" "></i>
                                                <?php } else { ?>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                    <i class="text-like icon wb-star" style="color: orange;"></i>
                                                <?php } ?> <div class="media-detail"><?php echo $row['comment']; ?></div> </div> </div></a> <?php } ?>
                                </div>
                            </div>
                        </li>
                        <li class="dropdown-menu-footer" role="presentation">
                            <a  class="dropdown-menu-footer-btn" href="viewuserfeedback.php" ><i class="icon wb-settings" aria-hidden="true"></i></a>
                            <a href="viewuserfeedback.php" role="menuitem">See all messages </a>
                        </li>
                    </ul>
                </li>
<style> .avatar-me-wrapper {
        min-height: 48px;
        overflow: hidden;
        padding-left: 58px;
        position: relative;  }
    .avatar-me {
        background-color:#62A8EA;
        color: #fff;
        display: block;
        height: 48px;
        left: 0;
        padding: 0 10px;
        text-align: center;
        text-overflow: ellipsis;
        text-transform: uppercase;
        top: 0;
        white-space: nowrap;
        width: 48px;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
    }
    .avatar-me {
        line-height: 32px;
        font-size: 18px;
        font-weight: 300;
    }
   .avatar-me {
            margin-top: -10px;
            height: 35px;
            width: 35px;
        }
        .avatar-me { font-size: 20px; }
    
</style>
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="slide-bottom" role="button"><?php echo $_SESSION['uname']; ?>
                        <?php $first = $_SESSION['uname']; $result = substr($first, 0, 1); $lateer=ucfirst($result);?>
                        <span class="avatar avatar-online"><span class="avatar-me"> <?php echo $lateer;  ?></span><i></i></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li role="presentation">
                            <a href="changepassword.php" role="menuitem"><i class="icon wb-edit" aria-hidden="true"></i> Change Password</a>
                        </li>
                        <li class="divider" role="presentation"></li>
                        <li role="presentation">
                            <a href="include/logout.php" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        </div>
         <div class="collapse navbar-search-overlap" id="site-navbar-search">
            <form role="search">
                <div class="form-group">
                    <div class="input-search">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" name="site-search" placeholder="Search...">
                        <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>