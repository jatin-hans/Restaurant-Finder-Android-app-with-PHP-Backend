<?php
session_start();
$id=$_POST['id'];
include'config.php';
$query=mysqli_query($con,"select * from tbl_restourant WHERE id='$id'");
$res=mysqli_fetch_array($query);
?>
<form class="modal-content" name="frm" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="icon wb-close" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title" id="exampleFormModalLabel">Edit Detail For <font color="#62A8EA"><?php echo $res['name']; ?></font></h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
        <div class="row" style="color: black;">
            <div class="col-lg-4 form-group">
                <label>Restaurant Name</label>
                <input type="text" value="<?php echo $res['name']; ?>" style="color: #62A8EA;" class="form-control" name="resname" placeholder="First Name" required="">
            </div>
            <div class="col-lg-4 form-group">
                <label>Phone No</label>
                <input type="text" value="<?php echo $res['phone_no']; ?>" style="color: #62A8EA;" class="form-control" name="mobile"/>
            </div>
            <div class="col-lg-4 form-group">
                <label>Email</label>
                <input type="email" value="<?php echo $res['email']; ?>" style="color: #62A8EA;" class="form-control" name="email" >
            </div>
            <div class="col-lg-4 form-group">
                <label>Restaurant Type</label>
                <?php if($res['Vegtype'] == "Veg"){ ?>
                <div class="radio-custom radio-primary">
                    <input type="radio"  class="boder" checked id="inputVeryAwesome" name="restype" value="Veg" required>
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Veg </label>
                </div>
                <div class="radio-custom radio-primary">
                    <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Nonveg">
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Non-Veg</label>
                </div>
                <div class="radio-custom radio-primary">
                    <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Both">
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Both</label>
                </div>
                <?php }
                elseif($res['Vegtype'] == "Nonveg"){
                 ?>
                    <div class="radio-custom radio-primary">
                        <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Veg" required>
                        <label style="color: #62A8EA;" for="inputVeryAwesome">Veg </label>
                    </div>
                    <div class="radio-custom radio-primary">
                        <input type="radio"  class="boder" checked id="inputVeryAwesome" name="restype" value="Nonveg">
                        <label style="color: #62A8EA;" for="inputVeryAwesome">Non-Veg</label>
                    </div>
                    <div class="radio-custom radio-primary">
                        <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Both">
                        <label style="color: #62A8EA;" for="inputVeryAwesome">Both</label>
                    </div>
                    <?php
                }
                else{
                    ?>
                    <div class="radio-custom radio-primary">
                        <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Veg" required>
                        <label style="color: #62A8EA;" for="inputVeryAwesome">Veg </label>
                    </div>
                    <div class="radio-custom radio-primary">
                        <input type="radio"  class="boder" id="inputVeryAwesome" name="restype" value="Nonveg">
                        <label style="color: #62A8EA;" for="inputVeryAwesome">Non-Veg</label>
                    </div>
                    <div class="radio-custom radio-primary">
                        <input type="radio"  class="boder" checked id="inputVeryAwesome" name="restype" value="Both">
                        <label style="color: #62A8EA;" for="inputVeryAwesome">Both</label>
                    </div>
                    <?php
                }
                ?>
                </div>
            <div class="col-lg-8 form-group">
                <label>Address</label>
                <textarea class="form-control"  style="color: #62A8EA;" rows="5" name="address" ><?php echo $res['address']; ?></textarea>
            </div>
            <div class="col-lg-4 form-group">
                <label>Zipcode</label>
                <input type="text" value="<?php echo $res['zipcode']; ?>"  style="color: #62A8EA;" class="form-control" name="zipcode" >
            </div>
            <div class="col-lg-4 form-group">
                <label>Timing</label>
                <?php $r = strcspn($res['time'],"To");
                $result = substr($res['time'],0,$r); ?>
                <input type="text" value="<?php echo $result; ?>" style="color: #62A8EA;" class="form-control" name="time"  required="">
            </div>
            <div class="col-lg-4 form-group">
                <label>To</label>
                <?php $r1 = strcspn($res['time'],"To");
                        $a=$r1-0;
                $result1 = substr($res['time'],-$a); ?>
                <input type="text" value="<?php echo $result1; ?>" style="color: #62A8EA;" class="form-control" name="totime"  required="">
            </div>
            <div class="col-lg-12 form-group">

                <style>
                    #myMap {
                        height: 350px;
                        width: 680px;
                    }
                </style>

                <div id="myMap"></div>
                <input id="address" type="text" style="width:600px;"/><br/>
                <input type="text" id="latitude" placeholder="Latitude"/>
                <input type="text" id="longitude" placeholder="Longitude"/>

            </div>

            <div class="col-lg-6 form-group">
                <label>Latitude</label>
                <input type="text" value="<?php echo $res['latitude']; ?>" style="color: #62A8EA;" class="form-control" name="latitude" >
            </div>
            <div class="col-lg-6 form-group">
                <label>Longitude</label>
                <input type="text" value="<?php echo $res['longitude']; ?>" style="color: #62A8EA;" class="form-control" name="longitude" >
            </div>



            <div class="col-lg-8 form-group">
                <label>Thumbnail image</label>
                <input style="color: #62A8EA;" type="file" class="form-control" name="image" placeholder="Change image">
            </div>
            <div class="col-lg-4 form-group">
                <label>image</label>
                <img height="100" width="100" style="border: 1px solid #62A8EA ;" src="uploads/<?php echo $res['thumimage']; ?>"/>

            </div>

            <div class="col-lg-4 form-group">
                <label>Status</label>
                <div class="radio-custom radio-primary">
                    <?php if($res['is_active'] == 1){ ?>
                    <input type="radio" style="color: #62A8EA;" checked class="boder" id="inputVeryAwesome" name="status" value="1" required>
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" style="color: #62A8EA;" class="boder" id="inputVeryAwesome" name="status" value="0" required>
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Disabled</label>
                    <?php }
                    else
                    { ?>
                        <input type="radio" style="color: #62A8EA;" class="boder" id="inputVeryAwesome" name="status" value="1" required>
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Active &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                    <input type="radio" style="color: #62A8EA;" checked class="boder" id="inputVeryAwesome" name="status" value="0" required>
                    <label style="color: #62A8EA;" for="inputVeryAwesome">Disabled</label>
                   <?php  } ?>
                </div>
            </div>
            <div class="col-lg-8 form-group">
                <label class="col-lg-12 col-sm-9 control-label">Food Type</label>
                <div class="col-lg-12 col-sm-9">
                    <select class="form-control boder" id="browsers" name="foodcat[]" title="Please select at least one browser"
                            size="5" multiple="multiple" required="">
                          <label>Price</label>
                <input type="text" value="" style="color: #62A8EA;" class="form-control" name="cat1" placeholder="Enter Price" required="">
                        <?php
                        $qury=mysqli_query($con,"select * from tbl_foodcategories");
                        while($res=mysqli_fetch_array($qury)){
                          //  $test=mysqli_query($con,"update tbl_foodcategories join tbl_food set tbl_foodcategories.food_id=tbl_food.food_id");
                            $ry=mysqli_query($con,"select * from tbl_food WHERE food_id='$id' && food_type='".$res['name']."'");
                            $ddt=mysqli_fetch_array($ry);
                            if($ddt)
                            {

                                ?><option  value="<?php echo $res['name']; echo $res['Price']; ?>" selected><?php echo $res['name']; echo $res['Price'] ?></option><?php


                            }
                            else{
                                ?><option  value="<?php echo $res['name']; echo $res['Price']; ?>" ><?php echo $res['name']; echo $res['Price'];?></option><?php
                            }

                            ?>

                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php
            $rit=$_SESSION['uname'];
            $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
            $user=mysqli_fetch_array($qur);
            if($user['right'] == 1 ) {
            ?>
            <div class="col-sm-12 pull-right">
                <button class="btn btn-primary btn-outline" name="submit" type="submit">Update Restaurant</button>
            </div>
            <?php }
            else {
                ?>
                <div class="col-sm-12 pull-right">
                    <button class="btn btn-primary btn-outline" onclick="right()"  type="button">Update Restaurant</button>
                </div>
                <?php
            }?>
            <div class="form-group">
             </div>
    </div>
</form>
<script>
    function right(){
        alert("You Have Sample Admin ! Cannot Update Restaurant Detail !!! ");
    }
</script>
