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
$total_kw = addslashes($_POST['total_kw']);




$sql_cek = "SELECT * FROM spd WHERE id_spd='$id_spd'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);     
$data_cek = mysqli_fetch_array($tampil_cek);

    
    $sql = mysqli_query($koneksi, "UPDATE kwitansi SET tgl_kw = '$tgl_kw', kode_rek = '$kode_rek', pagu = '$pagu', tahun = '$tahun', pengguna = '$pengguna', bendahara = '$bendahara' WHERE id_spt = '$id_spt'");

    
    foreach ($_POST['no_spd'] as $e => $no_spd) {
        $no_spd;
        $nip1 = $_POST['penerima1'][$e];        
       $sql_spd = mysqli_query($koneksi, "UPDATE kwitansi SET no_spd = '$no_spd' WHERE nip = '$nip1' AND id_spt = '$id_spt'");
    }
    $total3=0;
    $total=0;
    
    foreach ($_POST['spt2'] as $f => $spt2_) {
        
        $id_nilai = $_POST['id_nilai'][$f];        
        $nip3 = $_POST['penerima2'][$f];        
        $kategori3 = $_POST['kategori2'][$f];
        $nominal_lama = $_POST['nominal_lama'][$f];     
        //echo "<br>";  
        $nominal3 = $_POST['nominal2'][$f];    
        //echo "<br>";   
        $hari3 = $_POST['hari2'][$f];       
        $k_hari3 = $_POST['k_hari2'][$f];        
        $ket3 = $_POST['ket2'][$f];
        
       

        if ($hari3  == '0') {
            $hari4 = $hari3+1;
        }else{
            $hari4 = $hari3 ;
        }

        $nilai3 = $nominal3 * $hari4;
        $total3+=$nilai3;
        
    $sql_kw3 = mysqli_query($koneksi, "UPDATE kwitansi_nilai SET kategori = '$kategori3', nominal = '$nominal3', hari = '$hari3', k_hari = '$k_hari3', ket = '$ket3' WHERE id_nilai = '$id_nilai'");
        
            
    }
    $total3; 

    //Tambah Item Kwitansi//
    foreach ($_POST['spt'] as $i => $spt) {
        
        
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
    $total_lm = $total+$total3;
    //echo "<br>";
    $sql2 = mysqli_query($koneksi, "UPDATE spt SET cek_spt = 'O' WHERE id_spt = '$id_spt'");
    

    $sql2 = "SELECT SUM(jumlah)as jumlah FROM kwitansi WHERE pagu = '$pagu'";
    $tampil2 = mysqli_query($koneksi, $sql2);
	while ($data2 = mysqli_fetch_array($tampil2)) { 
	$jumlah =$data2['jumlah'];
	}

    if($total_lm >= $total_kw){
        //$total_lm = $total+$total3;
        echo $total_pagu= $total_lm-$total_kw;
    }elseif($total_lm <= $total_kw){
        //$total_lm = $total3+$total;
        echo $total_pagu= $total_kw-$total_lm;
    }

    //echo $total_pagu=$total+$total3;
    //echo "<br>";
    //echo $total_kw;
    //echo "<br>";
    

$tahun = date('Y');
$sql_p = "SELECT * FROM pagu WHERE tahun = '$tahun'";
$tampil_p = mysqli_query($koneksi, $sql_p);     
$data_p = mysqli_fetch_array($tampil_p);

    //echo $data_p['pagu_lk_akhir'];
    //echo "<br>";

if ($pagu == 'dalam_kota') {

    if($total_kw >= $total_lm){
        $pagu_hasil =  $data_p['pagu_dk_akhir']-$total_pagu;
    }elseif($total_kw <= $total_lm){
         $pagu_hasil =  $data_p['pagu_dk_akhir']+$total_pagu;
    }

    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}elseif ($pagu == 'luar_kota') {

    if($total_kw >= $total_lm){
        $pagu_hasil =  $data_p['pagu_lk_akhir']-$total_pagu;
    }elseif($total_kw <= $total_lm){
         $pagu_hasil =  $data_p['pagu_lk_akhir']+$total_pagu;
    }
	       
	$sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_dalam_kota') {
    
    if($total_kw >= $total_lm){
        $pagu_hasil =  $data_p['pagu_dk_kdh_akhir']-$total_pagu;
    }elseif($total_kw <= $total_lm){
         $pagu_hasil =  $data_p['pagu_dk_kdh_akhir']+$total_pagu;
    }

    $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_dk_kdh_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}elseif ($pagu == 'kdh_luar_kota') {
    
    if($total_kw >= $total_lm){
        $pagu_hasil =  $data_p['pagu_lk_kdh_akhir']-$total_pagu;
    }elseif($total_kw <= $total_lm){
         $pagu_hasil =  $data_p['pagu_lk_kdh_akhir']+$total_pagu;
    }

   $sql_pu= mysqli_query($koneksi, "UPDATE pagu SET pagu_lk_kdh_akhir = '$pagu_hasil' WHERE tahun = '$tahun'");

}


    //$sql=mysqli_query($koneksi, "UPDATE barang SET nama_barang = '$barang', merek = '$merek' WHERE id_barang = '$id_barang'");
    
    if ($sql){
    	echo "<script type='text/javascript'> document.location = '?page=kwe&id=$id_spt&msg=1'; </script>";
	}else{
		echo "<script type='text/javascript'> document.location = '?page=kwe&id=$id_spt&msg=2'; </script>";
	}

?>