<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$id_kw = addslashes($_POST['id_kw']);
$id_spt = $_GET['id'];
$id_spd = addslashes($_POST['id_spd']);
$no_kw = addslashes($_POST['no_kw']);
$tgl_kw = addslashes($_POST['tgl_kw']);
$kode_rek = addslashes($_POST['kode_rek']);
//$pagu = addslashes($_POST['pagu']);
$tahun = addslashes($_POST['tahun']);
$pengguna = addslashes($_POST['pengguna_anggaran']);
$bendahara = addslashes($_POST['bendahara']);
$total_kw = addslashes($_POST['total_kw']);
//$nip = $_POST['penerima'];

$sql_a = "SELECT * FROM kwitansi WHERE id_spt = '$id_spt'";
$tampil_a = mysqli_query($koneksi, $sql_a);     
$data_a = mysqli_fetch_array($tampil_a);
$pagu = $data_a['pagu'];

$sql1 = mysqli_query($koneksi, "UPDATE kwitansi SET kunci = 'Y' WHERE id_spt = '$id_spt'");
$sql2 = mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'F' WHERE id_spt = '$id_spt'");

                $sql_kw2 = "SELECT * FROM kwitansi_nilai WHERE id_spt = '$id_spt' ";
                $tampil_kw2 = mysqli_query($koneksi, $sql_kw2);
                $total_kw= 0;
                while($data_kw2 = mysqli_fetch_array($tampil_kw2)){
                $hari = $data_kw2['hari'];
                  
                if ($data_kw2['hari'] == '0') {
                $hari_kw = $data_kw2['hari']+1;
                }else{
                $hari_kw = $data_kw2['hari'];
                }

                $nilai_kw = $data_kw2['nominal'] * $hari_kw;

                $total_kw+=$nilai_kw;
                  
                }

              if ($total_kw == '') {                    
                      //echo '0'; 
                  echo "0";
                  } else {
                      //echo $total_kw; 
                  echo $total_kw;
                  };
              

$tahun = date('Y');
$sql_p = "SELECT * FROM pagu WHERE tahun = '$tahun'";
$tampil_p = mysqli_query($koneksi, $sql_p);     
$data_p = mysqli_fetch_array($tampil_p);

 
/*
if ($pagu == 'dalam_kota') {
    $pagu_hasil =  $data_p['pagu_dk_akhir']+$total_kw;
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}elseif ($pagu == 'luar_kota') {

    $pagu_hasil =  $data_p['pagu_lk_akhir']+$total_kw;
	$sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_dalam_kota') {
    $pagu_hasil =  $data_p['pagu_dk_kdh_akhir']+$total_kw;
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_kdh_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_luar_kota') {
    $pagu_hasil =  $data_p['pagu_lk_kdh_akhir']+$total_kw;
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_kdh_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}*/


    //$sql=mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$barang', merek = '$merek' WHERE id_barang = '$id_barang'");
    
    if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=kwitansi'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=kwitansi'; </script>";
	}

?>