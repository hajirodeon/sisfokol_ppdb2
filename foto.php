<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/cp_foto.html");



nocache;

//nilai
$filenya = "foto.php";
$filenyax = "i_index.php";
$filenya_ke = $sumber;






//foto
$qku2 = mysql_query("SELECT * FROM cp_g_foto ".
						"ORDER BY postdate DESC");
$rku2 = mysql_fetch_assoc($qku2);
$ku2_kd = nosql($rku2['kd']);
$ku2_nama = balikin($rku2['nama']);
$ku2_filex = balikin($rku2['filex']);
$judul = "Foto Galeri"; 
$judulku = $judul; 
$ku_filex2 = "$sumber/filebox/foto/$ku2_kd/$ku2_filex";





//artikel image ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


echo $ku_filex2;

//isi
$i_artikel_image = ob_get_contents();
ob_end_clean();











//detail artikel ////////////////////////////////////////////////////////////////////////////////////////
ob_start();




echo '<div class="section-heading">
<h5>Foto Galeri</h5>
</div>';
      
?>	  




<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>





<style>
	#masonry {
  column-count: 1;
  column-gap: 1em;
}

@media(min-width: 30em) {
  #masonry {
    column-count: 1;
    column-gap: 1em;
  }
}

@media(min-width: 40em) {
  #masonry {
    column-count: 2;
    column-gap: 1em;
  }
}

@media(min-width: 60em) {
  #masonry {
    column-count: 3;
    column-gap: 1em;
  }
}

@media(min-width: 75em) {
  #masonry {
    column-count: 3;
    column-gap: 1em;
  }
}

.item {
  background-color: none;
  display: inline-block;
  margin: 0 0 1em 0;
  width: 100%;
  cursor: pointer;
}

.item img {
  max-width: 100%;
  height: auto;
  width: 100%;
  margin-bottom: -4px;
  
  /*idk why but this fix stuff*/
}

.item.active {
  animation-name: active-in;
  animation-duration: 0.7s;
  animation-fill-mode: forwards;
  animation-direction: alternate;
}

.item.active:before {
  content: "+";
  transform: rotate(45deg);
  font-size: 48px;
  color: white;
  position: absolute;
  top: 20px;
  right: 20px;
  background-color:rgba(0,0,0,0.85);
  border-radius: 50%;
  width:48px;
  height:48px;
  text-align:center;
  line-height:48px;
  z-index:12;
}

.item.active img {
  animation-name: active-in-img;
  animation-duration: 0.7s;
  animation-fill-mode: forwards;
  animation-direction: alternate;
}


@keyframes active-in {
  0% {
    opacity:1;
    background-color:white;
  }
  
  50% {
    opacity:0;
    background-color:rgba(0,0,0,0.90);
  }
  
  100% {
    opacity: 1;
    position:fixed;
    top:0;
    left:0;
    right:0;
    bottom:0;
    background-color:rgba(0,0,0,0.90);
  }
}

@keyframes active-in-img {
  0% {
    opacity:1;
    transform:translate(0%, 0%);
    top: 0;
    left: 0;
    max-width: 100%;
  }
  49% {
    opacity:0;
    transform: translate(0%, -50%);
  }
  50% {
    position:absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -100%);
  }
  100% {
  display: block;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  max-width: 90%;
  width: auto;
  max-height: 95vh;
  opacity:1;
  }
}
</style>




<div class="container">
  <div id="masonry">

<?php
//foto
$qyuk2 = mysql_query("SELECT * FROM cp_g_foto ".
						"ORDER BY postdate DESC");
$ryuk2 = mysql_fetch_assoc($qyuk2);

do
	{
	//nilai
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_nama = balikin($ryuk2['nama']);
	$yuk2_filex = balikin($ryuk2['filex']);

	
	$yuk2_postdate = balikin($ryuk2['postdate']);
	$yuk2_nama2 = seo_friendly_url($yuk2_nama);
	


    echo '<div class="item">
      <a data-fancybox="gallery" data-caption="'.$yuk2_nama.'" href="'.$sumber.'/filebox/foto/'.$yuk2_kd.'/'.$yuk2_filex.'"><img src="'.$sumber.'/filebox/foto/'.$yuk2_kd.'/'.$yuk2_filex.'" class="img-thumbnail" alt="'.$yuk2_nama.'"></a>
    </div>';

	}
while ($ryuk2 = mysql_fetch_assoc($qyuk2));




echo '</div>
</div>';

  

        


        
//isi
$i_artikel_detail = ob_get_contents();
ob_end_clean();














//brcrumb ////////////////////////////////////////////////////////////////////////////////////////
ob_start();


echo '<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="'.$sumber.'"><i class="glyphicon glyphicon-home" aria-hidden="true"></i> BERANDA</a></li>
        <li class="breadcrumb-item"><a href="foto.php">Foto Galeri</a></li>
    </ol>
</nav>';

					
					
//isi
$i_artikel_bcrumb = ob_get_contents();
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










//isi *START
ob_start();




$qyuk2 = mysql_query("SELECT * FROM cp_g_foto ".
						"ORDER BY RAND() LIMIT 0,5");
$ryuk2 = mysql_fetch_assoc($qyuk2);

do
	{
	//nilai
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_nama = balikin($ryuk2['nama']);
	$yuk2_filex = balikin($ryuk2['filex']);

	
	$yuk2_postdate = balikin($ryuk2['postdate']);
	$yuk2_nama2 = seo_friendly_url($yuk2_nama);
	

	$nil_foto = "$sumber/filebox/foto/$yuk2_kd/$yuk2_filex";

	
	echo '<p>
	<img src="'.$nil_foto.'" width="100%">
	</p>';


	}
while ($ryuk2 = mysql_fetch_assoc($qyuk2));







//isi
$i_terbaru = ob_get_contents();
ob_end_clean();
















require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
