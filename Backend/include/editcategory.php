<?php
session_start();
$id=$_POST['id'];
include'config.php';
$query=mysqli_query($con,"select * from tbl_foodcategories WHERE id='$id'");
$res=mysqli_fetch_array($query);  ?>
<form class="modal-content" name="frm" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="icon wb-close" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title" id="exampleFormModalLabel"><?php echo $res['name']; ;?></h4>
    </div>
    <div class="modal-body">
        <div class="row" style="color: black;">
            <div class="col-lg-8 form-group">
                <label>Dish Name</label>
                <input type="text" value="<?php echo $res['name'] ;?>" style="color: #62A8EA;" class="form-control" name="cat" placeholder="First Name" required="">
                <input type="hidden"  name="id" value="<?php echo $res['id'] ?>" >
            </div>
            <div class="col-lg-8 form-group">
                <label>Price</label>
                <input type="text" value="<?php echo $res['Price'] ;?>" style="color: #62A8EA;" class="form-control" name="cat1" placeholder="Price" required="">
                <input type="hidden"  name="id" value="<?php echo $res['id'] ?>" >
            </div>
            
           
            <div class="col-lg-8 form-group">
                <img height="100" width="100" src="uploads/category/<?php echo $res['image']; ?>"/>
            </div>
            <div class="col-lg-6 form-group">
                <label>Change image</label>
                <input type="file" value="" style="color: #62A8EA;" class="form-control" name="image" />
            </div>
        </div>
        <?php
        $rit=$_SESSION['uname'];
        $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
        $user=mysqli_fetch_array($qur);
        if($user['right'] == 1 ) { ?>
        <div class="modal-footer">
            <button class="btn btn-primary" name="submit" type="submit" >Update Category</button>
        </div>
            <?php }  else{ ?>
            <div class="modal-footer">
                <button class="btn btn-primary" type="button" onclick="rightedtcat()">Update Category</button>
            </div>
            <?php } ?>
    </div>
</form>
<script> function rightedtcat(){ alert("You Have Sample Admin ! Cannot Update Food Category"); } </script>