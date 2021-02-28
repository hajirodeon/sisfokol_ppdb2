<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/cek/calon.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/calon.html");



nocache;

//nilai
$filenya = "calon.php";
$filenya2 = "calon.php";
$filenyax = "i_calon_du.php";
$judul = "Formulir Lengkap Calon : $nama6_session";
$judulku = $judul;
$ku_judul = $judulku;
$s = nosql($_REQUEST['s']);
$kdx = $kd6_session;
$kd = $kd6_session;


		

//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////
//jika beranda
if ($_POST['btnHOME'])
	{
	//nilai
	xloc($filenya2);
	exit();
	}






//jika ganti password
if ($_POST['btnPASS'])
	{
	//nilai
	$ke = "$filenya2?s=pass";
	xloc($ke);
	exit();
	}



//jika lihat profil
if ($_POST['btnPROFIL'])
	{
	//nilai
	$ke = "$filenya2?s=profil";
	xloc($ke);
	exit();
	}






//jika keluar
if ($_POST['btnKELUAR'])
	{
	//hapus session
	session_unset();
	session_destroy();
	
	
	//re-direct
	xloc($sumber);
	exit();
	}





/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




















//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();



//list
$qku = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 DESC");
$rku = mysqli_fetch_assoc($qku);
$e_tapelkd = nosql($rku['kd']);
$e_dt_tahun1 = nosql($rku['tahun1']);
$e_dt_tahun2 = nosql($rku['tahun2']);
$e_dt_tk = nosql($rku['dayatampung_tk']);
$e_dt_sd = nosql($rku['dayatampung_sd']);
$e_dt_smp = nosql($rku['dayatampung_smp']);
$e_dt_sma = nosql($rku['dayatampung_sma']);




//profil
$qx = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
					"WHERE kd = '$kdx'");
$rowx = mysqli_fetch_assoc($qx);
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
$o_diterima = balikin($rowx['diterima']);

$i_bayar_tgl = balikin($rowx['reg_bayar_tgl']);
$i_bayar = balikin($rowx['reg_bayar']);
$i_bayar_filex = balikin($rowx['reg_bayar_filex']);
$i_aktif_postdate = balikin($rowx['aktif_postdate']);


$i_nilai = balikin($rowx['nilai']);
$i_nilai_postdate = balikin($rowx['nilai_postdate']);


$i_bayar2 = xduit2($i_bayar);

$nil_foto1 = "$sumber/filebox/calon/$kd/$kd-calon.jpg";
$nil_foto2 = "$sumber/filebox/calon/$kd/$kd-bayar.jpg";




//isi
echo '<h4 class="post-title">'.$judul.'</h4>
<hr>';


echo '<form action="'.$filenya.'" method="post" name="formx2" id="formx2" enctype="multipart/form-data">
	
<p>
<input name="btnHOME" id="btnHOME" type="submit" class="btn btn-primary" value="BERANDA">
<input name="btnPASS" id="btnPASS" type="submit" class="btn btn-warning" value="GANTI PASSWORD">
<input name="btnPROFIL" id="btnPROFIL" type="submit" class="btn btn-success" value="DETAIL CALON">

<input name="btnKELUAR" id="btnKELUAR" type="submit" class="btn btn-danger" value="KELUAR >>">
</p>


</form>
<hr>';


echo '<div class="row">
    <div class="col-12">

<h3>Silahkan isi lengkap formulir berikut ini...</h3>';
?>



<script language='javascript'>
//membuat document jquery
$(document).ready(function(){

	$("#btnSMPE").on('click', function(){
		
		$("#formx_e").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpane",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){					
					$("#hasil_e").html(data);
					}
				});
			return false;
		});
	
	
	});	






	$("#btnSMPF").on('click', function(){
		
		$("#formx_f").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpanf",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_f").html(data);
					}
				});
			return false;
		});
	
	
	});	







	$("#btnSMPG").on('click', function(){
		
		$("#formx_g").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpang",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_g").html(data);
					}
				});
			return false;
		});
	
	
	});	
	
	









	$("#btnSMPH").on('click', function(){
		
		$("#formx_h").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpanh",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_h").html(data);
					}
				});
			return false;
		});
	
	
	});	
	










	$("#btnSMPI").on('click', function(){
		
		$("#formx_i").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpani",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_i").html(data);
					}
				});
			return false;
		});
	
	
	});	
	











	$("#btnSMPJ").on('click', function(){
		
		$("#formx_j").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpanj",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_j").html(data);
					}
				});
			return false;
		});
	
	
	});	
	











	$("#btnSMPK").on('click', function(){
		
		$("#formx_k").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpank",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_k").html(data);
					}
				});
			return false;
		});
	
	
	});	
	








	$("#btnSMPL").on('click', function(){
		
		$("#formx_l").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpanl",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_l").html(data);
					}
				});
			return false;
		});
	
	
	});	
	









	$("#btnSMPM").on('click', function(){
		
		$("#formx_m").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpanm",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_m").html(data);
					}
				});
			return false;
		});
	
	
	});	
	














	$("#btnSMPN").on('click', function(){
		
		$("#formx_n").submit(function(){
			$.ajax({
				url: "<?php echo $filenyax;?>?kd=<?php echo $kd;?>&aksi=simpann",
				type:$(this).attr("method"),
				data:$(this).serialize(),
				success:function(data){	
					$("#hasil_n").html(data);
					}
				});
			return false;
		});
	
	
	});	
	







	
	
	
	
	



});

</script>
	

<?php
echo '<form name="formx_e" id="formx_e">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA DIRI</h3>
        </div>
        <div class="box-body">';

			//detail
			$qx2 = mysqli_query($koneksi, "SELECT * FROM siswa ".
								"WHERE kd = '$kdx'");
			$rowx2 = mysqli_fetch_assoc($qx2, MYSQL_NUM);

			echo '<div class="row">
			    <div class="col-4">

				<p>
				Nama Lengkap : 
				<br>
				<input name="e_nama" id="e_nama" type="text" size="15" class="btn btn-default" value="'.$e_nama.'">
				</p>
				

				<p>
				Jenis Kelamin : 
				<br>
				
				<input name="e_kelamin" id="e_kelamin" type="text" size="5" class="btn btn-default" value="'.$e_kelamin.'">
				</p>
				
				<p>
				NISN : 
				<br>
				
				<input name="e_nisn" id="e_nisn" type="text" size="15" class="btn btn-default" value="'.$e_nisn.'">
				</p>
				
				<p>
				NIK / No.KITAS untuk WNA : 
				<br>
				<input name="e_nik" id="e_nik" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[4]).'">
				</p>
				
				<p>
				Tempat Lahir : 
				<br>
				<input name="e_tmp_lahir" id="e_tmp_lahir" type="text" size="15" class="btn btn-default"  value="'.balikin($rowx2[5]).'">
				</p>
				
				<p>
				Tanggal Lahir : 
				<br>
				<input name="e_tgl_lahir" id="e_tgl_lahir" type="text" size="10" class="btn btn-default"  value="'.balikin($rowx2[6]).'">
				</p>
				
				<p>
				No. Registrasi Akta Kelahiran : 
				<br>
				<input name="e_akta" id="e_akta" type="text" size="10" class="btn btn-warning" value="'.balikin($rowx2[7]).'">
				</p>
				
				<p>
				Agama / Kepercayaan : 
				<br>
				<input name="e_agama" id="e_agama" type="text" size="15" class="btn btn-default"  value="'.balikin($rowx2[8]).'">
				</p>
				
				<p>
				Kewarganegaraan : 
				<br>
				<input name="e_warga" id="e_warga" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[9]).'">
				</p>
				
				<p>
				Kebutuhan Khusus : 
				<br>
				
				<select name="e_kebutuhan" id="e_kebutuhan" class="btn btn-warning">
					<option value="'.balikin($rowx2[10]).'" selected>'.balikin($rowx2[10]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_kebutuhan ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				</p>
				
				
				<p>
				Alamat Jalan : 
				<br>
				<input name="e_alamat" id="e_alamat" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[11]).'">
				</p>
				
			</div>
			<div class="col-4">
				
				<p>
				RT : 
				<br>
				<input name="e_alamat_rt" id="e_alamat_rt" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx2[12]).'">
				</p>
				
				<p>
				RW : 
				<br>
				<input name="e_alamat_rw" id="e_alamat_rw" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx2[13]).'">
				</p>
				
				
				<p>
				Dusun : 
				<br>
				<input name="e_alamat_dusun" id="e_alamat_dusun" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[14]).'">
				</p>
				
				<p>
				Kelurahan : 
				<br>
				<input name="e_alamat_kelurahan" id="e_alamat_kelurahan" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[15]).'">
				</p>
				
				
				<p>
				Kecamatan : 
				<br>
				<input name="e_alamat_kecamatan" id="e_alamat_kecamatan" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[16]).'">
				</p>

				
				<p>
				Kabupaten/Kota : 
				<br>
				<input name="e_alamat_kab" id="e_alamat_kab" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[17]).'">
				</p>
								
				<p>
				Kode Pos : 
				<br>
				<input name="e_kodepos" id="e_kodepos" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx2[18]).'">
				</p>
				
				<p>
				Lintang : 
				<br>
				<input name="e_lintang" id="e_lintang" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[19]).'">
				</p>
				
				<p>
				Bujur : 
				<br>
				<input name="e_bujur" id="e_bujur" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[20]).'">
				</p>

							
				<p>
				Tempat Tinggal : 
				<br>

				<select name="e_tmp_tinggal" id="e_tmp_tinggal" class="btn btn-warning">
					<option value="'.balikin($rowx2[21]).'" selected>'.balikin($rowx2[21]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_tempat_tinggal ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				<p>
				Moda Transportasi : 
				<br>
				<select name="e_moda" id="e_moda" class="btn btn-warning">
					<option  value="'.balikin($rowx2[22]).'"selected>'.balikin($rowx2[22]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_moda ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				<p>
				Nomor KKS : 
				<br>
				<input name="e_kks" id="e_kks" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[23]).'">
				</p>
				
				<p>
				Anak Ke- : 
				<br>
				
				<input name="e_anak_ke" id="e_anak_ke" type="text" size="5" class="btn btn-default" value="'.$e_anak_ke.'">
				</p>


			</div>
			
			<div class="col-4">
								
				<p>
				Penerima KPS/PKH : 
				<br>
				<select name="e_penerima" id="e_penerima" class="btn btn-warning">
					<option  value="'.balikin($rowx2[25]).'"selected>'.balikin($rowx2[25]).'</option>
					<option value="Ya">Ya</option>
					<option value="Tidak">Tidak</option>
				</select>
				</p>
				
				<p>
				Nomor KPS/PKH, jika menerima : 
				<br>
				<input name="e_penerima_no" id="e_penerima_no" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[26]).'">
				</p>
				
				<p>
				Usulan dari Sekolah (Layak PIP) : 
				<br>

				<select name="e_pip_usulan" id="e_pip_usulan" class="btn btn-warning">
					<option  value="'.balikin($rowx2[27]).'"selected>'.balikin($rowx2[27]).'</option>
					<option value="Ya">Ya</option>
					<option value="Tidak">Tidak</option>
				</select>
				</p>
				
				<p>
				Penerima KIP (Kartu Indonesia Pintar) : 
				<br>
				<select name="e_kip_penerima" id="e_kip_penerima" class="btn btn-warning">
					<option  value="'.balikin($rowx2[28]).'"selected>'.balikin($rowx2[28]).'</option>
					<option value="Ya">Ya</option>
					<option value="Tidak">Tidak</option>
				</select>
				
				</p>
				
				<p>
				Nomor KIP : 
				<br>
				<input name="e_kip_no" id="e_kip_no" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[29]).'">
				</p>
				
				<p>
				Nama Tertera di KIP : 
				<br>
				<input name="e_kip_nama" id="e_kip_nama" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[30]).'">
				</p>
				
				<p>
				Terima Fisik Kartu KIP : 
				<br>
				<select name="e_kip_terima" id="e_kip_terima" class="btn btn-warning">
					<option  value="'.balikin($rowx2[31]).'"selected>'.balikin($rowx2[31]).'"</option>
					<option value="Ya">Ya</option>
					<option value="Tidak">Tidak</option>
				</select>
				
				</p>

				<p>
				Alasan Layak PIP : 
				<br>
				<select name="e_alasan_layak_pip" id="e_alasan_layak_pip" class="btn btn-warning">
					<option value="'.balikin($rowx2[32]).'" selected>'.balikin($rowx2[32]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_alasan_pip ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>


				
				<p>
				Bank : 
				<br>
				<input name="e_bank" id="e_bank" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[33]).'">
				</p>
				
				<p>
				Norek Bank : 
				<br>
				<input name="e_bank_norek" id="e_bank_norek" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[34]).'">
				</p>
				
				<p>
				Atas Nama : 
				<br>
				<input name="e_bank_an" id="e_bank_an" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[35]).'">
				</p>
			
				</div>
			</div>	
				
			
			<hr>
			<div id="hasil_e"></div>
			<p>
			<input name="btnSMPE" id="btnSMPE" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>

        
		</div>
	
	</div>
</form>
	








<form name="formx_f" id="formx_f">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA AYAH KANDUNG</h3>
        </div>
        <div class="box-body">';


			//detail
			$qx2 = mysqli_query($koneksi, "SELECT * FROM siswa_ayah ".
								"WHERE siswa_kd = '$kdx'");
			$rowx2 = mysqli_fetch_assoc($qx2, MYSQL_NUM);

		
			echo '<div class="row">
			    <div class="col-4">
		
				<p>
				Nama : 
				<br>
				<input name="f_nama" id="f_nama" type="text" size="15" class="btn btn-default" value="'.$o_ayah_nama.'">
				</p>
				
				<p>
				NIK : 
				<br>
				<input name="f_nik" id="f_nik" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[5]).'">
				</p>
				
				<p>
				Tahun Lahir : 
				<br>
				<input name="f_tahun_lahir" id="f_tahun_lahir" type="text" size="4" class="btn btn-warning" value="'.balikin($rowx2[6]).'">
				</p>
				
				<p>
				Pendidikan : 
				<br>
				<select name="f_pendidikan" id="f_pendidikan" class="btn btn-warning">
					<option value="'.balikin($rowx2[8]).'" selected>'.balikin($rowx2[7]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
		
			
				</div>
				<div class="col-4">
				
				<p>
				Pekerjaan : 
				<br>
				<select name="f_pekerjaan" id="f_pekerjaan" class="btn btn-warning">
					<option value="'.$o_ayah_kerja.'" selected>'.$o_ayah_kerja.'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pekerjaan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				
				</p>
				
				<p>
				Penghasilan Bulanan : 
				<br>

				<select name="f_penghasilan" id="f_penghasilan" class="btn btn-warning">
					<option value="'.balikin($rowx2[10]).'" selected>'.balikin($rowx2[9]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_penghasilan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				<p>
				Berkebutuhan Khusus : 
				<br>

				<select name="f_kebutuhan" id="f_kebutuhan" class="btn btn-warning">
					<option value="'.balikin($rowx2[11]).'" selected>'.balikin($rowx2[10]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_kebutuhan ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				</div>
			</div>
		
		
		
			<hr>
			<div id="hasil_f"></div>
			<p>
			<input name="btnSMPF" id="btnSMPF" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>
		
		
		        
		</div>
	
	</div>
</form>









<form name="formx_g" id="formx_g">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA IBU KANDUNG</h3>
        </div>
        <div class="box-body">';
        
			//detail
			$qx2 = mysqli_query($koneksi, "SELECT * FROM siswa_ibu ".
								"WHERE siswa_kd = '$kdx'");
			$rowx2 = mysqli_fetch_assoc($qx2, MYSQL_NUM);
		


			echo '<div class="row">
			    <div class="col-4">

				<p>
				Nama : 
				<br>
				<input name="g_nama" id="g_nama" type="text" size="15" class="btn btn-default" value="'.$o_ibu_nama.'">
				</p>
				
				<p>
				NIK : 
				<br>
				<input name="g_nik" id="g_nik" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx2[5]).'">
				</p>
				
				<p>
				Tahun Lahir : 
				<br>
				<input name="g_tahun_lahir" id="g_tahun_lahir" type="text" size="4" class="btn btn-warning" value="'.balikin($rowx2[6]).'">
				</p>
				

				
				<p>
				Pendidikan : 
				<br>
				<select name="g_pendidikan" id="g_pendidikan" class="btn btn-warning">
					<option value="'.balikin($rowx2[7]).'" selected>'.balikin($rowx2[7]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
		
			
				</div>
				<div class="col-4">
				
				<p>
				Pekerjaan : 
				<br>
				<select name="g_pekerjaan" id="g_pekerjaan" class="btn btn-warning">
					<option value="'.$o_ibu_kerja.'" selected>'.$o_ibu_kerja.'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pekerjaan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				
				</p>
				
				<p>
				Penghasilan Bulanan : 
				<br>

				<select name="g_penghasilan" id="g_penghasilan" class="btn btn-warning">
					<option value="'.balikin($rowx2[8]).'" selected>'.balikin($rowx2[8]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_penghasilan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				<p>
				Berkebutuhan Khusus : 
				<br>

				<select name="g_kebutuhan" id="g_kebutuhan" class="btn btn-warning">
					<option value="'.balikin($rowx2[9]).'" selected>'.balikin($rowx2[9]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_kebutuhan ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				</div>
			</div>
		
			<hr>
			<div id="hasil_g"></div>
			<p>
			<input name="btnSMPG" id="btnSMPG" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>
		
        
		</div>
	
	</div>
</form>







<form name="formx_h" id="formx_h">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA WALI</h3>
        </div>
        <div class="box-body">';
        
			//detail
			$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_wali ".
								"WHERE siswa_kd = '$kdx'");
			$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		

			echo '<div class="row">
			    <div class="col-4">
				<p>
				Nama : 
				<br>
				<input name="h_nama" id="h_nama" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx3[4]).'">
				</p>
				
				<p>
				NIK : 
				<br>
				<input name="h_nik" id="h_nik" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx3[5]).'">
				</p>
				
				<p>
				Tahun Lahir : 
				<br>
				<input name="h_tahun_lahir" id="h_tahun_lahir" type="text" size="4" class="btn btn-warning" value="'.balikin($rowx3[6]).'">
				</p>
				
				<p>
				Pendidikan : 
				<br>
				<select name="h_pendidikan" id="h_pendidikan" class="btn btn-warning">
					<option value="'.balikin($rowx3[7]).'" selected>'.balikin($rowx3[7]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pendidikan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
		
			
				</div>
				<div class="col-4">
				
				<p>
				Pekerjaan : 
				<br>
				<select name="h_pekerjaan" id="h_pekerjaan" class="btn btn-warning">
					<option value="'.balikin($rowx3[8]).'" selected>'.balikin($rowx3[8]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_pekerjaan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				
				</p>
				
				<p>
				Penghasilan Bulanan : 
				<br>

				<select name="h_penghasilan" id="h_penghasilan" class="btn btn-warning">
					<option  value="'.balikin($rowx3[9]).'" selected>'.balikin($rowx3[9]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_penghasilan ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>
				
				<p>
				Berkebutuhan Khusus : 
				<br>

				<select name="h_kebutuhan" id="h_kebutuhan" class="btn btn-warning">
					<option value="'.balikin($rowx3[10]).'" selected>'.balikin($rowx3[10]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_kebutuhan ".
											"ORDER BY nama ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				
				</p>

				
				</div>
			</div>
			
			<hr>
			<div id="hasil_h"></div>
			<p>
			<input name="btnSMPH" id="btnSMPH" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>
			
				   
		</div>
	
	</div>

</form>






<form name="formx_i" id="formx_i">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">KONTAK</h3>
        </div>
        <div class="box-body">';
        
			//detail
			$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa ".
								"WHERE kd = '$kdx'");
			$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		

			echo '<div class="row">
			    <div class="col-4">
        
				<p>
				Nomor Telepon Rumah : 
				<br>
				<input name="i_telp" id="i_telp" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx3[37]).'">
				</p>
				
				<p>
				Nomor HP : 
				<br>
				<input name="i_hp" id="i_hp" type="text" size="15" class="btn btn-warning" value="'.balikin($rowx3[38]).'">
				</p>
				
				<p>
				E-Mail : 
				<br>
				<input name="i_email" id="i_email" type="text" size="20" class="btn btn-warning" value="'.balikin($rowx3[39]).'">
				</p>
				
				</div>
			</div>
			
			<hr>
			<div id="hasil_i"></div>
			<p>
			<input name="btnSMPI" id="btnSMPI" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>
			
        
		</div>
	
	</div>
</form>













<form name="formx_j" id="formx_j">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA PRIODIK</h3>
        </div>
        <div class="box-body">';
        
			//detail
			$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_priodik ".
								"WHERE siswa_kd = '$kdx'");
			$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		

			echo '<div class="row">
			    <div class="col-4">
        
				<p>
				Tinggi Badan : 
				<br>
				<input name="j_tb" id="j_tb" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx3[4]).'"> Cm
				</p>
				
				<p>
				Berat Badan : 
				<br>
				<input name="j_bb" id="j_bb" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx3[5]).'"> Kg
				</p>
				
				<p>
				Jarak Tempat Tinggal ke Sekolah : 
				<br>

				<select name="j_jarak" id="j_jarak" class="btn btn-warning">
					<option value="'.balikin($rowx3[6]).'"selected>'.balikin($rowx3[6]).'</option>
					<option value="Kurang dari 1 Km">Kurang dari 1 Km</option>
					<option value="Lebih dari 1 Km">Lebih dari 1 Km</option>
				</select>
				</p>
				
				</div>
				
				<div class="col-4">
				
				<p>
				Sebutkan dalam Km : 
				<br>
				<input name="j_jarak2" id="j_jarak2" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx3[7]).'"> Km
				</p>
				
				<p>
				Waktu Tempuh ke Sekolah : 
				<br>
				<input name="j_jam" id="j_jam" type="text" size="2" class="btn btn-warning" value="'.balikin($rowx3[8]).'">Jam, 
				<input name="j_menit" id="j_menit" type="text" size="2" class="btn btn-warning" value="'.balikin($rowx3[9]).'">Menit 
				</p>
				
				
				<p>
				Jumlah Saudara Kandung : 
				<br>
				<input name="j_jml_saudara" id="j_jml_saudara" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx3[10]).'"> Km
				</p>
				
				
				
				</div>
			</div>
			
			<hr>
			<div id="hasil_j"></div>
			<p>
			<input name="btnSMPJ" id="btnSMPJ" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>


		</div>
	
	</div>
</form>









<form name="formx_k" id="formx_k">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA PRESTASI</h3>
        </div>
        <div class="box-body">
			<div class="row">
			    <div class="col-12">
        
		
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>NO</th>
				        <th>JENIS</th>
				        <th>TINGKAT</th>
				        <th>NAMA PRESTASI</th>
				        <th>TAHUN</th>
				        <th>PENYELENGGARA</th>
				        <th>PERINGKAT</th>
				      </tr>
				    </thead>
				    <tbody>';
				    
					
					//loop
					for ($k=1;$k<=3;$k++)
						{
						//detail
						$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_prestasi ".
											"WHERE siswa_kd = '$kdx' ".
											"AND no = '$k'");
						$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		
							
					      echo '<tr>
					        <td>'.$k.'</td>
					        <td>
					        
					        
							<select name="k_jenis_'.$k.'" id="k_jenis_'.$k.'" class="btn btn-warning">
								<option value="'.balikin($rowx3[5]).'"selected>'.balikin($rowx3[5]).'</option>';
								
								//list
								$qyuk = mysqli_query($koneksi, "SELECT * FROM m_jenis ".
														"ORDER BY round(no) ASC");
								$ryuk = mysqli_fetch_assoc($qyuk);
								
								do
									{
									//nilai
									$yuk_nama = cegah($ryuk['nama']);
									$yuk_nama2 = balikin($ryuk['nama']);
									
									echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
									}
								while ($ryuk = mysqli_fetch_assoc($qyuk));
			
							
							echo '</select>
					        </td>
					        <td>
							<select name="k_tingkat_'.$k.'" id="k_tingkat_'.$k.'" class="btn btn-warning">
								<option value="'.balikin($rowx3[6]).'" selected>'.balikin($rowx3[6]).'</option>';
								
								//list
								$qyuk = mysqli_query($koneksi, "SELECT * FROM m_tingkat ".
														"ORDER BY round(no) ASC");
								$ryuk = mysqli_fetch_assoc($qyuk);
								
								do
									{
									//nilai
									$yuk_nama = cegah($ryuk['nama']);
									$yuk_nama2 = balikin($ryuk['nama']);
									
									echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
									}
								while ($ryuk = mysqli_fetch_assoc($qyuk));
			
							
							echo '</select>
							
							
					        </td>
					        <td><input name="k_nama_'.$k.'" id="k_nama_'.$k.'" type="text" size="10" class="btn btn-warning" value="'.balikin($rowx3[7]).'"></td>
					        <td><input name="k_tahun_'.$k.'" id="k_tahun_'.$k.'" type="text" size="4" class="btn btn-warning" value="'.balikin($rowx3[8]).'"></td>
					        <td><input name="k_penyelenggara_'.$k.'" id="k_penyelenggara_'.$k.'" type="text" size="10" class="btn btn-warning" value="'.balikin($rowx3[9]).'"></td>
					        <td><input name="k_peringkat_'.$k.'" id="k_peringkat_'.$k.'" type="text" size="5" class="btn btn-warning" value="'.balikin($rowx3[10]).'"></td>
					      </tr>';
					    }

				    echo '</tbody>
				</table>
				  

				
				</div>
			</div>
			
			<hr>
			<div id="hasil_k"></div>
			<p>
			<input name="btnSMPK" id="btnSMPK" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>


		</div>
	
	</div>
</form>







<form name="formx_l" id="formx_l">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA BEASISWA</h3>
        </div>
        <div class="box-body">

			<div class="row">
			    <div class="col-12">
        
		
				<table class="table table-hover">
				    <thead>
				      <tr>
				        <th>NO</th>
				        <th>JENIS</th>
				        <th>KETERANGAN</th>
				        <th>TAHUN MULAI</th>
				        <th>TAHUN SELESAI</th>
				      </tr>
				    </thead>
				    <tbody>';
				    
					
					//loop
					for ($k=1;$k<=3;$k++)
						{
						//detail
						$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_beasiswa ".
											"WHERE siswa_kd = '$kdx' ".
											"AND no = '$k'");
						$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		
					      echo '<tr>
					        <td>'.$k.'</td>
					        <td>

							<select name="l_jenis_'.$k.'" id="l_jenis_'.$k.'" class="btn btn-warning">
								<option value="'.balikin($rowx3[5]).'" selected>'.balikin($rowx3[5]).'</option>';
								
								//list
								$qyuk = mysqli_query($koneksi, "SELECT * FROM m_jenis2 ".
														"ORDER BY round(no) ASC");
								$ryuk = mysqli_fetch_assoc($qyuk);
								
								do
									{
									//nilai
									$yuk_nama = cegah($ryuk['nama']);
									$yuk_nama2 = balikin($ryuk['nama']);
									
									echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
									}
								while ($ryuk = mysqli_fetch_assoc($qyuk));
			
							
							echo '</select>
							
					        
					        </td>
					        <td><input name="l_ket_'.$k.'" id="l_ket_'.$k.'" type="text" size="30" class="btn btn-warning" value="'.balikin($rowx3[6]).'"></td>
					        <td><input name="l_mulai_'.$k.'" id="l_mulai_'.$k.'" type="text" size="4" class="btn btn-warning" value="'.balikin($rowx3[7]).'"></td>
					        <td><input name="l_selesai_'.$k.'" id="l_selesai_'.$k.'" type="text" size="4" class="btn btn-warning" value="'.balikin($rowx3[8]).'"></td>
					      </tr>';
					    }

				    echo '</tbody>
				</table>
				  

				
				</div>
			</div>
			
			<hr>
			<div id="hasil_l"></div>
			<p>
			<input name="btnSMPL" id="btnSMPL" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>

        
		</div>
	
	</div>
</form>








<form name="formx_m" id="formx_m">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">DATA BERKAS DOKUMEN</h3>
        </div>
        <div class="box-body">';
			//detail
			$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa ".
								"WHERE kd = '$kdx'");
			$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		

			echo '<div class="row">
			    <div class="col-4">
        
				<p>
				No. Seri Ijazah : 
				<br>
				<input name="m_ijazah" id="m_ijazah" type="text" size="20" class="btn btn-warning" value="'.balikin($rowx3[40]).'">
				</p>
				
				<p>
				No. Seri SKHUN : 
				<br>
				<input name="m_skhun" id="m_skhun" type="text" size="20" class="btn btn-warning" value="'.balikin($rowx3[41]).'">
				</p>
				
				</div>
			</div>
			
			<hr>
			<div id="hasil_m"></div>
			<p>
			<input name="btnSMPM" id="btnSMPM" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>


        
		</div>
	
	</div>
</form>








<form name="formx_n" id="formx_n">
	<div class="box box-info">
        <div class="box-header">
          <i class="fa fa-pencil"></i>

          <h3 class="box-title">JIKA MENGUNDURKAN DIRI</h3>
        </div>
        <div class="box-body">';
			//detail
			$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa ".
								"WHERE kd = '$kdx'");
			$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);
		

			echo '<div class="row">
			    <div class="col-4">
        
				<p>
				Karena : 
				<br>

				<select name="n_karena" id="n_karena" class="btn btn-warning">
					<option value="'.balikin($rowx3[42]).'" selected>'.balikin($rowx3[42]).'</option>';
					
					//list
					$qyuk = mysqli_query($koneksi, "SELECT * FROM m_karena ".
											"ORDER BY round(no) ASC");
					$ryuk = mysqli_fetch_assoc($qyuk);
					
					do
						{
						//nilai
						$yuk_nama = cegah($ryuk['nama']);
						$yuk_nama2 = balikin($ryuk['nama']);
						
						echo '<option value="'.$yuk_nama.'">'.$yuk_nama2.'</option>';
						}
					while ($ryuk = mysqli_fetch_assoc($qyuk));

				
				echo '</select>
				</p>

				

				
				<p>
				Per Tanggal : 
				<br>
				<input name="n_tanggal" id="n_tanggal" type="text" size="10" class="btn btn-warning" value="'.balikin($rowx3[43]).'">
				</p>
		
				<p>
				Alasan : 
				<br>
				<input name="n_alasan" id="n_alasan" type="text" size="30" class="btn btn-warning" value="'.balikin($rowx3[44]).'">
				</p>
				
				</div>
			</div>
			
			<hr>
			<div id="hasil_n"></div>
			<p>
			<input name="btnSMPN" id="btnSMPN" type="submit" value="SIMPAN >" class="btn btn-danger">
			</p>

        
		</div>
	
	</div>
</form>




</div>
	
</div>';




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
