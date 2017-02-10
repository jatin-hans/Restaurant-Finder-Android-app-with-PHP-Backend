<?php
if(isset($_POST['updaterestaurant'])){
    if($_FILES['image']['name']) {
        $id = $dataid;
        $name =  addslashes($_POST['resname']);
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $restype = $_POST['restype'];
        $add = addslashes($_POST['address']);
        $zipcode = $_POST['zipcode'];
        $time = $_POST['time'];
        $totime = $_POST['totime'];
        $timing=$time."To ".$totime;
        $lat = $_POST['latitude'];
        $long = $_POST['longitude'];
        $status = $_POST['status'];
        $food=$_POST['foodcat'];
        $price=$_POST['Price'];
        $tmpFilePath = $_FILES['image']['tmp_name'];
        function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){
            $target_path = $target_folder;
            $thumb_path = $thumb_folder;
            $filename_err = explode(".",$_FILES[$field_name]['name']);
            $filename_err_count = count($filename_err);
            $file_ext = $filename_err[$filename_err_count-1];
            $r1 = chr(rand(ord('a'), ord('z')));
            $r2 = chr(rand(ord('a'), ord('z')));
            $r3 = chr(rand(ord('a'), ord('z')));
            $id=$r1.$r2.$r3;
            $fileName = $id.$_FILES[$field_name]['name'];
            $upload_image = $target_path.basename($fileName);
            if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))  {
                if($thumb == TRUE)  {
                    $thumbnail = $thumb_path.$fileName;
                    list($width,$height) = getimagesize($upload_image);
                    $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
                    switch($file_ext){
                        case 'jpg':
                            $source = imagecreatefromjpeg($upload_image);
                            break;
                        case 'jpeg':
                            $source = imagecreatefromjpeg($upload_image);
                            break;
                        case 'png':
                            $source = imagecreatefrompng($upload_image);
                            break;
                        case 'gif':
                            $source = imagecreatefromgif($upload_image);
                            break;
                        default:
                            $source = imagecreatefromjpeg($upload_image);
                    }
                    imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
                    switch($file_ext){
                        case 'jpg' || 'jpeg':
                            imagejpeg($thumb_create,$thumbnail,100);
                            break;
                        case 'png':
                            imagepng($thumb_create,$thumbnail,100);
                            break;
                        case 'gif':
                            imagegif($thumb_create,$thumbnail,100);
                            break;
                        default:
                            imagejpeg($thumb_create,$thumbnail,100);
                    }
                } return $fileName; }  else  { return false; }
        }
        if(!empty($_FILES['image']['name'])){
            $upload_img = cwUpload('image','uploads/image/','',TRUE,'uploads/','200','130');
            $thumb_src = 'uploads/thumbs/'.$upload_img;
            $imagepath =  $upload_img;
            $id = $dataid;
            $data2a=mysqli_query($con,"select * from tbl_restourant WHERE id='$id'");
            $dr=mysqli_fetch_array($data2a);
            $drd=$dr['thumimage'];
            unlink("uploads/".$drd); }
        $qury=mysqli_query($con,"select * from tbl_food WHERE food_id='$id'");
        if($query) {
            while ($data = mysqli_fetch_array($qury)) {
                $del = mysqli_query($con, "delete from tbl_food WHERE food_id='" . $data['food_id'] . "'");
                if ($del) { } }
        }
        foreach ($food as $value) {
            $qr = mysqli_query($con, "insert into tbl_food (food_id,food_type,Price) VALUES ('$id','$value',Price='" . $_POST['cat1'] . "')");
        }
        $update=mysqli_query($con," Update `tbl_restourant` SET `name`='$name',`address`='$add',`latitude`='$lat',`longitude`='$long',`zipcode`='$zipcode', `Vegtype`='$restype',`phone_no`='$mobile',`time`='$timing',`email`='$email',`is_active`='$status',`thumimage`='$imagepath' WHERE id='$id' ");
        if($query){ ?><script>aflert("Restaurant Detail UpdatfFfe Successfuly !! ");window.location='viewrestourant.php';</script><?php }
    }  else  {
        $idup = $dataid;
        $name =  addslashes($_POST['resname']);
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $restype = $_POST['restype'];
        $add = addslashes($_POST['address']);
        $zipcode = $_POST['zipcode'];
        $time = $_POST['time'];
        $totime = $_POST['totime'];
        $timing=$time."To ".$totime;
        $lat = $_POST['latitude'];
        $long = $_POST['longitude'];
        $status = $_POST['status'];
        $food=$_POST['foodcat'];
     //  $price=$_POST['cat1'];
        
        $qury=mysqli_query($con,"select * from tbl_food WHERE food_id='$idup'");
        if($query) { while ($data = mysqli_fetch_array($qury)) {
                $del = mysqli_query($con, "delete from tbl_food WHERE food_id='" . $data['food_id'] . "'");
                if ($del) { }
            }
        }
       $query11=  mysqli_query($con,"DECLARE @i AS INT
SET @i = 1
 WHILE(@i<COUNT(tbl_food.food_id))
  BEGIN 

        UPDATE tbl_foodcategories
    SET tbl_foodcategories.food_id=tbl_food.food_id
    WHERE tbl_food.food_id=@i

SET @i = @i+1
  END -- WHILE");
        
      //  $test=  mysqli_query($con,"select tbl_foodcategories.Price from tbl_foodcategories join tbl_food where tbl_foodcategories.tb1_restourant_id=tbl_food.food_id  order by food_id");
    //   $test1=mysqli_fetch_array($test);
        foreach ($food as $value) {
             //       $query11=  mysqli_query($con,"update tbl_foodcategories join tbl_food ON tbl_foodcategories.name=tbl_food.food_type set tbl_foodcategories.tb1_restourant_id=tbl_food.food_id where tbl_foodcategories.name=tbl_food.food_type");
 //$qr1 = mysqli_query($con, "insert into tbl_foodcategories (tb1_restourant_id) VALUES ('$idup')");
            $qr = mysqli_query($con, "insert into tbl_food (food_id,food_type) VALUES ('$idup','$value')");
        }
     
        $update=mysqli_query($con," Update `tbl_restourant` SET `name`='$name',`address`='$add',`latitude`='$lat',`longitude`='$long',`zipcode`='$zipcode', `Vegtype`='$restype',`phone_no`='$mobile',`time`='$timing',`email`='$email',`is_active`='$status' WHERE id='$idup' ");
        if($query){ ?><script>alert("Restaurant Detail Update Successfuly !! ");window.location='viewrestourant.php';</script><?php } }
}  ?>
