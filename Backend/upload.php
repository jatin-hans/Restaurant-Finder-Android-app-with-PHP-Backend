<?php
include'include/config.php';
function getExtension($str) {$i=strrpos($str,".");if(!$i){return"";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;}
$formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
 $name = $_FILES['file']['name'];
 $size = $_FILES['file']['size'];
 $tmp  = $_FILES['file']['tmp_name'];
 if(strlen($name)){
  $ext = getExtension($name);
  if(in_array($ext,$formats)){
   if($size<(1024*1024)){
    $imgn = time().".".$ext;
    if(move_uploaded_file($tmp, "uploads/offers/".$imgn)){
     $id=$_POST['name'];
     $qury1=mysqli_query($con,"select image from tbl_offers WHERE restaurant_id='$id'");
     $off1=mysqli_fetch_array($qury1);
     $image=$off1['image'];
     $qury1=mysqli_query($con,"update tbl_offers set image='$imgn' WHERE restaurant_id='$id' ");
     if($qury1){
      unlink("uploads/offers/".$image);
      echo "<br/> <img  height='130' width='250' src='uploads/offers/".$imgn."'>";
     }
     else{
      echo "ok";
     }
    }else{
     echo "Uploading Failed.";
    }
   }else{
    echo "Image File Size Max 1 MB";
   }
  }else{
   echo "Invalid Image file format.";
  }
 }else{
  echo "Please select an image.";
  exit;
 }
}
?>
