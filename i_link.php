<?php
//link
$qyuk2 = mysql_query("SELECT * FROM cp_m_link ".
						"ORDER BY nama ASC");
$ryuk2 = mysql_fetch_assoc($qyuk2);



do
	{
	//nilai
	$yuk2_kd = nosql($ryuk2['kd']);
	$yuk2_nama = balikin($ryuk2['nama']);
	$yuk2_urlnya = balikin($ryuk2['urlnya']);
	$yuk2_filex = balikin($ryuk2['filex']);
	$yuk2_postdate = balikin($ryuk2['postdate']);
	

    echo '<p>
    <a href="http://'.$yuk2_urlnya.'" target="_blank"><img src="'.$sumber.'/filebox/link/'.$yuk2_kd.'/'.$yuk2_filex.'" width="100%" height="100"></a>
    </p>';
	}
while ($ryuk2 = mysql_fetch_assoc($qyuk2));


?>