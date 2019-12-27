<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
	
nocache;




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//lihat gambar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'lihat1'))
	{
	//edit
	$qx = mysql_query("SELECT * FROM cp_profil");
	$rowx = mysql_fetch_assoc($qx);
	$e_filex1 = balikin($rowx['filex']);



	//jika edit / baru
	//nek null foto
	if (empty($e_filex1))
		{
		$nil_foto = "$sumber/template/img/bg-black.png";
		}
	else
		{
		$nil_foto = "$sumber/filebox/logo/$e_filex1";
		}
		

	echo '<img src="'.$nil_foto.'" height="200">';
	}
	
	
	

?>