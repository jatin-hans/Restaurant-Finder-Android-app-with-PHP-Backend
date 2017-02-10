<?php
include'include/config.php';
if(isset($_GET['lat']) && (isset($_GET['long']))) {
    $origLat = $_GET['lat'];
    $origLon = $_GET['long'];
    $query = mysqli_query($con, "SELECT  * , ( 3959 * ACOS( COS( RADIANS( $origLat ) ) * COS( RADIANS( `latitude` ) ) *
COS( RADIANS( `longitude` ) - RADIANS( $origLon ) ) + SIN( RADIANS( $origLat ) ) * SIN( RADIANS( `latitude` ) ) ) ) AS distance
FROM tbl_restourant
HAVING distance < 1000
ORDER BY distance
 ");
    $query1 = mysqli_query($con, "SELECT  * , ( 3959 * ACOS( COS( RADIANS( $origLat ) ) * COS( RADIANS( `latitude` ) ) *
COS( RADIANS( `longitude` ) - RADIANS( $origLon ) ) + SIN( RADIANS( $origLat ) ) * SIN( RADIANS( `latitude` ) ) ) ) AS distance
FROM tbl_restourant
HAVING distance < 1000
ORDER BY distance
 ");
    $num = mysqli_num_rows($query1);
    if ($num > 0) {
    while ($row = mysqli_fetch_array($query)) {

            $sql = mysqli_query($con, "SELECT res_id, AVG(ratting) AS ratavg FROM tbl_userfeedback WHERE res_id='" . $row['id'] . "'");
            while ($res = mysqli_fetch_array($sql)) {
                $avg = $res['ratavg'];
                $vg1 = round($avg, 1);
            }
            $rev = mysqli_query($con, "select * from tbl_userfeedback WHERE res_id='" . $row['id'] . "' ");
            $my = mysqli_num_rows($rev);
            $miles=round($row['distance'],3);
            $emparray[] = array(

                "id" => $row['id'],
                "name" => $row['name'],
                "address" => $row['address'],
                "distance" => $miles,
                "ratting" => $vg1,
                "vegtype" => $row['Vegtype'],
                "zipcode" => $row['zipcode'],
                "totalreview" => $my,
                "thumbnailimage" => $row['thumimage']
            );
            if (isset($emparray)) {
                $json['Restaurant'] = $emparray;
            } else {
                $arr[] = array("id" => "record not found");
                $json['Error'] = $arr;
                echo json_encode($json);
            }
        }
        echo json_encode($json, JSON_UNESCAPED_SLASHES);
    }
    else
    {
        $arr[] = array("id" => "record not found");
        $json['Error'] = $arr;
        echo json_encode($json);
    }
}
else
{
    $arr[] = array("id" => "record not found");
    $json['Error'] = $arr;
    echo json_encode($json);
}
?>