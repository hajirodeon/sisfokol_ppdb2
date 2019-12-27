<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;





//ketahui tapel terakhir
$qmboh = mysql_query("SELECT * FROM psb_m_tapel ".
						"ORDER BY tahun1 DESC");
$rmboh = mysql_fetch_assoc($qmboh);
$tapelkd = nosql($rmboh['kd']);
$tahun1 = nosql($rmboh['tahun1']);
$tahun2 = nosql($rmboh['tahun2']);







//nilai
$filenya = "calon.php";
$kd = nosql($_REQUEST['kd']);
$jalur = cegah($_REQUEST['jalur']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);

$judul = "[PPDB $tahun1/$tahun2] Calon Peserta Didik Baru";
$judulku = "$judul";
$judulx = $judul;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek batal
if ($_POST['btnBTL'])
	{
	//nilai
	$jalur = cegah($_POST['e_jalur']);
	
	
	//re-direct
	$ke = "$filenya?jalur=$jalur";
	xloc($ke);
	exit();
	}










//nek simpan kartu ujian
if ($_POST['btnSMP'])
	{
	//nilai
	$kd = cegah($_POST['kd']);
	$e_ruang = cegah($_POST['e_ruang']);
	$jalur = cegah($_POST['e_jalur']);
	
	
	
	//detail
	$qjuk = mysql_query("SELECT * FROM psb_m_ruangan ".
							"WHERE kd = '$e_ruang'");
	$rjuk = mysql_fetch_assoc($qjuk);
	$juk_kode = cegah($rjuk['kode']);
	$juk_nama = cegah($rjuk['nama']);
	
	
	//update
	mysql_query("UPDATE psb_calon SET ruangan_kd = '$e_ruang', ".
					"ruangan_kode = '$juk_kode', ".
					"ruangan_nama = '$juk_nama' ".
					"WHERE kd = '$kd'");
	
	
	//re-direct
	$ke = "$filenya?jalur=$jalur&kd=$kd";
	xloc($ke);
	exit();
	}











//jika export
//export
if ($_POST['btnEX'])
	{
	//nilai
	$jalur = balikin($_REQUEST['e_jalur']);
	
	
	
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "calon-$tahun1-$tahun2-$jalur.xls";
	$i_judul = "CALON";
	



	//header file
	function HeaderingExcel($i_filename)
		{
		header("Content-type:application/vnd.ms-excel");
		header("Content-Disposition:attachment;filename=$i_filename");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
		header("Pragma: public");
		}

	
	
	
	//bikin...
	HeaderingExcel($i_filename);
	$workbook = new Workbook("-");
	$worksheet1 =& $workbook->add_worksheet($i_judul);
	$worksheet1->write_string(0,0,"NO.");
	$worksheet1->write_string(0,1,"NOREG");
	$worksheet1->write_string(0,2,"STATUS");
	$worksheet1->write_string(0,3,"NISN");
	$worksheet1->write_string(0,4,"NAMA");
	$worksheet1->write_string(0,5,"TMP_LAHIR");
	$worksheet1->write_string(0,6,"TGL_LAHIR");
	$worksheet1->write_string(0,7,"KELAMIN");
	$worksheet1->write_string(0,8,"AGAMA");
	$worksheet1->write_string(0,9,"ANAK_STATUS");
	$worksheet1->write_string(0,10,"ANAK_KE");
	$worksheet1->write_string(0,11,"SEKOLAH_ASAL");
	$worksheet1->write_string(0,12,"ALAMAT");
	$worksheet1->write_string(0,13,"TELP");
	$worksheet1->write_string(0,14,"EMAIL");
	$worksheet1->write_string(0,15,"AYAH_NAMA");
	$worksheet1->write_string(0,16,"AYAH_KERJA");
	$worksheet1->write_string(0,17,"IBU_NAMA");
	$worksheet1->write_string(0,18,"IBU_KERJA");
	$worksheet1->write_string(0,19,"ORTU_ALAMAT");
	$worksheet1->write_string(0,20,"ORTU_TELP");



	//data
	$qdt = mysql_query("SELECT * FROM psb_calon ".
							"WHERE tapel_kd = '$tapelkd' ".
							"AND c_jalur = '$jalur' ".
							"ORDER BY noreg ASC");
	$rdt = mysql_fetch_assoc($qdt);

	do
		{
		//nilai
		$dt_nox = $dt_nox + 1;
		$dt_noreg = balikin($rdt['noreg']);
		$dt_c_nisn = balikin($rdt['c_nisn']);
		$dt_c_nama = balikin($rdt['c_nama']);
		$e_tmp_lahir = balikin($rdt['c_tmp_lahir']);
		$e_tgl_lahir = balikin($rdt['c_tgl_lahir']);
		$e_kelamin = balikin($rdt['c_kelamin']);
		$e_agama = balikin($rdt['c_agama']);
		$e_status_anak = balikin($rdt['c_anak_status']);
		$e_anak_ke = balikin($rdt['c_anak_ke']);
		$e_sekolah_asal = balikin($rdt['c_sekolah_asal']);
		$e_alamat = balikin($rdt['c_alamat']);
		$e_telp = balikin($rdt['c_telp']);
		$e_email = balikin($rdt['c_email']);	
		$o_ayah_nama = balikin($rdt['ortu_ayah_nama']);
		$o_ayah_kerja = balikin($rdt['ortu_ayah_kerja']);
		$o_ibu_nama = balikin($rdt['ortu_ibu_nama']);
		$o_ibu_kerja = balikin($rdt['ortu_ibu_kerja']);
		$o_alamat = balikin($rdt['ortu_alamat']);
		$o_telp = balikin($rdt['ortu_telp']);
		$o_aktif = balikin($rdt['aktif']);


		//jika belum aktif, perlu verifikasi
		if ($o_aktif == "false")
			{
			$o_aktif_ket = "Belum Verifikasi";
			}
			
		else if ($o_aktif == "true")
			{
			$o_aktif_ket = "AKTIF";
			}
	
	
		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_noreg);
		$worksheet1->write_string($dt_nox,2,$o_aktif_ket);
		$worksheet1->write_string($dt_nox,3,$dt_c_nisn);
		$worksheet1->write_string($dt_nox,4,$dt_c_nama);
		$worksheet1->write_string($dt_nox,5,$e_tmp_lahir);
		$worksheet1->write_string($dt_nox,6,$e_tgl_lahir);
		$worksheet1->write_string($dt_nox,7,$e_kelamin);
		$worksheet1->write_string($dt_nox,8,$e_agama);
		$worksheet1->write_string($dt_nox,9,$e_status_anak);
		$worksheet1->write_string($dt_nox,10,$e_anak_ke);
		$worksheet1->write_string($dt_nox,11,$e_sekolah_asal);
		$worksheet1->write_string($dt_nox,12,$e_alamat);
		$worksheet1->write_string($dt_nox,13,$e_telp);
		$worksheet1->write_string($dt_nox,14,$e_email);
		$worksheet1->write_string($dt_nox,15,$o_ayah_nama);
		$worksheet1->write_string($dt_nox,16,$o_ayah_kerja);
		$worksheet1->write_string($dt_nox,17,$o_ibu_nama);
		$worksheet1->write_string($dt_nox,18,$o_ibu_kerja);
		$worksheet1->write_string($dt_nox,19,$o_alamat);
		$worksheet1->write_string($dt_nox,20,$o_telp);
		}
	while ($rdt = mysql_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}






//jika verifikasi
if ($s == "verifikasi")
	{
	//nilai
	$jalur = cegah($_REQUEST['jalur']);
	$kd = nosql($_REQUEST['kd']);

	//detail
	$qx = mysql_query("SELECT * FROM psb_calon ".
						"WHERE kd = '$kd'");
	$rowx = mysql_fetch_assoc($qx);
	$e_noreg = balikin($rowx['noreg']);
	$e_nama = balikin($rowx['c_nama']);


	$nilku = $today;

	
	//update
	mysql_query("UPDATE psb_calon SET aktif = 'true', ".
					"aktif_postdate = '$nilku' ".
					"WHERE kd = '$kd'");
	
	//re-direct
	$pesan = "[$e_noreg]. [$e_nama]. Verifikasi Aktif : $nilku";
	$ke = "$filenya?jalur=$jalur";
	pekem($pesan,$ke);
	exit();
	}








//jika reset password
if ($s == "reset")
	{
	//nilai
	$jalur = cegah($_REQUEST['jalur']);
	$kd = nosql($_REQUEST['kd']);
	

	//detail
	$qx = mysql_query("SELECT * FROM psb_calon ".
						"WHERE kd = '$kd'");
	$rowx = mysql_fetch_assoc($qx);
	$e_noreg = balikin($rowx['noreg']);
	$e_nama = balikin($rowx['c_nama']);

	
	//passbaru
	$passbaru = substr($x,0,5);
	$passbarux = md5($passbaru);
	
	
	//update
	mysql_query("UPDATE psb_calon SET passwordx = '$passbarux', ".
					"passwordx2 = '$passbaru' ".
					"WHERE kd = '$kd'");
	
	//re-direct
	$pesan = "[$e_noreg]. [$e_nama]. Password Baru : $passbaru";
	$ke = "$filenya?jalur=$jalur";
	pekem($pesan,$ke);
	exit();
	}











//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$jalur = cegah($_POST['e_jalur']);
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?&jalur=$jalur&kunci=$kunci";
	xloc($ke);
	exit();
	}


/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();


//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");
?>


  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>
  
<?php


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formxx">';
	
	
	
//jika detail
if ($s == "detail")
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysql_query("SELECT * FROM psb_calon ".
						"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_sekolah = balikin($rowx['sekolah']);
	$e_tapel_nama = balikin($rowx['tapel_nama']);
	$e_jalur = balikin($rowx['c_jalur']);
	$e_noreg = balikin($rowx['noreg']);
	$e_nisn = balikin($rowx['c_nisn']);
	$e_nama = balikin($rowx['c_nama']);
	$e_tmp_lahir = balikin($rowx['c_tmp_lahir']);
	$e_tgl_lahir = balikin($rowx['c_tgl_lahir']);
	$e_kelamin = balikin($rowx['c_kelamin']);
	$e_agama = balikin($rowx['c_agama']);
	$e_status_anak = balikin($rowx['c_anak_status']);
	$e_anak_ke = balikin($rowx['c_anak_ke']);
	$e_sekolah_asal = balikin($rowx['c_sekolah_asal']);
	$e_alamat = balikin($rowx['c_alamat']);
	$e_telp = balikin($rowx['c_telp']);
	$e_email = balikin($rowx['c_email']);	
	$o_ayah_nama = balikin($rowx['ortu_ayah_nama']);
	$o_ayah_kerja = balikin($rowx['ortu_ayah_kerja']);
	$o_ibu_nama = balikin($rowx['ortu_ibu_nama']);
	$o_ibu_kerja = balikin($rowx['ortu_ibu_kerja']);
	$o_alamat = balikin($rowx['ortu_alamat']);
	$o_telp = balikin($rowx['ortu_telp']);


	$nil_foto = "$sumber/filebox/calon/$kd/$kd-calon.jpg";
		
	?>
	
	
	
	<div class="row">

	<div class="col-md-6">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" name="formx2">
	
	
	<p>
	TAPEL : 
	<br>
	<b>'.$e_tapel_nama.'</b>
	</p>
	
	
	<p>
	SEKOLAH : 
	<br>
	<b>'.$sekolah.'</b>
	</p>
	
	
	
	<p>
	JALUR : 
	<br>
	<b>'.$jalur.'</b>
	</p>
	
	
	<p>
	NOREG : 
	<br>
	<b>'.$e_noreg.'</b>
	</p>
	
		
	
	<p>
	NISN : 
	<br>
	<b>'.$e_nisn.'</b>
	</p>
	
		
	
	<p>
	NAMA : 
	<br>
	<b>'.$e_nama.'</b>
	</p>

	
	<p>
	Tempat, Tanggal Lahir :
	<br>
	<b>'.$e_tmp_lahir.', '.$e_tgl_lahir.'</b>
	</p> 
	

	<p>
	Jenis Kelamin :
	<br>
	<b>'.$e_kelamin.'</b>
	</p>
		
	<p>
	Agama :
	<br>
	<b>'.$e_agama.'</b>
	</p>
		
	<p>
	Status Anak :
	<br>
	<b>'.$e_status_anak.'</b>
	</p>
		
	<p>
	Anak ke-:
	<br>
	<b>'.$e_anak_ke.'</b>
	</p>
		
	<p>
	Sekolah Asal :
	<br>
	<b>'.$e_sekolah_asal.'</b>
	</p>
		
	<p>
	Alamat :
	<br>
	<b>'.$e_alamat.'</b>
	</p>
		
	<p>
	Telepon :
	<br>
	<b>'.$e_telp.'</b>
	</p>
		
	<p>
	E-Mail :
	<br>
	<b>'.$e_email.'</b>
	</p>
		
		
		
	<hr>
	<h3>ORANG TUA</h3>
		
		
	<p>
	Ayah, Nama :
	<br>
	<b>'.$o_ayah_nama.'</b>
	</p>
	
	<p>
	Ayah, Pekerjaan :
	<br>
	<b>'.$o_ayah_kerja.'</b>
	</p>
		
	<p>
	Ibu, Nama :
	<br>
	<b>'.$o_ibu_nama.'</b>
	</p>
		
	<p>
	Ibu, Pekerjaan :
	<br>
	<b>'.$o_ibu_kerja.'</b>
	</p>
		
	<p>
	Alamat :
	<br>
	<b>'.$o_alamat.'</b>
	</p>
		
	<p>
	Telepon :
	<br>
	<b>'.$o_telp.'</b>
	</p>

		
	<p>
	<input name="e_jalur" type="hidden" value="'.$jalur.'">
	
	<a href="calon_pdf.php?kd='.$kd.'" class="btn btn-danger" target="_blank">DETAIL LENGKAP</a>
	
	
	<input name="btnBTL" type="submit" value="DAFTAR CALON LAINNYA >>" class="btn btn-info">
	</p>
	
	
	</form>';
	
	?>
		
	
	
	</div>
	
	<div class="col-md-6">

		<img src="<?php echo $nil_foto;?>" width="300">
			

	</div>
	
	</div>


	<?php
	}
	
	




//jika kartu ujian
else if ($s == "kartu")
	{
	$kdx = nosql($_REQUEST['kd']);

	$qx = mysql_query("SELECT * FROM psb_calon ".
						"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_sekolah = balikin($rowx['sekolah']);
	$e_tapel_nama = balikin($rowx['tapel_nama']);
	$e_jalur = balikin($rowx['c_jalur']);
	$e_noreg = balikin($rowx['noreg']);
	$e_nisn = balikin($rowx['c_nisn']);
	$e_nama = balikin($rowx['c_nama']);
	$e_tmp_lahir = balikin($rowx['c_tmp_lahir']);
	$e_tgl_lahir = balikin($rowx['c_tgl_lahir']);
	$e_kelamin = balikin($rowx['c_kelamin']);
	$e_agama = balikin($rowx['c_agama']);
	$e_status_anak = balikin($rowx['c_anak_status']);
	$e_anak_ke = balikin($rowx['c_anak_ke']);
	$e_sekolah_asal = balikin($rowx['c_sekolah_asal']);
	$e_alamat = balikin($rowx['c_alamat']);
	$e_telp = balikin($rowx['c_telp']);
	$e_email = balikin($rowx['c_email']);	
	$o_ayah_nama = balikin($rowx['ortu_ayah_nama']);
	$o_ayah_kerja = balikin($rowx['ortu_ayah_kerja']);
	$o_ibu_nama = balikin($rowx['ortu_ibu_nama']);
	$o_ibu_kerja = balikin($rowx['ortu_ibu_kerja']);
	$o_alamat = balikin($rowx['ortu_alamat']);
	$o_telp = balikin($rowx['ortu_telp']);
	
	$e_ruang_kd = nosql($rowx['ruangan_kd']);
	$e_ruang_kode = nosql($rowx['ruangan_kode']);
	$e_ruang_nama = nosql($rowx['ruangan_nama']);
	$e_ruang_ket = "$e_ruang_kode/$e_ruang_nama";


	$nil_foto = "$sumber/filebox/calon/$kd/$kd-calon.jpg";
		
	?>

	
	
	</div>
	
	<div class="col-10">

			
		<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-pencil"></i>

              <h3 class="box-title">KARTU UJIAN</h3>
            </div>
            <div class="box-body">
				
				<div class="row">
				
					<div class="col-md-2">
					
					<img src="<?php echo $nil_foto;?>" width="150">
					
					</div>
				
				
					<div class="col-md-4">
		
					
					<p>
					TAPEL : 
					<br>
					<b><?php echo $e_tapel_nama;?></b>
					</p>
					
					
					<p>
					JALUR : 
					<br>
					<b><?php echo $jalur;?></b>
					</p>
					
		        	
					<p>
					NAMA PESERTA :
					<br>
					<b><?php echo $e_nama;?></b>
					</p>
		
					
					<p>
					No. Pendaftaran :
					<br>
					<b><?php echo $e_noreg;?></b>
					</p>
		
					<p>
						<select name="e_ruang" class="btn btn-block btn-warning">
						<option value="<?php echo $e_ruangkd;?>"><?php echo $e_ruang_ket;?></option>
						<?php
						//list ruang
						$qyuk = mysql_query("SELECT * FROM psb_m_ruangan ".
												"ORDER BY kode ASC");
						$ryuk = mysql_fetch_assoc($qyuk);
						
						do
							{
							//nilai
							$yuk_kd = nosql($ryuk['kd']);
							$yuk_kode = balikin($ryuk['kode']);
							$yuk_nama = balikin($ryuk['nama']);
								
							echo '<option value="'.$yuk_kd.'">'.$yuk_kode.'. '.$yuk_nama.'</option>';
							}
						while ($ryuk = mysql_fetch_assoc($qyuk));
						?>
						
						</select>
					</p>

			
					<hr>
					<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-block btn-danger">
					<hr>
		
					<p>
						<a href="calon_prt.php?ckd=<?php echo $kd;?>" class="btn btn-block btn-success" target="_blank">CETAK KARTU UJIAN</a>
					</p>				
		
		

			</div>

		</div>


	</div>
	
	</div>





	<div class="row">
	
		<div class="col-10" align="center">
		
			<?php
			echo '<p>
			<input name="e_sekolah" type="hidden" value="'.$sekolah.'">
			<input name="e_jalur" type="hidden" value="'.$jalur.'">
			<input name="kd" type="hidden" value="'.$kd.'">
			
			<hr>
			<input name="btnBTL" type="submit" value="DAFTAR CALON LAINNYA >>" class="btn btn-info">
			<hr>
			</p>';
			?>
			
			
				
		
		</div>
	
	</div>
	


	<?php
	}
	




	

else
	{

	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM psb_calon ".
						"WHERE tapel_kd = '$tapelkd' ".
						"AND c_jalur = '$jalur' ".
						"ORDER BY postdate DESC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM psb_calon ".
						"WHERE tapel_kd = '$tapelkd' ".
						"AND (c_nisn LIKE '%$kunci%' ".
						"OR noreg LIKE '%$kunci%' ".
						"OR c_nama LIKE '%$kunci%' ".
						"OR c_tmp_lahir LIKE '%$kunci%' ".
						"OR c_tgl_lahir LIKE '%$kunci%' ".
						"OR c_kelamin LIKE '%$kunci%' ".
						"OR c_agama LIKE '%$kunci%' ".
						"OR c_anak_status LIKE '%$kunci%' ".
						"OR c_anak_ke LIKE '%$kunci%' ".
						"OR c_sekolah_asal LIKE '%$kunci%' ".
						"OR c_alamat LIKE '%$kunci%' ".
						"OR c_telp LIKE '%$kunci%' ".
						"OR c_email LIKE '%$kunci%' ".
						"OR ortu_ayah_nama LIKE '%$kunci%' ".
						"OR ortu_ayah_kerja LIKE '%$kunci%' ".
						"OR ortu_ibu_nama LIKE '%$kunci%' ".
						"OR ortu_ibu_kerja LIKE '%$kunci%' ".
						"OR ortu_alamat LIKE '%$kunci%' ".
						"OR ortu_telp LIKE '%$kunci%' ".
						"OR reg_bayar_tgl LIKE '%$kunci%' ".
						"OR reg_bayar LIKE '%$kunci%' ".
						"OR postdate LIKE '%$kunci%' ".
						"OR aktif_postdate LIKE '%$kunci%') ".
						"ORDER BY postdate DESC";
		}
		
	
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlresult = $sqlcount;
	
	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?jalur=$jalur";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);


	
	echo '<p>
		Jalur : ';		
		echo "<select name=\"jalur\" class=\"btn btn-success\" onChange=\"MM_jumpMenu('self',this,0)\">";
		echo '<option value="'.$jalur.'">'.$jalur.'</option>
		<option value="'.$filenya.'?jalur=REGULER">REGULER</option>
		<option value="'.$filenya.'?jalur=PRESTASI">PRESTASI</option>
		</select>
		
		</p>';

	//jika null
	if (empty($jalur))
		{
		echo '<h3>
		<font color="red">
		Silahkan Pilih Dahulu Jalur Yang Diinginkan...
		</font>
		</h3>';
		}
		
	else
		{
		//ketahui jumlahnya
		$qyo = mysql_query("SELECT * FROM psb_calon ". 
								"WHERE tapel_kd = '$tapelkd' ".
								"AND c_jalur = '$jalur'");
		$ryo = mysql_fetch_assoc($qyo);
		$tyo = mysql_num_rows($qyo);
		
		
		//yg belum aktif / belum verifikasi
		$qyo2 = mysql_query("SELECT * FROM psb_calon ". 
								"WHERE tapel_kd = '$tapelkd' ".
								"AND c_jalur = '$jalur' ".
								"AND aktif = 'false'");
		$ryo2 = mysql_fetch_assoc($qyo2);
		$tyo2 = mysql_num_rows($qyo2);
		
		
		//sudah aktif
		$yo_aktif = $tyo - $tyo2;
						
		
		
		
		echo '<hr>
		<p>
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		<input name="btnEX" type="submit" value="EXPORT EXCEL" class="btn btn-success">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="e_sekolah" type="hidden" value="'.$sekolah.'">
		<input name="e_jalur" type="hidden" value="'.$jalur.'">
		
		</p>
			
		
		
		[TOTAL : <b>'.$tyo.'</b>]. 
		[Belum Verifikasi : <b><font color=red>'.$tyo2.'</font></b>]. 
		[AKTIF : <b><font color=green>'.$yo_aktif.'</font></b>].
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">VERIFIKASI</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">IMAGE</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NOREG</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NISN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">RUANG UJIAN</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">SEKOLAH ASAL</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">ALAMAT</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">EMAIL</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">TELEPON</font></strong></td>
		
		</tr>
		</thead>
		<tbody>';
		
		if ($count != 0)
			{
			do 
				{
				if ($warna_set ==0)
					{
					$warna = $warna01;
					$warna_set = 1;
					}
				else
					{
					$warna = $warna02;
					$warna_set = 0;
					}
		
				$nomer = $nomer + 1;
				$i_kd = nosql($data['kd']);
				$i_postdate = balikin($data['postdate']);
				$i_sekolah = balikin($data['sekolah']);
				$i_tapel_nama = balikin($data['tapel_nama']);
				$i_noreg = balikin($data['noreg']);
				$i_nisn = balikin($data['c_nisn']);
				$i_nama = balikin($data['c_nama']);
				$i_sekolah_asal = balikin($data['c_sekolah_asal']);
				$i_alamat = balikin($data['c_alamat']);
				$i_telp = balikin($data['c_telp']);
				$i_email = balikin($data['c_email']);
				$i_bayar_tgl = balikin($data['reg_bayar_tgl']);
				$i_bayar = balikin($data['reg_bayar']);
				$i_bayar_filex = balikin($data['reg_bayar_filex']);
				$i_aktif_postdate = balikin($data['aktif_postdate']);
		
				$i_ruang_kd = balikin($data['ruangan_kd']);
				$i_ruang_kode = balikin($data['ruangan_kode']);
				$i_ruang_nama = balikin($data['ruangan_nama']);
				$i_ruangan = "$i_ruang_kode. $i_ruang_nama";
		
				$i_bayar2 = xduit2($i_bayar);
		
				$nil_foto1 = "$sumber/filebox/calon/$i_kd/$i_kd-calon.jpg";
				$nil_foto2 = "$sumber/filebox/calon/$i_kd/$i_kd-bayar.jpg";
	
			
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>'.$i_postdate.'</td>
				<td>';
				
					
				//jika belum bayar
				if ($i_bayar_tgl == "0000-00-00")
					{
					echo "<font color=red>BELUM BAYAR</font>";
					}
					
				else
					{
					//jika belum verifikasi
					if ($i_aktif_postdate == "0000-00-00 00:00:00")
						{
						echo '<p>
						Tanggal Bayar : 
						<br>
						'.$i_bayar_tgl.'
						</p>
						
						<p>
						'.$i_bayar2.'
						</p>
						
						<p>
						Bukti Bayar :
						<br>
						<img src="'.$nil_foto2.'" width="200">
						</p>
	
						<p>
						<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal'.$i_kd.'">LIHAT</button>
						</p>



						<div class="modal fade" id="myModal'.$i_kd.'" role="dialog">
						    <div class="modal-dialog modal-lg">
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Bukti Bayar : '.$i_noreg.'. '.$i_nama.'</h4>
						        </div>
						        <div class="modal-body">
						          <p>
						          
									<img src="'.$nil_foto2.'" width="100%">
						          </p>
						        </div>
						        <div class="modal-footer">
						          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						        </div>
						      </div>
						    </div>
						  </div>
						  
  
  						
						
						<p>
						<a href="'.$filenya.'?s=verifikasi&sekolah='.$sekolah.'&jalur='.$jalur.'&kd='.$i_kd.'" class="btn btn-block btn-danger">VERIFIKASI BAYAR >></a>
						</p>';
						}
						
					else
						{
						echo '<p>
						Tanggal Bayar : 
						<br>
						<b>'.$i_bayar_tgl.'</b>
						</p>
						
						<p>
						<b>'.$i_bayar2.'</b>
						</p>
						
						<p>
						Bukti Bayar :
						<br>
						<img src="'.$nil_foto2.'" width="200">
						</p>

	
						<p>
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal'.$i_kd.'">LIHAT >></button>
						</p>



						<div class="modal fade" id="myModal'.$i_kd.'" role="dialog">
						    <div class="modal-dialog modal-lg">
						      <div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Bukti Bayar : '.$i_noreg.'. '.$i_nama.'</h4>
						        </div>
						        <div class="modal-body">
						          <p>
						          
									<img src="'.$nil_foto2.'" width="100%">
						          </p>
						        </div>
						        <div class="modal-footer">
						          <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
						        </div>
						      </div>
						    </div>
						  </div>
						  
  
  							
						<p>
						TELAH VERIFIKASI : 
						<br>
						<b><font color="green">'.$i_aktif_postdate.'</font></b>
						</p>';
						}
						
					}
				
			
				echo '</td>
				<td>
					<img src="'.$nil_foto1.'" width="150">
				</td>
				<td>'.$i_noreg.'</td>
				<td>'.$i_nisn.'</td>
				<td>
				'.$i_nama.'
				<br>
				<br>
				<a href="'.$filenya.'?s=detail&jalur='.$jalur.'&kd='.$i_kd.'" class="btn btn-block btn-info">DETAIL >></a>
				<br>
				<a href="'.$filenya.'?s=reset&jalur='.$jalur.'&kd='.$i_kd.'" class="btn btn-block btn-primary">RESET PASSWORD >></a>
				</td>
				<td>
				'.$i_ruangan.'
				<br>
				<a href="'.$filenya.'?s=kartu&jalur='.$jalur.'&kd='.$i_kd.'" class="btn btn-block btn-success">KARTU UJIAN >></a>
					
				</td>
				
				<td>'.$i_sekolah_asal.'</td>
				<td>'.$i_alamat.'</td>
				<td>'.$i_email.'</td>
				<td>'.$i_telp.'</td>
		        </tr>';
				}
			while ($data = mysql_fetch_assoc($result));
			}
		
		
		echo '</tbody>
		  </table>
		  </div>
		
		
		<table width="500" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td>
		<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
		<br>
	
		<input name="jml" type="hidden" value="'.$count.'">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="kd" type="hidden" value="'.$kdx.'">
		<input name="page" type="hidden" value="'.$page.'">
		</td>
		</tr>
		</table>
		</form>';
		}
	}








//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//null-kan
xclose($koneksi);
exit();
?>