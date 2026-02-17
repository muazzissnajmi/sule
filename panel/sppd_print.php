<?php //include 'session.php' ?>
<style type="text/css">
  @page { 
        /*size: landscape;*/
    }
  .tr, td {
    font-family: sans-serif;
    font-size: 11px;
    color: #444;
  }
    .border1 {
        border-width: 1px;
        border-style: solid;
        border-top-color: #8c8c8c;
        border-bottom-color: #8c8c8c;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .border2 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: #8c8c8c;
        border-left-color: transparent;
        border-right-color: transparent;
    }
     .border3 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
     .border4 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: #8c8c8c;
    }
     .border5 {
        border-width: 1px;
        border-style: solid;
        border-top-color: #8c8c8c;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .border6 {
        border-width: 1px;
        border-style: solid;
        border-top-color: #8c8c8c;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: #8c8c8c;
    }
    .table2 {
        border-width: 1px;
        border-style: solid;
        border-top-color: #ffffff;
        border-bottom-color: #ffffff;
        border-left-color: #ffffff;
        border-right-color: #ffffff;
    }
 </style>
 <style type="text/css">
/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        /*background-color: #FAFAFA;
        font: 12pt "Tahoma";*/
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 330mm;
        min-height: 210mm;
        padding: 5mm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 1px white solid;
        height: 220mm;
        /*outline: 2cm #FFEAEA solid;*/
    }
    
    @page {
        size: F4;
        margin: 0;
        size: landscape;
    }
    @media print {
        html, body {
            width: 330mm;
            height: 210mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>
<?php

include "../koneksi/koneksi.php";

$id_spd =  addslashes($_GET['id']);
//$no_spt = addslashes($_POST['no_spt']);
$sql = "SELECT * FROM spd INNER JOIN spt ON spd.id_spt=spt.id_spt INNER JOIN kota on spd.id_kota_tujuan=kota.id_kota WHERE id_spd='$id_spd'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);

$berwenang = $data['berwenang'];
$id_spt = $data['id_spt'];
$id_kota_tujuan = $data['id_kota_tujuan'];
$tiba_di_1 = $data['tiba_di_1'];
$berangkat_dari_1 = $data['berangkat_dari_1'];
$ke_1 = $data['ke_1'];

$tiba_di_2 = $data['tiba_di_2'];
$berangkat_dari_2 = $data['berangkat_dari_2'];
$ke_2 = $data['ke_2'];

$tiba_di_3 = $data['tiba_di_3'];
$berangkat_dari_3 = $data['berangkat_dari_3'];
$ke_3 = $data['ke_3'];

/* konversi NIP */
function konversi_nip($nipk, $batas = " ") {
    $nipk = trim($nipk," ");
    $panjang = strlen($nipk);
     
    if($panjang == 18) {
        $sub[] = substr($nipk, 0, 8); // tanggal lahir
        $sub[] = substr($nipk, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nipk, 14, 1); // jenis kelamin
        $sub[] = substr($nipk, 15, 3); // nomor urut
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2].$batas.$sub[3];
    
    } else {
        return $nipk;
    }
}
 
// Contoh penggunaan fungsi
// konversi nip 18 digit
// hasil: 19700518 200503 1 005
//echo konversi_nip("196102151992031002");
//echo "<br/>";

/* konversi tanggal */
function tgl_indo($tgl_spd){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tgl_spd);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
}


/* TERBILANG */
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }
 

?>
<script>
    window.print();


</script>



<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE REPORT SPD </title>
<link href="../img/logo_.png" rel='shortcut icon'>
<link rel="stylesheet" href="../css/report.css" />
</head>
<body>

<!--<link rel="stylesheet" href="../css/bootstrap.min.css" />-->


<div id="content">

<div class="container-fluid">
  
 
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        
        <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">           
                        
            <div class="widget-content nopadding">
              <center>
        <?php 
        $sql1 = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip where no_spt = '$id_spt'";
                  $tampil1 = mysqli_query($koneksi, $sql1);     
                  while($data1 = mysqli_fetch_array($tampil1)){
        ?>
  <div class="book">
    <div class="page">
        <div class="subpage">

        <table class="table2">
          <tr>
            <td valign="top">
            <table class="table1" border="0" rules="all"  style="width: 580px;">
              <thead>
                <tr class="border3">
                  <td colspan="8"><center><img src="../img/kops_surat.jpg" width="500px"></center></td>
                  <tr class="border3">
                  <td colspan="8"><hr style="border:0; border-top: 3px double #8c8c8c;"></td>
                </tr>
                </tr>
              </thead>
              <tbody>                
                <!--<tr class="border3">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td align="right">Lembaran Ke</td>
                  <td>:</td>
                  <td></td>-->
                </tr>
                <tr class="border3">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td align="right">Kode No</td>
                  <td>:</td>
                  <td>000.1.2</td>
                </tr>
                <tr class="border3">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td align="right">Nomor</td>
                  <td>:</td>
                  <td>..........................................</td>
                </tr>
                 <tr class="border3">
                  <td colspan="8" height="10px"></td>
                </tr>
                <tr class="border3">
                  <td colspan="8">
                    <center>
                      <strong>
                        <font size="3px"><u>SURAT PERJALANAN DINAS</U></font><br>
                       (S P D)
                      </strong>
                    </center>
                  </td>
                </tr>
                <tr>
                  <td class="border3" colspan="8" height="20px"></td>
                </tr>
                <tr>
                  <td class="border1" align="right" valign="top" width="20px">1.</td>
                  <td colspan="3" style="width: 950px;">Pejabat Pembuat Komitmen</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3" style="width: 1000px;"><!--<?php echo $data['memberi_perintah']; ?>-->Sekretaris Daerah</td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">2.</td>
                  <td colspan="3">Nama/Nip Pegawai yang melaksanakan Perjalanan Dinas</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3" valign="top"><b><?php echo $data1['nama']; ?></b></td>
                </tr>               
                <tr>
                  <td class="border2" align="right" valign="top">3.</td>
                  <td colspan="3">a. Pangkat dan Golongan Menurut</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3">
                    <?php if ($data1['pangkat'] == '') { echo "-"; }else{ ?>                    
                    <?php echo $data1['pangkat']; ?> / <?php echo $data1['golongan']; ?><?php }?>                      
                    </td>
                </tr>
                 <tr>
                  <td class="border2"></td>                  
                  <td colspan="3" valign="top">b. Jabatan/Instansi</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo ucfirst($data1['jabatan']); ?> / <?php echo $data['instansi']; ?></td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">c. Tingkat Pembayaran Perjalanan Dinas</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3"></td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">4.</td>
                  <td colspan="3" valign="top">Maksud Pejalanan Dinas</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3" align="justify">
                    <?php if ($data['keterangan'] == '') {?>
                      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <?php }else{ ?>
                    
                    <?php
                    // Get the content from $data['dasar_penugasan']
                    $content = $data['keterangan'];
                    
                    // Check if the content contains "#"
                    if (strpos($content, '#') !== false) {
                        // Split the content into an array using "#" as the delimiter
                        $listItems = explode('#', $content);
                    
                        // Remove any empty elements from the array
                        $listItems = array_filter($listItems);
                    
                        // Output the numbered list
                        echo '<ol style="padding-left:10px">';
                        foreach ($listItems as $item) {
                            echo '<li>' . trim($item) . '</li>';
                        }
                        echo '</ol>';
                    } else {
                        // If there is no "#" symbol, just output the content as is
                        echo $content;
                    }
                    }
                    ?>
                    
                    </td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">5.</td>
                  <td colspan="3">Alat Angkut yang dipergunakan</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3">
                    <?php 
                      $sql_ = "SELECT * FROM spd_transportasi WHERE no_spd='$id_spd'";
                      $tampil_ = mysqli_query($koneksi, $sql_);     
                      while ($data_ = mysqli_fetch_array($tampil_)){

                      echo $data_['transportasi'].". "; 
                      }
                      ?>
                  </td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">6.</td>
                  <td colspan="3">a. Tempat Berangkat</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['asal']; ?></td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3" valign="top">b. Tempat Tujuan</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3">
                    <?php echo $data['kota']; ?><br>
                    
                  <!--<?php
                    $sql_1 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_1]'";
                    $tampil_1 = mysqli_query($koneksi, $sql_1);     
                    $data_1 = mysqli_fetch_array($tampil_1)
                  ?>
                    - <?php echo $data_1['kota']; ?><br>-->

                  <?php
                    $sql_2 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_2]'";
                    $tampil_2 = mysqli_query($koneksi, $sql_2);     
                    $data_2 = mysqli_fetch_array($tampil_2)
                  ?>
                    <?php 
                    if ($data_2['kota'] == '') {
                      
                    }else{
                    echo $data_2['kota']."<br>"; }?>

                  <?php
                    $sql_3 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_3]'";
                    $tampil_3 = mysqli_query($koneksi, $sql_3);     
                    $data_3 = mysqli_fetch_array($tampil_3)
                  ?>
                    <?php 
                    if ($data_3['kota'] == '') {
                      
                    }else{
                    echo $data_3['kota']."<br>"; }?>

                  </td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">7.</td>
                  <td colspan="3">a. Lamanya Pejalanan Dinas</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['lama_perjalanan']; ?> (<?php echo terbilang($data['lama_perjalanan']); ?>) Hari</td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">b. Tanggal Berangkat</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo tgl_indo($data['tgl_berangkat']); ?></td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">c. Tanggal Kembali</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo tgl_indo($data['tgl_kembali']); ?></td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">8.</td>
                  <td colspan="3" valign="top">Pengikut</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3">
                    <?php 
                      $sql2 = "SELECT * FROM pegawai INNER JOIN pengikut ON pegawai.nip=pengikut.pengikut WHERE no_spt='$data[no_spt]'";
                      $tampil2 = mysqli_query($koneksi, $sql2);     
                      $no=1;
                      while ($data2 = mysqli_fetch_array($tampil2))
                      {

                      echo $no++.". ".$data2['nama']."<br>"; 
                      //echo $no++.". ".$data2['nama']." (".$data2['golongan']." | ".$data2['jabatan'].")<br>"; 
                      }
                      ?>
                  </td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">9.</td>
                  <td colspan="3">Pembebanan Anggaran</td>
                  <td class="border1" ></td>
                  <td class="border1"  colspan="3"></td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">a. Instansi</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo ucfirst($data['instansi']); ?></td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">b. Mata Anggaran</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['mata_anggaran']; ?></td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">10.</td>
                  <td colspan="3">Keterangan Lain-lain</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1"  colspan="3"><?php echo $data['keterangan_spd']; ?></td>
                </tr>
                <tr>
                  <td class="border3" colspan="8" height="5px"></td>
                </tr>
                <tr>
                  <td class="border3" colspan="5"></td>
                  <td class="border3">Dikeluarkan di</td>
                  <td class="border3">:</td>
                  <td class="border3"><?php echo $data['asal']; ?></td>
                </tr>
                <tr>
                  <td class="border3" colspan="5"></td>
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3">:</td>
                  <td class="border3"><?php echo tgl_indo($data['tgl_spd']); ?></td>
                </tr>
                <tr>
                  <td class="border3" colspan="5"></td>
                  <td class="border3" colspan="3">Pejabat Yang Berwenang</td>
                </tr>
                <tr>                  
                  <td colspan="5" class="border3"></td>                  
                  <td colspan="3" class="border3"></td>
                </tr>
                <tr>                  
                  <td colspan="5" class="border3"></td>                  
                  <td colspan="3" class="border3">
                    <?php
                    $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$data[berwenang]'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    $data_ttd = mysqli_fetch_array($tampil_ttd);

                    $sql_ttds = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$data[ttd]'";
                    $tampil_ttds = mysqli_query($koneksi, $sql_ttds);     
                    $data_ttds = mysqli_fetch_array($tampil_ttds);
                    
                  ?>    
                      
                    <center>
                      <!--<b>a.n BUPATI BIREUEN<br>-->
                      <?php if ($data_ttd['jabatan'] == 'BUPATI BIREUEN') {  
                      echo ucfirst($data_ttds['jabatan']); ?></b>
                    </center>
                  </td>
                </tr>                
                <tr>
                  <td colspan="5" class="border3" height="40px"></td>
                  <td colspan="3" class="border3"></td>
                </tr>
                <tr>
                  <td colspan="5" class="border3"></td>
                  <td colspan="3" class="border3">
                    <center>
                      <b><?php echo ucfirst($data_ttds['nama']); ?></b><br>
                      <?php echo ucfirst($data_ttds['pangkat']); ?><br>
                      Nip. <?php echo konversi_nip($data_ttds['nip']); ?>
                    </center>
                  </td>

                  <?php }elseif ($data_ttd['jabatan'] == 'WAKIL BUPATI BIREUEN') {  
                      echo ucfirst($data_ttds['jabatan']); ?></b>
                    </center>
                  </td>
                </tr>                
                <tr>
                  <td colspan="5" class="border3" height="40px"></td>
                  <td colspan="3" class="border3"></td>
                </tr>
                <tr>
                  <td colspan="5" class="border3"></td>
                  <td colspan="3" class="border3">
                    <center>
                      <b><?php echo ucfirst($data_ttds['nama']); ?></b><br>
                      <?php echo ucfirst($data_ttds['pangkat']); ?><br>
                      Nip. <?php echo konversi_nip($data_ttds['nip']); ?>
                    </center>
                  </td>

                  <?php }elseif ($data['ttd_ub'] == '') {  
                      echo ucfirst($data_ttd['jabatan']); ?></b>
                    </center>
                  </td>
                </tr>                
                <tr>
                  <td colspan="5" class="border3" height="40px"></td>
                  <td colspan="3" class="border3"></td>
                </tr>
                <tr>
                  <td colspan="5" class="border3"></td>
                  <td colspan="3" class="border3">
                    <center>
                      <b><?php echo ucfirst($data_ttd['nama']); ?></b><br>
                      <?php echo ucfirst($data_ttd['pangkat']); ?><br>
                      <?php if (strlen($data_ttd['nip']) < 18){
                          echo '';
                      }else{
                          echo 'Nip. '.konversi_nip($data_ttd['nip']).' ';
                      }
                      ?>
                      
                    </center>
                  </td>

                  <?php }else{ ?><?php echo ucfirst($data_ttd['jabatan']); ?><br>u.b<br>
                  <?php 
                  $sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$data[ttd_ub]'";
                    $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                    $data_tt = mysqli_fetch_array($tampil_tt);
                  ?>
                  <?php echo ucfirst($data_tt['jabatan']); ?>
                  </center>
                  </td>
                </tr>                
                <tr>
                  <td colspan="5" class="border3" height="40px"></td>
                  <td colspan="3" class="border3"></td>
                </tr>
                <tr>
                  <td colspan="5" class="border3"></td>
                  <td colspan="3" class="border3">
                    <center>
                      <b><?php echo ucfirst($data_tt['nama']); ?></b><br>
                      <?php echo ucfirst($data_tt['pangkat']); ?><br>
                      <?php if (strlen($data_tt['nip']) < 18){
                          echo '';
                      }else{
                          echo 'Nip. '.konversi_nip($data_tt['nip']).' ';
                      }
                      ?>
                    </center>
                  </td>
                  <?php } ?>
                </tr>
              </tbody>
            </table>
            </td>
            <td width="30px"></td>

            <td>
            <table class="table1" border="1" rules="all">
              <!--<thead>
                <tr class="border3">
                  <td colspan="9"><center><img src="../img/kops_surat.jpg" width="800px"></center></td>
                  <tr class="border3">
                  <td colspan="9"><hr style="border:0; border-top: 3px double #8c8c8c;"></td>
                </tr>
                </tr>
              </thead>-->
              <tbody>
                <tr>
                  <td class="border5" colspan="9"></td>
                </tr>
                <tr>
                  <td class="border5" width="25px" align="right" valign="top">I.</td>
                  <td class="border5" width="100px"></td>
                  <td class="border5" width="10px"></td>
                  <td class="border6" width="170px"></td>
                  <td class="border5"></td>
                  <td class="border5" width="120px" valign="top">Berangkat Dari</td>
                  <td class="border5" width="10px" valign="top">:</td>
                  <td class="border5" width="150px" valign="top"><?php echo $data['asal']; ?></td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border4"></td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">Ke</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"><?php echo $data['kota']; ?></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border3" colspan="3"></td>
                  <td class="border4"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">Pada Tanggal</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"><?php echo tgl_indo($data['tgl_berangkat']); ?></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border2" colspan="3" height="75px"></td>
                  <td></td>
                  <td class="border2" colspan="5"></td>
                </tr>
                <tr>
                  <td class="border5" align="right" valign="top">II.</td>
                  <td class="border5" valign="top">Tiba di</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border4" valign="top">
                  <?php echo $data['kota']; ?></td>
                  <td class="border5"></td>
                  <td class="border5" valign="top">Berangkat Dari</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border5" valign="top">
                  <?php echo $data['kota']; ?>
                  </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5" valign="top">Pada Tanggal</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border4" valign="top">
                  <?php echo tgl_indo($data['tgl_berangkat']); ?></td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">Ke</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top">                  
                  <?php
                    $sql_2 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_2]'";
                    $tampil_2 = mysqli_query($koneksi, $sql_2);     
                    $data_2 = mysqli_fetch_array($tampil_2);

                    if ($data_2['kota'] == '') {
                      echo $data['asal'];
                    }else{
                  ?>
                  <?php echo $data_2['kota']; }?>
                  </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">Pada Tanggal</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top">
                  <?php 
                    if ($data_2['kota'] == '') { 
                        echo tgl_indo($data['tgl_kembali']);
                    }else{ } ?></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="3" height="75px"></td>
                  <td></td>
                  <td class="border1" colspan="5"></td>
                </tr>
                <tr>
                  <td class="border5" align="right" valign="top">III.</td>
                  <td class="border5" valign="top">Tiba di</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border4" valign="top">                  
                  <?php echo $data_2['kota']; ?>
                  </td>
                  <td class="border5"></td>
                  <td class="border5" valign="top">Berangkat Dari</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border5" valign="top"><?php echo $data_2['kota']; ?>
                  </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5" valign="top">Pada Tanggal</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border4" valign="top">
                  <?php 
                  if ($data['pada_tgl_2'] == '') {                      
                    }else{
                    echo tgl_indo($data['pada_tgl_2']);} ?></td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">Ke</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top">
                  <?php
                    $sql_3 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_3]'";
                    $tampil_3 = mysqli_query($koneksi, $sql_3);     
                    $data_3 = mysqli_fetch_array($tampil_3);

                    if ($data_2['kota'] == '') {
                      
                    }elseif ($data_3['kota'] == '') {
                      echo $data['asal'];
                    }else{
                  ?>
                  <?php echo $data_3['kota']; }?>
                  </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">Pada Tanggal</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top">
                  <?php 
                    if ($data_2['kota'] == '') { 
                         
                    }elseif ($data_3['kota'] == '') { 
                         echo tgl_indo($data['tgl_kembali']);
                    }else{  } ?></td></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="3" height="75px"></td>
                  <td></td>
                  <td class="border1" colspan="5"></td>
                </tr>
                <tr>
                  <td class="border5" align="right" valign="top">IV.</td>
                  <td class="border5" valign="top">Tiba di</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border4" valign="top">                  
                  <?php echo $data_3['kota']; ?>
                  </td>
                  <td class="border5"></td>
                  <td class="border5" valign="top">Berangkat Dari</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border5" valign="top">
                  <?php echo $data_3['kota']; ?>
                  </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5" valign="top">Pada Tanggal</td>
                  <td class="border5" valign="top">:</td>
                  <td class="border4" valign="top">
                  <?php 
                    if ($data['pada_tgl_3'] == '') {                      
                    }else{
                    echo tgl_indo($data['pada_tgl_3']);} ?></td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">Ke</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top">
                    <?php 
                    if ($data_3['kota'] == '') {
                      
                    }else{echo $data['asal'];}
                    ?>
                  
                  </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">Pada Tanggal</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top">
                  <?php 
                    if ($data_3['kota'] == '') { 
                       
                    }else{ echo tgl_indo($data['tgl_kembali']);} ?></td></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="3" height="75px"></td>
                  <td></td>
                  <td class="border1" colspan="5"></td>
                </tr>
                <?php if ($data['ttd'] == '') { ?>
                <tr>
                  <td class="border3" align="right" valign="top">V.</td>                 
                  <td class="border3" valign="top">Tiba Kembali di</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"><?php echo $data['asal']; ?></td>                  
                  <td class="border3" colspan="4"><!--<center><b>a.n BUPATI BIREUEN</b></center>--></td>                
                </tr>
                <tr> 
                  <td class="border3"></td>                   
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"><?php if($data['tgl_kembali_print'] == NULL){ 
                    echo tgl_indo($data['tgl_kembali']); 
                                  }else{
                    echo tgl_indo($data['tgl_kembali_print']); 
                    }
                  
                  ?></td>
                  <td class="border3"></td>
                  <td class="border3" colspan="5"><!--<center><b><?php echo ucfirst($data_ttd['jabatan']); ?></b></center>--></td>               
                </tr>
                <tr>
                  <td class="border3"></td>  
                  <td class="border3" colspan="4" align="justify">
                    Telah diperiksa, dengan keterangan bahwa 
                    Perjalanan tersebut di atas benar dilakukan atas 
                    Perintahnya dan semata-mata untuk kepentingan
                    Jabatan dalam waktu yang sesingkat-singkatnya
                  </td>  
                   <td class="border3" colspan="5" height="30px" valign="bottom">
                     <!--<center>
                      <b><?php echo ucfirst($data_ttd['nama']); ?></b><br>
                      <?php echo ucfirst($data_ttd['pangkat']); ?><br>
                      Nip. <?php echo konversi_nip($data_ttd['nip']); ?>
                    </center>-->
                   </td>        
                </tr>
              <?php }else{ ?>
                 <tr>
                  <td class="border3" align="right" valign="top">V.</td>                 
                  <td class="border3" valign="top">Tiba Kembali di</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"><?php echo $data['asal']; ?></td>
                  <td class="border3" colspan="4"><!--<center><b>a.n BUPATI BIREUEN</b>--></td>                
                </tr>
                <tr> 
                  <td class="border3"></td>                   
                  <td class="border3" valign="top">Pada Tanggal</td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"><?php if($data['tgl_kembali_print'] == NULL){ 
                    echo tgl_indo($data['tgl_kembali']); 
                                  }else{
                    echo tgl_indo($data['tgl_kembali_print']); 
                    }
                  
                  ?></td>
                  <td class="border3"></td>
                  <td class="border3" colspan="5"><!--<center>
                  <b><?php echo ucfirst($data_ttd['jabatan']); ?></b><br>u.b<br>
                    <?php 
                  $sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$data[ttd]'";
                    $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                    $data_tt = mysqli_fetch_array($tampil_tt);
                  ?>
                  <b><?php echo ucfirst($data_tt['jabatan']); ?></b>
                  </center>--></td>               
                </tr>
                <tr>
                  <td class="border3"></td>  
                  <td class="border3" colspan="4" align="justify" valign="top">
                    Telah diperiksa, dengan keterangan bahwa 
                    Perjalanan tersebut di atas benar dilakukan atas 
                    Perintahnya dan semata-mata untuk kepentingan
                    Jabatan dalam waktu yang sesingkat-singkatnya
                  </td>  
                   <td class="border3" colspan="5" valign="bottom">
                    <!-- <center>
                      <b><?php echo ucfirst($data_tt['nama']); ?></b><br>
                      <?php echo ucfirst($data_tt['pangkat']); ?><br>
                      Nip. <?php echo konversi_nip($data_tt['nip']); ?>
                    </center>-->
                   </td>        
                </tr>
                <?php } ?>
                <tr>
                  <td class="border2" colspan="9" align="right"></td>                  
                </tr>
                <tr>
                  <td class="border1" align="right">VI.</td>
                  <td class="border1" colspan="8">CATATAN LAIN-LAIN</td>
                </tr>
                <tr>
                  <td class="border3" align="right" valign="top">VII.</td>
                  <td class="border3" colspan="8" align="justify">
                    Pejabat yang berwenang menerbitkan SPD, pegawai yang melakukan Perjalanan Dinas, Para pejabat yang mengesahkan tanggal berangkat/tiba serta Bendaharawan, bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara, apabila Negara menderita rugi akibat kesalahan, kelalaian dan kealpaannya.
                  </td>
                </tr>
              </tbody>  
            </table>
            
            </td>
          </tr>

        </table>
      </div>
    </div>
  </div>

      <?php }?>
            </center>
          </div>

        </div>
      </div>      
    </div>    
  </div>
 </form>
</div></div>


</body>
</html>