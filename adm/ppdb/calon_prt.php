<?php
session_start();


//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/class/kartu_ujian.php");



nocache;

//nilai
$filenya = "calon_prt.php";
$judul = "Calon Print Kartu Tes";
$judulku = $judul;
$ku_judul = $judulku;
$s = nosql($_REQUEST['s']);
$kdx = nosql($_REQUEST['ckd']);
$kd = nosql($_REQUEST['ckd']);




//start class
$pdf=new PDF('P','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetTitle($judul);
$pdf->SetAuthor($author);
$pdf->SetSubject($description);
$pdf->SetKeywords($keywords);







//list
$qku = mysql_query("SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 DESC");
$rku = mysql_fetch_assoc($qku);
$e_tapelkd = nosql($rku['kd']);
$e_dt_tahun1 = nosql($rku['tahun1']);
$e_dt_tahun2 = nosql($rku['tahun2']);
$e_dt_tk = nosql($rku['dayatampung']);




//profil
$qx = mysql_query("SELECT * FROM psb_calon ".
					"WHERE kd = '$kdx'");
$rowx = mysql_fetch_assoc($qx);
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







//bikin kotak garis luar
$pdf->Cell(100,70,'',1,0,'L');


//image
$pdf-> Image('../../img/logo.jpg',11,14,10); //logo
$pdf-> Image($nil_foto1,15,55,16); //calon


$baris_tebal = 5;
$pdf->SetY(10);
$pdf->SetFont('Times','B',10);
$pdf->Cell(100,$baris_tebal,'KARTU UJIAN PPDB '.$e_dt_tahun1.'/'.$e_dt_tahun2.'',0,0,'C');
$pdf->SetY(10+($baris_tebal));
$pdf->Cell(100,$baris_tebal,$sek_nama,0,0,'C');
$pdf->SetY(10+(2 * $baris_tebal));

//garis
$baris_tebal2 = 0.1;
$pdf->Cell(100,$baris_tebal2,'',1,0,'C');
					

//set posisi
$pdf->SetY(10+(3 * $baris_tebal) + 3);

$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,'No. Pendaftaran ',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$e_noreg.'',0,0,'L');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,'Nama Peserta ',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$e_nama.'',0,0,'L');
$pdf->Ln();


$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,'Username ',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$e_noreg.'',0,0,'L');
$pdf->Ln();

$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,'Password ',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$e_passx2.'',0,0,'L');
$pdf->Ln();


$pdf->SetFont('Times','',10);
$pdf->Cell(30,5,'ID Server/Ruang ',0,0,'L');
$pdf->SetFont('Times','B',10);
$pdf->Cell(30,5,': '.$i_ruangan.'',0,0,'L');
$pdf->Ln();





//list mapel
$nilY = $pdf->GetY();
$pdf->SetY($nilY + 2);
$pdf->SetX(38);
$pdf->SetFont('Times','B',8);
$pdf->SetFillColor(233,233,233);
$pdf->Cell(35,5,'JENIS UJIAN',1,0,'L',1);
$pdf->Cell(10,5,'SESI',1,0,'L',1);
$pdf->Cell(25,5,'JAM',1,0,'L',1);
$pdf->Ln();


//daftar mapel
$qyuk = mysql_query("SELECT * FROM psb_m_mapel ".
						"WHERE sekolah = '$e_sekolah2' ".
						"ORDER BY round(sesi) ASC");
$ryuk = mysql_fetch_assoc($qyuk);

do
	{
	//nilai
	$yuk_no = $yuk_no + 1;
	$yuk_sesi = balikin($ryuk['sesi']);
	$yuk_jam = balikin($ryuk['jam']);
	$yuk_nama = balikin($ryuk['nama']);
	
	
	
	$pdf->SetX(38);
	$pdf->Cell(35,5,$yuk_nama,1,0,'L');
	$pdf->Cell(10,5,$yuk_sesi,1,0,'L');
	$pdf->Cell(25,5,$yuk_jam,1,0,'L');
	$pdf->Ln();
	}
while ($ryuk = mysql_fetch_assoc($qyuk));


//output-kan ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->Output("calon-$e_noreg.pdf",I);
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
