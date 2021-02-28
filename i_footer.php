<?php

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
        <div class="container">
            <div class="row">
                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-md-6">

                    <div class="footer-widget">
                        <h6 class="widget-title"><?php echo $ku_nama;?></h6>
						
						<p>
							<?php echo $ku_isi;?>
						</p>
						
						
                            
		                        <ul class="list">
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
						</div>
                    
                </div>

                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <h6 class="widget-title">PPDB</h6>
                        	
							<ul>
								<li><a href="ppdb_dayatampung.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> Daya Tampung</a></li>
								<li><a href="ppdb_reg.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> Registrasi</a></li>
								<li><a href="ppdb_verifikasi.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> Verifikasi</a></li>
								<li><a href="ppdb_login.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> LOGIN</a></li>
								<li><a href="ppdb_rekap.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> Rekap Pendaftar</a></li>
								<li><a href="ppdb_cari.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> Cari Pendaftar</a></li>
								<li><a href="ppdb_hasilseleksi.php"><i class="fa fa-angle-double-right" class="footer-widget-nav" aria-hidden="true"></i> Hasil Seleksi</a></li>

							</ul>



                    </div>
                </div>



                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="footer-widget">
                        <h6 class="widget-title">VISITOR</h6>
						
						
						<?php
							//ketahui ip
							function get_client_ip_env() {
								$ipaddress = '';
							if (getenv('HTTP_CLIENT_IP'))
								$ipaddress = getenv('HTTP_CLIENT_IP');
							else if(getenv('HTTP_X_FORWARDED_FOR'))
								$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
							else if(getenv('HTTP_X_FORWARDED'))
								$ipaddress = getenv('HTTP_X_FORWARDED');
							else if(getenv('HTTP_FORWARDED_FOR'))
								$ipaddress = getenv('HTTP_FORWARDED_FOR');
							else if(getenv('HTTP_FORWARDED'))
								$ipaddress = getenv('HTTP_FORWARDED');
							else if(getenv('REMOTE_ADDR'))
								$ipaddress = getenv('REMOTE_ADDR');
							else
								$ipaddress = 'UNKNOWN';
							
								return $ipaddress;
							}
							
							
							$ipku = get_client_ip_env();
							
							
							
							
							
							
							
							//netralkan semua, jam sebelumnya
							mysqli_query($koneksi, "UPDATE cp_visitor SET online = 'false' ".
										"WHERE round(DATE_FORMAT(postdate, '%H')) < '$jam' ".
										"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggal' ".
										"AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' ".
										"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun'");
							
							
							
							
							
							
							
							//masukin ke database, yang online... dan statusnya...
							mysqli_query($koneksi, "INSERT INTO cp_visitor(kd, ipnya, online, postdate) VALUES ".
										"('$x', '$ipku', 'true', '$today')");
							
							
							
							
							
							
							
							
							//detailnya, online
							$qkun = mysqli_query($koneksi, "SELECT DISTINCT(ipnya) AS ipya ".
												"FROM cp_visitor ".
												"WHERE online = 'true' ".
												"AND round(DATE_FORMAT(postdate, '%d')) = '$tanggal' ".
												"AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' ".
												"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun'");
							$tkun = mysqli_num_rows($qkun);
							$nilx = $tkun;
							
							
							
							
							
							//detailnya, hari ini
							$qkun = mysqli_query($koneksi, "SELECT * FROM cp_visitor ".
												"WHERE round(DATE_FORMAT(postdate, '%d')) = '$tanggal' ".
												"AND round(DATE_FORMAT(postdate, '%m')) = '$bulan' ".
												"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun'");
							$tkun = mysqli_num_rows($qkun);
							$nil1 = $tkun;
							
							
							
							
							
							//detailnya, bulan ini
							$qkun = mysqli_query($koneksi, "SELECT * FROM cp_visitor ".
												"WHERE round(DATE_FORMAT(postdate, '%m')) = '$bulan' ".
												"AND round(DATE_FORMAT(postdate, '%Y')) = '$tahun'");
							$tkun = mysqli_num_rows($qkun);
							$nil2 = $tkun;
							
							
							
							//detailnya, total
							$qkun = mysqli_query($koneksi, "SELECT * FROM cp_visitor");
							$tkun = mysqli_num_rows($qkun);
							$nil3 = $tkun;
							
							?>
							
							
							<!-- Stylesheet -->
							<link rel="stylesheet" type="text/css" href="<?php echo $sumber;?>/template/counter/css/styles.css">
							
							<!-- Fonts -->
							<link href="https://fonts.googleapis.com/css?family=Press+Start+2P|Roboto+Condensed" rel="stylesheet">
							
							
							
							<div class="counting-container">
								<div class="counting-box" id="encounter">
									<h4><font color="orange"><?php echo $nilx;?></font></h4>
									<p>Online</p>
								</div>
								
								<div class="counting-box" id="encounter">
									<h4><font color="orange"><?php echo $nil1;?></font></h4>
									<p>Hari ini</p>
								</div>
							</div>
							
							
							<div class="counting-container">
								
								<div class="counting-box" id="battles">
									<h4><font color="orange"><?php echo $nil2;?></font></h4>
									<p>Bulan ini</p>
								</div>
								<div class="counting-box" id="locations">
									<h4><font color="orange"><?php echo $nil3;?></font></h4>
									<p>Total</p>
								</div>
							</div>
							
							
							
							Your IP : <b><?php echo $ipku;?></b> 
							
							
							<!-- JavaScript -->
							<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
							<script type="text/javascript" src="<?php echo $sumber;?>/template/counter/js/counter.js"></script>
							
												
						


                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
        <div class="copywrite-area">
            <div class="container">
                <div class="row">
                    <!-- Copywrite Text -->
                    <div class="col-12 col-sm-12">
                    	2021. {versi}
                    </div>
                </div>
            </div>
        </div>
