<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include'include/config.php';
if (isset($_GET['value']))
{
    $id = $_GET['value'];
    $query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.vegtype,tbl_restourant.thumimage,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 ,tbl_food.food_type, GROUP_CONCAT(tbl_images.img_url) AS images, GROUP_CONCAT(tbl_food.food_type) AS foods
FROM tbl_restourant
 JOIN   tbl_images ON tbl_restourant.id = tbl_images.image_id
 JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE tbl_restourant.id='$id' ");
    $querydata = mysqli_query($con, "select * from tbl_restourant WHERE id='$id'");
    $redata = mysqli_num_rows($querydata);
    if ($redata > 0) {

        while ($row = mysqli_fetch_assoc($query)) {
            $sql = mysqli_query($con, "SELECT res_id, AVG(ratting) AS ratavg FROM tbl_userfeedback WHERE res_id='" . $row['id'] . "'");
            while ($res = mysqli_fetch_array($sql)) {
                $avg = $res['ratavg'];
                $vg1 = round($avg, 1);
            }
            $rev = mysqli_query($con, "select * from tbl_userfeedback WHERE res_id='" . $row['id'] . "' ");
            $my = mysqli_num_rows($rev);
            $emparray[] = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "address" => $row['address'],
                "latitude" => $row['latitude'],
                "longitude" => $row['longitude'],
                "ratting" => $vg1,
                "vegtype" => $row['vegtype'],
                "zipcode" => $row['zipcode'],
                "food_type" => $row['food_type'],
                "phone_no" => $row['phone_no'],
                "time" => $row['time'],
                "video" => $row['video'],
                "email" => $row['email'],
                "totalreview" => $my,
                "images" => $row['images']
            );

        }
        $json['Restaurant'] = $emparray;

        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    }
    else {

        $arr[] = array("id" => "record not found");
        $json12['Error'] = $arr;
        echo json_encode($json12);
    }
}
 ?>