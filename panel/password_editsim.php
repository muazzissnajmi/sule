<?php
session_start();
include "../koneksi/koneksi.php";
//autentifikasi password
$pengacak  = "PG09381IJSLLE8302EDG";

$passwordlama  = $_POST['old_password'];
$passwordbaru1 = $_POST['pwd'];
$passwordbaru2 = $_POST['pwd2'];

// cek benar tidaknya password yang lama

$query = "SELECT * FROM users WHERE username = '".$_SESSION['username']."'";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);

/*if ($data['password'] == md5($pengacak.md5($passwordlama.$pengacak)))*/
if (md5($pengacak.md5($passwordlama).$pengacak.md5($passwordlama).$pengacak.md5($passwordlama).$pengacak) == $data['password'])
{
    // jika password lama benar, maka cek kesesuaian password baru 1 dan 2
    if ($passwordbaru1 == $passwordbaru2)
    {
        // jika password baru 1 dan 2 sama, maka proses update password dilakukan

        // enkripsi password baru sebelum disimpan ke db

        $passwordbaruenkrip = md5($pengacak . md5($passwordbaru1) . $pengacak . md5($passwordbaru1) .$pengacak . md5($passwordbaru1) . $pengacak);
							

        $query = mysqli_query($koneksi, "UPDATE users SET password = '$passwordbaruenkrip' WHERE username = '".$_SESSION['username']."'") or die(mysqli_error($koneksi));
         echo "<script type='text/javascript'> document.location = '?page=pse&msg=1'; </script>";
       }
	else { 
	echo "<script type='text/javascript'> document.location = '?page=pse&msg=2'; </script>"; 
	}	
	}
else {
echo "<script type='text/javascript'> document.location = '?page=pse&msg=3'; </script>";
}
?>
