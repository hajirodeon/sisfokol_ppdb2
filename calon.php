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
$judul = "Calon : $nama6_session";
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
	xloc($filenya);
	exit();
	}



//jika ganti password
if ($_POST['btnPASS'])
	{
	//nilai
	$ke = "$filenya?s=pass";
	xloc($ke);
	exit();
	}



//jika lihat profil
if ($_POST['btnPROFIL'])
	{
	//nilai
	$ke = "$filenya?s=profil";
	xloc($ke);
	exit();
	}





//jika lihat profil
if ($_POST['btnPROFIL'])
	{
	//nilai
	$ke = "$filenya?s=profil";
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




//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$passlama = md5(cegah($_POST["passlama"]));
	$passbaru = md5(cegah($_POST["passbaru"]));
	$passbaru2 = md5(cegah($_POST["passbaru2"]));
	$ke = "$filenya?s=pass";
		
		
	//cek
	//nek null
	if ((empty($passlama)) OR (empty($passbaru)) OR (empty($passbaru2)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$ke);
		exit();
		}

	//nek pass baru gak sama
	else if ($passbaru != $passbaru2)
		{
		//re-direct
		$pesan = "Password Baru Tidak Sama. Harap Diulangi...!!";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
							"WHERE kd = '$kd6_session' ".
							"AND usernamex = '$username6_session' ".
							"AND passwordx = '$passlama'");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);

		//cek
		if ($total != 0)
			{
			//perintah SQL
			mysqli_query($koneksi, "UPDATE psb_calon SET passwordx = '$passbaru' ".
							"WHERE kd = '$kd6_session' ".
							"AND usernamex = '$username6_session'");


			//auto-kembali
			$pesan = "PASSWORD BERHASIL DIGANTI.";
			pekem($pesan, $filenya);
			exit();
			}
		else
			{
			//re-direct
			$pesan = "PASSWORD LAMA TIDAK COCOK. HARAP DIULANGI...!!!";
			pekem($pesan, $ke);
			exit();
			}
		}
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




//daftar daya tampung
echo '<h4 class="post-title">'.$judul.'</h4>
<hr>';


echo '<form action="'.$filenya.'" method="post" name="formx2" id="formx2" enctype="multipart/form-data">
	
<p>
<input name="btnHOME" id="btnHOME" type="submit" class="btn btn-primary" value="BERANDA">
<input name="btnPASS" id="btnPASS" type="submit" class="btn btn-warning" value="GANTI PASSWORD">
<input name="btnPROFIL" id="btnPROFIL" type="submit" class="btn btn-success" value="PROFIL DIRI">

<input name="btnKELUAR" id="btnKELUAR" type="submit" class="btn btn-danger" value="KELUAR >>">
</p>
<hr>';

//jika null
if (empty($s))
	{
	echo '<div class="row">
        <div class="col-md-3">';
		?>
	
		<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-money"></i>

              <h3 class="box-title">VERIFIKASI</h3>
            </div>
            <div class="box-body">
            	<?php
				//jika belum bayar
				if ($i_bayar_tgl == "0000-00-00")
					{
					echo "<p>
					<font color=red>BELUM BAYAR</font>
					</p>";
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
						[<font color="red">BELUM VERIFIKASI ADMIN</font>].
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
						TELAH VERIFIKASI : 
						<br>
						<b><font color="green">'.$i_aktif_postdate.'</font></b>
						</p>';
						}
						
					}
				?>
				
				<hr>
				<a href='calon_du.php?ckd=<?php echo $kd;?>' class='btn btn-block btn-danger'>ENTRI FORM SELENGKAPNYA >></a>

    	        </div>
            
			</div>
		
		</div>
		

		
		<div class="col-md-5">
		

		<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-pencil"></i>

              <h3 class="box-title">KARTU UJIAN</h3>
            </div>
            <div class="box-body">
            	
            	<h3>KARTU UJIAN PPDB <?php echo $e_dt_tahun1;?>/<?php echo $e_dt_tahun2;?></h3>
            	
				<h3><?php echo $sek_nama;?></h3>

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
					<a href="calon_prt.php?ckd=<?php echo $kd;?>" class="btn btn-block btn-danger" target="_blank">CETAK KARTU UJIAN</a>
				</p>				



    	        </div>
    	        
			</div>

		</div>
		
		
		<div class="col-md-4">
			
		<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-pencil"></i>

              <h3 class="box-title">NILAI UJIAN</h3>
            </div>
            <div class="box-body">


				<h3><?php echo $i_nilai;?></h3>
				<i>Postdate : <?php echo $i_nilai_postdate;?></i>
				<hr>
			
	        </div>
	        
		</div>

	</div>
	
</div>


<?php
	}

//jika pass
else if ($s == "pass")
	{
	echo '<div class="row">
        <div class="col-md-5">';
		?>
	
		<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-tool"></i>

              <h3 class="box-title">GANTI PASSWORD</h3>
            </div>
            <div class="box-body">

				
				<p>
				Password Lama : 
				<br>
				<input name="passlama" type="password" size="15" class="btn btn-success">
				</p>
				
				<p>Password Baru : <br>
				<input name="passbaru" type="password" size="15" class="btn btn-success">
				</p>
				<p>RE-Password Baru : <br>
				<input name="passbaru2" type="password" size="15" class="btn btn-success">
				</p>
				
				
				<p>
				<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
				<input name="btnBTL" type="reset" value="BATAL" class="btn btn-info">
				</p>



	        </div>
            
		</div>
		
	</div>
		

	
	<div class="col-md-7">
	

	</div>


	
</div>

	<?php	
	}


//jika profil
else if ($s == "profil")
	{
	?>
	<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-tool"></i>

              <h3 class="box-title">PROFIL DIRI</h3>
            </div>
            <div class="box-body">

				
				<div class="row">
				
				<div class="col-md-3">
			
				<img src="<?php echo $nil_foto1;?>" width="100%" class="thumbnail" />
				
				<br>
				<br>
				
					
					<a href='calon_du.php?ckd=<?php echo $kd;?>' class='btn btn-block btn-danger'>ENTRI FORM SELENGKAPNYA >></a>

	
	
				</div>
				
				<div class="col-md-3">
				
				<p>
				Sekolah Asal :
				<br>
				<b>
					<?php echo $e_sekolah_asal;?>
				</b>
				</p>
				
				<?php
				//selain TK
				if ($kodenya <> 'tk')
					{
					echo '<p>
					NISN :
					<br>
					<b>
						'.$e_nisn.'
					</b>
					</p>';
					}
				?>
				
				
				<p>
				Nama :
				<br>
				<b>
					<?php echo $e_nama;?>
				</b>
				</p>
				
				<p>
				Tempat, Tanggal Lahir :
				<br>
				
				<b>
					<?php echo $e_tmp_lahir;?>, <?php echo $e_tgl_lahir;?>
				</b>
				</p> 

				
				</div>
				
				<div class="col-md-3">
				

				
				<p>
				Kelamin :
				<br>
				<b>
					<?php echo $e_kelamin;?>
				</b>
				</p>
				
				<p>
				Agama :
				<br>
				<b>
					<?php echo $e_agama;?>
				</b>
				</p>
				
				<p>
				Status Anak :
				<br>
				<b>
					<?php echo $e_status_anak;?>
				</b>
				</p>
				
				<p>
				Anak ke-:
				<br>
				<b>
					<?php echo $e_anak_ke;?>
				</b>
				</p>
				


				
				
				</div>



				<div class="col-md-3">
				
				<p>
				Alamat :
				<br>
				<b>
					<?php echo $e_alamat;?>
				</b>
				</p>
				
				<p>
				Telepon :
				<br>
				<b>
					<?php echo $e_telp;?>
				</b>
				</p>
				
				<p>
				E-Mail :
				<br>
				<b>
					<?php echo $e_email;?>
				</b>
				</p>
				
				
				</div>



				
			</div>
		</div>
				




	
		<div class="box box-info">
            <div class="box-header">
              <i class="fa fa-tool"></i>

              <h3 class="box-title">ORANG TUA</h3>
            </div>
            <div class="box-body">

				
				<div class="row">
				
					<div class="col-md-3">
					
					<p>
					Ayah, Nama :
					<br>
					<b>
						<?php echo $o_ayah_nama;?>
					</b>
					</p>
					
					<p>
					Ayah, Pekerjaan :
					<br>
					<b>
						<?php echo $o_ayah_kerja;?>
					</b>
					</p>
					
					</div>
					
					<div class="col-md-3">
					
					<p>
					Ibu, Nama :
					<br>
					<b>
						<?php echo $o_ibu_nama;?>
					</b>
					</p>
					
					<p>
					Ibu, Pekerjaan :
					<br>
					<b>
						<?php echo $o_ibu_kerja;?>
					</b>
					</p>
					</div>
					
					<div class="col-md-3">
					
					<p>
					Alamat :
					<br>
					<b>
						<?php echo $o_alamat;?>
					</b>
					</p>
					
					<p>
					Telepon :
					<br>
					<b>
						<?php echo $o_telp;?>
					</b>
					</p>
							
					
					</div>
				
				</div>
				
				


	        </div>


<?php
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
