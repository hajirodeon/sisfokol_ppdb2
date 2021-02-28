<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/ppdb.html");



nocache;

//nilai
$filenya = "ppdb_dayatampung.php";
$judul = "Daya Tampung";
$judulku = $judul;
$ku_judul = $judulku;
$kunci = cegah($_REQUEST['kunci']);
$kunci2 = balikin($_REQUEST['kunci']);


//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//nek reset
if ($_POST['btnRESET'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}





//jika cari
if ($_POST['btnCARI'])
	{
	//nilai
	$kunci = cegah($_POST['kunci']);


	//re-direct
	$ke = "$filenya?kunci=$kunci#cariid";
	xloc($ke);
	exit();
	}












		





//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


//daftar daya tampung
echo '<h4 class="post-title">'.$judul.'</h4>
<hr>';


//list
$qku = mysqli_query($koneksi, "SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 DESC");
$rku = mysqli_fetch_assoc($qku);
$e_tapelkd = nosql($rku['kd']);
$e_dt_tahun1 = nosql($rku['tahun1']);
$e_dt_tahun2 = nosql($rku['tahun2']);
$e_dt_tk = nosql($rku['dayatampung']);


echo "<h3>
Tahun Pelajaran $e_dt_tahun1/$e_dt_tahun2
</h3>";





//reg ///////////////////////////////////////////////////////
$qmboh = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
						"WHERE tapel_kd = '$e_tapelkd'");
$tmboh = mysqli_num_rows($qmboh);
$jml_tk = $tmboh;

//aktif
$qmboh = mysqli_query($koneksi, "SELECT * FROM psb_calon ".
						"WHERE tapel_kd = '$e_tapelkd' ".
						"AND aktif = 'true'");
$tmboh = mysqli_num_rows($qmboh);
$jml_tk_aktif = $tmboh;
$persen_tk_aktif = round(($jml_tk_aktif / $jml_tk) * 100);




?>		




      <div class="row">

        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="glyphicon glyphicon-education"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">DAYA TAMPUNG</span>
              <span class="info-box-number"><?php echo $e_dt_tk;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->






        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="glyphicon glyphicon-education"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">CALON</span>
              <span class="info-box-number"><?php echo $jml_tk;?></span>

              <div class="progress">
                <div class="progress-bar" style="width: <?php echo $persen_tk_aktif;?>%"></div>
              </div>
                  <span class="progress-description">
                    <?php echo $persen_tk_aktif;?>% Verifikasi
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      </div>
      <!-- /.row -->


<br>
<br>



<a name="cariid"></a>

<?php
//cari 
echo '<h4 class="post-title">CARI CALON PENDAFTAR</h4>
<hr>';




//jika null
if (empty($kunci))
	{
	$sqlcount = "SELECT * FROM psb_calon ".
					"WHERE tapel_kd = '$e_tapelkd' ".
					"ORDER BY postdate DESC";
	}
	
else
	{
	$sqlcount = "SELECT * FROM psb_calon ".
					"WHERE tapel_kd = '$e_tapelkd' ".
					"AND (sekolah LIKE '%$kunci%' ".
					"OR c_nisn LIKE '%$kunci%' ".
					"OR c_nama LIKE '%$kunci%' ".
					"OR c_sekolah_asal LIKE '%$kunci%') ".
					"ORDER BY postdate DESC";
	}
	

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlresult = $sqlcount;

$count = mysqli_num_rows(mysqli_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysqli_query($koneksi, "$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysqli_fetch_array($result);



echo '<form action="'.$filenya.'" method="post" name="formxx">
	<p>
	<input name="kunci" type="text" value="'.$kunci2.'" size="20" class="btn btn-warning">
	<input name="btnCARI" type="submit" value="CARI" class="btn btn-danger">
	<input name="btnRESET" type="submit" value="RESET" class="btn btn-info">
	<input name="s" type="hidden" value="'.$s.'">
	
	</p>
		
	
	<div class="table-responsive">          
	<table class="table" border="1">
	<thead>
	
	<tr valign="top" bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'">POSTDATE</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">NISN</font></strong></td>
	<td><strong><font color="'.$warnatext.'">NAMA</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">SEKOLAH ASAL</font></strong></td>
	
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

		$nomer = $nomer + 1;
		$i_kd = nosql($data['kd']);
		$i_postdate = balikin($data['postdate']);
		$i_sekolah = balikin($data['sekolah']);
		$i_nisn = balikin($data['c_nisn']);
		$i_nama = balikin($data['c_nama']);
		$i_sekolah_asal = balikin($data['c_sekolah_asal']);
	
		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$i_postdate.'</td>
		<td>'.$i_nisn.'</td>
		<td>'.$i_nama.'</td>
		<td>'.$i_sekolah_asal.'</td>
        </tr>';
		}
	while ($data = mysqli_fetch_assoc($result));

	echo '</tbody>
	  </table>
	  </div>
	

<table width="100%" border="0" cellspacing="0" cellpadding="3">
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
?>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php

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
