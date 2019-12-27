<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");




$foldernya = "../../filebox/logo/";
			


$namabaru = "logo.jpg";
$namabaru2 = "logo.png";




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
   $path = "../../filebox/logo/$new_name";
   list($width, $height) = getimagesize($_FILES["image_upload"]["tmp_name"]);
   if($ext == 'png')
   {
    $new_image = imagecreatefrompng($_FILES["image_upload"]["tmp_name"]);
   }
   if($ext == 'jpg' || $ext == 'jpeg')  
            {  
               $new_image = imagecreatefromjpeg($_FILES["image_upload"]["tmp_name"]);  
            }
            //$new_width=200;
            $new_width=400;
            //$new_height = ($height/$width)*$new_width;
            $new_height = 400;
            $tmp_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($tmp_image, $path, 80);
            imagedestroy($new_image);
            imagedestroy($tmp_image);
            echo '<img src="'.$path.'" width="100" height="100">';
			
			
	
	
	//untuk logo header web		
	$new_image = '';
   $new_name = $namabaru2;
   $path = "../../filebox/logo/$new_name";
   list($width, $height) = getimagesize($_FILES["image_upload"]["tmp_name"]);
   if($ext == 'png')
   {
    $new_image = imagecreatefrompng($_FILES["image_upload"]["tmp_name"]);
   }
   if($ext == 'jpg' || $ext == 'jpeg')  
            {  
               $new_image = imagecreatefromjpeg($_FILES["image_upload"]["tmp_name"]);  
            }
            //$new_width=200;
            $new_width=90;
            //$new_height = ($height/$width)*$new_width;
            $new_height = 50;
            $tmp_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($tmp_image, $path, 80);
            imagedestroy($new_image);
            imagedestroy($tmp_image);
			
			
			
			
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
