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
$penerima = addslashes($_POST['penerima']);
$bendahara = addslashes($_POST['bendahara']);
//$nip = $_POST['pengguna_anggaran'];



$sql_cek = "SELECT * FROM spd WHERE id_spd='$id_spd'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);     
$data_cek = mysqli_fetch_array($tampil_cek);
//$id_spt = $data_cek['id_spt'];
    
    $sql = mysqli_query($koneksi, "UPDATE kwitansi SET tgl_kw = '$tgl_kw', kode_rek = '$kode_rek', pagu = '$pagu', tahun = '$tahun', penerima = '$penerima', bendahara = '$bendahara', kunci = 'N' WHERE id_spt = '$id_spt'");

    /*$sql = mysqli_query($koneksi, "UPDATE kwitansi SET no_kw = '$no_kw', tgl_kw = '$tgl_kw', kode_rek = '$kode_rek', pagu = '$pagu', tahun = '$tahun', keterangan = '$keterangan', penerima = '$penerima', bendahara = '$bendahara', pengguna = '$pengguna_anggaran', penginapan = '$penginapan', penginapan_hari = '$penginapan_hari', saku = '$saku', saku_hari = '$saku_hari', makan = '$makan', makan_hari = '$makan_hari', transport_lokal = '$transport_lokal', transport_lokal_hari = '$transport_lokal_hari', transport_pp = '$transport_pp', transport_pp_hari ='$transport_pp_hari', bbm = '$bbm', bbm_hari = '$bbm_hari', bbm_pp = '$bbm_pp', bbm_pp_hari = '$bbm_pp_hari', jumlah = '$jumlah', kunci = 'Y' WHERE id_kw = '$id_kw'");*/

    foreach ($_POST['pengguna_anggaran'] as $i => $nip) {
        //echo $nip;

        $penginapan = $_POST['penginapan'][$i];
        $penginapan_hari = $_POST['penginapan_hari'][$i];

        $saku = $_POST['saku'][$i];
        $saku_hari = $_POST['saku_hari'][$i];

        $makan = $_POST['makan'][$i];
        $makan_hari = $_POST['makan_hari'][$i];

        $transport_lokal = $_POST['transport_lokal'][$i];
        $transport_lokal_hari = $_POST['transport_lokal_hari'][$i];

        $transport_pp = $_POST['transport_pp'][$i];
        $transport_pp_hari = $_POST['transport_pp_hari'][$i];

        $transport_pesawat = $_POST['transport_pesawat'][$i];
        $transport_pesawat_hari = $_POST['transport_pesawat_hari'][$i];

        $transport_bus = $_POST['transport_bus'][$i];
        $transport_bus_hari = $_POST['transport_bus_hari'][$i];

        $bbm = $_POST['bbm'][$i];
        $bbm_hari = $_POST['bbm_hari'][$i];
        $bbm_ket = $_POST['bbm_ket'][$i];

        $bbm_pp = $_POST['bbm_pp'][$i];
        $bbm_pp_hari = $_POST['bbm_pp_hari'][$i];
        $bbm_pp_ket = $_POST['bbm_pp_ket'][$i];

        $jumlah = $penginapan + $saku + $makan + $transport_lokal + $transport_pp + $transport_pesawat + $transport_bus + $bbm + $bbm_pp;
        $total+=$jumlah;
        //$jumlah = $_POST['jumlah'][$i];

        $no_spd = $_POST['no_spd'][$i];
            
            $sql_kw = mysqli_query($koneksi, " INSERT INTO kwitansi_nilai VALUES ('','$id_spt','$nip','$no_spd','$penginapan','$penginapan_hari','$saku','$saku_hari','$makan','$makan_hari','$transport_lokal','$transport_lokal_hari','$transport_pp','$transport_pp_hari','$transport_pesawat','$transport_pesawat_hari','$transport_bus','$transport_bus_hari','$bbm','$bbm_hari','$bbm_ket','$bbm_pp','$bbm_pp_hari','$bbm_pp_ket','$jumlah')");

            /*$sql_kw = mysqli_query($koneksi, " INSERT INTO kwitansi_nilai VALUES ('','$id_spt','$nip_','','','')");*/
    }
    $total;
    
    //$sql1 = mysqli_query($koneksi, "UPDATE spd SET kunci = 'Y' WHERE id_spd = '$id_spd'");
    $sql2 = mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'O' WHERE id_spt = '$id_spt'");

    $sql_lpd = mysqli_query($koneksi, " INSERT INTO lpd VALUES ('','$id_spt','','','N')");

    $sql2 = "SELECT SUM(jumlah)as jumlah FROM kwitansi WHERE pagu = '$pagu'";
    $tampil2 = mysqli_query($koneksi, $sql2);
	while ($data2 = mysqli_fetch_array($tampil2)) { 
	$jumlah =$data2['jumlah'];
	}


$tahun = date('Y');
$sql_p = "SELECT * FROM pagu WHERE tahun = '$tahun'";
$tampil_p = mysqli_query($koneksi, $sql_p);     
$data_p = mysqli_fetch_array($tampil_p);

//$pagu =  $jumlah - $data_p['pagu_dk_awal'];

if ($pagu == 'dalam_kota') {

    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_akhir = '$total' WHERE tahun = '$tahun'");

}elseif ($pagu == 'luar_kota') {
	
	$sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_akhir = '$total' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_dalam_kota') {
    
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_kdh_akhir = '$total' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_luar_kota') {
    
    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_kdh_akhir = '$total' WHERE tahun = '$tahun'");

}


    //$sql=mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$barang', merek = '$merek' WHERE id_barang = '$id_barang'");
    
   if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=kwitansi&id=$id_kw&msg=3'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=kwe&id=$id_kw&msg=2'; </script>";
	}

?>