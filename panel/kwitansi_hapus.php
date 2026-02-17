<?php //include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
	$id = $_GET['id'];
	$sql_kw = "SELECT * FROM kwitansi WHERE id_spt = '$id'";
                  $tampil_kw = mysqli_query($koneksi, $sql_kw);
                  $data_kw = mysqli_fetch_array($tampil_kw);
                  $pagu = $data_kw['pagu'];
                  $tahun = $data_kw['tahun'];

	$sql_kw2 = "SELECT * FROM kwitansi_nilai WHERE id_spt = '$id'";
                  $tampil_kw2 = mysqli_query($koneksi, $sql_kw2);
                  $total= 0;
                  while($data_kw2 = mysqli_fetch_array($tampil_kw2)){
                  $hari = $data_kw2['hari'];
                  
                  if ($data_kw2['hari'] == '0') {
                    $hari2 = $data_kw2['hari']+1;
                  }else{
                    $hari2 = $data_kw2['hari'];
                  }

                  $nilai = $data_kw2['nominal'] * $hari2;

                  $total+=$nilai;
                  
                  }
                  $total;


$sql_p = "SELECT * FROM pagu WHERE tahun = '$tahun'";
$tampil_p = mysqli_query($koneksi, $sql_p);     
$data_p = mysqli_fetch_array($tampil_p);


if ($pagu == 'dalam_kota') {

    $total_nilai = $data_p['pagu_dk_akhir'] - $total;
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}elseif ($pagu == 'luar_kota') {
	echo $total_nilai = $data_p['pagu_lk_akhir'] - $total;
	$sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_dalam_kota') {
    $total_nilai = $data_p['pagu_dk_kdh_akhir'] - $total;
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_kdh_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_luar_kota') {
    $total_nilai = $data_p['pagu_lk_kdh_akhir'] - $total;
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_kdh_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}

	$sql = mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'O' WHERE id_spt = '$id'");
	$sql2 = mysqli_query($koneksi, "DELETE FROM kwitansi WHERE id_spt = '$id'");
	$sql4 = mysqli_query($koneksi, "DELETE FROM kwitansi_nilai WHERE id_spt = '$id'");
	$sql4 = mysqli_query($koneksi, "DELETE FROM lpd WHERE id_spt = '$id'");

	echo "<script type='text/javascript'> document.location = '?page=kwitansi&msg=1'; </script>";

?>
