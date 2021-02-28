<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/ppdb.html");



nocache;

//nilai
$filenya = "ppdb_verifikasi.php";
$judul = "Verifikasi Pendaftar";
$judulku = $judul;
$ku_judul = $judulku;
$s = nosql($_REQUEST['s']);
$mbkd = nosql($_REQUEST['mbkd']);


		








//ketahui tapel terakhir
$qku = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
						"ORDER BY round(tahun1) DESC");
$rku = mysqli_fetch_assoc($qku);
$tapel_kd = nosql($rku['kd']);
$tapel_nama = nosql($rku['tahun1']);



		
//PROSES ///////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnKRM'])
	{
	//nilai
	$c_user = cegah($_POST['c_user']);
	$c_pass = md5(cegah($_POST['c_pass']));
	$c_nama = cegah($_POST['c_nama']);
	$c_nominal = cegah($_POST['c_nominal']);
	$c_tgl_bayar = cegah($_POST['c_tgl_bayar']);


	$e_tgl_lahir1 = balikin($c_tgl_bayar);
	$tglku = explode("/", $e_tgl_lahir1);
	$e_tgl = trim($tglku[0]);
	$e_bulan = trim($tglku[1]);
	$e_tahun = trim($tglku[2]);
	$c_tgl_bayar = "$e_tahun:$e_bulan:$e_tgl";
	
	

	//update ////////////////////////////////////////////////////////////////////////////////////////////
	$qcc = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
							"WHERE usernamex = '$c_user' ".
							"AND passwordx = '$c_pass'");
	$rcc = mysqli_fetch_assoc($qcc);
	$tcc = mysqli_num_rows($qcc);
	$memberkd = nosql($rcc['kd']);
	
	
	$folderku = "filebox/calon";
	chmod($folderku, 0777);
	
	
	//buat folder...
	if (!file_exists('filebox/calon/'.$memberkd.'')) {
		mkdir('filebox/calon/'.$memberkd.'', 0777, true);
		}
	
	
	
	
	
	//jika null
	if (empty($tcc))
		{
		//re-direct
		$pesan = "Verifikasi Tidak Cocok. Harap Diperhatikan...!!";
		pekem($pesan,$filenya);
		exit();
		}
		
	else
		{
		//update...
		mysqli_query($koneksi, "UPDATE psb_calon SET reg_bayar_tgl = '$e_tgl_bayar' ".
						"WHERE kd = '$memberkd'");

		
		//upload image... ///////////////////////////////////////////////////////////////////////////////////
		$foldernya = "filebox/calon/$memberkd/";
				
		
		$namabaru = "$memberkd-bayar.jpg";
		
		
		
		//hapus dulu...
		unlink($foldernya.$namabaru);
	
	
	
	
		//update
		mysqli_query($koneksi, "UPDATE psb_calon SET reg_bayar = '$c_nominal', ".
						"reg_bayar_tgl = '$c_tgl_bayar', ".
						"reg_bayar_filex = '$namabaru' ".
						"WHERE kd = '$memberkd'");
			
	
	
		
			
		
		$name = $_FILES["image_upload"]["name"];
		$size = $_FILES["image_upload"]["size"];
		$ext = end(explode(".", $name));
		$allowed_ext = array("png", "jpg", "jpeg");
		if(in_array($ext, $allowed_ext))
			 {
			  if($size < (5120*5120))
			  {
			   $new_image = '';
			   $new_name = $namabaru;
			   $path = "filebox/calon/$memberkd/$new_name";
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
			    $new_width=1000;
			    //$new_height = ($height/$width)*200;
			    $new_height = ($height/$width)*$new_width;
			    //$new_height = 400;
			    $tmp_image = imagecreatetruecolor($new_width, $new_height);
			    imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			    imagejpeg($tmp_image, $path, 100);
			    imagedestroy($new_image);
			    imagedestroy($tmp_image);
			    echo '<img src="'.$path.'" width="100" height="100">';
			  }
			  else
			  {
			  	//re-direct
			   $pesan = 'Image File size maksimal 5 MB';
			   pekem($pesan,$filenya);
			   exit();
			  }
			 }
			 else
			 {
			 //re-direct
			 $pesan =  'Salah Image File';
			 pekem($pesan,$filenya);
			 exit();
			 }
	
	
	
	
		//chmod
		$folderku = "filebox/calon";
		chmod($folderku, 0755);
	
	
		//bikin sesi
		$_SESSION['mbkd'] = $memberkd;
		
	
		//re-direct
		$ke = "$filenya?s=sukses&mbkd=$memberkd";
		xloc($ke);
		exit();
		}
	}		
		

//PROSES ///////////////////////////////////////////////////////////////////////////////////////////////
				
		
		





//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


//daftar daya tampung
echo '<h4 class="post-title">'.$judul.'</h4>
<hr>';


require("template/js/jumpmenu.js");
require("template/js/number.js");

?>
	



<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

	$('#c_tgl_bayar').datepicker({
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        autoclose: true,
    })
    
    
		
});

</script>
	

<?php
echo '<form action="'.$filenya.'" method="post" name="formx2" id="formx2" enctype="multipart/form-data">';



//jika null
if (empty($s))
	{
	echo '<div class="row">
	
	<div class="col-md-4">
	
	<p>
	Uername :
	<br>
	<input name="c_user" id="c_user" type="text" value="" class="btn btn-block btn-warning">
	</p>
	
	<p>
	Password :
	<br>
	<input name="c_pass" id="c_pass" type="text" value="" class="btn btn-block btn-warning">
	</p>
	
	<p>
	Jumlah Bayar (Rp) :
	<br>
	<input name="c_nominal" id="c_nominal" type="text" value="" class="btn btn-block btn-warning">
	</p>
	
	
	<p>
	Tanggal Bayar :
	<br>
	<input name="c_tgl_bayar" id="c_tgl_bayar" type="text" size="10" value="" class="btn btn-block btn-warning">
	</p>
	
	
	</div>
	
	</div>
	
	
	
	
	<hr>';
	?>
	
	
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
	
	
	<style type="text/css">
	.thumb-image{
	 float:left;
	 width:100px;
	 height:100px;
	 position:relative;
	 padding:5px;
	}
	</style>
	
	
	
	
	<table border="0" cellspacing="0" cellpadding="3">
	<tr valign="top">
	<td width="100">
		<div id="image-holder"></div>
	</td>
	</tr>
	</table>
	
	<script>
	$(document).ready(function() {
		
	 $.noConflict();
	 
	 	
	        $("#image_upload").on('change', function() {
	      //Get count of selected files
	      var countFiles = $(this)[0].files.length;
	      var imgPath = $(this)[0].value;
	      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	      var image_holder = $("#image-holder");
	      image_holder.empty();
	      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	        if (typeof(FileReader) != "undefined") {
	          //loop for each file selected for uploaded.
	          for (var i = 0; i < countFiles; i++) 
	          {
	            var reader = new FileReader();
	            reader.onload = function(e) {
	              $("<img />", {
	                "src": e.target.result,
	                "class": "thumb-image"
	              }).appendTo(image_holder);
	            }
	            image_holder.show();
	            reader.readAsDataURL($(this)[0].files[i]);
	          }
	          
	
	    
	        } else {
	          alert("This browser does not support FileReader.");
	        }
	      } else {
	        alert("Pls select only images");
	      }
	    });
	    
	    
	    
	    
	  });
	</script>
	
	<?php
	echo '<div id="loading" style="display:none">
	<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
		</div>
		
	<h3>File Image Bukti Bayar / Transfer :</h3> 
	
	<p>		
	<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />
	</p>
	
	
	<p>
	<input name="btnKRM" id="btnKRM" type="submit" class="btn btn-danger" value="KIRIM VERIFIKASI >>">
	</p>';
	}


//jika sukses
else if ($s == "sukses")
	{
	//jika sesi sama
	if ($_SESSION['mbkd'] == $mbkd)
		{
		echo "<p>
		<font color='red'>
		Silahkan hubungi panitia, agar bukti transfer bisa segera cek. Dan Melanjutkan proses LOGIN.
		</font> 
		</p>";
		
		//hapus session
		session_unset();
		session_destroy();
		}
		
	else
		{
		//re-direct
		xloc($filenya);
		exit();
		}
	
	}	
	
	
echo '</form>';





//isi
$i_artikel_detail = ob_get_contents();
ob_end_clean();



















//isi *START
ob_start();

require("i_menu.php");

//isi
$i_menu = ob_get_contents();
ob_end_clean();














//isi *START
ob_start();

require("i_footer.php");

//isi
$i_footer = ob_get_contents();
ob_end_clean();



















require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
