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
$filenya = "ppdb_login.php";
$judul = "LOGIN CALON";
$judulku = $judul;
$ku_judul = $judulku;


		








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
	$c_user = cegah($_POST['c_user']);
	$c_pass = md5(cegah($_POST['c_pass']));
	$c_pass2 = balikin($_POST['c_pass']);
	

	//update ////////////////////////////////////////////////////////////////////////////////////////////
	$qcc = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
							"WHERE usernamex = '$c_user' ".
							"AND passwordx = '$c_pass' ".
							"AND aktif = 'true'");
	$rcc = mysqli_fetch_assoc($qcc);
	$tcc = mysqli_num_rows($qcc);
	$memberkd = nosql($rcc['kd']);
	$c_nama = balikin($rcc['c_nama']);
	
	//jika null
	if (empty($tcc))
		{
		//re-direct
		$pesan = "Login Calon Belum Aktif. Silahkan Lakukan Verifikasi Pembayaran Terlebih Dahulu...!!";
		pekem($pesan,$filenya);
		exit();
		}
		
	else
		{
		session_start();

		//bikin session
		$_SESSION['kd6_session'] = nosql($rcc['kd']);
		$_SESSION['username6_session'] = $c_user;
		$_SESSION['pass6_session'] = $c_pass;
		$_SESSION['nama6_session'] = $c_nama;
		$_SESSION['adm_session'] = "CALON";
		$_SESSION['hajirobe_session'] = $hajirobe;


		//update
		mysqli_query($koneksi, "UPDATE psb_calon SET passwordx2 = '$c_pass2', ".
						"last_login = '$today' ".
						"WHERE kd = '$memberkd'");


		//re-direct
		$ke = "calon.php";
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

echo '<form action="'.$filenya.'" method="post" name="formx2" id="formx2" enctype="multipart/form-data">

<div class="row">

<div class="col-md-4">

<p>
Uername :
<br>
<input name="c_user" id="c_user" type="text" value="" class="btn btn-block btn-warning">
</p>

<p>
Password :
<br>
<input name="c_pass" id="c_pass" type="password" value="" class="btn btn-block btn-warning">
</p>



<p>
<input name="btnKRM" id="btnKRM" type="submit" class="btn btn-block btn-danger" value="LANJUT >>">
</p>



</div>

</div>




<hr>



</form>';



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
