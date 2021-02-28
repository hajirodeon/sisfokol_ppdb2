<?php
//slideshow
$qyuk2 = mysqli_query($koneksi, "SELECT * FROM cp_m_slideshow ".
						"ORDER BY RAND()");
$ryuk2 = mysqli_fetch_assoc($qyuk2);

do
	{
	//nilai
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_filex = balikin($ryuk2['filex']);
	$yuk2_urlnya = balikin($ryuk2['urlnya']);
	$yuk2_nama = balikin($ryuk2['nama']);
	$yuk2_isi = balikin($ryuk2['isi']);
	$yuk2_postdate = balikin($ryuk2['postdate']);
	
    echo '<div class="hero-blog-post bg-img bg-overlay" style="background-image: url('.$sumber.'/filebox/slideshow/'.$yuk2_kd.'/'.$yuk2_filex.');">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="post-content text-center">
                            <a href="http://'.$yuk2_urlnya.'" target="blank" class="post-title" data-animation="fadeInUp" data-delay="300ms">'.$yuk2_nama.'</a>
                            

	                            <a href="http://'.$yuk2_urlnya.'" class="bg-warning">&nbsp;&nbsp;&nbsp; '.$yuk2_isi.'&nbsp;&nbsp;&nbsp;</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>';

	}
while ($ryuk2 = mysqli_fetch_assoc($qyuk2));
?>