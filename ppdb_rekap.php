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
$filenya = "ppdb_rekap.php";
$judul = "Rekap Pendaftar";
$judulku = $judul;
$ku_judul = $judulku;


		





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
