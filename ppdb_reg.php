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
$filenya = "ppdb_reg.php";
$judul = "Daftar Menjadi Peserta Didik Baru";
$judulku = $judul;
$ku_judul = $judulku;

$s = nosql($_REQUEST['s']);
$memberkd = nosql($_REQUEST['memberkd']);
$ke = "$filenya?memberkd=$memberkd";





		
//jika null, kasi kd
if (empty($memberkd))
	{
	//nilai
	$memberkd = $x;
	
	
	//re-direct
	$ke = "$filenya?memberkd=$memberkd";
	xloc($ke);
	exit();
	}






//ketahui tapel terakhir
$qku = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
						"ORDER BY round(tahun1) DESC");
$rku = mysqli_fetch_assoc($qku);
$tapel_kd = nosql($rku['kd']);
$tapel_nama = nosql($rku['tahun1']);
$tapel_status = nosql($rku['status']);



		
//PROSES ///////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ($_POST['btnKRM'])
	{
	$memberkd = cegah($_POST['memberkd']);
	$sekolah = cegah($_POST['e_sekolah']);
	$sekolah2 = balikin($_POST['e_sekolah']);
	$jalur = cegah($_POST['e_jalur']);
	$c_sekolah_asal = cegah($_POST['c_sekolah_asal']);
	$c_nisn = cegah($_POST['c_nisn']);
	$c_nama = cegah($_POST['c_nama']);
	$c_tmp_lahir = cegah($_POST['c_tmp_lahir']);
	$c_tgl_lahir = cegah($_POST['c_tgl_lahir']);
	
	$e_tgl_lahir1 = balikin($c_tgl_lahir);
	$tglku = explode("/", $e_tgl_lahir1);
	$e_tgl = trim($tglku[0]);
	$e_bulan = trim($tglku[1]);
	$e_tahun = trim($tglku[2]);
	$c_tgl_lahir = "$e_tahun:$e_bulan:$e_tgl";
	
	
	
	
	$c_kelamin = cegah($_POST['c_kelamin']);
	$c_agama = cegah($_POST['c_agama']);
	$c_anak_status = cegah($_POST['c_anak_status']);
	$c_anak_ke = cegah($_POST['c_anak_ke']);
	$c_alamat = cegah($_POST['c_alamat']);
	$c_telp = cegah($_POST['c_telp']);
	$c_email = cegah($_POST['c_email']);
	$o_ayah_nama = cegah($_POST['o_ayah_nama']);
	$o_ayah_kerja = cegah($_POST['o_ayah_kerja']);
	$o_ibu_nama = cegah($_POST['o_ibu_nama']);
	$o_ibu_kerja = cegah($_POST['o_ibu_kerja']);
	$o_alamat = cegah($_POST['o_alamat']);
	$o_telp = cegah($_POST['o_telp']);








	//jika ada null, ulangi...
	if ((empty($jalur)) OR (empty($c_nama)) OR (empty($c_sekolah_asal)) OR (empty($c_telp)) OR (empty($c_alamat)))
		{
		//re-dirct
		$pesan = "Input Harus Lengkap. Harap Diperhatikan...!!";
		$ke = "$filenya?memberkd=$memberkd";
		pekem($pesan,$ke);
		exit();
		}
		
	else
		{
		//bikin nomor /////////////////////////////////////////////////////////////////////////////////////
			$tabelnya = "nomerku";
			
			//chmod dulu
			$folderku = "filebox/calon";
			chmod($folderku, 0777);
			
			
			//buat folder...
			if (!file_exists('filebox/calon/'.$memberkd.'')) {
			mkdir('filebox/calon/'.$memberkd.'', 0777, true);
			}
			
			
			
			
			
			
			
			//deteksi query
			$qcc = mysqli_query($koneksi, "SELECT * FROM $tabelnya ".
									"WHERE calon_kd = '$memberkd'");
			$tcc = mysqli_num_rows($qcc);
			
			//jika null, insert
			if (empty($tcc))
				{
				mysqli_query($koneksi, "INSERT INTO $tabelnya(calon_kd, tapel_kd, tapel_nama, jalur, postdate) VALUES ".
								"('$memberkd', '$tapel_kd', '$tapel_nama', '$jalur', '$today')");
				}
			
			
			
			//ketahui noid
			$qcc = mysqli_query($koneksi, "SELECT * FROM $tabelnya ".
									"WHERE calon_kd = '$memberkd'");
			$rcc = mysqli_fetch_assoc($qcc);
			$cc_noid = nosql($rcc['noid']);
			
			
			//deteksi digit
			if (strlen($cc_noid) == 1)
				{
				$nomerku = "0000$cc_noid";
				}
			
			else if (strlen($cc_noid) == 2)
				{
				$nomerku = "000$cc_noid";
				}
				
			else if (strlen($cc_noid) == 3)
				{
				$nomerku = "00$cc_noid";
				}
				
			else if (strlen($cc_noid) == 4)
				{
				$nomerku = "0$cc_noid";
				}
				
			else if (strlen($cc_noid) == 5)
				{
				$nomerku = "$cc_noid";
				}
			
			
			//bikin nomor
			$nomernya = "$tapel_nama$nomerku";
			
			
			//update noreg
			mysqli_query($koneksi, "UPDATE $tabelnya SET calon_noreg = '$nomernya' ".
							"WHERE calon_kd = '$memberkd'");
		
		//bikin nomor /////////////////////////////////////////////////////////////////////////////////////		
		
		





	
	
		
		//ketahui noid //////////////////////////////////////////////////////////////////////////////////////
		$qcc = mysqli_query($koneksi, "SELECT * FROM $tabelnya ".
							"WHERE calon_kd = '$memberkd'");
		$rcc = mysqli_fetch_assoc($qcc);
		$cc_noreg = cegah($rcc['calon_noreg']);
	
	
		
	
		//insert ////////////////////////////////////////////////////////////////////////////////////////////
		mysqli_query($koneksi, "INSERT INTO psb_calon(kd, tapel_kd, tapel_nama, noreg, sekolah, ".
						"c_jalur, c_sekolah_asal, c_nisn, c_nama, ".
						"c_tmp_lahir, c_tgl_lahir, c_kelamin, c_agama, ".
						"c_anak_status, c_anak_ke, c_alamat, c_telp, ".
						"c_email, ortu_ayah_nama, ortu_ayah_kerja, ".
						"ortu_ibu_nama, ortu_ibu_kerja, ortu_alamat, ortu_telp, postdate) VALUES ".
						"('$memberkd', '$tapel_kd', '$tapel_nama', '$cc_noreg', '$sekolah', ".
						"'$jalur', '$c_sekolah_asal', '$c_nisn', '$c_nama', ".
						"'$c_tmp_lahir', '$c_tgl_lahir', '$c_kelamin', '$c_agama', ".
						"'$c_anak_status', '$c_anak_ke', '$c_alamat', '$c_telp', ".
						"'$c_email', '$o_ayah_nama', '$o_ayah_kerja', ".
						"'$o_ibu_nama', '$o_ibu_kerja', '$o_alamat', '$o_telp', '$today')");
	
	
		//update akses login... /////////////////////////////////////////////////////////////////////////////
		$e_user = $cc_noreg;
		$e_user2 = balikin($cc_noreg);
		$e_pass = substr($x,0,5);
		$e_passx = md5($e_pass);
	
	
		//update
		mysqli_query($koneksi, "UPDATE psb_calon SET usernamex = '$e_user', ".
						"passwordx = '$e_passx' ".
						"WHERE kd = '$memberkd'");
			
		
			
			
		//upload image... ///////////////////////////////////////////////////////////////////////////////////
		$foldernya = "filebox/calon/$memberkd/";
				
		
		$namabaru = "$memberkd-calon.jpg";
		
		
		
		//hapus dulu...
		unlink($foldernya.$namabaru);
	
	
	
	
		//update
		mysqli_query($koneksi, "UPDATE psb_calon SET filex = '$namabaru' ".
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
			    $new_width=400;
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
			   echo 'Image File size maksimal 5 MB';
			  }
			 }
			 else
			 {
			  echo 'Salah Image File';
			 }
	
	
	
	
		//bikin sesi trus, re-direct 
		$_SESSION['userkd'] = $memberkd;
		$_SESSION['ku_user'] = $e_user;
		$_SESSION['ku_pass'] = $e_pass;
	
	
	
		//chmod
		$folderku = "filebox/calon";
		chmod($folderku, 0755);
	
	
		//re-direct
		$ke = "$filenya?memberkd=$memberkd&s=sukses";
		xloc($ke);
		exit();
		}
		
		
	}		
		

//PROSES ///////////////////////////////////////////////////////////////////////////////////////////////
				
		
		
		
		
		





		
		




//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


echo '<h4 class="post-title">'.$judul.'</h4>
<hr>';





require("template/js/jumpmenu.js");
require("template/js/number.js");


//jika null, reg...........................................................................
if (empty($s))
	{
	$sesi_sukses = cegah($_SESSION['sesi_sukses']);
	
	
	//jika sudah pernah sukses
	if ($sesi_sukses == "YA")
		{
		//hapus sesi, re-direct baru
		$_SESSION['sesi_sukses'] = "";
		
		//re-direct
		$ke = "$filenya?memberkd=$memberkd";
		xloc($ke);
		exit();
		}
	
	?>
	



	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){

		$('#c_tgl_lahir').datepicker({
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            autoclose: true,
        })
        
	
	
	
			
	});
	
	</script>
		

	<?php
	//jika pendaftaran dibuka
	if ($tapel_status == "true")
		{
		echo '<form action="'.$filenya.'?memberkd='.$memberkd.'" method="post" name="formx2" id="formx2" enctype="multipart/form-data">
		
		<div class="row">
		
		
		<div class="col-md-4">
		<p>
		Jalur :
		<br>
		<select name="e_jalur" class="btn btn-block btn-warning">
			<option value="'.$jalur.'">'.$jalur.'</option>
			<option value="REGULER">REGULER</option>
			<option value="PRESTASI">PRESTASI</option>
		</select>
		</p>
			
		
			</div>
			
		</div>';
			?>
			
			
			<hr>
			
			
			<h3>DATA DIRI</h3>
			
			<div class="row">
			
			<div class="col-md-3">
			
			<p>
			Sekolah Asal :
			<br>
			<input name="c_sekolah_asal" id="c_sekolah_asal" type="text" value="" class="btn btn-block btn-warning">
			</p>

			<p>
			NISN :
			<br>
			<input name="c_nisn" id="c_nisn" type="text" value="" class="btn btn-block btn-warning">
			</p>


			<p>
			Nama :
			<br>
			<input name="c_nama" id="c_nama" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			<p>
			Tempat Lahir :
			<br>
			<input name="c_tmp_lahir" id="c_tmp_lahir" type="text" size="20" value="" class="btn btn-block btn-warning">
			</p> 
			
			
			<p>
			Tanggal Lahir :
			<br>
			<input name="c_tgl_lahir" id="c_tgl_lahir" type="text" size="10" value="" class="btn btn-block btn-warning">
			</p>
			
			</div>
			
			<div class="col-md-3">
			
			
			<p>
			Kelamin :
			<br>
			<select name="c_kelamin" id="c_kelamin" class="btn btn-block btn-warning">
			<option value="" selected></option>
			<option value="L">Laki - Laki</option>
			<option value="P">Perempuan</option>
			</select>
			
			</p>
			
			<p>
			Agama :
			<br>
			<select name="c_agama" id="c_agama" class="btn btn-block btn-warning">
			<option value="" selected></option>
			<option value="Islam">Islam</option>
			<option value="Kristen">Kristen</option>
			<option value="Katolik">Katolik</option>
			<option value="Hindu">Hindu</option>
			<option value="Budha">Budha</option>
			</select>
			
			</p>
			
			<p>
			Status Anak :
			<br>
			<select name="c_anak_status" id="c_anak_status" class="btn btn-block btn-warning">
			<option value="" selected></option>
			<option value="Kandung">Kandung</option>
			<option value="Angkat">Angkat</option>
			</select>
			</p>
			
			<p>
			Anak ke-:
			<br>
			<input name="c_anak_ke" id="c_anak_ke" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			
			</div>
			
			<div class="col-md-3">
			
			<p>
			Alamat :
			<br>
			<input name="c_alamat" id="c_alamat" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			<p>
			Telepon :
			<br>
			<input name="c_telp" id="c_telp" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			<p>
			E-Mail :
			<br>
			<input name="c_email" id="c_email" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			
			</div>
			
			</div>
			
			<hr>
			
			
			<h3>ORANG TUA</h3>
			
			<div class="row">
			
			<div class="col-md-3">
			
			<p>
			Ayah, Nama :
			<br>
			<input name="o_ayah_nama" id="o_ayah_nama" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			<p>
			Ayah, Pekerjaan :
			<br>
			<input name="o_ayah_kerja" id="o_ayah_kerja" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			</div>
			
			<div class="col-md-3">
			
			<p>
			Ibu, Nama :
			<br>
			<input name="o_ibu_nama" id="o_ibu_nama" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			<p>
			Ibu, Pekerjaan :
			<br>
			<input name="o_ibu_kerja" id="o_ibu_kerja" type="text" value="" class="btn btn-block btn-warning">
			</p>
			</div>
			
			<div class="col-md-3">
			
			<p>
			Alamat :
			<br>
			<input name="o_alamat" id="o_alamat" type="text" value="" class="btn btn-block btn-warning">
			</p>
			
			<p>
			Telepon :
			<br>
			<input name="o_telp" id="o_telp" type="text" value="" class="btn btn-block btn-warning">
			</p>
					
			
			</div>
			
			</div>
			
			
			
			
			<hr>
			
			
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
			</div>';
			?>
			
			<h3>File Image Resmi (Ukuran 4x6):</h3> 
			
			<p>		
			<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />
			</p>
			
			
			<p>
			<input name="memberkd" id="memberkd" type="hidden" value="<?php echo $memberkd;?>">
			<input name="btnKRM" id="btnKRM" type="submit" class="btn btn-block btn-danger" value="KIRIM FORMULIR >>">
			</p>
			
			
			
			</form>
			
			<?php
		}
	else
		{
		echo "<h3>
		<font color=red>
		Pendaftaran Calon Peserta Didik Baru, Telah Ditutup...
		</font>
		</h3>";
		}
	}
	
else
	{
	//ambil sesi
	$ku_user1 = cegah($_SESSION['ku_user']);
	$ku_user = balikin($_SESSION['ku_user']);
	$ku_user2 = cegah($_SESSION['ku_user']);
	$ku_pass = balikin($_SESSION['ku_pass']);
	$ku_pass2 = cegah($_SESSION['ku_pass']);



	//bikin sesi sukses
	$_SESSION['sesi_sukses'] = "YA";
	
	/*
	//jika null, re-direct
	if (empty($ku_user))
		{
		xloc($filenya);
		exit();
		}
	 * 
	 */
	?>


	
	<script language='javascript'>
	//membuat document jquery
	$(document).ready(function(){
	
	
		$("#btnVERIFIKASI").on('click', function(){
			window.location.href = "<?php echo $sumber;?>/ppdb_verifikasi.php";
		});	
	
	
	});
	
	</script>
	
	
	
	
	<?php
	//ketahui noid //////////////////////////////////////////////////////////////////////////////////////
	$qcc = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
						"WHERE kd = '$memberkd'");
	$rcc = mysqli_fetch_assoc($qcc);
	$cc_noreg = cegah($rcc['noreg']);

											
	
	echo '<form name="formx23" id="formx23">
	<h1>BERHASIL MELAKUKAN PENDAFTARAN</h1>

	<p>
	Silahkan Catat,
	<br> 
	Username : <b>'.$cc_noreg.'</b>
	</p>
	
	<p>
	Password : <b>'.$ku_pass.'</b> 
	</p>
	
	<hr>


	NB. Silahkan Lanjut Verifikasi Pembayaran, Agar Login Calon Bisa Digunakan.
	
	<hr>
	
	</form>';
	}			



/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi
$i_artikel_detail = ob_get_contents();
ob_end_clean();














//brcrumb ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


echo '<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="'.$sumber.'"><i class="glyphicon glyphicon-home" aria-hidden="true"></i> BERANDA</a></li>
        <li class="breadcrumb-item active" aria-current="page">'.$ku_judul.'</li>
    </ol>
</nav>';

					
					
//isi
$i_artikel_bcrumb = ob_get_contents();
ob_end_clean();




















//artikel image ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


//foto random
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_g_foto ".
						"WHERE filex <> '' ".
						"ORDER BY RAND()");
$ryuk2 = mysqli_fetch_assoc($qyuk2);
$yuk2_kd = nosql($ryuk2['kd']);
$yuk2_nama = balikin($ryuk2['nama']);
$yuk2_filex = balikin($ryuk2['filex']);


echo "$sumber/filebox/foto/$yuk2_kd/$yuk2_filex";




//isi
$i_artikel_image = ob_get_contents();
ob_end_clean();
















//isi *START
ob_start();

require("i_menu.php");

//isi
$i_menu = ob_get_contents();
ob_end_clean();








//isi *START
ob_start();

require("i_ppdb.php");

//isi
$i_ppdb = ob_get_contents();
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
