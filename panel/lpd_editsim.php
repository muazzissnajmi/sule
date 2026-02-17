<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$id_lpd = addslashes($_POST['id_lpd']);
$hasil = addslashes($_POST['hasil']);
$tgl = date('d-m-Y');

    $sql= mysqli_query($koneksi, "UPDATE lpd SET hasil_dicapai = '$hasil', tgl_lpd = '$tgl', kunci = 'Y' WHERE id_lpd = '$id_lpd'");

   if ($sql){
   		
    	echo "<script type='text/javascript'> document.location = '?page=lpde&id=$id_lpd&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=lpde&id=$id_lpd&msg=2'; </script>";
	}

?>