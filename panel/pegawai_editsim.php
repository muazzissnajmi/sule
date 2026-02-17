<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$id_pegawai = addslashes($_POST['id_pegawai']);
$nip = addslashes($_POST['nip']);
$nama = addslashes($_POST['nama']);
//$golongan = addslashes($_POST['golongan']);
$pangkat = addslashes($_POST['pangkat']);
$jabatan = addslashes($_POST['jabatan']);
$no_sk = addslashes($_POST['no_sk']);
$tgl_sk = addslashes($_POST['tgl_sk']);

if ($pangkat == '') {
      $golongan = '';
}elseif ($pangkat == 'Juru Muda') {
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

    $sql= mysqli_query($koneksi, "UPDATE pegawai SET nama = '$nama', golongan = '$golongan', pangkat = '$pangkat', jabatan = '$jabatan', no_sk = '$no_sk', tgl_sk = '$tgl_sk' WHERE nip = '$nip'");

    //$sql=mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$barang', merek = '$merek' WHERE id_barang = '$id_barang'");
    
   if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=pe&id=$nip&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=pe&id=$nip&msg=2'; </script>";
	}

?>