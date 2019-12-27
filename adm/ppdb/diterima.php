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
$filenya = "diterima.php";
$kd = nosql($_REQUEST['kd']);
$jalur = cegah($_REQUEST['jalur']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);

$judul = "[PPDB $tahun1/$tahun2] DITERIMA/DITOLAK";
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











//jika import
if ($_POST['btnIM'])
	{
	//nilai
	$jalur = cegah($_POST['e_jalur']);
	
	
	//re-direct
	$ke = "$filenya?jalur=$jalur&s=import";
	xloc($ke);
	exit();
	}







//import sekarang
if ($_POST['btnIMX'])
	{
	//nilai
	$jalur = cegah($_POST['e_jalur']);

	$filex_namex2 = strip(strtolower($_FILES['filex_xls']['name']));

	//nek null
	if (empty($filex_namex2))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya?jalur=$jalur&s=import";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//deteksi .xls
		$ext_filex = substr($filex_namex2, -4);

		if ($ext_filex == ".xls")
			{
			//nilai
			$path1 = "../../filebox";
			$path2 = "../../filebox/excel";
			chmod($path1,0777);
			chmod($path2,0777);

			//nama file import, diubah menjadi baru...
			$filex_namex2 = "nilai$today.xls";

			//mengkopi file
			copy($_FILES['filex_xls']['tmp_name'],"../../filebox/excel/$filex_namex2");

			//chmod
            $path3 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0755);
			chmod($path2,0777);
			chmod($path3,0777);

			//file-nya...
			$uploadfile = $path3;


			//require
			require('../../inc/class/PHPExcel.php');
			require('../../inc/class/PHPExcel/IOFactory.php');


			  // load excel
			  $load = PHPExcel_IOFactory::load($uploadfile);
			  $sheets = $load->getActiveSheet()->toArray(null,true,true,true);
			
			  $i = 1;
			  foreach ($sheets as $sheet) 
			  	{
			    // karena data yang di excel di mulai dari baris ke 2
			    // maka jika $i lebih dari 1 data akan di masukan ke database
			    if ($i > 1) 
			    	{
				      // nama ada di kolom A
				      // sedangkan alamat ada di kolom B
				      $i_xyz = md5("$x$i");
				      $i_no = cegah($sheet['A']);
				      $i_noreg = cegah2($sheet['B']);
				      $i_nisn = cegah2($sheet['C']);
				      $i_nama = cegah2($sheet['D']);
				      $i_sekolah_asal = cegah2($sheet['E']);
				      $i_nilai = cegah2($sheet['F']);
				      $i_diterima = cegah2($sheet['G']);
				      
					  
					  //jika diterima
					  if ($i_diterima == "DITERIMA")
					  		{
					  		$i_status = "true";
					  		}
							
					  else if ($i_diterima == "DITOLAK")
					  		{
					  		$i_status = "false";
					  		}
				      
					
					  
					  
					  
						//cek
						$qcc = mysql_query("SELECT * FROM psb_calon ".
												"WHERE tapel_kd = '$tapelkd' ".
												"AND aktif = 'true' ".
												"AND sekolah = '$sekolah' ".
												"AND c_jalur = '$jalur' ".
												"AND noreg = '$i_noreg'");
						$rcc = mysql_fetch_assoc($qcc);
						$tcc = mysql_num_rows($qcc);
		
						//jika ada, update				
						if (!empty($tcc))
							{
							mysql_query("UPDATE psb_calon SET diterima = '$i_status', ".
											"diterima_postdate = '$today' ".
											"WHERE tapel_kd = '$tapelkd' ".
											"AND aktif = 'true' ".
											"AND sekolah = '$sekolah' ".
											"AND c_jalur = '$jalur' ".
											"AND noreg = '$i_noreg'");
							}
		
		
						else
							{
							//cuekin aja...
							}
					  
				    }
			
			    $i++;
			  }





			//hapus file, jika telah import
			$path1 = "../../filebox/excel/$filex_namex2";
			chmod($path1,0777);
			unlink ($path1);


			//re-direct
			$ke = "$filenya?jalur=$jalur";
			xloc($ke);
			exit();
			}
		else
			{
			//salah
			$pesan = "Bukan File .xls . Harap Diperhatikan...!!";
			$ke = "$filenya?jalur=$jalur&s=import";
			pekem($pesan,$ke);
			exit();
			}
		}
	}












//jika export
//export
if ($_POST['btnEX'])
	{
	//nilai
	$sekolah2 = cegah($sekolah);
	$jalur = balikin($_REQUEST['e_jalur']);
	
	
	
	//require
	require('../../inc/class/excel/OLEwriter.php');
	require('../../inc/class/excel/BIFFwriter.php');
	require('../../inc/class/excel/worksheet.php');
	require('../../inc/class/excel/workbook.php');


	//nama file e...
	$i_filename = "status-$tahun1-$tahun2-$jalur.xls";
	$i_judul = "STATUS";
	



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
	$worksheet1->write_string(0,2,"NISN");
	$worksheet1->write_string(0,3,"NAMA");
	$worksheet1->write_string(0,4,"SEKOLAH_ASAL");
	$worksheet1->write_string(0,5,"NILAI");
	$worksheet1->write_string(0,6,"STATUS");




	//data
	$qdt = mysql_query("SELECT * FROM psb_calon ".
							"WHERE aktif = 'true' ".
							"AND tapel_kd = '$tapelkd' ".
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
		$dt_c_sekolah_asal = balikin($rdt['c_sekolah_asal']);
		$e_nilai = balikin($rdt['nilai']);
		$e_diterima = balikin($rdt['diterima']);
		
		//status
		if ($e_diterima == "true")
			{
			$e_status = "DITERIMA";
			}
		else if ($e_diterima == "false")
			{
			$e_status = "DITOLAK";
			}
			
			
	
		//ciptakan
		$worksheet1->write_string($dt_nox,0,$dt_nox);
		$worksheet1->write_string($dt_nox,1,$dt_noreg);
		$worksheet1->write_string($dt_nox,2,$dt_c_nisn);
		$worksheet1->write_string($dt_nox,3,$dt_c_nama);
		$worksheet1->write_string($dt_nox,4,$dt_c_sekolah_asal);
		$worksheet1->write_string($dt_nox,5,$e_nilai);
		$worksheet1->write_string($dt_nox,6,$e_status);
		}
	while ($rdt = mysql_fetch_assoc($qdt));


	//close
	$workbook->close();

	
	
	//re-direct
	xloc($filenya);
	exit();
	}












//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$jalur = cegah($_POST['e_jalur']);
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?jalur=$jalur&kunci=$kunci";
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







//jika import
if ($s == "import")
	{
	?>
	<div class="row">

	<div class="col-md-12">
		
	<?php
	echo '<form action="'.$filenya.'" method="post" enctype="multipart/form-data" name="formxx2">
	<p>
		<input name="filex_xls" type="file" size="30" class="btn btn-warning">
	</p>

	<p>
		<input name="e_jalur" type="hidden" value="'.$jalur.'">
		<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
		<input name="btnIMX" type="submit" value="IMPORT >>" class="btn btn-danger">
	</p>
	
	
	</form>';	
	?>
		


	</div>
	
	</div>


	<?php
	}




else 
	{
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
	//jika null
	if (empty($kunci))
		{
		$sqlcount = "SELECT * FROM psb_calon ".
						"WHERE aktif = 'true' ".
						"AND tapel_kd = '$tapelkd' ".
						"AND c_jalur = '$jalur' ".
						"ORDER BY noreg ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM psb_calon ".
						"WHERE aktif = 'true' ".
						"AND tapel_kd = '$tapelkd' ".
						"AND (c_nisn LIKE '%$kunci%' ".
						"OR noreg LIKE '%$kunci%' ".
						"OR c_nama LIKE '%$kunci%' ".
						"OR c_sekolah_asal LIKE '%$kunci%' ".
						"OR nilai LIKE '%$kunci%') ".
						"ORDER BY noreg ASC";
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
	
	
	
	echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
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
		echo '<hr>
		<p>
		<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning">
		<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
		<input name="btnBTL" type="submit" value="RESET" class="btn btn-info">
		<input name="btnIM" type="submit" value="IMPORT" class="btn btn-success">
		<input name="btnEX" type="submit" value="EXPORT" class="btn btn-danger">
		<input name="s" type="hidden" value="'.$s.'">
		<input name="e_jalur" type="hidden" value="'.$jalur.'">
		
		</p>
			
		
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">IMAGE</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NOREG</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NISN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">SEKOLAH ASAL</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NILAI</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">STATUS</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		
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
		
		
				$nil_foto1 = "$sumber/filebox/calon/$i_kd/$i_kd-calon.jpg";
				$i_nilai = balikin($data['nilai']);
				$i_diterima = balikin($data['diterima']);
				$i_diterima_postdate = balikin($data['diterima_postdate']);
				
				//jika diterima
				if ($i_diterima == "true")
					{
					$i_diterima_ket = "<font color=green>DITERIMA</font>";
					$warna = "orange";
					}
					
				else if ($i_diterima == "false")
					{
					$i_diterima_ket = "<font color=red>Ditolak</font>";
					}
					
			
				echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
				echo '<td>
					<img src="'.$nil_foto1.'" width="150">
				</td>
				<td>'.$i_noreg.'</td>
				<td>'.$i_nisn.'</td>
				<td>
				'.$i_nama.'
				</td>
				<td>'.$i_sekolah_asal.'</td>
				<td>'.$i_nilai.'</td>
				<td>'.$i_diterima_ket.'</td>
				<td>'.$i_diterima_postdate.'</td>
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