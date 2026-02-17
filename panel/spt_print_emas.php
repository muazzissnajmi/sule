<?php //include 'session.php' ?> <style type="text/css">
  body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tahoma";
  }

  * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
  }

  .page {
    width: 210mm;
    min-height: 330mm;
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
    height: 285mm;
    /*outline: 2cm #FFEAEA solid;*/
  }

  @page {
    size: F4;
    margin: 0;
    size: portrait;
  }

  @media print {

    html,
    body {
      width: 210mm;
      height: 330mm;
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
</style> <?php

include "../koneksi/koneksi.php";
error_reporting(0);

$id_spt =  addslashes($_GET['id']);
//$sql = "SELECT * FROM spt INNER JOIN pegawai ON spt.berwenang=pegawai.nip WHERE id_spt = $id_spt";
$sql = "SELECT * FROM spt WHERE id_spt = '$id_spt'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
$no_spt = $data['no_spt'];
$tgl_spt = $data['tgl_spt'];
$nd_spt = $data['nd_spt'];
$tgl_nd = $data['tgl_nd'];

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
//echo "
//<br/>";

/* konversi tanggal */
function tgl_indo($tgl_spt){
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
  $pecahkan = explode('-', $tgl_spt);
  
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
    } else if ($nilai 
<20) {
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
    if($nilai
	<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }

?> <script>
  window.print();
</script>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>SULE REPORT SPT 100.3.5/SPT/ <?php echo $data['no_spt']; ?>/ <?php echo substr($data['tgl_spt'],-4);?> </title>
    <link href="../img/logo_.png" rel='shortcut icon'>
  </head>
  <body>
    <!--<link rel="stylesheet" href="../css/bootstrap.min.css" />-->
    <link rel="stylesheet" href="../css/report.css" />
    <div class="book">
      <div class="page">
        <div class="subpage">
          <div id="content" style="
    margin-bottom: 20px;
    height: inherit;
">
            <div class="container-fluid">
              <div class="row-fluid">
                <div class="span12">
                  <div class="widget-box">
                    <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
                      <div class="widget-content nopadding form-horizontal">
                        <div class="widget-content nopadding">
                          <center> <?php
                $sql_ck = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt = '$id_spt'";
                $tampil_ck = mysqli_query($koneksi, $sql_ck);     
                $data_ck = mysqli_fetch_array($tampil_ck);
                $jabatan_ck = $data_ck['jabatan'];

                if ($jabatan_ck == 'BUPATI BIREUEN') {                
              ?> <table class="table1" border="0">
                              <thead>
                                <tr>
                                  <td colspan="7">
                                    <center>
                                      <img src="../img/logo-garuda-emas.jpg" width="138px">
                                    </center>
                                  </td>
                                <tr>
                                  <td colspan="7">
                                    <center>
                                      <strong>
                                        <font size="4px">BUPATI BIREUEN</font>
                                      </strong>
                                    </center>
                                  </td>
                                </tr>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td colspan="7">
                                    <center>
                                      <strong>
                                        <br>
                                        <br> <?php if ($data['no_spt'] == '') {?> <font size="3px">
                                          <u>SURAT TUGAS <?php echo $nd_spt ?> </U>
                                        </font>
                                        <br> NOMOR : 100.3.5/ST/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ <?php echo substr($data['tgl_spt'],-4);?> <br>
                                        <br> <?php }else{?> <font size="3px">
                                          <u>SURAT TUGAS </U>
                                        </font>
                                        <br> NOMOR : 100.3.5/ST/ <?php echo $data['no_spt']; ?>/ <?php echo substr($data['tgl_spt'],-4);?> <br>
                                        <br> <?php }?> </strong>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="span1" width="100px" height="30px" valign="top">Dasar</td>
                                  <td width="10" valign="top">:</td>
                                  <td class="span8" colspan="5" align="justify" valign="top">
                                      <?php
                                        // Get the content from $data['dasar_penugasan']
                                        $content = ucfirst($data['dasar_penugasan']);
                                        
                                        // Check if the content contains "#"
                                        if (strpos($content, '#') !== false) {
                                            // Split the content into an array using "#" as the delimiter
                                            $listItems = explode('#', $content);
                                        
                                            // Remove any empty elements from the array
                                            $listItems = array_filter($listItems);
                                        
                                            // Output the numbered list
                                            echo '<ol style="padding-left:16px">';
                                            foreach ($listItems as $item) {
                                                echo '<li>' . trim($item) . '</li>';
                                            }
                                            echo '</ol>';
                                        } else {
                                            // If there is no "#" symbol, just output the content as is
                                            echo $content;
                                        }
                                        ?>
                                </td>
                                </tr>
                                <tr>
                                  <td colspan="7" height="30px">
                                    <br>
                                    <center>
                                      <strong>MEMERINTAHKAN : </strong>
                                    </center>
                                    <br>
                                  </td>
                                </tr>
                                <tr> <?php

                      $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt= '$data[id_spt]' ORDER BY id_pengikut ";
                      $tampil_ = mysqli_query($koneksi, $sql_);
                      $no=1;
                      $row = mysqli_num_rows($tampil_);
                      $row_ = $row+$row;
                      //$nip2 = $data_['pengikut']; 
                      ?> <td valign="top" rowspan="
																																<?php echo $row_; ?>">Kepada </td>
                                  <td class="span1" valign="top" rowspan="
																																<?php echo $row_; ?>">: </td> <?php 

                      while ($data_ = mysqli_fetch_array($tampil_))

                      {
                  ?>
                                <tr valign="top">
                                  <td valign="top"></td>
                                  <td class="span1" height="60px">Nama <br>Jabatan </td>
                                  <td align="right" height="40px">: <br>: </td>
                                  <td width="" colspan="2" align="justify">
                                    <b> <?php echo ucfirst($data_['nama']); ?> </b>
                                    <br> <?php echo ucfirst($data_['jabatan']); ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr> <?php } ?> </tr>
                                <tr>
                                  <td valign="top">Untuk</td>
                                  <td valign="top">:</td> <?php
                    //echo $id_spt =  addslashes($_GET['id']);
                    $sql_ket = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_ket = mysqli_query($koneksi, $sql_ket);     
                    $data_ket = mysqli_fetch_array($tampil_ket);
                  ?> <td colspan="5" align="justify">
                    <?php
                    // Get the content from $data['dasar_penugasan']
                    $content = ucfirst($data['keterangan']);
                    
                    // Check if the content contains "#"
                    if (strpos($content, '#') !== false) {
                        // Split the content into an array using "#" as the delimiter
                        $listItems = explode('#', $content);
                    
                        // Remove any empty elements from the array
                        $listItems = array_filter($listItems);
                    
                        // Output the numbered list
                        echo '<ol style="padding-left:16px">';
                        foreach ($listItems as $item) {
                            echo '<li>' . trim($item) . '</li>';
                        }
                        echo '</ol>';
                    } else {
                        // If there is no "#" symbol, just output the content as is
                        echo $content;
                    }
                    ?>
                    Selama <?php echo $data_ket['lama_perjalanan']; ?> ( <?php echo terbilang($data_ket['lama_perjalanan']); ?>) Hari terhitung mulai tanggal <?php echo tgl_indo($data_ket['tgl_berangkat']); ?> sampai dengan <?php echo tgl_indo($data_ket['tgl_kembali']); ?> di <?php echo trim($data_ket['kota']);?> <?php if ($data_ket['tiba_di_2'] == '...') {
                    echo ".";
                  }elseif ($data_ket['tiba_di_3'] == '...'){  
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo " dan ". trim($data_tu2['kota'])."."; 
                  }else{
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo ", ". trim($data_tu2['kota']); }?> <?php if ($data_ket['tiba_di_3'] == '...') {
                    
                  }else{ $sql_tu3 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_3=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu3 = mysqli_query($koneksi, $sql_tu3);     
                    $data_tu3 = mysqli_fetch_array($tampil_tu3);
                    echo "dan ". trim($data_tu3['kota'])."."; } ?> </td>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="7" align="justify">
                                    <br>Demikian Surat Tugas ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
                                  </td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td width="200px"></td>
                                  <td colspan="2" class="span3">
                                    <center>
                                      <br> Ditetapkan di Bireuen <br> Pada Tanggal <?php echo tgl_indo($tgl_spt); ?> <br>
                                      <br> <?php
                  $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$data[berwenang]'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    $data_ttd = mysqli_fetch_array($tampil_ttd);

                  if ($data['ttd'] == '') { ?> <b> <?php echo ucfirst($data_ttd['jabatan']); ?> </b>
                                    </center>
                                  </td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td width="100px"></td>
                                  <td colspan="2" height="50px"></td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>
                                    <center>
                                      <b> <?php echo ucfirst($data_ttd['nama']); ?> </b>
                                      <br> <?php echo ucfirst($data_ttd['pangkat']); ?> <br>
                                    </center>
                                  </td> <?php }else{ ?> <b> <?php echo ucfirst($data_ttd['jabatan']); ?> </b>
                                  <br>u.b <br> <?php 
                  $sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$data[ttd]'";
                    $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                    $data_tt = mysqli_fetch_array($tampil_tt);
                  ?> <b> <?php echo ucfirst($data_tt['jabatan']); ?> </b>
                          </center>
                          </td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td width="100px"></td>
                            <td colspan="2" height="50px"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                              <center>
                                <b> <?php echo ucfirst($data_tt['nama']); ?> </b>
                                <br> <?php echo ucfirst($data_tt['pangkat']); ?> <br>
                              </center>
                            </td> <?php } ?>
                          </tr>
                          </tbody>
                          </table> <?php }elseif ($jabatan_ck == 'WAKIL BUPATI BIREUEN') {                
              ?> <table class="table1" border="0">
                            <thead>
                              <tr>
                                <td colspan="7">
                                  <center>
                                    <img src="../img/logo-garuda-emas.jpg" width="138px">
                                  </center>
                                </td>
                              <tr>
                                <td colspan="7">
                                  <center>
                                    <strong>
                                      <font size="4px">BUPATI BIREUEN</font>
                                    </strong>
                                  </center>
                                </td>
                              </tr>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="7">
                                  <center>
                                    <strong>
                                      <br>
                                      <br> <?php if ($data['no_spt'] == '') {?> <font size="3px">
                                        <u>SURAT TUGAS </U>
                                      </font>
                                      <br> NOMOR : 100.3.5/ST/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ <?php echo substr($data['tgl_spt'],-4);?> <br>
                                      <br> <?php }else{?> <font size="3px">
                                        <u>SURAT TUGAS </U>
                                      </font>
                                      <br> NOMOR : 100.3.5/ST/ <?php echo $data['no_spt']; ?>/ <?php echo substr($data['tgl_spt'],-4);?> <br>
                                      <br> <?php }?> </strong>
                                  </center>
                                </td>
                              </tr>
                              <tr>
                                <td class="span1" width="100px" height="30px" valign="top">Dasar</td>
                                <td width="10" valign="top">:</td>
                                <td class="span8" colspan="5" align="justify" valign="top"> 
                                <?php
                                        // Get the content from $data['dasar_penugasan']
                                        $content = ucfirst($data['dasar_penugasan']);
                                        
                                        // Check if the content contains "#"
                                        if (strpos($content, '#') !== false) {
                                            // Split the content into an array using "#" as the delimiter
                                            $listItems = explode('#', $content);
                                        
                                            // Remove any empty elements from the array
                                            $listItems = array_filter($listItems);
                                        
                                            // Output the numbered list
                                            echo '<ol style="padding-left:16px">';
                                            foreach ($listItems as $item) {
                                                echo '<li>' . trim($item) . '</li>';
                                            }
                                            echo '</ol>';
                                        } else {
                                            // If there is no "#" symbol, just output the content as is
                                            echo $content;
                                        }
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="7" height="30px">
                                  <br>
                                  <center>
                                    <strong>MEMERINTAHKAN : </strong>
                                  </center>
                                  <br>
                                </td>
                              </tr>
                              <tr> <?php

                      $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt= '$data[id_spt]' ORDER BY id_pengikut ";
                      $tampil_ = mysqli_query($koneksi, $sql_);
                      $no=1;
                      $row = mysqli_num_rows($tampil_);
                      $row_ = $row+$row;
                      //$nip2 = $data_['pengikut']; 
                      ?> <td valign="top" rowspan="
																																																						<?php echo $row_; ?>">Kepada </td>
                                <td class="span1" valign="top" rowspan="
																																																						<?php echo $row_; ?>">: </td> <?php 

                      while ($data_ = mysqli_fetch_array($tampil_))

                      {
                  ?>
                              <tr valign="top">
                                <td valign="top"></td>
                                <td class="span1" height="60px">Nama <br>Jabatan </td>
                                <td align="right" height="40px">: <br>: </td>
                                <td width="" colspan="2" align="justify">
                                  <b> <?php echo ucfirst($data_['nama']); ?> </b>
                                  <br> <?php echo ucfirst($data_['jabatan']); ?>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr> <?php } ?> </tr>
                              <tr>
                                <td valign="top">Untuk</td>
                                <td valign="top">:</td> <?php
                    //echo $id_spt =  addslashes($_GET['id']);
                    $sql_ket = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_ket = mysqli_query($koneksi, $sql_ket);     
                    $data_ket = mysqli_fetch_array($tampil_ket);
                  ?> <td colspan="5" align="justify">
                    <?php
                    // Get the content from $data['dasar_penugasan']
                    $content = ucfirst($data['keterangan']);
                    
                    // Check if the content contains "#"
                    if (strpos($content, '#') !== false) {
                        // Split the content into an array using "#" as the delimiter
                        $listItems = explode('#', $content);
                    
                        // Remove any empty elements from the array
                        $listItems = array_filter($listItems);
                    
                        // Output the numbered list
                        echo '<ol style="padding-left:16px">';
                        foreach ($listItems as $item) {
                            echo '<li>' . trim($item) . '</li>';
                        }
                        echo '</ol>';
                    } else {
                        // If there is no "#" symbol, just output the content as is
                        echo $content;
                    }
                    ?>
                    Selama <?php echo $data_ket['lama_perjalanan']; ?> ( <?php echo terbilang($data_ket['lama_perjalanan']); ?>) Hari terhitung mulai tanggal <?php echo tgl_indo($data_ket['tgl_berangkat']); ?> sampai dengan <?php echo tgl_indo($data_ket['tgl_kembali']); ?> di <?php echo trim($data_ket['kota']);?> <?php if ($data_ket['tiba_di_2'] == '...') {
                    echo ".";
                  }elseif ($data_ket['tiba_di_3'] == '...'){  
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo " dan ". trim($data_tu2['kota'])."."; 
                  }else{
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo ", ". trim($data_tu2['kota']); }?> <?php if ($data_ket['tiba_di_3'] == '...') {
                    
                  }else{ $sql_tu3 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_3=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu3 = mysqli_query($koneksi, $sql_tu3);     
                    $data_tu3 = mysqli_fetch_array($tampil_tu3);
                    echo "dan ". trim($data_tu3['kota'])."."; } ?> </td>
                              </tr>
                              <tr>
                                <td colspan="7" align="justify">
                                  <br>Demikian Surat Tugas ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="200px"></td>
                                <td colspan="2" class="span3">
                                  <center>
                                    <br> Ditetapkan di Bireuen <br> Pada Tanggal <?php echo tgl_indo($tgl_spt); ?> <br>
                                    <br> <?php
                  $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$data[berwenang]'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    $data_ttd = mysqli_fetch_array($tampil_ttd);

                  if ($data['ttd'] == '') { ?> <b> <?php echo ucfirst($data_ttd['jabatan']); ?> </b>
                                  </center>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="100px"></td>
                                <td colspan="2" height="50px"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <center>
                                    <b> <?php echo ucfirst($data_ttd['nama']); ?> </b>
                                    <br> <?php echo ucfirst($data_ttd['pangkat']); ?>
                                  </center>
                                </td> <?php }else{ ?> <b> <?php echo ucfirst($data_ttd['jabatan']); ?> </b>
                                <br>u.b <br> <?php 
                  $sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$data[ttd]'";
                    $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                    $data_tt = mysqli_fetch_array($tampil_tt);
                  ?> <b> <?php echo ucfirst($data_tt['jabatan']); ?> </b>
                                </center>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="100px"></td>
                                <td colspan="2" height="50px"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <center>
                                    <b> <?php echo ucfirst($data_tt['nama']); ?> </b>
                                    <br> <?php echo ucfirst($data_tt['pangkat']); ?> <br> Nip. <?php echo konversi_nip($data_tt['nip']); ?>
                                  </center>
                                </td> <?php } ?>
                              </tr>
                            </tbody>
                          </table> <?php }else{ ?> <table class="table1" border="0">
                            <thead>
                              <tr>
                                <td colspan="7">
                                  <center>
                                    <img src="../img/logo-garuda-emas.jpg" width="138px">
                                  </center>
                                </td>
                              <tr>
                                <td colspan="7">
                                  <center>
                                    <strong>
                                      <font size="4px">BUPATI BIREUEN</font>
                                    </strong>
                                  </center>
                                </td>
                              </tr>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="7">
                                  <center>
                                    <strong>
                                      <br>
                                      <br> <?php if ($data['no_spt'] == '') {?> <font size="3px">
                                        <u>SURAT TUGAS </U>
                                      </font>
                                      <br> NOMOR : Peg.800.1.11.1/ST/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/ <?php echo substr($data['tgl_spt'],-4);?> <br>
                                      <br> <?php }else{?> <font size="3px">
                                        <u>SURAT TUGAS </U>
                                      </font>
                                      <br> NOMOR : Peg.800.1.11.1/ST/ <?php echo $data['no_spt']; ?>/ <?php echo substr($data['tgl_spt'],-4);?> <br>
                                      <br> <?php }?> </strong>
                                  </center>
                                </td>
                              </tr>
                              <tr>
                                <td class="span1" width="100px" height="30px" valign="top">Dasar</td>
                                <td width="10" valign="top">:</td>
                                <td class="span8" colspan="5" align="justify" valign="top"> 
                                <?php
                                        // Get the content from $data['dasar_penugasan']
                                        $content = ucfirst($data['dasar_penugasan']);
                                        
                                        // Check if the content contains "#"
                                        if (strpos($content, '#') !== false) {
                                            // Split the content into an array using "#" as the delimiter
                                            $listItems = explode('#', $content);
                                        
                                            // Remove any empty elements from the array
                                            $listItems = array_filter($listItems);
                                        
                                            // Output the numbered list
                                            echo '<ol style="padding-left:16px">';
                                            foreach ($listItems as $item) {
                                                echo '<li>' . trim($item) . '</li>';
                                            }
                                            echo '</ol>';
                                        } else {
                                            // If there is no "#" symbol, just output the content as is
                                            echo $content;
                                        }
                                        ?>
                                </td>
                              </tr>
                              <tr>
                                <td colspan="7" height="30px">
                                  <br>
                                  <center>
                                    <strong>MEMERINTAHKAN : </strong>
                                  </center>
                                  <br>
                                </td>
                              </tr>
                              <tr> <?php

                      $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt= '$data[id_spt]' ORDER BY id_pengikut ";
                      $tampil_ = mysqli_query($koneksi, $sql_);
                      $no=1;
                      $row = mysqli_num_rows($tampil_);
                      $row_ = $row+$row;
                      //$nip2 = $data_['pengikut']; 
                      ?> <td valign="top" rowspan="
																																																																												<?php echo $row_; ?>">Kepada </td>
                                <td class="span1" valign="top" rowspan="
																																																																												<?php echo $row_; ?>">: </td> <?php 

                      while ($data_ = mysqli_fetch_array($tampil_))

                      {
                  ?>
                              <tr valign="top">
                                <td valign="top"> <?php echo $no++; ?>. </td> <?php if ($data_['pangkat'] == '') {?> <td class="span1" height="50px"> <?php }else{ ?>
                                <td class="span1" height="80px"> <?php }?> <?php if ($data_['pangkat'] == '') {?> Nama <br>Jabatan <?php }else{ ?>Nama <br>Pangkat <br>NIP <br>Jabatan <?php } ?> </td>
                                <td align="right" height="40px"> <?php if ($data_['pangkat'] == '') {?> : <br>: <?php }else{ ?>: <br>: <br>: <br>: <?php } ?> </td>
                                <td width="" colspan="2" align="justify"> <?php if ($data_['pangkat'] == '') {?> <b> <?php echo ucfirst($data_['nama']); ?> </b>
                                  <br> <?php echo ucfirst($data_['jabatan']); ?> <?php }else{ ?> <b> <?php echo ucfirst($data_['nama']); ?> </b>
                                  <br> <?php if ($data_['pangkat'] == '') { echo "-"; }else{ ?> <?php echo ucfirst($data_['pangkat']); ?> ( <?php echo ucfirst($data_['golongan']); ?>) <?php }?> <br> 
                                  <?php if ($data_['nip'] < 999999999999) { echo "-"; }else{?> <?php 
                                  if($data_['nip']==1976051720060410033){
                                        $data_['nip'] = 197605172006041003;
                                    }
                                  
                                  echo konversi_nip($data_['nip']); }?> <br> <?php echo ucfirst($data_['jabatan']); ?> <?php } ?>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr> <?php } ?> </tr>
                              <tr>
                                <td valign="top">Untuk</td>
                                <td valign="top">:</td> <?php
                    //echo $id_spt =  addslashes($_GET['id']);
                    $sql_ket = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_ket = mysqli_query($koneksi, $sql_ket);     
                    $data_ket = mysqli_fetch_array($tampil_ket);
                  ?> <td colspan="5" align="justify"> 
                    <?php
                    // Get the content from $data['dasar_penugasan']
                    $content = ucfirst($data['keterangan']);
                    
                    // Check if the content contains "#"
                    if (strpos($content, '#') !== false) {
                        // Split the content into an array using "#" as the delimiter
                        $listItems = explode('#', $content);
                    
                        // Remove any empty elements from the array
                        $listItems = array_filter($listItems);
                    
                        // Output the numbered list
                        echo '<ol style="padding-left:16px">';
                        foreach ($listItems as $item) {
                            echo '<li>' . trim($item) . '</li>';
                        }
                        echo '</ol>';
                    } else {
                        // If there is no "#" symbol, just output the content as is
                        echo $content;
                    }
                    ?>
                    Selama <?php echo $data_ket['lama_perjalanan']; ?> ( <?php echo terbilang($data_ket['lama_perjalanan']); ?>) Hari terhitung mulai tanggal <?php echo tgl_indo($data_ket['tgl_berangkat']); ?> sampai dengan <?php echo tgl_indo($data_ket['tgl_kembali']); ?> di <?php echo trim($data_ket['kota']);?> <?php if ($data_ket['tiba_di_2'] == '...') {
                    echo ".";
                  }elseif ($data_ket['tiba_di_3'] == '...'){  
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo " dan ". trim($data_tu2['kota'])."."; 
                  }else{
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo ", ". trim($data_tu2['kota']); }?> <?php if ($data_ket['tiba_di_3'] == '...') {
                    
                  }else{ $sql_tu3 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_3=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu3 = mysqli_query($koneksi, $sql_tu3);     
                    $data_tu3 = mysqli_fetch_array($tampil_tu3);
                    echo "dan ". trim($data_tu3['kota'])."."; } ?> </td>
                              </tr>
                              <tr>
                                <td colspan="7" align="justify">
                                  <br>Demikian Surat Tugas ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="200px"></td>
                                <td colspan="2" class="span3">
                                  <br> Ditetapkan di Bireuen <br> Pada Tanggal <?php echo tgl_indo($tgl_spt); ?> <br>
                                  <br>
                                  <center> <?php 
                      $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$data[berwenang]'";
                      $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                      $data_ttd = mysqli_fetch_array($tampil_ttd);
                      $jabatan_ttd = $data_ttd['jabatan'];
                      if ($jabatan_ttd == 'BUPATI BIREUEN') { echo " ";
                      }elseif ($jabatan_ttd == 'WAKIL BUPATI BIREUEN'){
                      
                      }else{ ?>a.n BUPATI BIREUEN <br> <?php }?> <?php
                  if ($nd_spt != '') { ?> <b>Sekretaris Daerah</b>
                                  </center>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="100px"></td>
                                <td colspan="2" height="50px"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <center>
                                    <b> <?php echo ucfirst($data_ttd['nama']); ?> </b>
                                    <br> <?php echo ucfirst($data_ttd['pangkat']); ?> <br> <?php if ($data_ttd['nip'] < 999999999999) { echo "-"; }else{?> <?php echo "Nip. ". konversi_nip($data_ttd['nip']); }?> <?php echo $nd_spt ?> <br> <?php echo $tgl_nd ?>
                                  </center>
                                </td> <?php }
                  else if ($data['ttd_ub'] == '') { ?> <b> <?php echo ucfirst($data_ttd['jabatan']); ?> </b>
                                </center>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="100px"></td>
                                <td colspan="2" height="50px"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <center>
                                    <b> <?php echo ucfirst($data_ttd['nama']); ?> </b>
                                    <br> <?php echo ucfirst($data_ttd['pangkat']); ?> <br> <?php if ($data_ttd['nip'] < 999999999999) { echo "-"; }else{?> <?php echo "Nip. ". konversi_nip($data_ttd['nip']); }?> <?php echo $nd_spt ?>
                                  </center>
                                </td> <?php }else{ ?> <b> <?php echo ucfirst($data_ttd['jabatan']); ?> </b>
                                <br>u.b <br> <?php 
                  $sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$data[ttd_ub]'";
                    $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                    $data_tt = mysqli_fetch_array($tampil_tt);
                  ?> <b> <?php echo ucfirst($data_tt['jabatan']); ?> </b>
                                </center>
                                </td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td width="100px"></td>
                                <td colspan="2" height="50px"></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                  <center>
                                    <b> <?php echo ucfirst($data_tt['nama']); ?> </b>
                                    <br> <?php echo ucfirst($data_tt['pangkat']); ?> <br>undefined<?php if ($data_tt['nip'] < 999999999999) { echo "-"; }else{?>undefined<?php echo "Nip. ". konversi_nip($data_tt['nip']); }?>
                                  </center>
                                </td> <?php } ?>
                              </tr>
                            </tbody>
                          </table> <?php } ?> </center>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              </form>
            </div>
          </div>
          <footer style="margin-top: 50px;"><center>Jalan Sultan Malikussaleh Cot Gapu, Kabupaten Bireuen, Provinsi Aceh</br>Telp. (0644) 323111, 22414 Faks. (0644) 21221, 22416 Kode Pos 24251</center></footer>
        </div>
        
      </div>
    </div>
  </body>
</html>