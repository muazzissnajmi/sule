<?php include 'session.php' ?>
<?php

//header("Refresh: 1800;");  
include "../koneksi/koneksi.php";

//$waktu =  date('H:i');
//"<br>";
$tgl_cek =  "12";
$tahun_cek =  date('Y');
$tgl = $tgl_cek."-".$tahun_cek;
$tahun_ = date('m-Y');
$tahun =  date('Y')+1;

if ($tgl == $tahun_){
$sql = mysqli_query($koneksi, " INSERT INTO pagu VALUES ('$tahun',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)");
}

?>