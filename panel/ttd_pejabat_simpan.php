<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$ttd = addslashes($_POST['ttd']);
$nama = addslashes($_POST['nama']);
    
    $sql_cek = mysqli_query($koneksi, "select * from ttd_pejabat where nip = '$nama'");
	$process = mysqli_fetch_array($sql_cek);

    
   
	if ($process['nip'] == $nama){
   		echo "<script type='text/javascript'> document.location = '?page=ttdpt&msg=2'; </script>";
   	}else{
   		$sql= mysqli_query($koneksi, "INSERT INTO ttd_pejabat VALUES (NULL,'$ttd','$nama',NULL)");
    	echo "<script type='text/javascript'> document.location = '?page=ttd_pejabat&msg=3'; </script>";
	}

?>