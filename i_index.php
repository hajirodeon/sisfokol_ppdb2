<?php
session_start();

require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
	




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'pollsimpan'))
	{
	//ambil nilai
	$v_opsi = nosql($_GET['v_opsi']);

	//cek
	$qcc = mysql_query("SELECT * FROM cp_polling");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);

	//if...
	if ($v_opsi == "nopsi1")
		{
		$nil_opsi1x = 1;
		}
	else if ($v_opsi == "nopsi2")
		{
		$nil_opsi2x = 1;
		}
	else if ($v_opsi == "nopsi3")
		{
		$nil_opsi3x = 1;
		}
	else if ($v_opsi == "nopsi4")
		{
		$nil_opsi4x = 1;
		}
	else if ($v_opsi == "nopsi5")
		{
		$nil_opsi5x = 1;
		}


	//nilai
	$nil_opsi1 = (nosql($rcc['nil_opsi1']))+$nil_opsi1x;
	$nil_opsi2 = (nosql($rcc['nil_opsi2']))+$nil_opsi2x;
	$nil_opsi3 = (nosql($rcc['nil_opsi3']))+$nil_opsi3x;
	$nil_opsi4 = (nosql($rcc['nil_opsi4']))+$nil_opsi4x;
	$nil_opsi5 = (nosql($rcc['nil_opsi5']))+$nil_opsi5x;


	//update
	mysql_query("UPDATE cp_polling SET nil_opsi1 = '$nil_opsi1', ".
					"nil_opsi2 = '$nil_opsi2', ".
					"nil_opsi3 = '$nil_opsi3', ".
					"nil_opsi4 = '$nil_opsi4', ".
					"nil_opsi5 = '$nil_opsi5'");

	
	echo "<p>
	<b><font color=red>Terima Kasih Telah Mengisi Polling...</font></b>
	</p>";
	
	exit();
	}








//jika simpan
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'newssimpan'))
	{
	//ambil nilai
	$emailku = cegah($_GET['emailku']);

	//cek
	$qcc = mysql_query("SELECT * FROM cp_newsletter ".
							"WHERE email = '$emailku'");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);

	//jika null
	if (empty($tcc))
		{
		//insert
		mysql_query("INSERT INTO cp_newsletter(kd, email, postdate) VALUES ".
						"('$x', '$emailku', '$today')");
		}
	
	
		
	echo '<p>
	<font color="red">
	<strong>E-Mail BerhasilTerdaftar...</strong>
	</font>
	</p>';
		
		
	exit();
	}















//jika artikel : beri komentar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'artikelkomentar'))
	{
	//ambil nilai
	$nil1 = cegah($_GET['e_nil1']);
	$nil2 = cegah($_GET['e_nil2']);
	$ongkoku = cegah($_GET['e_ongko']);
	$artkd = cegah($_GET['artkd']);
	$namaku = cegah($_GET['e_nama']);
	$emailku = cegah($_GET['e_email']);
	$isiku = cegah($_GET['e_isi']);
	$xyz = "$artkd$namaku$emailku$isiku";

	
	
	//jika admin, gak boleh
	if (($namaku == "admin") OR ($namaku == "administrator"))
		{
		echo '<p>
		<font color="red">
		<strong>Silahkan Dicek Lagi...!!</strong>
		</font>
		</p>';			
		}
		
	else
		{
		$ongkokux = $nil1 + $nil2;
		
		//jika betul
		if ($ongkoku == $ongkokux)
			{
			//insert
			mysql_query("INSERT INTO cp_artikel_komentar(kd, kd_artikel, nama, email, isi, postdate) VALUES ".
							"('$xyz', '$artkd', '$namaku', '$emailku', '$isiku', '$today')");
		
		
			?>
	
		
			<script language='javascript'>
			//membuat document jquery
			$(document).ready(function(){
	
				$("#iformnya").hide();
						
			});
			
			</script>
				
		
		
			<?php
			//update jumlah komentar
			$qku = mysql_query("SELECT * FROM cp_artikel_komentar ".
									"WHERE kd_artikel = '$artkd' ".
									"AND aktif = 'true'");
			$rku = mysql_fetch_assoc($qku);				
			$tku = mysql_num_rows($qku);
			
			//update
			mysql_query("UPDATE cp_artikel SET jml_komentar = '$tku' ".
							"WHERE kd = '$artkd'");
			
			
			
			
			
			
			echo '<p>
			<font color="green">
			<strong>Komentar Akan Muncul dalam Daftar Komentar, Setelah Melewati Verifikasi Admin. 
			<br>
			Terima Kasih....</strong>
			</font>
			</p>';
			}
			
		else
			{
			echo '<p>
			<font color="red">
			<strong>Silahkan Jawab Perhitungan Matematika dengan Benar...!!</strong>
			</font>
			</p>';
			}
		}
		
		
	exit();
	}











//jika bukutamu
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'bukutamu'))
	{
	//ambil nilai
	$nil1 = cegah($_GET['e_nil1']);
	$nil2 = cegah($_GET['e_nil2']);
	$ongkoku = cegah($_GET['e_ongko']);
	$artkd = cegah($_GET['artkd']);
	$namaku = cegah($_GET['e_nama']);
	$emailku = cegah($_GET['e_email']);
	$alamatku = cegah($_GET['e_alamat']);
	$telpku = cegah($_GET['e_telp']);
	$situsku = cegah($_GET['e_situs']);
	$isiku = cegah($_GET['e_isi']);
	$xyz = "$artkd$namaku$emailku$isiku";

	
	
	//jika admin, gak boleh
	if (($namaku == "admin") OR ($namaku == "administrator"))
		{
		echo '<p>
		<font color="red">
		<strong>Silahkan Dicek Lagi...!!</strong>
		</font>
		</p>';			
		}
		
	else
		{
		$ongkokux = $nil1 + $nil2;
		
		//jika betul
		if ($ongkoku == $ongkokux)
			{
			//insert
			mysql_query("INSERT INTO cp_bukutamu(kd, nama, alamat, telp, email, situs, isi, postdate) VALUES ".
							"('$xyz', '$namaku', '$alamatku', '$telpku', '$emailku', '$situsku', '$isiku', '$today')");
		
		
			?>
	
		
			<script language='javascript'>
			//membuat document jquery
			$(document).ready(function(){
	
				$("#iformnya").hide();
						
			});
			
			</script>
				
		
		
			<?php
			echo '<p>
			<font color="green">
			<strong>Terima Kasih Telah Mengisi Buku Tamu....</strong>
			</font>
			</p>';
			}
			
		else
			{
			echo '<p>
			<font color="red">
			<strong>Silahkan Jawab Perhitungan Matematika dengan Benar...!!</strong>
			</font>
			</p>';
			}
		}
		
		
	exit();
	}















//jika artikel suka
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'artikelsuka'))
	{
	//ambil nilai
	$artkd = cegah($_GET['artkd']);

	//update
	mysql_query("UPDATE cp_artikel SET jml_suka = jml_suka + 1 ".
					"WHERE kd = '$artkd'");
		
	echo '<p>
	<font color="green">
	<strong>Saya Suka Artikel ini...</strong>
	</font>
	</p>';


		
	exit();
	}









//jika artikel gak suka
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'artikelgaksuka'))
	{
	//ambil nilai
	$artkd = cegah($_GET['artkd']);

		
	echo '<p>
	<font color="red">
	<strong>Saya Tidak Suka Artikel ini...</strong>
	</font>
	</p>';


		
	exit();
	}













exit();
?>