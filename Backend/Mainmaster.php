<?php
include("include/config.php");
$qury = mysqli_query($con, "select id from tbl_restourant ");
while ($res = mysqli_fetch_assoc($qury)) {
    $query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 , GROUP_CONCAT(tbl_images.img_url) AS images /*,GROUP_CONCAT(tbl_food.food_type) AS foods*/
FROM tbl_restourant
 JOIN   tbl_images ON tbl_restourant.id = tbl_images.image_id
/* JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id*/
WHERE tbl_restourant.id='" . $res['id'] . "' ");
    while ($row = mysqli_fetch_assoc($query)) {
        $emparray[] =$row;
    }
$json['Restaurant']=$emparray;
}
echo json_encode($json);
?>