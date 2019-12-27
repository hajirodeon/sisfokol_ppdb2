<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");



//ambil nilai
$kd = nosql($_REQUEST['kd']);



$foldernya = "../../filebox/foto/$kd/";
			
			
//buat folder...
if (!file_exists('../../filebox/foto/'.$kd.'')) {
    mkdir('../../filebox/foto/'.$kd.'', 0777, true);
	}




$namabaru = "$kd-1.png";




//hapus dulu...
unlink($foldernya.$namabaru);









		  
//upload.php;
if(isset($_FILES["image_upload"]["name"])) 
{
 $name = $_FILES["image_upload"]["name"];
 $size = $_FILES["image_upload"]["size"];
 $ext = end(explode(".", $name));
 $allowed_ext = array("png", "jpg", "jpeg");
 if(in_array($ext, $allowed_ext))
 {
//  if($size < (1024*1024))
  if($size < (5120*5120))
  {
   $new_image = '';
   $new_name = $namabaru;
   $path = "../../filebox/foto/$kd/$new_name";
   list($width, $height) = getimagesize($_FILES["image_upload"]["tmp_name"]);
   if($ext == 'png')
   {
    $new_image = imagecreatefrompng($_FILES["image_upload"]["tmp_name"]);
   }
   if($ext == 'jpg' || $ext == 'jpeg')  
            {  
               $new_image = imagecreatefromjpeg($_FILES["image_upload"]["tmp_name"]);  
            }
    $new_width=500;
    $new_height = ($height/$width)*$new_width;
    $tmp_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    imagejpeg($tmp_image, $path, 80);
    imagedestroy($new_image);
    imagedestroy($tmp_image);
    echo '<img src="'.$path.'" width="200" height="200">';
  }
  else
  {
   echo 'Image File size must be less than 5 MB';
  }
 }
 else
 {
  echo 'Invalid Image File';
 }
}
else
{
 echo 'Please Select Image File';
}





?>
