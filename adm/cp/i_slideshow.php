<?php
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
	
nocache;




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//lihat gambar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'lihat1'))
	{
	//ambil nilai
	$kd = nosql($_GET['kd']);
	
	//edit
	$qx = mysqli_query($koneksi, "SELECT * FROM cp_m_slideshow ".
						"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_filex1 = balikin($rowx['filex']);



	//jika edit / baru
	//nek null foto
	if (empty($e_filex1))
		{
		$nil_foto = "$sumber/template/img/bg-black.png";
		}
	else
		{
		$nil_foto = "$sumber/filebox/slideshow/$kd/$e_filex1";
		}
		

	echo '<img src="'.$nil_foto.'" height="200">';
	}
	
	
	

?>