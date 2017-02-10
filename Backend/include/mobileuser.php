<?php include("include/config.php"); ?>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Mobile User Detail</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Mobile User</li>
        </ol>
    </div>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-hover dataTable table-striped width-full" data-plugin="dataTable">
                    <thead>
                    <tr><td></td></tr>
                    </thead>
                    <tbody>
                    <?php $query=mysqli_query($con,"select * from tbl_mobileuser ORDER BY id DESC "); while($res=mysqli_fetch_array($query)){ ?>
                    <tr>
                        <td> <li class="list-group-item">
                                <div class="media">
                                    <div class="media-left"> <?php $first = $res['username']; $result = substr($first, 0, 1); $lateer=ucfirst($result);?>
                                        <div class="avatar avatar-off">
                                            <div style="height:50px ;width:50px ;border-radius:
                                             50px;background-color: #62A8EA;text-align: center;font-size: 30px;color: white;"> <?php echo $lateer;  ?></div>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">
                                            <?php echo  $res['username']; ?>
                                        </h4>
                                        <p> <i class="icon icon-color wb-envelope" aria-hidden="true"></i> <?php echo  $res['email']; ?> </p>
                                    </div>
                                    <div class="media-right">
                                        <button type="button" class="btn btn-outline btn-success btn-sm">Active</button>
                                    </div>
                                </div>
                            </li> </td>
                        <?php } ?>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>