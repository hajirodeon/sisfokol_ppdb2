<?php
session_start();

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/admin.html");

nocache;

//nilai
$filenya = "tapel.php";
$judul = "[PPDB] Data Tahun Pelajaran";
$judulku = "$judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kd = nosql($_REQUEST['kd']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek baru
if ($_POST['btnBR'])
	{
	//nilai
	$ke = "$filenya?s=baru&kd=$x";
	
	
	//re-direct
	xloc($ke);
	exit();
	}








//reset nomor urut
if ($_POST['btnRESET'])
	{
						
	//hapus table nomor, reset awal lagi...
	mysqli_query($koneksi, "DROP TABLE nomerku");
		
		
	
	
	//bikin baru... TK /////////////////////////////////////////////////////
	mysqli_query($koneksi, "CREATE TABLE `nomerku` (
				  `noid` int(50) NOT NULL,
				  `calon_kd` varchar(50) NOT NULL,
				  `tapel_kd` varchar(50) NOT NULL,
				  `tapel_nama` varchar(100) NOT NULL,
				  `calon_nama` varchar(100) NOT NULL,
				  `calon_noreg` varchar(100) NOT NULL,
				  `postdate` datetime NOT NULL,
				  `jalur` varchar(100) NOT NULL
				) ENGINE=MyISAM;");
				
	mysqli_query($koneksi, "ALTER TABLE `nomerku`
				  ADD PRIMARY KEY (`calon_kd`),
				  ADD UNIQUE KEY `noid` (`noid`);");
				  
				  
	mysqli_query($koneksi, "ALTER TABLE `nomerku`
				  MODIFY `noid` int(50) NOT NULL AUTO_INCREMENT;");
		

	
	
	//re-direct
	$pesan = "Reset Nomor Urut Pendaftaran, Telah Berhasil...";
	pekem($pesan,$filenya);
	exit();
	}









//nek batal
if ($_POST['btnBTL'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$page = nosql($_POST['page']);
	$e_kd = nosql($_POST['e_kd']);
	$e_tahun1 = cegah($_POST['e_tahun1']);
	$e_tahun2 = cegah($_POST['e_tahun2']);
	$e_dt_tk = cegah($_POST['e_dt_tk']);
	$e_status = cegah($_POST['e_status']);

	
		

	//nek null
	if ((empty($e_tahun1)) OR (empty($e_tahun2)) OR (empty($e_dt_tk)) OR (empty($e_status)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$e_kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//netralkan semua dulu
		mysqli_query($koneksi, "UPDATE psb_m_tapel SET status = 'false'");
		
		
		
		//jika baru
		if ($s == "baru")
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO psb_m_tapel(kd, tahun1, tahun2, status, ".
							"dayatampung, postdate) VALUES ".
							"('$e_kd', '$e_tahun1', '$e_tahun2', '$e_status', ".
							"'$e_dt_tk', '$today')");


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
				
				
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE psb_m_tapel SET tahun1 = '$e_tahun1', ".
							"tahun2 = '$e_tahun2', ".
							"status = '$e_status', ".
							"dayatampung = '$e_dt_tk', ".
							"postdate = '$today' ".
							"WHERE kd = '$e_kd'");


			//re-direct
			xloc($filenya);
			exit();
			}

		}
	}

	
	
	

//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);
	$ke = $filenya;

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysqli_query($koneksi, "DELETE FROM psb_m_tapel ".
						"WHERE kd = '$kd'");
						
		
		//hapus daftar calon
		mysqli_query($koneksi, "DELETE FROM psb_calon ".
						"WHERE tapel_kd = '$kd'");
		
		}



		

	//auto-kembali
	xloc($ke);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi *START
ob_start();

?>



  
  <script>
  	$(document).ready(function() {
    $('#table-responsive').dataTable( {
        "scrollX": true
    } );
} );
  </script>
  
<?php
//require
require("../../template/js/jumpmenu.js");
require("../../template/js/checkall.js");
require("../../template/js/swap.js");


//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">

<p>
<input name="btnBR" type="submit" value="BUAT BARU" class="btn btn-danger">

<input name="btnRESET" type="submit" value="RESET NOMOR URUT PENDAFTARAN" class="btn btn-success">
<hr>
</p>';


if (($s == "baru") OR ($s == "edit"))
	{
	//edit
	$qx = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
						"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_kd = nosql($rowx['kd']);
	$e_tahun1 = nosql($rowx['tahun1']);
	$e_tahun2 = nosql($rowx['tahun2']);
	$e_dt_tk = nosql($rowx['dayatampung']);
	$e_status = nosql($rowx['status']);

	//jika true
	if ($e_status == "true")
		{
		$e_status_ket = "AKTIF";
		}
	else
		{
		$e_status_ket = "Tidak Aktif";
		}
		
	
	
	echo '<table border="0" cellspacing="0" cellpadding="3" bgcolor="white">
	<tr valign="top">
	<td>
	
	<p>
	Tahun Pelajaran : 
	<br>

	<input name="e_tahun1" type="text" size="5" value="'.$e_tahun1.'" class="btn-warning">/
	<input name="e_tahun2" type="text" size="5" value="'.$e_tahun2.'" class="btn-warning">
	</p>
	
	
	<p>
	Daya Tampung : 
	<br>

	<input name="e_dt_tk" type="text" size="5" value="'.$e_dt_tk.'" class="btn-warning">
	</p>
	
	<p>
	Status : 
	<br>

	<select name="e_status" class="btn-warning">
	<option value="'.$e_status.'" selected>'.$e_status_ket.'</option>
	<option value="true">PENDAFTARAN AKTIF</option>
	<option value="false">Pendaftaran Ditutup</option>
	</select>
	</p>
	
	
	
	
	
	
	</td>

	</tr>
	</table>
	
	
	<p>
	<hr>	
	
	<input name="s" type="hidden" value="'.$s.'">
	<input name="e_kd" type="hidden" value="'.$kd.'">
	<input name="page" type="hidden" value="'.$page.'">

	
	<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
	<input name="btnBTL" type="submit" value="BATAL" class="btn btn-info">
	<hr>
	</p>';
	}
	
	
else
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlcount = "SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 ASC";
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);

	
	echo '<div class="table-responsive">          
		  <table class="table" border="1">
		    <thead>
							
				<tr bgcolor="'.$warnaheader.'">
				<td width="16">&nbsp;</td>
				<td width="30">&nbsp;</td>
				<td width="100"><strong><font color="'.$warnatext.'">TAPEL</font></strong></td>
				<td width="100"><strong><font color="'.$warnatext.'">STATUS</font></strong></td>
				<td><strong><font color="'.$warnatext.'">DAYA TAMPUNG</font></strong></td>
				</tr>
	
		    </thead>
		    <tbody>';
	
	if ($count != 0)
		{
		do {
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
			$e_kd = nosql($data['kd']);
			$e_tahun1 = balikin($data['tahun1']);
			$e_tahun2 = balikin($data['tahun2']);
			$e_status = balikin($data['status']);
			$e_postdate = balikin($data['postdate']);
			$e_dt_tk = nosql($data['dayatampung']);
			
			//jika true
			if ($e_status == "true")
				{
				$e_status_ket = "<font color='green'>PENDAFTARAN AKTIF</font>";
				}
			else
				{
				$e_status_ket = "Pendaftaran Ditutup";
				}


	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$e_kd.'">
	        </td>
			<td>
			<a href="'.$filenya.'?s=edit&kd='.$e_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$e_tahun1.'/'.$e_tahun2.'</td>
			<td>'.$e_status_ket.'</td>
			<td>'.$e_dt_tk.'</td>
	        </tr>';
			}
		while ($data = mysqli_fetch_assoc($result));
		}
	
	
	echo '</tbody>
		  </table>
		  </div>
		  
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'
	<input name="jml" type="hidden" value="'.$count.'">
	<br>
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$count.')" class="btn btn-primary">
	<input name="btnBTL" type="reset" value="BATAL" class="btn btn-warning">
	<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
	</td>
	</tr>
	</table>
	<br>
	
	<p>
	NB. Menghapus Data Tahun Pelajaran, Berarti Menghapus semua Daftar Calon untuk Tahun Pelajaran Tersebut.
	</p>';
	}
	

echo '</form>';

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//null-kan
xclose($koneksi);
exit();
?>