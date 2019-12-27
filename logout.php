<?php
session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");


//hapus session
session_unset();
session_destroy();


//re-direct
xloc($sumber);
exit();
?>