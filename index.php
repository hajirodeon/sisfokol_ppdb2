<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/cp_depan.html");



nocache;

//nilai
$filenya = "index.php";
$filenyax = "i_index.php";
$filenya_ke = $sumber;
$judul = "$sek_nama";
$judulku = $judul;






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}






/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////









//isi *START
ob_start();

require("i_video.php");

//isi
$i_video = ob_get_contents();
ob_end_clean();














//isi *START
ob_start();

require("i_menu.php");

//isi
$i_menu = ob_get_contents();
ob_end_clean();









//isi *START
ob_start();

require("i_foto.php");

//isi
$i_foto = ob_get_contents();
ob_end_clean();








//isi *START
ob_start();

require("i_slideshow.php");

//isi
$i_slideshow = ob_get_contents();
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
