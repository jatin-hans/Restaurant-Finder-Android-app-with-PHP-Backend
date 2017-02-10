<style>
    #fileupload {
        background: white;
        color: #ffffff;
        font-size: 18px;
        border: 1px solid grey;
    }
</style>
<form class="modal-content" name="frm" method="post" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="icon wb-close" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title" id="exampleFormModalLabel">Add New Dish</h4>
    </div>
    <div class="modal-body">

        <div class="row" style="color: black;">
            <div class="col-lg-8 form-group">
                <label>Dish Name</label>
                <input type="text" value="" style="color: #62A8EA;" class="form-control" name="cat" placeholder="Enter Dish Name" required="">
            </div>
              <div class="col-lg-8 form-group">
                <label>Price</label>
                <input type="text" value="" style="color: #62A8EA;" class="form-control" name="cat1" placeholder="Enter Price" required="">
            </div>
            <div class="col-lg-8 form-group">
                <input type="file" value="" style="color: #62A8EA;" class="form-control" name="image" required="">
            </div>
        </div>
        <?php
        session_start();
        include'config.php';
        $rit=$_SESSION['uname'];
        $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'");
        $user=mysqli_fetch_array($qur);
        if($user['right'] == 1 ) {
        ?>
        <div class="modal-footer">
            <button class="btn btn-primary" name="addcat" type="submit" >Add Dish</button>
        </div>
        <?php }
        else{
            ?>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="rightadd()" type="button" >Add Dish</button>
            </div>
            <?php
        }?>

    </div>
</form>
<script>
    function rightadd(){
        alert("You Have Sample Admin ! Cannot Add Food Category");
    }
</script>