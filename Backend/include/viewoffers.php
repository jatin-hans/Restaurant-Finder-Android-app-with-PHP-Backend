<?php
include'config.php'; $id=$_POST['id']; $query=mysqli_query($con,"select * from tbl_offers WHERE restaurant_id='$id'"); if($query){
while($res=mysqli_fetch_array($query)){
    echo "<a class="."imageref"." href="."#"."><img src="."uploads/offers/".$res['image']." height="."130"." width="."250"." /></a>"; echo "&nbsp;";}
} else { } ?>