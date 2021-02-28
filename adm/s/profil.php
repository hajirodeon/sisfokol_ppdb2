<?php
session_start();

//ambil nilai
require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/adm.php");
$tpl = LoadTpl("../../template/admin.html");


nocache;

//nilai
$filenya = "profil.php";
$judul = "[SETTING]. Profil Sekolah";
$judulku = "$judul";




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//simpan
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$e_nama = cegah($_POST["e_nama"]);
	$e_isi = cegah($_POST["e_isi"]);
	$e_alamat = cegah($_POST["e_alamat"]);
	$e_telp = cegah($_POST["e_telp"]);
	$e_fax = cegah($_POST["e_fax"]);
	$e_email = cegah($_POST["e_email"]);
	$e_web = cegah($_POST["e_web"]);
	$e_fb = cegah($_POST["e_fb"]);
	$e_twitter = cegah($_POST["e_twitter"]);
	$e_youtube = cegah($_POST["e_youtube"]);
	$e_instagram = cegah($_POST["e_instagram"]);
	$e_wa = cegah($_POST["e_wa"]);


	$namabaru = "logo.jpg";


	//cek
	//nek null
	if ((empty($e_nama)) OR (empty($e_telp)) OR (empty($e_email)) OR (empty($e_wa)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	else
		{
		//perintah SQL
		mysqli_query($koneksi, "UPDATE cp_profil SET judul = '$e_nama', ".
						"isi = '$e_isi', ".
						"filex = '$namabaru', ".
						"alamat = '$e_alamat', ".
						"telp = '$e_telp', ".
						"fax = '$e_fax', ".
						"email = '$e_email', ".
						"web = '$e_web', ".
						"fb = '$e_fb', ".
						"twitter = '$e_twitter', ".
						"youtube = '$e_youtube', ".
						"instagram = '$e_instagram', ".
						"wa = '$e_wa', ".
						"postdate = '$today'");


		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
	
	
	
	
	
	
	
	
	






//simpan
if ($_POST['btnSMP2'])
	{
	//ambil nilai
	$e_alamat = cegah($_POST["e_alamat2"]);


	//cek
	//nek null
	if (empty($e_alamat))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}

	else
		{
		//perintah SQL
		mysqli_query($koneksi, "UPDATE cp_profil SET alamat_googlemap = '$e_alamat'");


		//auto-kembali
		xloc($filenya);
		exit();
		}
	}
	
	
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






//isi *START
ob_start();






     	
echo '<form action="'.$filenya.'" method="post" name="formx">';


//detail
$qku = mysqli_query($koneksi, "SELECT * FROM cp_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_judul = balikin($rku['judul']);
$ku_isi = balikin($rku['isi']);
$ku_web = balikin($rku['web']);
$ku_email = balikin($rku['email']);
$ku_alamat = balikin($rku['alamat']);
$ku_alamat2 = balikin($rku['alamat_googlemap']);
$ku_telp = balikin($rku['telp']);
$ku_fax = balikin($rku['fax']);
$ku_fb = balikin($rku['fb']);
$ku_twitter = balikin($rku['twitter']);
$ku_youtube = balikin($rku['youtube']);
$ku_wa = balikin($rku['wa']);
$ku_instagram = balikin($rku['instagram']);

echo '<div class="row">

<div class="col-md-6">


<p>
Nama : 
<br>
<input name="e_nama" type="text" size="20" value="'.$ku_judul.'" class="btn-warning">
</p>


<p>
Sekilas Semboyan / Tagline : 
<br>
<input name="e_isi" type="text" size="50" value="'.$ku_isi.'" class="btn-warning">
</p>


<p>
Alamat : 
<br>
<input name="e_alamat" type="text" size="30" value="'.$ku_alamat.'" class="btn-warning">
</p>

<p>
Telepon : 
<br>
<input name="e_telp" type="text" size="20" value="'.$ku_telp.'" class="btn-warning">
</p>


<p>
Fax : 
<br>
<input name="e_fax" type="text" size="20" value="'.$ku_fax.'" class="btn-warning">
</p>


<p>
WEB : 
<br>
<input name="e_web" type="text" size="30" value="'.$ku_web.'" class="btn-warning">
</p>


</div>

<div class="col-md-6">


<p>
E-Mail : 
<br>
<input name="e_email" type="text" size="30" value="'.$ku_email.'" class="btn-warning">
</p>



<p>
FB : 
<br>
<input name="e_fb" type="text" size="30" value="'.$ku_fb.'" class="btn-warning">
</p>


<p>
Twitter : 
<br>
<input name="e_twitter" type="text" size="30" value="'.$ku_twitter.'" class="btn-warning">
</p>


<p>
Youtube : 
<br>
<input name="e_youtube" type="text" size="30" value="'.$ku_youtube.'" class="btn-warning">
</p>

<p>
WA : 
<br>
<input name="e_wa" type="text" size="30" value="'.$ku_wa.'" class="btn-warning">
</p>


<p>
Instagram : 
<br>
<input name="e_instagram" type="text" size="30" value="'.$ku_instagram.'" class="btn-warning">
</p>


</div>

</div>


<p>
<input name="btnSMP" type="submit" value="SIMPAN" class="btn btn-danger">
</p>
</form>

<hr>



<div class="row">

<div class="col-md-6">

<h3>LOGO SEKOLAH</h3>';
?>


	
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  


	<style type="text/css">
	.thumb-image{
	 float:left;
	 width:150px;
	 height:150px;
	 position:relative;
	 padding:5px;
	}
	</style>
	
	
	
	
		<table border="0" cellspacing="0" cellpadding="3">
		<tr valign="top">
		<td width="100">
			<div id="image-holder"></div>
		</td>
		

		</tr>
		</table>
	
	<script>
	$(document).ready(function() {
		
		
	        $("#image_upload").on('change', function() {
	          //Get count of selected files
	          var countFiles = $(this)[0].files.length;
	          var imgPath = $(this)[0].value;
	          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
	          var image_holder = $("#image-holder");
	          image_holder.empty();
	          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
	            if (typeof(FileReader) != "undefined") {
	              //loop for each file selected for uploaded.
	              for (var i = 0; i < countFiles; i++) 
	              {
	                var reader = new FileReader();
	                reader.onload = function(e) {
	                  $("<img />", {
	                    "src": e.target.result,
	                    "class": "thumb-image"
	                  }).appendTo(image_holder);
	                }
	                image_holder.show();
	                reader.readAsDataURL($(this)[0].files[i]);
	              }
	              
	
		    
	            } else {
	              alert("This browser does not support FileReader.");
	            }
	          } else {
	            alert("Pls select only images");
	          }
	        });
	        
	        


	        
	        
	        
	      });
	</script>

	<?php
	echo '<div id="loading" style="display:none">
	<img src="'.$sumber.'/template/img/progress-bar.gif" width="100" height="16">
	</div>
	
	
   <form method="post" id="upload_image" enctype="multipart/form-data">
	<input type="file" name="image_upload" id="image_upload" class="btn btn-warning" />

   </form>
   
   <hr>';
	
	?>
	
	
	<script>  
	$(document).ready(function(){
		
		
		
	       $('#image-holder').load("<?php echo $sumber;?>/adm/s/i_profil.php?aksi=lihat1");

	
	
	        
	    $('#upload_image').on('change', function(event){
	     event.preventDefault();
	     
			$('#loading').show();
	
	
		
		     $.ajax({
		      url:"i_profil_upload.php",
		      method:"POST",
		      data:new FormData(this),
		      contentType:false,
		      cache:false,
		      processData:false,
		      success:function(data){
				$('#loading').hide();
		       $('#preview').load("<?php echo $sumber;?>/adm/s/i_profil.php?aksi=lihat");
		       	
		      }
		     })
		    });
		    
		    
	});  
	</script>


<?php
echo '</div>


<div class="col-md-6">

<h3>PETA GOOGLE MAP</h3>';

echo '<form action="'.$filenya.'" method="post" name="formx2">

<p>
Alamat Google Map : 
<br>
<input name="e_alamat2" type="text" size="30" value="'.$ku_alamat2.'" class="btn-warning">
</p>

<p>
<input name="btnSMP2" type="submit" value="SIMPAN" class="btn btn-danger">
</p>


</form>';







//jadikan koordinat
$address = urlencode($ku_alamat2);

$url = "https://maps.google.com/maps/api/geocode/json?key=$keyku&address=$address";


 
$responseJson = file_get_contents($url);


$response = json_decode($responseJson);

if ($response->status == 'OK') 
	{
	//koordinat dari alamat
    $latitude = $response->results[0]->geometry->location->lat;
    $longitude = $response->results[0]->geometry->location->lng;
	} 
else 
	{
	//kasi default, kota kendal jawa tengah
    $latitude = "-7.0265442";
    $longitude = "110.1879106"; 
	} 
?>



<style>
  #map {
    height: 100%;
  }
</style>

  <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&&callback=initMap&key=<?php echo $keyku;?>"></script>





<style>
 #map-canvas {
        width: 100%;
        height: 400px;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script>
var map;
function initialize() {
        var myLatLng = {lat: <?php echo $latitude;?>, lng: <?php echo $longitude;?>};

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
          zoom: 20,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: '<?php echo $ku_nama;?>'
        });

}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <div id="map-canvas"></div>


</div>


</div>



<?php
//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");

//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>