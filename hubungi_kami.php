<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/cp_kontak.html");



nocache;

//nilai
$filenya = "hubungi_kami.php";
$filenyax = "i_index.php";
$filenya_ke = $sumber;
$judul = "Hubungi Kami"; 
$judulku = $judul; 









//detail  ////////////////////////////////////////////////////////////////////////////////////////
ob_start();




echo '<div class="section-heading">
<h5>'.$judul.'</h5>
</div>';
        

        


//detail
$qku = mysqli_query($koneksi, "SELECT * FROM cp_profil");
$rku = mysqli_fetch_assoc($qku);
$ku_nama = balikin($rku['judul']);
$ku_isi = balikin($rku['isi']);
$ku_telp = balikin($rku['telp']);
$ku_fax = balikin($rku['fax']);
$ku_email = balikin($rku['email']);
$ku_fb = balikin($rku['fb']);
$ku_twitter = balikin($rku['twitter']);
$ku_instagram = balikin($rku['instagram']);
$ku_youtube = balikin($rku['youtube']);
$ku_wa = balikin($rku['wa']);
$ku_alamat = balikin($rku['alamat']);
$ku_alamat_googlemap = balikin($rku['alamat_googlemap']);


?>

<h6 class="widget-title"><?php echo $ku_nama;?></h6>
	
	<p>
		<?php echo $ku_isi;?>
	</p>
	
	
			<?php                            
            //jadikan koordinat
			$address = urlencode($ku_alamat_googlemap);
			
			$url = "https://maps.google.com/maps/api/geocode/json?key=$keyku&address=$address";
			
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
			$responseJson = curl_exec($ch);
			curl_close($ch);
			
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
			          zoom: 16,
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



            <ul class="list">
            	<li>
            		<p>
            			<?php echo $ku_alamat_googlemap;?>
            		</p>
            	</li>
                <li>
                	<p>
					E-Mail : <a href="mailto:<?php echo $ku_email;?>"><?php echo $ku_email;?></a>
					</p>
				</li>
				
				
                <li>
                	<p>
                		Telp/Fax : <?php echo $ku_telp;?>/<?php echo $ku_fax;?>		
                	</p>
				</li>

				
                <li>
                	<p>
                		<a href="http://<?php echo $ku_fb;?>" target="_blank"><img src="<?php echo $sumber;?>/template/sosmed/036-facebook.png" width="32"></a> 

                		<a href="http://<?php echo $ku_twitter;?>" target="_blank"><img src="<?php echo $sumber;?>/template/sosmed/008-twitter.png" width="32"></a>

                		<a href="http://<?php echo $ku_instagram;?>" target="_blank"><img src="<?php echo $sumber;?>/template/sosmed/029-instagram.png" width="32"></a>

                		<a href="http://<?php echo $ku_youtube;?>" target="_blank"><img src="<?php echo $sumber;?>/template/sosmed/001-youtube.png" width="32"></a>		

                		<a href="http://wa.me//<?php echo $ku_wa;?>" target="_blank"><img src="<?php echo $sumber;?>/template/sosmed/005-whatsapp.png" width="32"></a>
                	</p>
				</li>
				
            </ul>





<?php
        
//isi
$i_artikel_detail = ob_get_contents();
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





















require("inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
