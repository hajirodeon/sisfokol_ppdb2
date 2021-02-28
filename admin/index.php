<?php
session_start();


//ambil nilai
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
$tpl = LoadTpl("../template/login_admin.html");



nocache;

//nilai
$filenya = "index.php";
$filenya_ke = $sumber;
$judul = "LOGIN ADMIN";
$judulku = $judul;






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnOK'])
	{
	//ambil nilai
	$username = nosql($_POST["usernamex"]);
	$password = md5(nosql($_POST["passwordx"]));

	//cek null
	if ((empty($username)) OR (empty($password)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//query
		$q = mysqli_query($koneksi, "SELECT * FROM adminx ".
							"WHERE usernamex = '$username' ".
							"AND passwordx = '$password' LIMIT 0,1");
		$row = mysqli_fetch_assoc($q);
		$total = mysqli_num_rows($q);
	
		//cek login
		if (!empty($total))
			{
			session_start();
	
			//bikin session
			$_SESSION['kd6_session'] = nosql($row['kd']);
			$_SESSION['username6_session'] = $username;
			$_SESSION['pass6_session'] = $password;
			$_SESSION['adm_session'] = "Administrator";
			$_SESSION['hajirobe_session'] = $hajirobe;
	
	
			//re-direct
			$ke = "../adm/index.php";
			xloc($ke);
			exit();
			}
		else
			{
			//re-direct
			$pesan = "PASSWORD SALAH... SILAHKAN ULANGI LAGI...";
			pekem($pesan, $filenya);
			exit();
			}
		}
	
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">


<p>
Username :
<br>
<input name="usernamex" type="text" size="15" class="btn btn-info btn-block">
</p>


<p>
Password :
<br>
<input name="passwordx" type="password" size="15" class="btn btn-info btn-block">
</p>


<p>
<input name="btnOK" type="submit" value="LANJUT &gt;&gt;&gt;" class="btn btn-danger">
</p>


</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>
