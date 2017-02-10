<?php
include("include/config.php");
if(isset($_GET['value'])) {
$query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,
tbl_restourant.email,tbl_restourant.is_active, tbl_restourant.Vegtype ,tbl_foodtype.foodtype,tbl_foodtype.price,tbl_foodtype.img /*, GROUP_CONCAT(tbl_food.food_type) AS foods*/
FROM tbl_restourant
JOIN tbl_foodtype ON tbl_restourant.id=tbl_foodtype.ft_id
/*JOIN tbl_foodcategories ON tbl_foodcategories.name=tbl_food.food_type*/
WHERE tbl_restourant.id='" . $_GET['value'] . "'"); 
    while ($row = mysqli_fetch_assoc($query)) {
        $emparray[] =
            array(
                "id" => $row['id'],
                "food_type" => $row['foodtype'],
                "Vegtype" => $row['Vegtype'],
                "price" => $row['price'],
                "img" => $row['img']
             
            );
        
        
    }
    $json['Foodtype'] = $emparray;
    echo json_encode($json);
}
else
{
    $qu=mysqli_query($con,"select * from tbl_restourant");
    while($r=mysqli_fetch_assoc($qu))
    {
    $query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 , GROUP_CONCAT(tbl_food.food_type) AS foods
FROM tbl_restourant
JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE tbl_restourant.id='" . $r['id'] . "' ");
    while ($row = mysqli_fetch_assoc($query))
    {
        $emparray[] =
            array(
                "id" => $row['id'],
                "foodtype" => $row['foods']
            );
    }
    $json['Foodtype'] = $emparray;
}
    echo json_encode($json);
}
?>