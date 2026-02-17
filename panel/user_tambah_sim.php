<?php 
include "../koneksi/koneksi.php";

$username 	= addslashes($_POST['username']);
$password 	= addslashes($_POST['pwd']);
$password2 	= addslashes($_POST['pwd2']);
$nip	 	= addslashes($_POST['nip']);
$email	 	= addslashes($_POST['email']);
$rule	 	= addslashes($_POST['rule']);
$jk	 		= addslashes($_POST['jk']);

$sql_cek = "SELECT * FROM users WHERE username = '$username'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($tampil_cek);

if ($password == $password2)
{

	if ($data_cek['username'] == $username) {

		echo "<script type='text/javascript'> document.location = '?page=usern&msg=4'; </script>";

	}else{
	// perlu dibuat sebarang pengacak
	$pengacak  = "PG09381IJSLLE8302EDG";

	// mengenkripsi password dengan md5() dan pengacak
	$newPass1 = md5($pengacak . md5($password) . $pengacak . md5($password) . $pengacak . md5($password) . $pengacak);

	// simpan data ke database
	$query = mysqli_query($koneksi, "INSERT INTO users VALUES('$username', '$newPass1', '$nip','$email','$rule','status','Y','$jk')");
	}


if ($query) {
	/*session_start();
	
	$namaaktifitas		= $_SESSION['username'];
	$username2 	= mysqli_real_escape_string($koneksi, $_POST['username']);
	$role2		= mysqli_real_escape_string($koneksi, $_POST['role']); */
	
	// jika berhasil menyimpan
	echo "<script type='text/javascript'> document.location = '?page=user&msg=1'; </script>";	
} else {
	// jika gagal menyimpan
	echo "<script type='text/javascript'> document.location = '?page=usern&msg=2'; </script>";
	}
	
}
else 
	echo "<script type='text/javascript'> document.location = '?page=usern&msg=3'; </script>";
?>