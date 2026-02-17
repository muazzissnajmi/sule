<?php //include 'session.php' ?>
<?php

include "../koneksi/koneksi.php";
error_reporting(1);


 function rupiah_($angka_){
  
    $hasil_rupiah = "Rp. " . number_format($angka_,0,',','.');
    return $hasil_rupiah;
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


  //$angka = 1530093;
  //echo terbilang($angka);

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
 

?>
<script>
   // window.print();
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE REPORT KWITANSI</title>
<link href="../img/logo_.png" rel='shortcut icon'>
</head>
<body>


  <style type="text/css">

    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt sans-serif;
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
        html, body {
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
</style>

<!--<link rel="stylesheet" href="../css/bootstrap.min.css" />-->

<style type="text/css">
  .table1 {
    font-family: sans-serif;
    font-size: 12px;
    /*border-collapse: collapse;
    
    border: 0px solid #f2f5f7;*/   
    border-collapse: collapse;
    width: 100%;

}
.border3 {
        border-width: 1px;
        border-style: solid;
        border-top-color:  #8c8c8c;
        border-bottom-color:  #8c8c8c;
        border-left-color: #8c8c8c;
        border-right-color: transparent;
    }
 .border4 {
        border-width: 1px;
        border-style: solid;
        border-top-color:  #8c8c8c;
        border-bottom-color:  #8c8c8c;
        border-left-color: transparent;
        border-right-color: transparent;
    }
</style>

<?php 
  
$id =  addslashes($_GET['id']);
$sql = "SELECT * FROM kwitansi WHERE id_spt = '$id'";
$tampil= mysqli_query($koneksi, $sql);     
while($data = mysqli_fetch_array($tampil)){
$id_spt = $data['id_spt'];
$nip = $data['nip'];

$sql_spt = "SELECT * FROM spt  WHERE id_spt = '$id_spt'";
$tampil_spt = mysqli_query($koneksi, $sql_spt);     
$data_spt = mysqli_fetch_array($tampil_spt);

$sql_spd = "SELECT * FROM spd  WHERE id_spt = '$id_spt'";
$tampil_spd = mysqli_query($koneksi, $sql_spd);     
$data_spd = mysqli_fetch_array($tampil_spd);

$data['tgl_kw'] = date('d-m-Y', strtotime($data_spd['tgl_kembali'] . ' +3 days'));

?>

<div class="book">
    <div class="page">
        <div class="subpage">

<div id="content">

<div class="container-fluid">
  
 
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        
        <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">           
                        
            <div class="widget-content nopadding">
              <center>
            <table class="table1" border="0">
              <thead>
                <tr>
                  <td colspan="7"><center><img src="../img/kops_surat.jpg" width='100%'></center></td>
                  </td>
                  <tr>
                  <td colspan="7"><hr style="border:0; border-top: 3px double #8c8c8c;"></td>
                </tr>
                </tr>
              </thead>
              <tbody>                
                
                <tr>
                  <td colspan="7">
                    <center>
                      <strong>
                        <font size="3px" valign='top' >DAFTAR PENGELUARAN RIL</font>
                      </strong>
                    </center>
                    <p style="font-size:10pt;margin-bottom: 12px;">Yang bertanda tangan dibawah ini :</p>
                  </td>
                </tr> 
                <?php

                      $sql_p = "SELECT * FROM pegawai WHERE nip= '$data[nip]'";
                      $tampil_p = mysqli_query($koneksi, $sql_p);

                      $data_p = mysqli_fetch_array($tampil_p);
                      $show = "";
                    
                    if(strlen($data_p['nip'])<18){
                        $show = "none";
                    }
                ?>
                 <tr>
                     
                    <td style="width:5%;padding-left: 20px;"><p style="font-size:10pt;">Nama</p></td>
                    <td style="width:90%;"><p style="font-size:10pt;">: <?php echo $data_p['nama']; ?></p></td>
                </tr>
                <tr style="display:<?php echo $show;?>">
                    <td style="width:20%;padding-left: 20px;"><p style="font-size:10pt;">Pangkat</p></td>
                    <td style="width:80%;"><p style="font-size:10pt;">: <?php echo $data_p['pangkat']; ?></p></td>
                </tr>
                <tr style="display:<?php echo $show;?>">
                    <td style="width:20%;padding-left: 20px;"><p style="font-size:10pt;">NIP</p></td>
                    <td style="width:80%;"><p style="font-size:10pt;">: <?php echo $data_p['nip']; ?></p></td>
                </tr>
                <tr>
                    <td style="width:20%;padding-left: 20px;"><p style="font-size:10pt;">Jabatan</p></td>
                    <td style="width:80%;height:20px"><p style="font-size:10pt;height:inherit;">: <?php echo $data_p['jabatan']; ?></p></td>
                </tr>
                
                </tbody>
              </table>
            <?php if($data_p['jabatan']=="Pj. BUPATI BIREUEN" || $data_p['jabatan']=="BUPATI BIREUEN" || $data_p['jabatan']=="WAKIL BUPATI BIREUEN"){
                $nomorspt = "100.3.5";
            }else{
                $nomorspt = "Peg.800.1.11.1";
            }
            
            ?>
        <p style="text-align: justify;">Berdasarkan Surat Tugas Nomor: <?php echo $nomorspt ?>/ST/<?php echo $data_spt['no_spt']; ?>/<?php echo substr($data_spt['tgl_spt'],-4);?> Tanggal <?php echo tgl_indo($data_spt['tgl_spt']); ?>, dengan ini kami menyatakan dengan sesungguh-sungguhnya bahwa :
        </p>
        <ol>
        <li style="text-align: justify;">Biaya Perjalanan Dinas dibawah ini yang tidak dapat diperoleh bukti-bukti pengeluarannya, meliputi:</li>
            <br>
                <table class="table1" border="1">
                  <tbody>
                    <tr>
                      <th height="30px">No</th>
                      <th colspan="3">Uraian </th>
                      <th colspan="2">Jumlah</th>
                    </tr>
                    <?php
                    
                    $sql_p = "SELECT * FROM pegawai WHERE nip= '$data[nip]'";
                    $tampil_p = mysqli_query($koneksi, $sql_p);
                    
                    $data_p = mysqli_fetch_array($tampil_p);
                    
                    
                    $sql_kn = "SELECT * FROM kwitansi_nilai 
                    INNER JOIN kwitansi_kategori ON kwitansi_nilai.kategori = kwitansi_kategori.id_kategori_kw 
                    WHERE nip = '$nip' 
                    AND id_spt = '$id' 
                    AND kwitansi_kategori.id_kategori_kw IN (1,9,10)
                    AND kwitansi_nilai.ket NOT LIKE '%#%'
                    ORDER BY CAST(kwitansi_nilai.kategori AS UNSIGNED) ASC";
                    //ORDER BY (CAST(kwitansi_nilai.nominal AS UNSIGNED) * CAST(kwitansi_nilai.hari AS UNSIGNED)) DESC";
                    
                    
                    
                    $tampil_kn = mysqli_query($koneksi, $sql_kn);
                    $no=1;
                    $jumlah = 0;
                    $rowspan = mysqli_num_rows($tampil_kn);
                    
                    $ket_count = []; // Array to store occurrences of ket for 'penginapan'
                    // **First loop: Count how many times each 'ket' appears**
                    while ($data_kn = mysqli_fetch_array($tampil_kn)) {  
                        if (isset($data_kn['kategori']) && stripos($data_kn['kategori'], 'Penginapan') !== false) {
                            $ket_value = $data_kn['kategori'];
                            if (!isset($ket_count[$ket_value])) {
                                $ket_count[$ket_value] = 0;
                            }
                            $ket_count[$ket_value]++;
                        }
                    }
                    
                    // **Reset query to fetch data again**
                    mysqli_data_seek($tampil_kn, 0);
                    
                    // **Second loop: Generate the table**
                    while ($data_kn = mysqli_fetch_array($tampil_kn)) {  
                        $hari = ($data_kn['hari'] == '0') ? 1 : $data_kn['hari'];
                        $nominal = $hari * $data_kn['nominal'];
                        $jumlah += $nominal; 
                        
                        $data_kn['ket'] = str_replace('#', '', $data_kn['ket']);
                        
                        $biaya = "Biaya";
                        $daritanggal = "";
                    
                        // **Check if 'ket' appears more than 2 times**
                        if (isset($data_kn['kategori']) && stripos($data_kn['kategori'], 'Penginapan') !== false) {
                            $ket_value = $data_kn['kategori'];
                    
                            if ($ket_count[$ket_value] > 1) {
                                $daritanggal = $data_kn['kategori'] . " sebesar " . $data_kn['ket'] . " " . rupiah_($data_kn['nominal']) . 
                                               " x " . $data_kn['hari'] . " " . $data_kn['k_hari'];
                            } else {
                                if(strpos($data_kn['ket'], '@') !== false){
                                    $data_kn['ket'] = str_replace('@', '', $data_kn['ket']);
                                    $daritanggal = $data_kn['kategori'] . " sebesar " . $data_kn['ket'] . " " . rupiah_($data_kn['nominal']) . 
                                               " x " . $data_kn['hari'] . " " . $data_kn['k_hari'];
                                }else{
                                    $daritanggal = $data_kn['kategori'] . " dari tanggal " . tgl_indo($data_spd['tgl_berangkat']) . 
                                               " sampai dengan " . tgl_indo($data_spd['tgl_kembali']) . 
                                               " sebesar " . $data_kn['ket'] . " " . rupiah_($data_kn['nominal']) . 
                                               " x " . $data_kn['hari'] . " " . $data_kn['k_hari'];
                                }
                                
                            }
                        }
                    
                        if (isset($data_kn['kategori']) && stripos($data_kn['kategori'], 'BBM') !== false) {
                            $daritanggal = $data_kn['kategori'] . " " . $data_kn['ket'] . " = " . 
                                           rupiah_($data_kn['nominal']) . " x " . $data_kn['hari'] . " " . $data_kn['k_hari'];
                        }
                        
                    ?>
                    <tr>
                      <td width="40px" height="40px" ><center><?php echo $no++; ?></center></td>
                      <td width="470px" colspan="3" style="text-align: justify;"><?php echo $biaya ?> <?php echo $daritanggal ?> </td>
                      

                      <td width="20px" align="right" class="border3">&nbsp;Rp. </td>
                      <td width="100px" align="right">&nbsp;<?php echo number_format($nominal, 0, ".", "."); ?>,-</td>
                      
                      
                    </tr>
                    <?php }?> 
                    <tr>                      
                      <td align="center" colspan="4" height="30px"><strong>J U M L A H </strong>&nbsp;&nbsp;</td>
                      <td width="20px" align="right" class="border3">&nbsp;<strong>Rp. </strong></td>
                      <td align="right">&nbsp;<strong><?php echo number_format($jumlah, 0, ".", "."); ?>,-</strong></td>
                    </tr>
                      
              </tbody>
            </table>
            <br>
            <li style="text-align: justify;">Jumlah uang tersebut pada angka 1 diatas benar-benar dikeluarkan untuk pelaksanaan Perjalanan Dinas dimaksud dan apabila dikemudian hari terdapat kelebihan atas pembayaran, kami bersedia menyetorkan kelebihan tersebut ke Kas Daerah.</li>
            </ol> 
            <br>
            <table class="table" border="0" style="font-size:10pt;">
              <tr>
                <td width="430px"></td>
                <td width="430px" align="center"></td>
              </tr>
              <tr>
                <td align="center">Mengetahui/Menyetujui</td>
                <td align="center">Bireuen, <?php echo tgl_indo($data['tgl_kw']); ?></td>
              </tr>
              
              <tr>
                <td align="center">Pengguna Anggaran</td>
                <td align="center">Pelaksana Perjalanan Dinas</td>
              </tr>
               <tr>
                <td align="center" height="90px"></td>
                <td align="center"></td>
              </tr>
               <tr>
                   <?php
                    $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN kwitansi ON kwitansi.pengguna=ttd_pejabat.id_ttd_pejabat WHERE id_spt= '$id'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);
                    $data_ttd = mysqli_fetch_array($tampil_ttd);                    

                    $sql_pe = "SELECT * FROM pegawai WHERE nip= '$data_ttd[nip_pejabat]'";
                    $tampil_pe = mysqli_query($koneksi, $sql_pe);

                    $data_pe = mysqli_fetch_array($tampil_pe);?>
                <td align="center"><strong><?php echo $data_pe['nama']; ?></strong></td>
                <td align="center"><strong><?php echo $data_p['nama']; ?></strong></td>
              </tr>
              <tr>
                <td align="center"><?php echo $data_pe['pangkat']; ?></td>
                <td align="center"><?php echo $data_p['pangkat']; ?></td>
              </tr>
              <tr>
                
                <td align="center">
                  <?php if ($data_pe['nip'] < 999999999999) { echo ""; }else{?>
                     
                  Nip. <?php echo $data_pe['nip']; }?></td>
                  <td align="center">
                  <?php if ($data_p['nip'] < 999999999999) { echo ""; }else{?>
                     
                  Nip. <?php echo $data_p['nip']; }?></td>
                  
              </tr>
               
             
            </table>
            </center>
          </div>

        </div>
      </div>      
    </div>    
  </div>
 </form>
</div></div></div>
</div>
</div>

<?php } ?>




</body>
</html>