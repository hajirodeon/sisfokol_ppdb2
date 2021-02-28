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
$filenya = "mapel.php";
$judul = "[PPDB] Data Mapel/Jenis Ujian";
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
	$e_sekolah = cegah($_POST['e_sekolah']);
	$e_sesi = cegah($_POST['e_sesi']);
	$e_jam = cegah($_POST['e_jam']);
	$e_mapel = cegah($_POST['e_mapel']);
		

	//nek null
	if ((empty($e_sekolah)) OR (empty($e_sesi)) OR (empty($e_jam)) OR (empty($e_mapel)))
		{
		//re-direct
		$pesan = "Belum Ditulis. Harap Diulangi...!!";
		$ke = "$filenya?s=$s&kd=$e_kd";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ($s == "baru")
			{
			//insert
			mysqli_query($koneksi, "INSERT INTO psb_m_mapel(kd, sekolah, sesi, jam, ".
							"nama, postdate) VALUES ".
							"('$e_kd', '$e_sekolah', '$e_sesi', '$e_jam', ".
							"'$e_mapel', '$today')");


			//re-direct
			xloc($filenya);
			exit();
			}
			
			
				
				
		//jika update
		if ($s == "edit")
			{
			mysqli_query($koneksi, "UPDATE psb_m_mapel SET sekolah = '$e_sekolah', ".
							"sesi = '$e_sesi', ".
							"jam = '$e_jam', ".
							"nama = '$e_mapel', ".
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
		mysqli_query($koneksi, "DELETE FROM psb_m_mapel ".
						"WHERE kd = '$kd'");
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
<hr>
</p>';


if (($s == "baru") OR ($s == "edit"))
	{
	//edit
	$qx = mysqli_query($koneksi, "SELECT * FROM psb_m_mapel ".
						"WHERE kd = '$kd'");
	$rowx = mysqli_fetch_assoc($qx);
	$e_kd = nosql($rowx['kd']);
	$e_sesi = balikin($rowx['sesi']);
	$e_jam = balikin($rowx['jam']);
	$e_nama = balikin($rowx['nama']);
	
	echo '<table border="0" cellspacing="0" cellpadding="3" bgcolor="white">
	<tr valign="top">
	<td>
	
	
	<p>
	Sesi Ke-: 
	<br>

	<input name="e_sesi" type="text" size="5" value="'.$e_sesi.'" class="btn-warning">
	</p>
	
	
	<p>
	Jam Mulai - Selesai : 
	<br>

	<input name="e_jam" type="text" size="20" value="'.$e_jam.'" class="btn-warning">
	</p>
	
	
	<p>
	Nama Mapel / Jenis Ujian : 
	<br>

	<input name="e_mapel" type="text" size="30" value="'.$e_nama.'" class="btn-warning">
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
	
	$sqlcount = "SELECT * FROM psb_m_mapel ".
					"ORDER BY round(sesi) ASC";
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
				<td width="100"><strong><font color="'.$warnatext.'">SESI</font></strong></td>
				<td width="100"><strong><font color="'.$warnatext.'">JAM</font></strong></td>
				<td><strong><font color="'.$warnatext.'">MAPEL/JENIS UJIAN</font></strong></td>
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
			$e_sesi = balikin($data['sesi']);
			$e_jam = balikin($data['jam']);
			$e_mapel = balikin($data['nama']);


	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<input type="checkbox" name="item'.$nomer.'" value="'.$e_kd.'">
	        </td>
			<td>
			<a href="'.$filenya.'?s=edit&kd='.$e_kd.'"><img src="'.$sumber.'/template/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$e_sesi.'</td>
			<td>'.$e_jam.'</td>
			<td>'.$e_mapel.'</td>
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
	<br>';
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