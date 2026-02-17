<!-- LOADING PAGE -->
	<script src="js/preload/jquery-2.2.1.min.js"></script>
	<style type="text/css">
	.preloader {
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  z-index: 9999;
	  background-color: #fff;
	}
	.preloader .loading {
	  position: absolute;
	  left: 50%;
	  top: 50%;
	  transform: translate(-50%,-50%);
	  font: 14px arial;
	}
	</style>

	<script>
	$(document).ready(function(){
	$(".preloader").fadeIn().delay(2000).fadeOut(); /* .fadeIn(1000).delay(1000).fadeOut() time 1000=1dtk*/
	})
	</script>
	<!-- END LOADING PAGE -->


	<div class="preloader">
  		<div class="loading">
    		<img src="img/loading.gif" width="80">
    		
  		</div>
	</div>

<?php
include "koneksi/koneksi.php";
session_start();

if ($_POST['submit']) {

	// terima data dari form login
	$username = htmlspecialchars ($_POST['username']);
	$password = htmlspecialchars ($_POST['password']);
	
	// untuk mencegah sql injection
	// kita gunakan mysql_real_escape_string
	//$username = mysqli_real_escape_string($koneksi, $username);
	//$password = mysqli_real_escape_string($koneksi, $password);
	
	//perintah login
	$sql_cek = "SELECT * FROM users WHERE BINARY username= '$username'";				
	$qry_cek = mysqli_query($koneksi, $sql_cek) or die (header("location: login.php?msg=1"));
	$ada_cek = mysqli_num_rows($qry_cek);
	$hls_cek = mysqli_fetch_array($qry_cek);	

	$aktif = $hls_cek['aktif'];
	$tgl = date('l, d-m-Y h:i');
	
	//kode pengacak
	$pengacak  = "PG09381IJSLLE8302EDG";
	
	//membaca password terenkripsi md5 4x enkripsi
	if (md5($password) == $hls_cek['password'] & $ada_cek >=1 & $aktif == "Y") {



	// kalau username dan password sudah terdaftar di database
	// buat session dengan nama username dengan isi nama user yang login
	$_SESSION['username'] = $username;
	$_SESSION['id_divisi'] = $hls_cek['id_divisi'];
	$_SESSION['id_outlet'] = $hls_cek['id_outlet'];
	$_SESSION['role'] = $hls_cek['role'];

	//cek remember me
	$_SESSION['submit'] = TRUE;
   
	if (isset($_POST['remember']))
	{
	//set waktu saat ini
	$time = time();
	//set cookie
	setcookie('submit', $username, $time + 43200); //SET LAMA WAKTU COOKIES
	}
	
	// redirect ke halaman users [menampilkan semua users]
	//$sql= mysqli_query($koneksi, "UPDATE users SET status = 'login' WHERE username = '$username'");

	//$sql2= mysqli_query($koneksi, "INSERT INTO log VALUES ('','$username','[ LOGIN ] $tgl')");
	//header('location:redirect.php');
	echo "<script type='text/javascript'> document.location = 'redirect.php'; </script>"; 

}elseif($aktif == "N"){
	//header('location:index.php?msg=3');
	echo "<script type='text/javascript'> document.location = 'index.php?msg=3'; </script>"; 

} else {
	// kalau username ataupun password tidak terdaftar di database
	//header('location:index.php?msg=2');
	echo "<script type='text/javascript'> document.location = 'index.php?msg=2'; </script>"; 
	}
  }

?>