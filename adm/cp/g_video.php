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
$filenya = "g_video.php";
$judul = "[COMPANY PROFILE]. Galeri Video";
$judulku = "[COMPANY PROFILE]. $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);
$kdku = nosql($_REQUEST['kdku']);








//jika daftar
if($_POST['btnDF'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
	
	

//jika simpan
if($_POST['btnSMP'])
	{
	$s = nosql($_POST['s']);
	$kdku = nosql($_POST['kdku']);
	$e_judul = cegah($_POST['e_judul']);
	$e_judul2 = urlencode($_POST['e_judul2']);
	$e_urlnya = cegah($_POST['e_urlnya']);


	
	//nek null
	if ((empty($e_judul)) OR (empty($e_urlnya)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap...!!";
		$ke = "$filenya?s=baru&kdku=$x";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//jika baru
		if ((empty($s)) OR ($s == "baru"))
			{
			$kdku = $x;
			
			//query
			mysql_query("INSERT INTO cp_g_video(kd, judul, filex, postdate) VALUES ".
							"('$kdku', '$e_judul', '$e_urlnya', '$today')");


			
			//re-direct
			xloc($filenya);
			exit();
			}
		else 
			{
			//query
			mysql_query("UPDATE cp_g_video SET judul = '$e_judul', ".
							"filex = '$e_urlnya', ".
							"postdate = '$today' ".
							"WHERE kd = '$kdku'");

			//re-direct
			$ke = "$filenya?s=edit&kdku=$kdku";
			xloc($ke);
			exit();
			}
		}


	exit();
	}






//jika hapus data
if($_POST['btnHPS'])
	{
	//ambil semua
	for ($i=1; $i<=$limit;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM cp_g_video ".
						"WHERE kd = '$kd'");

		}



	//re-direct
	xloc($filenya);
	exit();
	}













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
//js
require("../../inc/js/swap.js");
require("../../inc/js/checkall.js");


echo '<form action="'.$filenya.'" enctype="multipart/form-data" method="post" name="formx">



[<a href="'.$filenya.'?s=baru&kdku='.$x.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>Entri Baru]';




//jika edit
//tampilkan form
if (($s == 'baru') OR ($s == 'edit'))
	{
	//query
	$qx = mysql_query("SELECT * FROM cp_g_video ".
						"WHERE kd = '$kdku'");
	$rowx = mysql_fetch_assoc($qx);
	$e_judul = balikin($rowx['judul']);
	$e_filex = balikin($rowx['filex']);
	$e_postdate = $rowx['postdate'];

	echo '<h2>Baru/Edit</h2>
	<hr>
		
	<p>
	Judul : 
	<br>
	<input name="e_judul" id="e_judul" type="text" value="'.$e_judul.'" size="50" class="btn-warning">
	</p>


	<p>
	URL VIDEO YOUTUBE : 
	<br>
	<input name="e_urlnya" id="e_urlnya" type="text" value="'.$e_filex.'" size="50" class="btn-warning">
	</p>



		
	<p>
	<input name="kdku" id="kdku" type="hidden" value="'.$kdku.'">

	<button name="btnSMP" id="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">SIMPAN</button>
	<button name="btnDF" id="btnDF" type="submit" value="BATAL" class="btn btn-info">BATAL</button>
	</p>';
	
	

	}
else 
	{
	//query
	$p = new Pager();
	$start = $p->findStart($limit);

	$sqlcount = "SELECT * FROM cp_g_video ".
					"ORDER BY postdate DESC";
	$sqlresult = $sqlcount;

	$count = mysql_num_rows(mysql_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysql_fetch_array($result);

	
	
	if ($count != 0)
		{
		//view data
		echo '<div class="table-responsive">          
		  <table class="table" border="1">
		    <thead>
			
		<tr bgcolor="'.$warnaheader.'">
		<td width="1">&nbsp;</td>
		<td width="1">&nbsp;</td>
		<td><strong><font color="'.$warnatext.'">JUDUL</font></strong></td>
		<td width="200"><strong><font color="'.$warnatext.'">URL VIDEO YOUTUBE</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
		</tr>
		
		</thead>
		<tbody>';


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

			//nilai
			$nomer = $nomer + 1;
			$i_kd = nosql($data['kd']);
			$i_judul = balikin($data['judul']);
			$i_postdate = $data['postdate'];
			$i_filex = balikin($data['filex']);



			//ambil kode untuk embed
			$pecahku = explode("=", $i_filex);
			$i_filex2 = trim($pecahku[1]); 

			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td><input name="kd'.$nomer.'" type="hidden" value="'.$i_kd.'">
			<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
    		</td>
			<td>
			<a href="'.$filenya.'?s=edit&kdku='.$i_kd.'" title="EDIT..."><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>
			</td>
			<td>'.$i_judul.'</td>
			<td>
			
			<iframe width="500" height="300" src="https://www.youtube.com/embed/'.$i_filex2.'"></iframe>
			
			'.$i_filex.'
			
			</td>
			<td>'.$i_postdate.'</td>
    		</tr>';
			}
		while ($data = mysql_fetch_assoc($result));

		echo '</tbody>
		  </table>
		  </div>
	
	
		<table width="100%" border="0" cellspacing="0" cellpadding="3">
		<tr>
		<td width="300">
		<input name="jml" type="hidden" value="'.$limit.'">
		<input name="s" type="hidden" value="'.nosql($_REQUEST['s']).'">
		<input name="kdku" type="hidden" value="'.nosql($_REQUEST['kdku']).'">
		<input name="btnALL" type="button" value="SEMUA" class="btn btn-info" onClick="checkAll('.$limit.')">
		<input name="btnBTL" type="reset" value="BATAL" class="btn btn-warning">
		<input name="btnHPS" type="submit" value="HAPUS" class="btn btn-danger">
		</td>
		<td align="right"><strong><font color="#FF0000">'.$count.'</font></strong> Data. '.$pagelist.'</td>
		</tr>
		</table>';
		}
	else
		{
		echo '<p>
		<font color="red">
		<strong>BELUM ADA DATA.</strong>
		</font>
		</p>';
		}

	}



echo '</form>';

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>