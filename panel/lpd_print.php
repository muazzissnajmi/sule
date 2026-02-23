<?php //include 'session.php' ?>
<style type="text/css">

    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 11pt "Tahoma";
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
<?php

include "../koneksi/koneksi.php";

error_reporting(0);

/* konversi NIP */
function konversi_nip($nipk, $batas = " ")
{
  $nipk = trim($nipk, " ");
  $panjang = strlen($nipk);

  if ($panjang == 18) {
    $sub[] = substr($nipk, 0, 8); // tanggal lahir
    $sub[] = substr($nipk, 8, 6); // tanggal pengangkatan
    $sub[] = substr($nipk, 14, 1); // jenis kelamin
    $sub[] = substr($nipk, 15, 3); // nomor urut

    return $sub[0] . $batas . $sub[1] . $batas . $sub[2] . $batas . $sub[3];

  }
  else {
    return $nipk;
  }
}

/* konversi tanggal */
function tgl_indo($tgl_spt)
{
  $bulan = array(
    1 => 'Januari',
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

  return $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
}

/* TERBILANG */
function penyebut($nilai)
{
  $nilai = abs($nilai);
  $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  $temp = "";
  if ($nilai < 12) {
    $temp = " " . $huruf[$nilai];
  }
  else if ($nilai < 20) {
    $temp = penyebut($nilai - 10) . " belas";
  }
  else if ($nilai < 100) {
    $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
  }
  else if ($nilai < 200) {
    $temp = " seratus" . penyebut($nilai - 100);
  }
  else if ($nilai < 1000) {
    $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
  }
  else if ($nilai < 2000) {
    $temp = " seribu" . penyebut($nilai - 1000);
  }
  else if ($nilai < 1000000) {
    $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
  }
  else if ($nilai < 1000000000) {
    $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
  }
  else if ($nilai < 1000000000000) {
    $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
  }
  else if ($nilai < 1000000000000000) {
    $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
  }
  return $temp;
}
function terbilang($nilai)
{
  if ($nilai < 0) {
    $hasil = "minus " . trim(penyebut($nilai));
  }
  else {
    $hasil = trim(penyebut($nilai));
  }
  return $hasil;
}


function tambahHariKerja($tanggalAwal, $jumlahHari)
{
  $tanggal = strtotime($tanggalAwal);
  $hariDitambahkan = 0;

  while ($hariDitambahkan < $jumlahHari) {
    // maju 1 hari
    $tanggal = strtotime("+1 day", $tanggal);

    // cek apakah weekend (6 = Sabtu, 7 = Minggu)
    $hari = date("N", $tanggal);
    if ($hari >= 6) {
      continue; // skip Sabtu & Minggu
    }

    // kalau weekday, hitung
    $hariDitambahkan++;
  }

  return date("d-m-Y", $tanggal);
}



$id_lpd = addslashes($_GET['id']);
$sql_lpd = "SELECT * FROM lpd WHERE id_lpd = '$id_lpd'";
$tampil_lpd = mysqli_query($koneksi, $sql_lpd);
$data_lpd = mysqli_fetch_array($tampil_lpd);

$id_spt = $data_lpd['id_spt'];
$sql = "SELECT * FROM spt WHERE id_spt = '$id_spt'";
$tampil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($tampil);
$no_spt = $data['no_spt'];
$berwenang = $data['berwenang'];

?>
<script>
    //window.print();
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE REPORT SPT Peg. 800/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'], -4); ?></title>
<link href="../img/logo_.png" rel='shortcut icon'>
</head>
<body>

<!--<link rel="stylesheet" href="../css/bootstrap.min.css" />-->
<link rel="stylesheet" href="../css/report.css" />

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
              <?php
$sql_ck = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt = '$id_spt'";
$tampil_ck = mysqli_query($koneksi, $sql_ck);
$data_ck = mysqli_fetch_array($tampil_ck);
$jabatan_ck = $data_ck['jabatan'];


?>
            
            <table class="table1" border="0">
              <tr>
                <td colspan="7" width="1000px" height="50px"></td>                
              </tr>
              <tr>
                <td colspan="7"><center><h2><u>LAPORAN HASIL PERJALANAN DINAS</u></h2></center></td>                
              </tr>
              <tr>
                <td colspan="7" height="50px"></td>
              </tr>
              <tr>
                <td width="20px" valign="top"><b>1.</b></td>
                <td width="20px"></td>
                <td colspan="5"><b>DASAR</b></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td align="justify" colspan="5" align="justify"> 
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
}
else {
  // If there is no "#" symbol, just output the content as is
  echo $content;
}
?>
                </td>
              </tr>              
              <tr>
                <td colspan="7" height="20px"></td>
              </tr>              
              <tr>
                <td valign="top"><b>2.</b></td>
                <td></td>
                <td colspan="5"><b>LAMA PERJALANAN</b></td>
              </tr>
              <?php
$sql_spd = "SELECT * FROM spd WHERE id_spt='$id_spt'";
$tampil_spd = mysqli_query($koneksi, $sql_spd);
$data_spd = mysqli_fetch_array($tampil_spd);
?>
              
              <tr>
                <td></td>
                <td></td>
                <?php
$sql_nama = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY golongan DESC";
$tampil_nama = mysqli_query($koneksi, $sql_nama);
$data_nama = mysqli_fetch_array($tampil_nama);

if ($data_nama['jabatan'] == "Pj. BUPATI BIREUEN" || $data_nama['jabatan'] == "BUPATI BIREUEN" || $data_nama['jabatan'] == "WAKIL BUPATI BIREUEN") {
  $nomorspt = "100.3.5";
}
else {
  $nomorspt = "Peg.800.1.11.1";
}
?>
                <td colspan="5" align="justify">Selama <?php echo $data_spd['lama_perjalanan']; ?> (<?php echo terbilang($data_spd['lama_perjalanan']); ?>) hari terhitung pada tanggal <?php echo tgl_indo($data_spd['tgl_berangkat']); ?> sampai dengan <?php echo tgl_indo($data_spd['tgl_kembali']); ?>. Sesuai dengan Surat Tugas berdasarkan SPT Nomor: <?php echo $nomorspt?>/ST/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'], -4); ?>, tanggal <?php echo tgl_indo($data['tgl_spt']); ?>.</td>
              </tr>
              <tr>
                <td colspan="7" height="20px"></td>
              </tr>
              <?php
$sql_ket = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt = '$id_spt'";
$tampil_ket = mysqli_query($koneksi, $sql_ket);
$data_ket = mysqli_fetch_array($tampil_ket);
?>
              <tr>
                <td valign="top"><b>3.</b></td>
                <td></td>
                <td colspan="5" valign="top"><b>TUJUAN PERJALANAN DINAS</b></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td valign="top" colspan="5"><?php echo $data_ket['kota']; ?><?php if ($data_ket['tiba_di_2'] == '...') {

}
elseif ($data_ket['tiba_di_3'] == '...') {
  $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
  $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);
  $data_tu2 = mysqli_fetch_array($tampil_tu2);
  echo "Dan " . $data_tu2['kota'];
}
else {
  $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
  $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);
  $data_tu2 = mysqli_fetch_array($tampil_tu2);
  echo ", " . $data_tu2['kota'];
}?>

                  <?php if ($data_ket['tiba_di_3'] == '...') {

}
else {
  $sql_tu3 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_3=kota.id_kota WHERE id_spt = '$data[id_spt]'";
  $tampil_tu3 = mysqli_query($koneksi, $sql_tu3);
  $data_tu3 = mysqli_fetch_array($tampil_tu3);
  echo "Dan " . $data_tu3['kota'];
}?></td>
              </tr>                            
              <tr>
                <td colspan="7" height="20px"></td>
              </tr>              
              <tr>
                <td valign="top"><b>4.</b></td>
                <td></td>
                <td colspan="5"><b>HASIL PERJALANAN DINAS</b></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td colspan="5" align="justify">
                <?php
// Get the content from $data['dasar_penugasan']
$content = ucfirst($data_lpd['hasil_dicapai']);

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
}
else {
  // If there is no "#" symbol, just output the content as is
  echo $content;
}
?>
                </td>
              </tr>
              <tr>
                <td colspan="7" height="20px"></td>
              </tr>
              <tr>
                <td valign="top"><b>5.</b></td>
                <td></td>
                <td colspan="5"><b>PENUTUP</b></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td colspan="5" align="justify">Demikian laporan perjalanan dinas ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</td>
              </tr>
              <tr>
                <td colspan="7" height="40px"></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="200px"></td>
                <?php
$data_lpd['tgl_lpd'] = tambahHariKerja($data_spd['tgl_kembali'], 10);

?>
                <td><?php echo $data_spd['asal']; ?>, <?php echo tgl_indo($data_lpd['tgl_lpd']); ?></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Yang Melakukan Perjalanan Dinas</td>
              </tr>
              <tr>
                <td colspan="7" height="20px"></td>                
              </tr>
              <?php
$sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY golongan DESC";
$tampil_ = mysqli_query($koneksi, $sql_);
$no = 1;
while ($data_ = mysqli_fetch_array($tampil_)) { ?>
              <tr>
                <td valign="top"><?php echo $no++; ?>.</td>
                <td colspan="5"><?php echo ucfirst($data_['nama']); ?><br>                  
                 <?php if ($data_['nip'] < 999999999999) {
    echo "";
  }
  else { ?>
                            Nip. <?php echo konversi_nip($data_['nip']);
  }?><br></td>
                
                <td valign="top">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<br>
                &nbsp;&nbsp;....................................................................
                </td>
              </tr>
              <tr>
                <td height="30px"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td width="280px"></td>
                <td></td>
              </tr>
            <?php
}?>
            </table>

          </div>

        </div>
      </div>      
    </div>    
  </div>
 </form>
</div></div>

</div>      
    </div>    
  </div>

</body>
</html>