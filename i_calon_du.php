<?php
session_start();

require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
	




$filenyax = "i_calon_du.php";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika simpan, data diri
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpane'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$e_nama = cegah($_GET['e_nama']);
	$e_kelamin = cegah($_GET['e_kelamin']);
	$e_nisn = cegah($_GET['e_nisn']);
	$e_nik = cegah($_GET['e_nik']);
	$e_tmp_lahir = cegah($_GET['e_tmp_lahir']);
	$e_tgl_lahir = cegah($_GET['e_tgl_lahir']);
	$e_akta = cegah($_GET['e_akta']);
	$e_agama = cegah($_GET['e_agama']);
	$e_warga = cegah($_GET['e_warga']);
	$e_kebutuhan = cegah($_GET['e_kebutuhan']);
	$e_alamat = cegah($_GET['e_alamat']);
	$e_alamat_rt = cegah($_GET['e_alamat_rt']);
	$e_alamat_rw = cegah($_GET['e_alamat_rw']);
	$e_alamat_dusun = cegah($_GET['e_alamat_dusun']);
	$e_alamat_kelurahan = cegah($_GET['e_alamat_kelurahan']);
	$e_alamat_kecamatan = cegah($_GET['e_alamat_kecamatan']);
	$e_alamat_kab = cegah($_GET['e_alamat_kab']);
	$e_kodepos = cegah($_GET['e_kodepos']);
	$e_lintang = cegah($_GET['e_lintang']);
	$e_bujur = cegah($_GET['e_bujur']);
	$e_tmp_tinggal = cegah($_GET['e_tmp_tinggal']);
	$e_moda = cegah($_GET['e_moda']);
	$e_kks = cegah($_GET['e_kks']);
	$e_anak_ke = cegah($_GET['e_anak_ke']);
	$e_penerima = cegah($_GET['e_penerima']);
	$e_penerima_no = cegah($_GET['e_penerima_no']);
	$e_pip_usulan = cegah($_GET['e_pip_usulan']);
	$e_kip_penerima = cegah($_GET['e_kip_penerima']);
	$e_kip_no = cegah($_GET['e_kip_no']);
	$e_kip_nama = cegah($_GET['e_kip_nama']);
	$e_kip_terima = cegah($_GET['e_kip_terima']);
	$e_alasan_layak_pip = cegah($_GET['e_alasan_layak_pip']);
	$e_bank = cegah($_GET['e_bank']);
	$e_bank_norek = cegah($_GET['e_bank_norek']);
	$e_bank_an = cegah($_GET['e_bank_an']);
				
				
	//empty
	if ((empty($e_nik)) OR (empty($e_warga)) OR (empty($e_kodepos)) OR (empty($e_moda)) OR (empty($e_anak_ke)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//hapus dulu, lalu insert...
		mysql_query("DELETE FROM siswa ".
						"WHERE kd = '$kd'");
		
		
		//insert
		mysql_query("INSERT INTO siswa(kd, nisn, nama, kelamin, ".
						"nik, tmp_lahir, tgl_lahir, noreg_akta_lahir, ".
						"agama, warga, kebutuhan_khusus, alamat_jalan, ".
						"rt, rw, dusun, kelurahan, ".
						"kecamatan, kabupaten, kodepos, ".
						"lintang, bujur, tempat_tinggal, moda_transportasi, nomor_kks, ".
						"anak_ke, penerima_kps_pkh, nomor_kps_pkh, usulan_dari_sekolah, ".
						"penerima_kip, nomor_kip, nama_kip, terima_kip, ".
						"alasan_pip, bank, bank_norek, bank_an, postdate) VALUES ".
						"('$kd', '$e_nisn', '$e_nama', '$e_kelamin', ".
						"'$e_nik', '$e_tmp_lahir', '$e_tgl_lahir', '$e_akta', ".
						"'$e_agama', '$e_warga', '$e_kebutuhan', '$e_alamat', ".
						"'$e_alamat_rt', '$e_alamat_rw', '$e_alamat_dusun', '$e_alamat_kelurahan', ".
						"'$e_alamat_kecamatan', '$e_alamat_kab', '$e_kodepos', ".
						"'$e_lintang', '$e_bujur', '$e_tmp_tinggal', '$e_moda', '$e_kks', ".
						"'$e_anak_ke', '$e_penerima', '$e_penerima_no', '$e_pip_usulan', ".
						"'$e_kip_penerima', '$e_kip_no', '$e_kip_nama', '$e_kip_terima', ".
						"'$e_alasan_layak_pip', '$e_bank', '$e_bank_norek', '$e_bank_an', '$today')");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}














//jika simpan, ayah
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanf'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$f_nama = cegah($_GET['f_nama']);
	$f_nik = cegah($_GET['f_nik']);
	$f_tahun_lahir = cegah($_GET['f_tahun_lahir']);
	$f_pendidikan = cegah($_GET['f_pendidikan']);
	$f_pekerjaan = cegah($_GET['f_pekerjaan']);
	$f_penghasilan = cegah($_GET['f_penghasilan']);
	$f_kebutuhan = cegah($_GET['f_kebutuhan']);
			
				
	//empty
	if ((empty($f_nama)) OR (empty($f_nik)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//hapus dulu, lalu insert...
		mysql_query("DELETE FROM siswa_ayah ".
						"WHERE siswa_kd = '$kd'");
		
		
		//insert
		mysql_query("INSERT INTO siswa_ayah(kd, siswa_kd, nama, nik, ".
						"tahun_lahir, pendidikan, pekerjaan, ".
						"penghasilan_bulanan, kebutuhan_khusus, postdate) VALUES ".
						"('$x', '$kd', '$f_nama', '$f_nik', ".
						"'$f_tahun_lahir', '$f_pendidikan', '$f_pekerjaan', ".
						"'$f_penghasilan', '$f_kebutuhan', '$today')");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}















//jika simpan, ibu
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpang'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$f_nama = cegah($_GET['g_nama']);
	$f_nik = cegah($_GET['g_nik']);
	$f_tahun_lahir = cegah($_GET['g_tahun_lahir']);
	$f_pendidikan = cegah($_GET['g_pendidikan']);
	$f_pekerjaan = cegah($_GET['g_pekerjaan']);
	$f_penghasilan = cegah($_GET['g_penghasilan']);
	$f_kebutuhan = cegah($_GET['g_kebutuhan']);
			
				
	//empty
	if ((empty($f_nama)) OR (empty($f_nik)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//hapus dulu, lalu insert...
		mysql_query("DELETE FROM siswa_ibu ".
						"WHERE siswa_kd = '$kd'");
		
		
		//insert
		mysql_query("INSERT INTO siswa_ibu(kd, siswa_kd, nama, nik, ".
						"tahun_lahir, pendidikan, pekerjaan, ".
						"penghasilan_bulanan, kebutuhan_khusus, postdate) VALUES ".
						"('$x', '$kd', '$f_nama', '$f_nik', ".
						"'$f_tahun_lahir', '$f_pendidikan', '$f_pekerjaan', ".
						"'$f_penghasilan', '$f_kebutuhan', '$today')");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}














//jika simpan, wali
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanh'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$f_nama = cegah($_GET['h_nama']);
	$f_nik = cegah($_GET['h_nik']);
	$f_tahun_lahir = cegah($_GET['h_tahun_lahir']);
	$f_pendidikan = cegah($_GET['h_pendidikan']);
	$f_pekerjaan = cegah($_GET['h_pekerjaan']);
	$f_penghasilan = cegah($_GET['h_penghasilan']);
	$f_kebutuhan = cegah($_GET['h_kebutuhan']);
			
				
	//empty
	if ((empty($f_nama)) OR (empty($f_nik)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//hapus dulu, lalu insert...
		mysql_query("DELETE FROM siswa_wali ".
						"WHERE siswa_kd = '$kd'");
		
		
		//insert
		mysql_query("INSERT INTO siswa_wali(kd, siswa_kd, nama, nik, ".
						"tahun_lahir, pendidikan, pekerjaan, ".
						"penghasilan_bulanan, kebutuhan_khusus, postdate) VALUES ".
						"('$x', '$kd', '$f_nama', '$f_nik', ".
						"'$f_tahun_lahir', '$f_pendidikan', '$f_pekerjaan', ".
						"'$f_penghasilan', '$f_kebutuhan', '$today')");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}











//jika simpan, kontak
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpani'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$f_telp = cegah($_GET['i_telp']);
	$f_hp = cegah($_GET['i_hp']);
	$f_email = cegah($_GET['i_email']);

				
	//empty
	if ((empty($f_telp)) OR (empty($f_hp)) OR (empty($f_email)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//update
		mysql_query("UPDATE siswa SET telp = '$f_telp', ".
						"hp = '$f_hp', ".
						"email = '$f_email' ".
						"WHERE kd = '$kd'");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}











//jika simpan, priodik
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanj'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$j_tb = cegah($_GET['j_tb']);
	$j_bb = cegah($_GET['j_bb']);
	$j_jarak = cegah($_GET['j_jarak']);
	$j_jarak2 = cegah($_GET['j_jarak2']);
	$j_jam = cegah($_GET['j_jam']);
	$j_menit = cegah($_GET['j_menit']);
	$j_jml_saudara = cegah($_GET['j_jml_saudara']);


				
	//empty
	if ((empty($j_tb)) OR (empty($j_bb)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//hapus dulu, lalu insert...
		mysql_query("DELETE FROM siswa_priodik ".
						"WHERE siswa_kd = '$kd'");
		
		
		//insert
		mysql_query("INSERT INTO siswa_priodik(kd, siswa_kd, tb, bb, ".
						"jarak, jarak2, waktu_jam, waktu_menit, jml_saudara, postdate) VALUES ".
						"('$x', '$kd', '$j_tb', '$j_bb', ".
						"'$j_jarak', '$j_jarak2', '$j_jam', '$j_menit', '$j_jml_saudara', '$today')");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}












//jika simpan, prestasi
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpank'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$jml = 3;


	//hapus dulu, lalu insert...
	mysql_query("DELETE FROM siswa_prestasi ".
					"WHERE siswa_kd = '$kd'");
		
		
	
	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		$xyz = md5("$x$i");
		
		//ambil nilai
		$yuk = "k_jenis_";
		$yuhu = "$yuk$i";
		$k_jenis = cegah($_GET["$yuhu"]);

		$yuk = "k_tingkat_";
		$yuhu = "$yuk$i";
		$k_tingkat = cegah($_GET["$yuhu"]);

		$yuk = "k_nama_";
		$yuhu = "$yuk$i";
		$k_nama = cegah($_GET["$yuhu"]);
		

		$yuk = "k_tahun_";
		$yuhu = "$yuk$i";
		$k_tahun = cegah($_GET["$yuhu"]);
		
		$yuk = "k_penyelenggara_";
		$yuhu = "$yuk$i";
		$k_penyelenggara = cegah($_GET["$yuhu"]);

		$yuk = "k_peringkat_";
		$yuhu = "$yuk$i";
		$k_peringkat = cegah($_GET["$yuhu"]);


		//insert
		mysql_query("INSERT INTO siswa_prestasi(kd, no, siswa_kd, jenis, tingkat, ".
						"nama, tahun, penyelenggara, peringkat, postdate) VALUES ".
						"('$xyz', '$i', '$kd', '$k_jenis', '$k_tingkat', ".
						"'$k_nama', '$k_tahun', '$k_penyelenggara', '$k_peringkat', '$today')");

		}


	echo '<b><font color="green">Berhasil Simpan... </font></b>';

	
	exit();
	}











//jika simpan, beasiswa
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanl'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$jml = 3;


	//hapus dulu, lalu insert...
	mysql_query("DELETE FROM siswa_beasiswa ".
					"WHERE siswa_kd = '$kd'");
		
		
	
	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		$xyz = md5("$x$i");
		
		//ambil nilai
		$yuk = "l_jenis_";
		$yuhu = "$yuk$i";
		$l_jenis = cegah($_GET["$yuhu"]);
		
		$yuk = "l_ket_";
		$yuhu = "$yuk$i";
		$l_ket = cegah($_GET["$yuhu"]);
		
		$yuk = "l_mulai_";
		$yuhu = "$yuk$i";
		$l_mulai = cegah($_GET["$yuhu"]);
		
		$yuk = "l_selesai_";
		$yuhu = "$yuk$i";
		$l_selesai = cegah($_GET["$yuhu"]);



		//insert
		mysql_query("INSERT INTO siswa_beasiswa(kd, no, siswa_kd, jenis, ket, ".
						"mulai, selesai, postdate) VALUES ".
						"('$xyz', '$i', '$kd', '$l_jenis', '$l_ket', ".
						"'$l_mulai', '$l_selesai', '$today')");

		}


	echo '<b><font color="green">Berhasil Simpan... </font></b>';

	
	exit();
	}










//jika simpan, berkas
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpanm'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$f_ijazah = cegah($_GET['m_ijazah']);
	$f_skhun = cegah($_GET['m_skhun']);

				
	//empty
	if ((empty($f_ijazah)) OR (empty($f_skhun)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//update
		mysql_query("UPDATE siswa SET berkas_ijazah = '$f_ijazah', ".
						"berkas_skhun = '$f_skhun' ".
						"WHERE kd = '$kd'");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}









//jika simpan, keluar
if ((isset($_GET['aksi']) && $_GET['aksi'] == 'simpann'))
	{
	//ambil nilai
	$kd = cegah($_GET['kd']);
	$f_karena = cegah($_GET['n_karena']);
	$f_tanggal = cegah($_GET['n_tanggal']);
	$f_alasan = cegah($_GET['n_alasan']);

				
	//empty
	if ((empty($f_karena)) OR (empty($f_tanggal)) OR (empty($f_alasan)))
		{
		echo '<b>
		<font color=red>
		INPUT TIDAK LENGKAP
		</font>
		</b>';	
		} 
	else
		{
		//update
		mysql_query("UPDATE siswa SET keluar_karena = '$f_karena', ".
						"keluar_tgl = '$f_tanggal', ".
						"keluar_alasan = '$f_alasan' ".
						"WHERE kd = '$kd'");


		echo '<b><font color="green">Berhasil Simpan... </font></b>';
		}	

	
	exit();
	}










exit();
?>