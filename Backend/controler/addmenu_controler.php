

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<?php
include 'include/config.php';
$rname =  addslashes($_POST['username']);
$add=addslashes($_POST['address']);
$restype=$_POST['restype'];
$postcode=$_POST['zipcode'];
$mobile=$_POST['mobile'];
$email=$_POST['email'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$time=$_POST['time'];
$totime=$_POST['time2'];
$timing=$time." "."To"." ".$totime;
$status=$_POST['status'];
$food=$_POST['browsers'];
$phone=$_POST['phone_no'];
// $ph=isset($_POST['id5']) ? $_POST['id5'] : null;
//$ido=$_POST['id'];
//$id2=$_POST['id'];
//$menu=$_POST['menu'];
$ratting=2;
/*function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = ''){
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
    if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image)) {
        if($thumb == TRUE) {
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
        } return $fileName;
    } else { return false; }
} if(!empty($_FILES['image']['name'])){
    $upload_img = cwUpload('image','../uploads/image/','',TRUE,'../uploads/','200','97');
    $thumb_src = '../uploads/thumbs/'.$upload_img;
    $imagepath =  $upload_img;
}$query=mysqli_query($con,"insert into tbl_restourant (name,address,latitude,longitude,ratting,zipcode,phone_no,time,email,is_active,vegtype,thumimage) VALUES ('$rname','$add','$latitude','$longitude','$ratting','$postcode','$mobile','$timing','$email','$status','$restype','$imagepath')");
if($query){
    $q=mysqli_query($con,"select id from tbl_restourant WHERE name ='$rname' && phone_no='$mobile'");
    $r=mysqli_fetch_array($q);
    foreach($food as $value){
        $qr=mysqli_query($con,"insert into tbl_food (food_id,food_type) VALUES ('".$r['id']."','$value')");
              //  $qr1=mysqli_query($con,"insert into tbl_foodcategories (food_id,name) VALUES ('".$r['id']."')");
        //$qry=mysqli_query($con,"insert into tbl_foodtype(`foodtype`,`img`,`price`) VALUES ('".$_POST['cat']."','$imagepath','".$_POST['cat1']."') ");
    }
    for($i=0; $i<count($_FILES['photos']['name']); $i++) {
        $tmpFilePath = $_FILES['photos']['tmp_name'][$i];
        if ($tmpFilePath != ""){
            $r1 = chr(rand(ord('a'), ord('z')));
            $r2 = chr(rand(ord('a'), ord('z')));
            $id=$r1.$r2;
            $newFilePath = "../uploads/" .$id. $_FILES['photos']['name'][$i];
            $imagepath= $id.$_FILES['photos']['name'][$i];
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                $qry=mysqli_query($con,"insert into tbl_images (image_id,img_url) VALUES ('".$r['id']."','$imagepath')");
            }
        }
    }
    ?> <script> window.location='../addrestourant.php';</script><?php
}*/

/*function encrypt_decrypt($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

// hash
        $key = hash('sha256', $secret_key);

// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

 $idd = $_GET['a2NoOTY1OVhIRGd1VThRZ2JXUlk0dz09'];

    $dataid=encrypt_decrypt('decrypt', $idd);
*/
if(isset($_POST['addmenu'])){
  
  
    
    $tmpFilePath = $_FILES['image1']['tmp_name'];
    $r1 = chr(rand(ord('a'), ord('z')));
    $r2 = chr(rand(ord('a'), ord('z')));
    $r3 = chr(rand(ord('a'), ord('z')));
  

    $id=$r1.$r2.$r3;
    //Setup our new file path
    $newFilePath = "uploads/category/" .$id. preg_replace('/\s+/','',$_FILES['image1']['name']);
    $imagepath= $id.preg_replace('/\s+/','',$_FILES['image1']['name']);
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $newFilePath);
   // $query=mysqli_query($con,"insert into tbl_restourant (name,address,latitude,longitude,ratting,zipcode,phone_no,time,email,is_active,vegtype,thumimage) VALUES ('$rname','$add','$latitude','$longitude','$ratting','$postcode','$mobile','$timing','$email','$status','$restype','$imagepath')");
//if($query){
   // $q=mysqli_query($con,"select id from tbl_restourant WHERE name ='$rname' && phone_no='$mobile'");
   // $r=mysqli_fetch_array($q);
  //  $id1=$_POST['id'];
   $ido=$_POST['id5'];
//   $query = mysqli_query($con,"select * from tbl_restourant WHERE id = '$dataid' ");
  //  $res=mysqli_fetch_array($query);
  //  $id=$_POST['id'];
 // $q=mysqli_query($con,"select id from tbl_restourant WHERE phone_no='$mobile'");
   // $r=mysqli_fetch_array($q);
    $qry=mysqli_query($con,"insert into tbl_foodtype(`foodtype`,`img`,`price`,`ft_id`) VALUES ('".$_POST['menu']."','$imagepath','".$_POST['menu1']."','".$_POST['id']."') ");
    
   
    if($qry){
        ?><script>alert("Menu Added Successfully");
            </script><?php
    }
    else{
        ?><script>alert("Menu Not Add Please Try Agains !!");
            window.location='../addrestourant.php';</script><?php
    }
    
}
//}
?>
 
    



