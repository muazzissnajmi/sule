
<?php

include "../koneksi/koneksi.php";
error_reporting(1);


 function rupiah_($angka_){
  
    $hasil_rupiah = "Rp " . number_format($angka_,0,',','.');
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
    font-size: 11px;
    color: #444;
    /*border-collapse: collapse;
    width: 70%;
    border: 0px solid #f2f5f7;*/   
    border-collapse: collapse;

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
                    <br>
                    <center>
                      <strong>
                        <font size="3px" valign='top' >RINCIAN BIAYA PERJALANAN DINAS</font>
                      </strong>
                    </center>
                    <br><br>
                  </td>
                </tr> 
                <tr>
                  <td width="150px" height="15px">Lampiran SPD No.</td>
                  <td width="5px">:</td>
                  <td width="230px"><strong>000.1.2/<?php echo $data['no_spd']; ?>/<?php echo substr($data_spt['tgl_spt'],-4);?></strong></td>
                  <td width="50px"></td>
                  <td width="120px">Nomor</td>
                  <td width="5px">:</td>
                  <td width="200px"><strong><!--<?php echo $data['no_kw']; ?>--></strong> . . . . . . . . . . . . . . . . . . . . . .</td>
                </tr>
                <tr>
                  <td height="25px">Tanggal</td>
                  <td>:</td>
                  <td><strong><?php echo tgl_indo($data_spt['tgl_spt']); ?></strong></td>
                  <td></td>
                  <td>Kode Rek</td>
                  <td>:</td>
                  <td><strong><?php echo $data['kode_rek']; ?></strong></td>
                </tr>
                <tr>
                  <td height="15px"></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td>Tahun</td>
                  <td>:</td>
                  <td><strong><?php echo substr($data_spt['tgl_spt'],-4);?></strong></td>
                </tr>
                </tbody>
              </table>
              <br>

             
                <table class="table1" border="1">
                  <tbody>
                    <tr>
                      <th>No</th>
                      <th colspan="3">Rincian Biaya</th>
                      <th colspan="2">Jumlah</th>
                      <th>Keterangan</th>
                    </tr>
                     <?php

                      $sql_p = "SELECT * FROM pegawai WHERE nip= '$data[nip]'";
                      $tampil_p = mysqli_query($koneksi, $sql_p);

                      $data_p = mysqli_fetch_array($tampil_p);
                    
                      
                      $sql_kn = "SELECT * FROM kwitansi_nilai INNER JOIN kwitansi_kategori ON kwitansi_nilai.kategori=kwitansi_kategori.id_kategori_kw WHERE nip = '$nip' AND id_spt= '$id'";
                      
                      $tampil_kn = mysqli_query($koneksi, $sql_kn);
                      $no=1;
                      $jumlah = 0;
                      $rowspan = mysqli_num_rows($tampil_kn);
                      while($data_kn = mysqli_fetch_array($tampil_kn)){                        
                        $data_kn['id_spt'];

                        $hari = $data_kn['hari'];
                  
                        if ($data_kn['hari'] == '0') {
                          $hari2 = $data_kn['hari']+1;
                        }else{
                          $hari2 = $data_kn['hari'];
                        }

                        $nominal = $hari2*$data_kn['nominal'];
                        $jumlah+=$nominal; 


                    
                        $sql_ket = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt = '$id'";
                        $tampil_ket = mysqli_query($koneksi, $sql_ket);     
                        $data_ket = mysqli_fetch_array($tampil_ket);
                        $data_kn['ket'] = str_replace('#', '', $data_kn['ket']);
                        $data_kn['ket'] = str_replace('@', '', $data_kn['ket']);
                  
                    ?>
                    <tr>
                      <td width="40px" height="20px"><center><?php echo $no++; ?></center></td>
                      <?php if ($data_kn['hari'] == '0') {?>
                        <td width="300px" colspan="3"><?php echo $data_kn['kategori']; ?> <?php echo $data_kn['ket']; ?></td>
                      <?php }else{ ?>
                        <td width="300px"><?php echo $data_kn['kategori']; ?> <?php echo $data_kn['ket']; ?></td>
                        <td width="90px" class="border4" align="right"><center><?php echo $data_kn['hari']; ?> <?php echo $data_kn['k_hari']; ?> @</center></td>
                        <td width="100px" align="right">&nbsp;<?php echo rupiah_($data_kn['nominal']); ?>,-</td>
                      <?php } ?>

                      <td width="20px" align="right" class="border3">&nbsp;<strong>Rp. </strong></td>
                      <td width="80px" align="right">&nbsp;<strong><?php echo number_format($nominal, 0, ".", "."); ?>,-</strong></td>
                      
                      <?php if($jum <= 1) { ?>
                      <?php 
                        if($data_p['jabatan']=="Pj. BUPATI BIREUEN" || $data_p['jabatan']=="BUPATI BIREUEN" || $data_p['jabatan']=="WAKIL BUPATI BIREUEN"){
                            $nomorspt = "100.3.5";
                        }else{
                            $nomorspt = "Peg.800.1.11.1";
                        }
                      ?>
                      <td width="280px" rowspan="<?php echo $rowspan+1; ?>" valign="top" align="">Perjalanan Dinas an. <?php echo $data_p['nama']; ?>, ST Nomor: <?php echo $nomorspt ?>/ST/<?php echo $data_spt['no_spt']; ?>/<?php echo substr($data_spt['tgl_spt'],-4);?> Tanggal <?php echo tgl_indo($data_spt['tgl_spt']); ?> ke <?php echo trim($data_ket['kota']);?><?php if ($data_ket['tiba_di_2'] == '...') {
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
                    echo ", ". trim($data_tu2['kota']); }?>

                  <?php if ($data_ket['tiba_di_3'] == '...') {
                    
                  }else{ $sql_tu3 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_3=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu3 = mysqli_query($koneksi, $sql_tu3);     
                    $data_tu3 = mysqli_fetch_array($tampil_tu3);
                    echo "dan ". trim($data_tu3['kota'])."."; } ?></td>
                  </td>

                          <?php 
                            $jum = $rowspan;      
                            
                            } else {
                                $jum = $jum - 1;
                            }
                          ?>
                    </tr>
                    <?php }?> 
                    <tr>                      
                      <td align="right" colspan="4"><strong>J U M L A H </strong>&nbsp;&nbsp;</td>
                      <td width="20px" align="right" class="border3">&nbsp;<strong>Rp. </strong></td>
                      <td align="right">&nbsp;<strong><?php echo number_format($jumlah, 0, ".", "."); ?>,-</strong></td>
                    </tr>
                    <tr style="background-color:lightCyan">
                      <td colspan="6" align="center" colspan=""><strong>Terbilang : <i><?php echo ucwords(terbilang($jumlah)); ?> Rupiah</i></strong></td>
                      <td></td>

                    </tr>     
              </tbody>
            </table>
            <br>
            <table class="table1" border="0">
              <tr>
                <td width="430px"></td>
                <td width="430px" align="center">Bireuen, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<?php echo tgl_indo($data['tgl_kw']); ?>--></td>
              </tr>
              <tr>
                <td align="center">Telah dibayar Sejumlah</td>
                <td align="center">Telah menerima jumlah uang sebesar</td>
              </tr>
              <tr>
                <td align="center"><?php echo rupiah_($jumlah); ?>,-</td>
                <td align="center"><?php echo rupiah_($jumlah); ?>,-</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
                <td align="center"></td>
              </tr>
              <tr>
                <td align="center">Bendahara Pengeluaran,</td>
                <td align="center">Yang Menerima,</td>
              </tr>
               <tr>
                <td align="center" height="50px"></td>
                <td align="center"></td>
              </tr>
               <tr>
                <td align="center"><strong>
                  <?php
                    $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN kwitansi ON kwitansi.bendahara=ttd_pejabat.id_ttd_pejabat WHERE id_spt= '$id'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);
                    $data_ttd = mysqli_fetch_array($tampil_ttd);                    

                    $sql_B = "SELECT * FROM pegawai WHERE nip= '$data_ttd[nip_pejabat]'";
                    $tampil_B = mysqli_query($koneksi, $sql_B);

                    $data_B = mysqli_fetch_array($tampil_B);
                    
                    echo $data_B['nama']; ?>
                    </strong>
                  </td>
                <td align="center"><strong><?php echo $data_p['nama']; ?></strong></td>
              </tr>
              <tr>
                <td align="center">Nip. <?php echo konversi_nip($data_B['nip']); ?></td>
                <td align="center">
                  <?php if ($data['nip'] < 999999999999) { echo ""; }else{?>
                     
                  Nip. <?php echo konversi_nip($data['nip']); }?></td>
              </tr>
               
              <tr>
                <td align="center" colspan="2" height="20px"><hr style="border:0; border-top: 3px double #8c8c8c;"></td>
              </tr>
              <tr>
                <td align="center" colspan="2" height="10px">PERHITUNGAN SPD RAMPUNG</td>
              </tr>
              <tr>
                <td align="center">&nbsp;</td>
                <td align="center"></td>
              </tr>
              <tr>
                <td align="center" colspan="2">
                  <table class="table1" align="left" >
                  <tr>
                    <td width="30px"></td>
                    <td width="200px">Ditetapkan sejumlah</td>
                    <td width="10px">:</td>
                    <td><?php echo rupiah_($jumlah); ?>,-</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>Yang telah dibayar semula</td>
                    <td>:</td>
                    <td>-</td>
                  </tr>
                  <td></td>
                  <td>Sisa kurang / Lebih</td>
                  <td>:</td>
                  <td><?php echo rupiah_($jumlah); ?>,-</td>
                  </table>
                </td>
              </tr>
              <?php
                    $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN kwitansi ON kwitansi.pengguna=ttd_pejabat.id_ttd_pejabat WHERE id_spt= '$id'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);
                    $data_ttd = mysqli_fetch_array($tampil_ttd);                    

                    $sql_pe = "SELECT * FROM pegawai WHERE nip= '$data_ttd[nip_pejabat]'";
                    $tampil_pe = mysqli_query($koneksi, $sql_pe);

                    $data_pe = mysqli_fetch_array($tampil_pe);?>
              <tr>
                <td align="center"></td>
                <td align="center">Pengguna Anggaran,<br>
                  <b><?php echo $data_pe['jabatan']; ?></b>
                </td>
              </tr>
               
              <tr>
                <td align="center" height="50px"></td>
                <td align="center"></td>
              </tr>
               <tr>
                <td align="center"> </td>
                <td align="center"><strong>                  
                    <?php echo $data_pe['nama']; ?>
                    </strong>    
                  </td>
              </tr>
              <tr>
                <td align="center"></td>
                <td align="center"><?php echo $data_pe['pangkat']; ?><br>Nip. <?php echo konversi_nip($data_pe['nip']); ?></td>
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