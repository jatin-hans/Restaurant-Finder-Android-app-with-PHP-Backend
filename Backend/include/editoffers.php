<?php include("include/config.php"); ?>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Restaurant Offers</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Edit Offer</li>
        </ol>
    </div>
    <div class="page-content container-fluid">
            <style>.boder  {   border: solid darkgrey 1px;   } </style>
        <button class="btn btn-primary" data-target="#exampleFormModal" data-toggle="modal" type="button"><i class="wb-plus"></i>&nbsp;&nbsp;Add New Offers</button>&nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary" data-target="#model" data-toggle="modal" type="button">
            <i class="wb-close"></i>&nbsp;&nbsp;Remove Offers Image</button>
        <div id="demo" style="color: green;"></div>
        <div id="error" style="color: red;"></div>
            <div class="panel-body">
                <form  method="post" action="upload.php"  id="uploadform" enctype="multipart/form-data" >
                    <div class="row row-lg">
                        <div class="col-lg-6 form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 ">Restaurant Name</label> <?php
                                $query=mysqli_query($con,"select * from tbl_restourant"); ?>
                                <div class="col-lg-12 col-sm-9">
                                    <select class="form-control" name="name" id="name" onchange="editoffers()"  required="">
                                        <option value="">Select Restaurant</option>
                                        <?php while($row=mysqli_fetch_array($query)) {
                                            $query1 = mysqli_query($con, "select * from tbl_offers WHERE restaurant_id='" . $row['id'] . "'");
                                            $dat=mysqli_fetch_array($query1);
                                            if ($dat) { ?>
                                                <option  value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option> <?php
                                            } else { } }?>
                                    </select>
                                </div>
                            </div>
                            <div id="showresults" style="color: Green; ">
                                <div id="loader" style="display:none;"> <center><img src="uploads/load.gif" /></center> </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9">Change Images</label>
                                <div class="col-lg-12 col-sm-9">
                                    <input class="form-control boder"  type="file" name="file" id="image" required=""/>
                                </div>
                            </div>
                            <div id="demo" style="color: green;"></div>
                            <div id="error" style="color: red;"></div>
                        </div>
                        <script> function onsuccess(response,status) {
                                var sc = "Your Offers Image Change Successfully !!!"
                                $("#loader").hide();
                                $("#showresults").html("Status :<b>"+sc+'</b><div id="msg">'+response+'</div>'); }
                                $("#uploadform").on('submit',function(){
                                $("#loader").show();
                                var options={ url     : $(this).attr("action"),  success : onsuccess }; $(this).ajaxSubmit(options); return false; });
                        </script>

                    </div>
                    <?php
                    $riti=$_SESSION['uname'];
                    $qury=mysqli_query($con,"select * from adminlogin WHERE Username='$riti'");
                    $user1=mysqli_fetch_array($qury);
                    if($user1['right'] == 1 ) { ?>
                    <div class="form-group col-lg-12 text-left padding-top-m">
                        <input  type="submit" class="btn btn-primary" id="submit"  name="submit" value="Update Offers">
                    </div>
                    <?php }  else{ ?>
                        <div class="form-group col-lg-12 text-left padding-top-m">
                            <input  type="submit" class="btn btn-primary"  onclick="righteditofr()" value="Update Offers">
                        </div> <?php } ?>
                    </div>
            </form>
        </div>
    <div class="modal fade" id="exampleFormModal" aria-hidden="false" aria-labelledby="exampleFormModalLabel"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content"  name="frm" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="wb-close"></i></button>
                    <h4 class="modal-title" id="exampleFormModalLabel">Add New Restaurant Offres</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                            <div class="row row-lg">
                                <div class="col-lg-8 form-horizontal">
                                    <div class="form-group">
                                        <label class="col-lg-12 col-sm-3 ">Restaurant Name</label>
                                        <?php  $query=mysqli_query($con,"select * from tbl_restourant");  ?>
                                        <div class="col-lg-12 col-sm-9">
                                            <select class="form-control" name="offname" id="name"  required="">
                                                <option value="">Select Restaurant</option>
                                                <?php while($row=mysqli_fetch_array($query)){
                                                    $query1 = mysqli_query($con, "select * from tbl_offers WHERE restaurant_id='" . $row['id'] . "'");
                                                    $dat=mysqli_fetch_array($query1);
                                                    if ($dat) { } else { ?> <option id="opt" value="<?php echo $row['id'] ?>"> <?php echo $row['name']; ?></option><?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-12 col-sm-9">Select Images</label>
                                        <div class="col-lg-12 col-sm-9">
                                            <input class="form-control boder" type="file" name="offimage" id="image" required=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        $rit=$_SESSION['uname'];
                        $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
                        $user=mysqli_fetch_array($qur);
                        if($user['right'] == 1 ) { ?>
                        <div class="modal-footer">
                            <button  type="submit" class="btn btn-primary" name="addoffer" type="submit" >Add Offers</button>
                        </div>
                        <?php }  else { ?>
                            <div class="modal-footer">
                                <button  type="submit" class="btn btn-primary" onclick="rightaddofr()"  type="button" >Add Offers</button>
                            </div>
                            <?php } ?>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    <div class="modal fade" id="model" aria-hidden="false" aria-labelledby="exampleFormModalLabel"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content"  name="frm" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="wb-close"></i> </button>
                    <h4 class="modal-title" id="exampleFormModalLabel">Remove Offres image</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row row-lg">
                            <div class="col-lg-8 form-horizontal">
                                <div class="form-group">
                                    <label class="col-lg-12 col-sm-3 ">Restaurant Name</label>
                                    <?php  $query=mysqli_query($con,"select * from tbl_restourant"); ?>
                                    <div class="col-lg-12 col-sm-9">
                                        <select class="form-control" name="offname" id="offname" onchange="removeffers()"  required="" >
                                            <option value="">Select Restaurant</option>
                                            <?php while($row=mysqli_fetch_array($query)){
                                                $query1 = mysqli_query($con, "select * from tbl_offers WHERE restaurant_id='" . $row['id'] . "'");
                                                $dat=mysqli_fetch_array($query1);
                                                if ($dat) { ?> <option id="opt" value="<?php echo $row['id'] ?>"> <?php echo $row['name']; ?></option><?php } else { ?>
                                                <?php }?> <?php } ?>
                                        </select> <br/> <div id="remove" style="color: Green; "></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $rit=$_SESSION['uname'];
                        $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
                        $user=mysqli_fetch_array($qur);
                        if($user['right'] == 1 ) { ?>
                            <div class="modal-footer">
                                <button  type="submit" class="btn btn-primary" name="remove" type="submit" >Remove Offers</button>
                            </div>
                        <?php }  else { ?>
                            <div class="modal-footer">
                                <button  type="submit" class="btn btn-primary" onclick="rightaddofr()"  type="button" >Remove Offers</button>
                            </div> <?php } ?>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
<?php include'controler/editoffers_controler.php';  ?>
