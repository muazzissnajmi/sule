<?php //include 'session.php' ?>
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
<title>SULE REPORT SPTJM</title>
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

$sql_spd = "SELECT * FROM spd  WHERE id_spt = '$id_spt'";
$tampil_spd = mysqli_query($koneksi, $sql_spd);     
$data_spd = mysqli_fetch_array($tampil_spd);


$sql_p = "SELECT * FROM pegawai WHERE nip= '$data[nip]'";
                      $tampil_p = mysqli_query($koneksi, $sql_p);

                      $data_p = mysqli_fetch_array($tampil_p);
                      
$sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN kwitansi ON kwitansi.bendahara=ttd_pejabat.id_ttd_pejabat WHERE id_spt= '$id'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);
                    $data_ttd = mysqli_fetch_array($tampil_ttd);                    

                    $sql_B = "SELECT * FROM pegawai WHERE nip= '$data_ttd[nip_pejabat]'";
                    $tampil_B = mysqli_query($koneksi, $sql_B);

                    $data_B = mysqli_fetch_array($tampil_B);
                    
                    $show = "";
                    
                    if(strlen($data_p['nip'])<18){
                        $show = "none";
                    }
?>

<div class="book">
    <div class="page">
        <div class="subpage">

<div id="content">

        
    <style>
    
    .table td, .table th {
        font-size: 12px;
    }
    p1{
            font-size:12pt;
            margin:3px;
        }
 
    </style>
    <br>
    
    <div style="font-size:12pt;margin:35px;font-family: 'Bookman Old Style';">
        
        <p style="text-align: center;font-size:14pt;"><b>SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK</b></p>
        <br>
        <ol>
            
        <li>Yang bertanda tangan dibawah ini :</li>
        <table class="table" style="width:100%;">
            <tbody>
                <tr>
                    <td style="width:20%;"><p style="font-size:12pt;">Nama</p></td>
                    <td style="width:80%;"><p style="font-size:12pt;">: <?php echo $data_p['nama']; ?></p></td>
                </tr>
                <tr>
                    <td style="width:20%;"><p style="font-size:12pt;">Jabatan</p></td>
                    <td style="width:80%;"><p style="font-size:12pt;">: <?php echo $data_p['jabatan']; ?></p></td>
                </tr>
                <tr style="display:<?php echo $show;?>">
                    <td style="width:20%;"><p style="font-size:12pt;">NIP</p></td>
                    <td style="width:80%;"><p style="font-size:12pt;">: <?php echo $data_p['nip']; ?></p></td>
                </tr>
            </tbody>
        </table>
        </ol>
    
        <ol start="2">
        <?php if($data_p['jabatan']=="Pj. BUPATI BIREUEN" || $data_p['jabatan']=="BUPATI BIREUEN" || $data_p['jabatan']=="WAKIL BUPATI BIREUEN"){
            $nomorspt = "100.3.5";
        }else{
            $nomorspt = "Peg.800.1.11.1";
        }
        
        ?>
            
        <li style="text-align: justify;">Berdasarkan Surat Tugas (ST)  Nomor: <?php echo $nomorspt ?>/<?php echo $data_spt['no_spt']; ?>/<?php echo substr($data_spt['tgl_spt'],-4);?> Tanggal <?php echo tgl_indo($data_spt['tgl_spt']); ?> dan Surat Perintah Dinas (SPD) Nomor <?php echo $data['no_spd']; ?>/<?php echo substr($data_spd['tgl_spd'],-4);?>, Tanggal <?php echo tgl_indo($data_spd['tgl_spd']); ?> dengan ini kami menyatakan dengan sesungguh-sungguhnya bahwa :
        <ol style="list-style-type: lower-alpha;">
        <li>Seluruh biaya yang dikeluarkan benar-benar dipergunakan untuk keperluan Perjalanan dinas dimaksud.</li>
        <li>Seluruh bukti-bukti pendukung perjalanan dinas (Biaya transportasi, Boarding Pass dan Bill Hotel) adalah asli dan sesuai dengan sebenarnya.</li>
        <li style="text-align: justify;">Apabila dikemudian hari yang dikeluarkan dan bukti-bukti tersebut tidak sesuai dengan keadaan sebenarnya dan menjadi temuan aparat pengawas fungsional karena dianggap merugikan keuangan daerah/Negara dengan menyalahi ketentuan dan peraturan perundangan yang berlaku, maka saya bersedia bertanggungjawab dan mengganti seluruh kegiatan tersebut sesuai dengan ketentuan dan peraturan perundang-undangan yang berlaku.</li>
        </ol>
        </li>
        </ol>
        <ol start="3">
        <li style="text-align: justify;">Demikian Pernyataan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.</li>
        </ol>
        <p>&nbsp;</p>
        
        <table class="table table-bordered" style="border-color:white;width:100%;">
            <tbody>
                <tr>
                    <td style="width:50%;border-color:white">
                    <p style="text-align:center;margin:0px;border-color:white"><b></b><br><br><br><br><br></p>
                    </td>
                    <td style="width:50%;border-color:white">
                    <p style="font-size:12pt;text-align:center;margin:0px;border-color:white"><br>Pelaksana Perjalanan Dinas<br><br><br><br><br></p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align:center;margin:0px;width:50%;border-color:white"></td>
                    <td style="width:50%;border-color:white">
                    <p style="font-size:12pt;text-align:center;margin:0px;border-color:white"><b><u><?php echo $data_p['nama']; ?></u></b><br></p>
                    </td>
                </tr>
                
            </tbody>
        </table>
    
    
    </div>
	 
    </div>
    
</div>
</div></div>
<?php } ?>




</body>
</html>