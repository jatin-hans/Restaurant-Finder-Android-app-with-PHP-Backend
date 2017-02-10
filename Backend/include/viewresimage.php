<?php  session_start(); include'config.php'; $id=$_POST['id']; $query=mysqli_query($con,"select * from tbl_images WHERE image_id='$id'"); ?>
<?php  while($data=mysqli_fetch_array($query)){ ?>
    <li>
        <div class="category" style="background-color: #F1F4F5; border: 1px solid #F1F4F5; ">
            <div class="icon-wrap">
                <img src="uploads/<?php echo $data['img_url']; ?>" height="150" width="250">
            </div>
            <?php  $rit=$_SESSION['uname']; $qur=mysqli_query($con,"select * from adminlogin WHERE Username='$rit'"); $user=mysqli_fetch_array($qur);
            if($user['right'] == 1 ) { ?>
            <button type="button" class="btn btn-sm btn-icon btn-danger btn-round" style="margin-left:-250px;margin-top:-320px;"  onclick="deleteimage(<?php echo $data['id']; ?>,<?php echo $data['image_id']; ?>)"> <i class="icon wb-close" aria-hidden="true" ></i></button>
            <?php }  else { ?>
                <button type="button" class="btn btn-sm btn-icon btn-danger btn-round" style="margin-left:-250px;margin-top:-320px;"
                        onclick="rightdelimg()">
                    <i class="icon wb-close" aria-hidden="true" ></i>
                </button>
                <?php } ?>
        </div>
    </li>
<?php } ?>
<script> function rightdelimg() { alert("You Have Sample Admin ! Cannot Delete Restaurant Images "); } </script>
