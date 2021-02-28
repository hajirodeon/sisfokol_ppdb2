<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/ppdb.html");



nocache;


//list
$qku = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 DESC");
$rku = mysqli_fetch_assoc($qku);
$tapelkd = nosql($rku['kd']);
$e_dt_tahun1 = nosql($rku['tahun1']);
$e_dt_tahun2 = nosql($rku['tahun2']);
$e_dt_status = nosql($rku['status']);



//nilai
$filenya = "ppdb_hasilseleksi.php";
$judul = "Hasil Seleksi $e_dt_tahun1/$e_dt_tahun2";
$judulku = $judul;
$ku_judul = $judulku;
$sekolah = cegah($_REQUEST['sekolah']);
$jalur = cegah($_REQUEST['jalur']);
$s = nosql($_REQUEST['s']);
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);

$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


		



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$sekolah = cegah($_POST['e_sekolah']);
	$jalur = cegah($_POST['e_jalur']);
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?sekolah=$sekolah&jalur=$jalur&kunci=$kunci";
	xloc($ke);
	exit();
	}















//require
require("template/js/jumpmenu.js");
require("template/js/checkall.js");
require("template/js/swap.js");




//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


//daftar daya tampung
echo '<h4 class="post-title">'.$judul.'</h4>
<hr>';


//jika aktif daftar
if ($e_dt_status == "true")
	{
	echo '<h3>
	<font color=red>
	Proses Pendaftaran Masih Berlangsung...
	</font>
	</h3>';
	}
	
//jika pengumuman
else if ($e_dt_status == "false")
	{
	//ketahui update terakhir
	$qyuk = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
							"ORDER BY aktif_postdate DESC");
	$ryuk = mysqli_fetch_assoc($qyuk);
	$yuk_postdate = balikin($ryuk['aktif_postdate']);
		
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
						"AND sekolah LIKE '$sekolah%' ".
						"AND c_jalur = '$jalur' ".
						"ORDER BY noreg ASC";
		}
		
	else
		{
		$sqlcount = "SELECT * FROM psb_calon ".
						"WHERE aktif = 'true' ".
						"AND tapel_kd = '$tapelkd' ".
						"AND sekolah LIKE '$sekolah%' ".
						"AND c_jalur = '$jalur' ".
						"AND (c_nisn LIKE '%$kunci%' ".
						"OR noreg LIKE '%$kunci%' ".
						"OR c_nama LIKE '%$kunci%' ".
						"OR c_sekolah_asal LIKE '%$kunci%') ".
						"ORDER BY noreg ASC";
		}
		
	
	//query
	$p = new Pager();
	$start = $p->findStart($limit);
	
	$sqlresult = $sqlcount;
	
	$count = mysqli_num_rows(mysqli_query($sqlcount));
	$pages = $p->findPages($count, $limit);
	$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
	$target = "$filenya?jalur=$jalur";
	$pagelist = $p->pageList($_GET['page'], $pages, $target);
	$data = mysqli_fetch_array($result);
	
	
	
	echo '<p>
	Update Terakhir : <b>'.$yuk_postdate.'</b>
	</p>
	
	<hr>
	
	<form action="'.$filenya.'" method="post" name="formxx">
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
		<input name="s" type="hidden" value="'.$s.'">
		<input name="e_jalur" type="hidden" value="'.$jalur.'">
		
		</p>
			
		
		
		<div class="table-responsive">          
		<table class="table" border="1">
		<thead>
		
		<tr valign="top" bgcolor="'.$warnaheader.'">
		<td width="50"><strong><font color="'.$warnatext.'">NOREG</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">NISN</font></strong></td>
		<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
		<td width="150"><strong><font color="'.$warnatext.'">SEKOLAH ASAL</font></strong></td>
		<td width="50"><strong><font color="'.$warnatext.'">KETERANGAN</font></strong></td>
		
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
				echo '<td>'.$i_noreg.'</td>
				<td>'.$i_nisn.'</td>
				<td>
				'.$i_nama.'
				</td>
				<td>'.$i_sekolah_asal.'</td>
				<td>'.$i_diterima_ket.'</td>
		        </tr>';
				}
			while ($data = mysqli_fetch_assoc($result));
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
$i_artikel_detail = ob_get_contents();
ob_end_clean();














//brcrumb ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


echo '<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="'.$sumber.'"><i class="glyphicon glyphicon-home" aria-hidden="true"></i> BERANDA</a></li>
        <li class="breadcrumb-item active" aria-current="page">'.$ku_judul.'</li>
    </ol>
</nav>';

					
					
//isi
$i_artikel_bcrumb = ob_get_contents();
ob_end_clean();




















//artikel image ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


//foto random
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_g_foto ".
						"WHERE filex <> '' ".
						"ORDER BY RAND()");
$ryuk2 = mysqli_fetch_assoc($qyuk2);
$yuk2_kd = nosql($ryuk2['kd']);
$yuk2_nama = balikin($ryuk2['nama']);
$yuk2_filex = balikin($ryuk2['filex']);


echo "$sumber/filebox/foto/$yuk2_kd/$yuk2_filex";




//isi
$i_artikel_image = ob_get_contents();
ob_end_clean();


















//isi *START
ob_start();

require("i_menu.php");

//isi
$i_menu = ob_get_contents();
ob_end_clean();








//isi *START
ob_start();

require("i_ppdb.php");

//isi
$i_ppdb = ob_get_contents();
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
