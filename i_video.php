<script>
	/*JS FOR SCROLLING THE ROW OF THUMBNAILS*/ 
	$(document).ready(function () {
	  $('.vid-item').each(function(index){
	    $(this).on('click', function(){
	      var current_index = index+1;
	      $('.vid-item .thumb').removeClass('active');
	      $('.vid-item:nth-child('+current_index+') .thumb').addClass('active');
	    });
	  });
	});
	
</script>								


<style>
	.title {
		width: 100%;
		max-width: 854px;
		margin: 0 auto;
	}

	.caption {
		width: 100%;
		max-width: 854px;
		margin: 0 auto;
		padding: 20px 0;
	}

	.vid-main-wrapper {
		width: 100%;
		max-width: 1100px;
		min-width: 440px;
		background: #fff;
		margin: 0 auto;
	}


	/*  VIDEO PLAYER CONTAINER
	############################### */
	.vid-container {
	    position: relative;
	    padding-bottom: 52%;
	    padding-top: 30px; 
	    height: 0; 
		width:70%;
		float:left;
	}
	 
	.vid-container iframe,
	.vid-container object,
	.vid-container embed {
	    position: absolute;
	    top: 0;
	    left: 0;
	    width: 100%;
	    min-height: 360px;
	}


	/*  VIDEOS PLAYLIST 
	############################### */
	.vid-list-container {
		width: 30%;
  		height:500px;
		overflow: hidden;
  		float:right;
	}

.vid-list-container:hover, .vid-list-container:focus {
   overflow-y: auto;
 }

	ol#vid-list {
  margin:0;
  padding:0;
  background: #222;
	}

ol#vid-list li {
	  list-style: none;
}

ol#vid-list li a {
  text-decoration: none;
  background-color: #222;
  height:100px;
  display:block;
  padding:10px;
}

ol#vid-list li a:hover {
  background-color:#666666
}

	.vid-thumb {
  float:left;
		margin-right: 8px;
	}

.active-vid { 
  background:#3A3A3A;
}

	#vid-list .desc {
		color: #CACACA;
		font-size: 13px;
		margin-top:5px;
	}


	@media (max-width: 624px) {
		body {
			margin: 15px;
		}
		.caption {
			margin-top: 40px;
		}
		.vid-list-container {
			padding-bottom: 20px;
		}

	}
</style>



<div class="vid-main-wrapper clearfix">

  		    <!-- THE YOUTUBE PLAYER -->
  		    
  		<?php
  		//terpilih
		$qkuy = mysqli_query($koneksi, "SELECT * FROM cp_g_video ".
								"ORDER BY postdate DESC");
		$rkuy = mysqli_fetch_assoc($qkuy);
		$kuy_judul = balikin($rkuy['judul']);
		$kuy_url1 = balikin($rkuy['filex']);
					
		//ambil kode untuk embed
		$pecahku = explode("=", $kuy_url1);
		$kuy_kode = trim($pecahku[1]); 
		?>
		
		
      <div class="vid-container">
          <iframe id="vid_frame" src="https://www.youtube.com/embed/<?php echo $kuy_kode;?>?rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="500"></iframe>
      </div>

      <!-- THE PLAYLIST -->
      <div class="vid-list-container">
            <ol id="vid-list">
            	
				<?php 
				//tampilkan daftar video youtube
				$qkuy = mysqli_query($koneksi, "SELECT * FROM cp_g_video ".
										"ORDER BY postdate DESC");
				$rkuy = mysqli_fetch_assoc($qkuy);
				
				do
					{
					$kuy_judul = balikin($rkuy['judul']);
					$kuy_url1 = balikin($rkuy['filex']);
					
					//ambil kode untuk embed
					$pecahku = explode("=", $kuy_url1);
					$kuy_kode = trim($pecahku[1]); 
		
														            	
		              echo '<li>
		                <a href="javascript:void();" onClick="document.getElementById(\'vid_frame\').src=\'https://youtube.com/embed/'.$kuy_kode.'?autoplay=1&rel=0&showinfo=0&autohide=1\'">
		                  <span class="vid-thumb"><img width=72 src="https://img.youtube.com/vi/'.$kuy_kode.'/default.jpg" /></span>
		                  <div class="desc">'.$kuy_judul.'</div>
		                </a>
		              </li>';
	              
					}
				while ($rkuy = mysqli_fetch_assoc($qkuy))
              
				?>

              
            </ul>
       </div>

  	
</div>

