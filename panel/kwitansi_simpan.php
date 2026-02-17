<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
$id_kw = addslashes($_POST['id_kw']);
$id_spt = addslashes($_POST['id_spt']);
$id_spd = addslashes($_POST['id_spd']);
$no_kw = addslashes($_POST['no_kw']);
$tgl_kw = addslashes($_POST['tgl_kw']);
$kode_rek = addslashes($_POST['kode_rek']);
$pagu = addslashes($_POST['pagu']);
$tahun = addslashes($_POST['tahun']);
$pengguna = addslashes($_POST['pengguna_anggaran']);
$bendahara = addslashes($_POST['bendahara']);


$sql_cek = "SELECT * FROM spd WHERE id_spd='$id_spd'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);     
$data_cek = mysqli_fetch_array($tampil_cek);

    $sql = mysqli_query($koneksi, "UPDATE kwitansi SET tgl_kw = '$tgl_kw', kode_rek = '$kode_rek', pagu = '$pagu', tahun = '$tahun', pengguna = '$pengguna', bendahara = '$bendahara', kunci = 'N' WHERE id_spt = '$id_spt'");


    foreach ($_POST['no_spd'] as $e => $no_spd) {
        $no_spd;
        $nip1 = $_POST['penerima1'][$e];        
       $sql_spd = mysqli_query($koneksi, "UPDATE kwitansi SET no_spd = '$no_spd' WHERE nip = '$nip1' ORDER by id_kw desc LIMIT 1;");
    }
    $total=0;
    foreach ($_POST['spt'] as $i => $spt) {
        //echo $nip;
        
        $nip = $_POST['penerima'][$i];
        $kategori = $_POST['kategori'][$i];
        $nominal = $_POST['nominal'][$i];
        $hari = $_POST['hari'][$i];
        $k_hari = $_POST['k_hari'][$i];
        $ket = $_POST['ket'][$i];

        if ($hari  == '0') {
            $hari2 = $hari+1;
        }else{
            $hari2 = $hari ;
        }

        $nilai = $nominal * $hari2;
        $total+=$nilai;
        
    $sql_kw = mysqli_query($koneksi, "INSERT INTO kwitansi_nilai VALUES (NULL,'$spt','$nip','$kategori','$nominal','$hari','$k_hari','$ket')");
        
            
    }
    $total;
    
    $sql2 = mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'K' WHERE id_spt = '$id_spt'");

    $sql_lpd = mysqli_query($koneksi, " INSERT INTO lpd VALUES (NULL,'$id_spt',NULL,NULL,'N')");

    $sql2 = "SELECT SUM(jumlah)as jumlah FROM kwitansi WHERE pagu = '$pagu'";
    $tampil2 = mysqli_query($koneksi, $sql2);
	while ($data2 = mysqli_fetch_array($tampil2)) { 
	$jumlah =$data2['jumlah'];
	}


$tahun = date('Y');
$sql_p = "SELECT * FROM pagu WHERE tahun = '$tahun'";
$tampil_p = mysqli_query($koneksi, $sql_p);     
$data_p = mysqli_fetch_array($tampil_p);


if ($pagu == 'dalam_kota') {

    echo $total_nilai = $total + $data_p['pagu_dk_akhir'];
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}elseif ($pagu == 'luar_kota') {
	echo $total_nilai =  $total + $data_p['pagu_lk_akhir'];
	$sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_dalam_kota') {
    echo $total_nilai = $total + $data_p['pagu_dk_kdh_akhir'];
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_kdh_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_luar_kota') {
    echo $total_nilai = $total + $data_p['pagu_lk_kdh_akhir'];
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_kdh_akhir = '$total_nilai' WHERE tahun = '$tahun'");

}

    
   if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=kwitansi&id=$id_kw&msg=3'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=kwe&id=$id_kw&msg=2'; </script>";
	}

?>