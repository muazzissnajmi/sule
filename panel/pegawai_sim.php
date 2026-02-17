<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$nip = addslashes($_POST['nip']);
$nama = addslashes($_POST['nama']);
//$golongan = addslashes($_POST['golongan']);
$pangkat = addslashes($_POST['pangkat']);
$jabatan = addslashes($_POST['jabatan']);
$no_sk = addslashes($_POST['no_sk']);
$tgl_sk = addslashes($_POST['tgl_sk']);

if ($pangkat == 'Juru Muda') {
      $golongan = 'I/b';
}elseif ($pangkat == 'Juru Muda Tk.I') {
      $golongan = 'II/b';
}elseif ($pangkat == 'Juru') {
      $golongan = 'I/c';
}elseif ($pangkat == 'Juru Tk. I') {
      $golongan = 'I/d';
}elseif ($pangkat == 'Pengatur Muda') {
      $golongan = 'II/a';
}elseif ($pangkat == 'Pengatur Muda Tk. I') {
      $golongan = 'II/b';
}elseif ($pangkat == 'Pengatur') {
      $golongan = 'II/c';
}elseif ($pangkat == 'Pengatur TK.I') {
      $golongan = 'II/d';
}elseif ($pangkat == 'Penata Muda') {
      $golongan = 'III/a';
}elseif ($pangkat == 'Penata Muda Tk. I') {
      $golongan = 'III/b';
}elseif ($pangkat == 'Penata') {
      $golongan = 'III/c';
}elseif ($pangkat == 'Penata Tk.I') {
      $golongan = 'III/d';

}elseif ($pangkat == 'Pembina') {
      $golongan = 'IV/a';
}elseif ($pangkat == 'Pembina Tk. I') {
      $golongan = 'IV/b';
}elseif ($pangkat == 'Pembina Utama Muda') {
      $golongan = 'IV/c';
}elseif ($pangkat == 'Pembina Utama Madya') {
      $golongan = 'IV/d';
}




$sql_cek = "SELECT * FROM pegawai WHERE nip = '$nip'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_array($tampil_cek);
//echo $data_cek['nip'];

if ($nip < 999999999999) {
   $nip2 = date('dmysHi');
  $sql= mysqli_query($koneksi, "INSERT INTO pegawai VALUES (null,'$nip2','$nama','$golongan','$pangkat','$jabatan','$no_sk','$tgl_sk')");  
      echo "<script type='text/javascript'> document.location = '?page=pt&msg=1'; </script>";
}
if ($data_cek['nip'] == $nip) {
  echo "<script type='text/javascript'> document.location = '?page=pt&msg=2'; </script>";
}elseif ($nip == '' ){
  $sql= mysqli_query($koneksi, "INSERT INTO pegawai VALUES (null,'$nip','$nama','$golongan','$pangkat','$jabatan','$no_sk','$tgl_sk')");  
      echo "<script type='text/javascript'> document.location = '?page=pt&msg=1'; </script>";
}else{
    $sql= mysqli_query($koneksi, "INSERT INTO pegawai VALUES (null,'$nip','$nama','$golongan','$pangkat','$jabatan','$no_sk','$tgl_sk')");	
    	echo "<script type='text/javascript'> document.location = '?page=pt&msg=1'; </script>";
	
}


?>