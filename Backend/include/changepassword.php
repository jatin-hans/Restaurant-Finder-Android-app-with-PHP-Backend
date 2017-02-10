<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Change Admin Password</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Change Password</li>
        </ol>
    </div>
    <div class="page-content">
        <div class="panel">
            <div class="panel-body container-fluid">
                <div class="row row-lg">
                    <div class="clearfix hidden-xs"></div>
                    <div class="col-sm-12 col-md-6">
                        <div class="example-wrap">
                            <div class="example">
                                <form class="form-horizontal" method="post">
                                    <div id="msg2" style="color: green;"></div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Old Password: </label>
                                        <div class="col-sm-8">
                                            <input type="password" required="" class="form-control"
                                                   name="oldpass" placeholder="Enter Old Password" autocomplete="off"/>
                                            <div id="msg1" style="color: indianred"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">New Password: </label>
                                        <div class="col-sm-8">
                                            <input type="password" required="" class="form-control pass" name="pass" placeholder="Enter New Password"
                                                   autocomplete="off"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Confirm Password: </label>
                                        <div class="col-sm-8">
                                            <input type="password" required="" class="form-control cpass" name="conpass" placeholder="Enter Confirm Password"
                                                   autocomplete="off" onblur="confirmpass()" />
                                            <div id="msg" style="color: indianred;"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-9 col-sm-offset-3">
                                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Change Password </button>
                                            <button type="reset" class="btn btn-default btn-outline">Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include'controler/changepass_controler.php'; ?>