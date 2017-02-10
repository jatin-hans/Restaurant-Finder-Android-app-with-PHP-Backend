<?php
include("include/config.php");
if (isset($_GET['search'])) {
    $id = $_GET['search'];
    $query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.vegtype,tbl_restourant.thumimage,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 /*, GROUP_CONCAT(tbl_images.img_url) AS images*/ /*GROUP_CONCAT(tbl_food.food_type) AS foods*/


FROM tbl_restourant

 /*JOIN   tbl_images ON tbl_restourant.id = tbl_images.image_id*/
 JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE
 tbl_restourant.name LIKE  '" . $id . "%'
 OR tbl_restourant.zipcode LIKE  '%" . $id . "'
 OR tbl_restourant.vegtype LIKE '" . $id . "%'
ORDER BY id DESC
  ");
    $query1 = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.vegtype,tbl_restourant.thumimage,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 /*, GROUP_CONCAT(tbl_images.img_url) AS images*/ /*GROUP_CONCAT(tbl_food.food_type) AS foods*/

FROM tbl_restourant
 /*JOIN   tbl_images ON tbl_restourant.id = tbl_images.image_id*/
 JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE
 tbl_restourant.name LIKE  '" . $id . "%'
 OR tbl_restourant.zipcode LIKE  '%" . $id . "'
 OR tbl_restourant.vegtype LIKE '" . $id . "%'

  ");
    $res = mysqli_fetch_assoc($query1);
    if ($res) {
        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $sql = mysqli_query($con, "SELECT res_id, AVG(ratting) AS ratavg FROM tbl_userfeedback WHERE res_id='" . $row['id'] . "'");
                while ($res = mysqli_fetch_array($sql)) {
                    $avg = $res['ratavg'];
                    $vg1 = round($avg, 1);
                }
                $rev = mysqli_query($con, "select * from tbl_userfeedback WHERE res_id='" . $row['id'] . "' ");
                $my = mysqli_num_rows($rev);
                /* $qry=mysqli_query($con,"select food_type from tbl_food WHERE food_id='".$row['id']."' ");
                 while($data=mysqli_fetch_assoc($qry)){
                      $a[]=$data;
                 }
                 $b=array($a);*/

                $emparray[] = array(
                    "id" => $row['id'],
                    "name" => $row['name'],
                    "address" => $row['address'],
                    "latitude" => $row['latitude'],
                    "longitude" => $row['longitude'],
                    "ratting" => $vg1,
                    "vegtype" => $row['vegtype'],
                    "zipcode" => $row['zipcode'],
                    /*"phone_no" => $row['phone_no'],
                    "time" => $row['time'],
                    "video" => $row['video'],
                    "email" => $row['email'],*/
                    "totalreview" => $my,
                    "thumbnailimage" => $row['thumimage']

                    /* "food"=>$b*/


                );

            }
            if (isset($emparray)) {
                $json['Restaurant'] = $emparray;
            }
            else {
                $arr[] = array("id" => "record not found");
                $json['Error'] = $arr;
                echo json_encode($json);
            }
        }

        echo json_encode($json, JSON_UNESCAPED_SLASHES);

    }
    else {
        $id = $_GET['search'];
        $query = mysqli_query($con, "select food_id,food_type from tbl_food WHERE food_type LIKE '%" . $id . "%'");
        $query1 = mysqli_query($con, "select food_id,food_type from tbl_food WHERE food_type LIKE '%" . $id . "%'");
        $res1 = mysqli_fetch_assoc($query1);
        if ($res1) {
            if ($query) {
                while ($res = mysqli_fetch_assoc($query)) {
                    $query2 = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.vegtype,tbl_restourant.thumimage,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 ,/* GROUP_CONCAT(tbl_images.img_url) AS images*/ GROUP_CONCAT(tbl_food.food_type) AS foods
FROM tbl_restourant
 /*JOIN   tbl_images ON tbl_restourant.id = tbl_images.image_id*/
JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE tbl_restourant.id='" . $res['food_id'] . "' ");
                    $row = mysqli_fetch_assoc($query2);
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
                        "zipcode" => $row['zipcode'],
                        "vegtype" => $row['vegtype'],
                        "totalreview" => $my,
                        "thumbnailimage" => $row['thumimage']


                    );

                }
                $json['Restaurant'] = $emparray;
            }
            echo json_encode($json, JSON_UNESCAPED_SLASHES);
        }
        else {

            $arr[] = array("id" => "record not found");
            $json['Error'] = $arr;
            echo json_encode($json);

        }
    }


}
elseif (isset($_GET['value']))
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
    } else {

        $arr[] = array("id" => "record not found");
        $json12['Error'] = $arr;
        echo json_encode($json12);
    }
}
else {

    $qury = mysqli_query($con, "select id from tbl_restourant ");
    while ($res = mysqli_fetch_assoc($qury)) {
        $query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.vegtype,tbl_restourant.thumimage,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
 ,/* GROUP_CONCAT(tbl_images.img_url) AS images*/ GROUP_CONCAT(tbl_food.food_type) AS foods
FROM tbl_restourant
 /*JOIN   tbl_images ON tbl_restourant.id = tbl_images.image_id*/
JOIN tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE tbl_restourant.id='" . $res['id'] . "' ");
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
                "zipcode" => $row['zipcode'],
                "vegtype" => $row['vegtype'],
                "totalreview" => $my,
                "thumbnailimage" => $row['thumimage']

            );

        }
        $json['Restaurant'] = $emparray;
    }

    echo json_encode($json, JSON_UNESCAPED_SLASHES);


}
?>
<?php
/*include'include/config.php';
$query = mysqli_query($con, "
SELECT tbl_restourant.id,tbl_restourant.name,tbl_restourant.address,tbl_restourant.latitude,tbl_restourant.longitude,
tbl_restourant.ratting,tbl_restourant.vegtype,tbl_restourant.thumimage,
tbl_restourant.zipcode,tbl_restourant.phone_no,tbl_restourant.time,tbl_restourant.video,tbl_restourant.email,tbl_restourant.is_active
,  GROUP_CONCAT(tbl_food.food_type) AS foods
FROM tbl_restourant
JOIN   tbl_food ON tbl_restourant.id=tbl_food.food_id
WHERE tbl_restourant.id=18 ");
$querydata = mysqli_query($con, "select * from tbl_restourant WHERE id=18");
$redata = mysqli_num_rows($querydata);
if ($redata > 0) {

while ($row = mysqli_fetch_assoc($query)) {
$sql = mysqli_query($con, "SELECT res_id, AVG(ratting) AS ratavg FROM tbl_userfeedback WHERE res_id=18");
while ($res = mysqli_fetch_array($sql)) {
$avg = $res['ratavg'];
$vg1 = round($avg, 1);
}
$rev = mysqli_query($con, "select * from tbl_userfeedback WHERE res_id='" . $row['id'] . "' ");
$my = mysqli_num_rows($rev);
    $db=mysqli_query($con,"select * from tbl_images WHERE image_id=18");
    while($dbdata=mysqli_fetch_assoc($db)){
        $ard[]=$dbdata['img_url'];
    }
$emparray[] = array(
    "tbl_food"=>$row['foods'],
"id" => $row['id'],
"name" => $row['name'],
"address" => $row['address'],
"latitude" => $row['latitude'],
"longitude" => $row['longitude'],
"ratting" => $vg1,
"vegtype" => $row['vegtype'],
"zipcode" => $row['zipcode'],
"phone_no" => $row['phone_no'],
"time" => $row['time'],
"video" => $row['video'],
"email" => $row['email'],
"totalreview" => $my,
"images" => $ard
);

}
$json['Restaurant'] = $emparray;

echo json_encode($json, JSON_UNESCAPED_SLASHES);
} else {
$arr[] = array("id" => "record not found");
$json12['Error'] = $arr;
echo json_encode($json12);
}*/
?>