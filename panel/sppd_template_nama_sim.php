<?php
include "../koneksi/koneksi.php";

$nama_pejabat = addslashes($_POST['nama_pejabat']);
$nip = addslashes($_POST['nip']);
$pangkat = addslashes($_POST['pangkat']);
$jabatan = addslashes($_POST['jabatan']);

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


$sql_cek1 = "SELECT * FROM sppd_template WHERE nama_pejabat = '$nama_pejabat'";
	$tampil_cek1 = mysqli_query($koneksi, $sql_cek1);
	$data_cek1 = mysqli_fetch_array($tampil_cek1);

	if ($data_cek1['nama_pejabat'] == $nama_pejabat) {
		
		echo "<script type='text/javascript'> document.location = '?page=sppdttn&msg=2'; </script>";

	}else{
	
		$sql1 = mysqli_query($koneksi, "INSERT INTO sppd_template VALUES (null,'$nama_pejabat','$jabatan','$pangkat','$golongan','$nip')");
		echo "<script type='text/javascript'> document.location = '?page=sppdttn&msg=1'; </script>";
	}
?>