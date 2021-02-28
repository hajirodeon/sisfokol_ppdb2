<?php
session_start();


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/kartu_ujian.php");



nocache;

//nilai
$kd = nosql($_REQUEST['kd']);
$kdx = nosql($_REQUEST['kd']);






//start class
$pdf=new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle($judul);
$pdf->SetAuthor($author);
$pdf->SetSubject($description);
$pdf->SetKeywords($keywords);







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
$e_sekolah2 = cegah($e_sekolah);
$e_tapel_nama = balikin($rowx['tapel_nama']);
$e_jalur = balikin($rowx['c_jalur']);
$e_noreg = balikin($rowx['noreg']);
$e_nisn = balikin($rowx['c_nisn']);
$e_nama = balikin($rowx['c_nama']);
$e_passx2 = balikin($rowx['passwordx2']);
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

$i_bayar_tgl = balikin($rowx['reg_bayar_tgl']);
$i_bayar = balikin($rowx['reg_bayar']);
$i_bayar_filex = balikin($rowx['reg_bayar_filex']);
$i_aktif_postdate = balikin($rowx['aktif_postdate']);

$i_ujian_server = balikin($rowx['ruangan_kode']);
$i_ujian_ruang = balikin($rowx['ruangan_nama']);
$i_ruangan = "$i_ujian_server/$i_ujian_ruang";

$i_nilai = balikin($rowx['nilai']);
$i_nilai_postdate = balikin($rowx['nilai_postdate']);


$i_bayar2 = xduit2($i_bayar);

$nil_foto1 = "$sumber/filebox/calon/$kd/$kd-calon.jpg";
$nil_foto2 = "$sumber/filebox/calon/$kd/$kd-bayar.jpg";







//image
$pdf-> Image('../../img/logo.jpg',11,10,20); //logo
$pdf-> Image($nil_foto1,170,35,25); //calon


$baris_tebal = 5;
$pdf->SetY(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(190,$baris_tebal,'PPDB '.$e_dt_tahun1.'/'.$e_dt_tahun2.'',0,0,'C');
$pdf->SetY(10+($baris_tebal));
$pdf->Cell(190,$baris_tebal,$sek_nama,0,0,'C');
$pdf->SetY(10+(2 * $baris_tebal));
$pdf->Cell(190,0.1,'',1,1,'C');





//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
$pdf->SetY(30);


ob_start();




//list
$qku = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 DESC");
$rku = mysqli_fetch_assoc($qku);
$e_tapelkd = nosql($rku['kd']);
$e_dt_tahun1 = nosql($rku['tahun1']);
$e_dt_tahun2 = nosql($rku['tahun2']);
$e_dt_tk = nosql($rku['dayatampung']);




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







echo '<b>DATA DIRI</b>';

//detail
$qx2 = mysqli_query($koneksi, "SELECT * FROM siswa ".
					"WHERE kd = '$kdx'");
$rowx2 = mysqli_fetch_assoc($qx2, MYSQL_NUM);

echo '<p>
	Nama Lengkap : 
	<br>
	'.$e_nama.'
	</p>
				

	<p>
	Jenis Kelamin : 
	<br>
	
	'.$e_kelamin.'
	</p>
				
	<p>
	NISN : 
	<br>
	
	'.$e_nisn.'
	</p>
				
	<p>
	NIK / No.KITAS untuk WNA : 
	<br>
	'.balikin($rowx2[4]).'
	</p>
				
	<p>
	Tempat Lahir : 
	<br>
	'.balikin($rowx2[5]).'
	</p>
				
	<p>
	Tanggal Lahir : 
	<br>
	'.balikin($rowx2[6]).'
	</p>
				
	<p>
	No. Registrasi Akta Kelahiran : 
	<br>
	'.balikin($rowx2[7]).'
	</p>
				
	<p>
	Agama / Kepercayaan : 
	<br>
	'.balikin($rowx2[8]).'
	</p>
				
	<p>
	Kewarganegaraan : 
	<br>
	'.balikin($rowx2[9]).'
	</p>
				
	<p>
	Kebutuhan Khusus : 
	<br>
	
	'.balikin($rowx2[10]).'
	</p>
				
				
	<p>
	Alamat Jalan : 
	<br>
	'.balikin($rowx2[11]).'
	</p>
				
	<p>
	RT : 
	<br>
	'.balikin($rowx2[12]).'
	</p>
				
	<p>
	RW : 
	<br>
	'.balikin($rowx2[13]).'
	</p>
				
	
	<p>
	Dusun : 
	<br>
	'.balikin($rowx2[14]).'
	</p>
	
	<p>
	Kelurahan : 
	<br>
	'.balikin($rowx2[15]).'
	</p>
				
				
	<p>
	Kecamatan : 
	<br>
	'.balikin($rowx2[16]).'
	</p>

				
	<p>
	Kabupaten/Kota : 
	<br>
	'.balikin($rowx2[17]).'
	</p>
								
	<p>
	Kode Pos : 
	<br>
	'.balikin($rowx2[18]).'
	</p>
				
	<p>
	Lintang : 
	<br>
	'.balikin($rowx2[19]).'
	</p>
				
	<p>
	Bujur : 
	<br>
	'.balikin($rowx2[20]).'
	</p>

							
	<p>
	Tempat Tinggal : 
	<br>

	'.balikin($rowx2[21]).'	
	</p>
				
	<p>
	Moda Transportasi : 
	<br>
	
	'.balikin($rowx2[22]).'
	</p>
				
	<p>
	Nomor KKS : 
	<br>
	'.balikin($rowx2[23]).'
	</p>
			
	<p>
	Anak Ke- : 
	<br>
	
	'.$e_anak_ke.'
	</p>



	<p>
	Penerima KPS/PKH : 
	<br>
	'.balikin($rowx2[25]).'
	</p>
				
	<p>
	Nomor KPS/PKH, jika menerima : 
	<br>
	'.balikin($rowx2[26]).'
	</p>
				
	<p>
	Usulan dari Sekolah (Layak PIP) : 
	<br>

	'.balikin($rowx2[27]).'
	</p>
				
	<p>
	Penerima KIP (Kartu Indonesia Pintar) : 
	<br>
	'.balikin($rowx2[28]).'
	</p>
				
	<p>
	Nomor KIP : 
	<br>
	'.balikin($rowx2[29]).'
	</p>
				
	<p>
	Nama Tertera di KIP : 
	<br>
	'.balikin($rowx2[30]).'
	</p>
				
	<p>
	Terima Fisik Kartu KIP : 
	<br>
	'.balikin($rowx2[31]).'	
	</p>

	<p>
	Alasan Layak PIP : 
	<br>
	'.balikin($rowx2[32]).'
	</p>


	
	<p>
	Bank : 
	<br>
	'.balikin($rowx2[33]).'
	</p>
			
	<p>
	Norek Bank : 
	<br>
	'.balikin($rowx2[34]).'
	</p>
				
	<p>
	Atas Nama : 
	<br>
	'.balikin($rowx2[35]).'
	</p>



<br>
<br>
<hr>
<br>
<b>DATA AYAH KANDUNG</b>';



//detail
$qx2 = mysqli_query($koneksi, "SELECT * FROM siswa_ayah ".
					"WHERE siswa_kd = '$kdx'");
$rowx2 = mysqli_fetch_assoc($qx2, MYSQL_NUM);


echo '<p>
	Nama : 
	<br>
	'.$o_ayah_nama.'
	</p>
	
	<p>
	NIK : 
	<br>
	'.balikin($rowx2[5]).'
	</p>
				
	<p>
	Tahun Lahir : 
	<br>
	'.balikin($rowx2[6]).'
	</p>
				
	<p>
	Pendidikan : 
	<br>
	'.balikin($rowx2[8]).'
	</p>
		
	<p>
	Pekerjaan : 
	<br>
	'.$o_ayah_kerja.'
	</p>
				
	<p>
	Penghasilan Bulanan : 
	<br>
	'.balikin($rowx2[10]).'
	</p>
				
	<p>
	Berkebutuhan Khusus : 
	<br>
	'.balikin($rowx2[11]).'
	</p>


<br>
<br>
<hr>
<br>
<b>DATA IBU KANDUNG</b>';


//detail
$qx2 = mysqli_query($koneksi, "SELECT * FROM siswa_ibu ".
					"WHERE siswa_kd = '$kdx'");
$rowx2 = mysqli_fetch_assoc($qx2, MYSQL_NUM);



echo '<p>
	Nama : 
	<br>
	'.$o_ibu_nama.'
	</p>
				
	<p>
	NIK : 
	<br>
	'.balikin($rowx2[5]).'
	</p>
				
	<p>
	Tahun Lahir : 
	<br>
	'.balikin($rowx2[6]).'
	</p>
				

	
	<p>
	Pendidikan : 
	<br>
	'.balikin($rowx2[7]).'	
	</p>
		
	
	<p>
	Pekerjaan : 
	<br>
	'.$o_ibu_kerja.'
	</p>
				
	<p>
	Penghasilan Bulanan : 
	<br>
	'.balikin($rowx2[8]).'
	</p>
				
	<p>
	Berkebutuhan Khusus : 
	<br>
	'.balikin($rowx2[9]).'
	</p>



<br>
<br>
<hr>
<br>
<b>DATA WALI</b>';
        
//detail
$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_wali ".
					"WHERE siswa_kd = '$kdx'");
$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);


echo '<p>
	Nama : 
	<br>
	'.balikin($rowx3[4]).'
	</p>
	
	<p>
	NIK : 
	<br>
	'.balikin($rowx3[5]).'
	</p>
			
	<p>
	Tahun Lahir : 
	<br>
	'.balikin($rowx3[6]).'
	</p>
				
	<p>
	Pendidikan : 
	<br>
	'.balikin($rowx3[7]).'
	</p>
		
	

	<p>
	Pekerjaan : 
	<br>
	'.balikin($rowx3[8]).'	
	</p>
				
	<p>
	Penghasilan Bulanan : 
	<br>
	'.balikin($rowx3[9]).'
	</p>
				
	<p>
	Berkebutuhan Khusus : 
	<br>

	'.balikin($rowx3[10]).'
	</p>



<br>
<br>
<hr>
<br>
<b>KONTAK</b>';

//detail
$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa ".
				"WHERE kd = '$kdx'");
$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);


echo '<p>
Nomor Telepon Rumah : 
<br>
'.balikin($rowx3[37]).'
</p>

<p>
Nomor HP : 
<br>
'.balikin($rowx3[38]).'
</p>
				
<p>
E-Mail : 
<br>
'.balikin($rowx3[39]).'
</p>


<br>
<br>
<hr>
<br>
<b>DATA PRIODIK</b>';

//detail
$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_priodik ".
					"WHERE siswa_kd = '$kdx'");
$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);


echo '<p>
Tinggi Badan : 
<br>
'.balikin($rowx3[4]).' Cm
</p>
				
<p>
Berat Badan : 
<br>
'.balikin($rowx3[5]).' Kg
</p>

<p>
Jarak Tempat Tinggal ke Sekolah : 
<br>

'.balikin($rowx3[6]).'
</p>
				

<p>
Sebutkan dalam Km : 
<br>
'.balikin($rowx3[7]).' Km
</p>

<p>
Waktu Tempuh ke Sekolah : 
<br>
'.balikin($rowx3[8]).'Jam, '.balikin($rowx3[9]).' Menit 
</p>
				
				
<p>
Jumlah Saudara Kandung : 
<br>
'.balikin($rowx3[10]).' 
</p>


<br>
<br>
<hr>
<br>';
				
//isi
$i_artikel_detail = ob_get_contents();
ob_end_clean();




$pdf->WriteHTML($i_artikel_detail);





$nilY = $pdf->GetY();
$pdf->SetY($nilY + 2);
$pdf->SetX(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(35,5,'DATA PRESTASI',0,0,'L');
$pdf->Ln();


$pdf->SetX(10);
$pdf->SetFont('Times','B',8);
$pdf->SetFillColor(233,233,233);
$pdf->Cell(7,5,'NO',1,0,'L',1);
$pdf->Cell(15,5,'JENIS',1,0,'L',1);
$pdf->Cell(65,5,'NAMA PRESTASI',1,0,'L',1);
$pdf->Cell(15,5,'TAHUN',1,0,'L',1);
$pdf->Cell(65,5,'PENYELENGGARA',1,0,'L',1);
$pdf->Cell(20,5,'PERINGKAT',1,0,'L',1);

$pdf->Ln();


//loop
for ($k=1;$k<=3;$k++)
	{
	//detail
	$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_prestasi ".
						"WHERE siswa_kd = '$kdx' ".
						"AND no = '$k'");
	$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);

		  
	$pdf->Cell(7,5,$k,1,0,'L');
	$pdf->Cell(15,5,balikin($rowx3[5]),1,0,'L');
	$pdf->Cell(65,5,balikin($rowx3[6]),1,0,'L');
	$pdf->Cell(15,5,balikin($rowx3[7]),1,0,'L');
	$pdf->Cell(65,5,balikin($rowx3[8]),1,0,'L');
	$pdf->Cell(20,5,balikin($rowx3[9]),1,0,'L');
	
	$pdf->Ln();
		  
    }






//batas
$pdf->Ln();
$pdf->Cell(190,0.1,'',1,0,'L');
$pdf->Ln();




$nilY = $pdf->GetY();
$pdf->SetY($nilY + 10);
$pdf->SetX(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(35,5,'DATA BEASISWA',0,0,'L');
$pdf->Ln();


$pdf->SetX(10);
$pdf->SetFont('Times','B',8);
$pdf->SetFillColor(233,233,233);
$pdf->Cell(7,5,'NO',1,0,'L',1);
$pdf->Cell(30,5,'JENIS',1,0,'L',1);
$pdf->Cell(70,5,'KETERANGAN',1,0,'L',1);
$pdf->Cell(30,5,'TAHUN MULAI',1,0,'L',1);
$pdf->Cell(30,5,'TAHUN SELESAI',1,0,'L',1);

$pdf->Ln();

					
//loop
for ($k=1;$k<=3;$k++)
	{
	//detail
	$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa_beasiswa ".
						"WHERE siswa_kd = '$kdx' ".
						"AND no = '$k'");
	$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);

  	$pdf->Cell(7,5,$k,1,0,'L');
	$pdf->Cell(30,5,balikin($rowx3[5]),1,0,'L');
	$pdf->Cell(70,5,balikin($rowx3[6]),1,0,'L');
	$pdf->Cell(30,5,balikin($rowx3[7]),1,0,'L');
	$pdf->Cell(30,5,balikin($rowx3[8]),1,0,'L');
	
	$pdf->Ln();
		  
    }






$pdf->SetFont('Times','',10);




ob_start();

echo '<br>
<br>
<hr>
<br>
<b>DATA BERKAS DOKUMEN</b>';


//detail
$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa ".
					"WHERE kd = '$kdx'");
$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);


echo '<p>
	No. Seri Ijazah : 
	<br>
	'.balikin($rowx3[40]).'
	</p>
	
	<p>
	No. Seri SKHUN : 
	<br>
	'.balikin($rowx3[41]).'
	</p>


<br>
<br>
<hr>
<br>


<b>JIKA MENGUNDURKAN DIRI</b>
<br>';
//detail
$qx3 = mysqli_query($koneksi, "SELECT * FROM siswa ".
					"WHERE kd = '$kdx'");
$rowx3 = mysqli_fetch_assoc($qx3, MYSQL_NUM);


echo '<p>
	Karena : 
	<br>
	'.balikin($rowx3[42]).'
	</p>
	
	<p>
	Per Tanggal : 
	<br>
	'.balikin($rowx3[43]).'
	</p>

	<p>
	Alasan : 
	<br>
	'.balikin($rowx3[44]).'
	</p>';
	
	
	
//isi
$i_artikel_detail2 = ob_get_contents();
ob_end_clean();







$pdf->WriteHTML($i_artikel_detail2);











//output-kan ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Output("lengkap-$e_noreg-$e_nama.pdf",I);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//diskonek
exit();
?>
