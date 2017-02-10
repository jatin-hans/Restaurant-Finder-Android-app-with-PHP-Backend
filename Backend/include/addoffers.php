<?php include("include/config.php"); ?>
<div class="page animsition">
    <div class="page-header">
        <h1 class="page-title">Add Restaurant Offers</h1>
        <ol class="breadcrumb">
            <li><a href="master.php">Home</a></li>
            <li class="active">Add Offers</li>
        </ol>
    </div>
    <div class="page-content container-fluid">
        <!-- Panel Full Example -->
        <div class="panel">
            <style>
                .boder {
                    border: solid darkgrey 1px;
                }
            </style>
            <style>
                #fileupload {
                    background: white;
                    color: #ffffff;
                    font-size: 18px;
                    border: 1px solid grey;
                }
            </style>
            <div class="panel-body">
                <form id="" method="post" enctype="multipart/form-data" onsubmit="addoffers()">
                    <div class="row row-lg">
                        <div class="col-lg-6 form-horizontal">
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-3 ">Restaurant Name</label>
                                <?php
                                $query = mysqli_query($con, "select * from tbl_restourant");
                                ?>
                                <div class="col-lg-12 col-sm-9">
                                    <select class="form-control" name="name" id="name" required="">
                                        <option value="">Select Restaurant</option>
                                        <?php while ($row = mysqli_fetch_array($query)) { ?>
                                            <option id="opt"
                                                    value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-12 col-sm-9">Select Images</label>
                                <div class="col-lg-12 col-sm-9">
                                    <input class="form-control boder" type="file" name="image" id="image" required=""/>
                                </div>
                            </div>
                            <div id="demo" style="color: green;"></div>
                            <div id="error" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 text-left padding-top-m">
                        <input type="submit" class="btn btn-primary" name="submit" value="Add Offers">
                    </div>
            </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['name'];
                $check = mysqli_query($con, "select * from tbl_offers WHERE restaurant_id='$id'");
                $res = mysqli_fetch_array($check);
                if ($res) { ?>
                    <script> document.getElementById("error").innerHTML = "!!! allready set offers image !!! Please edit ! ";</script><?php
                } else {
                    $qury = mysqli_query($con, "select name from tbl_restourant WHERE id='$id'");
                    $off = mysqli_fetch_array($qury);
                    $name = $off['name'];
                    $tmpFilePath = $_FILES['image']['tmp_name'];
                    $id = uniqid();
                    $newFilePath = "uploads/offers/" . $id . $_FILES['image']['name'];
                    $imagepath = $id . $_FILES['image']['name'];
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $id = $_POST['name'];
                        $qury1 = mysqli_query($con, "insert into tbl_offers (restaurant_id,title,image) VALUE ('$id','$name','$imagepath')");
                        if ($qury1) {
                            ?>
                            <script>window.location = '';
                                document.getElementById("demo").innerHTML = "!!! Offers Add Successfuly !!! ";</script><?php
                        } else { echo "not"; }
                    }
                }
            }
            ?>
        </div>
    </div>
</div>
</div>
</div>
