<?php //include 'session.php' ?>
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
        min-height: 297mm;
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
        size: A4;
        margin: 0;
        size: portrait;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
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
    .page-footer {
    position: absolute;
    bottom: 10mm;
    left: 0;
    width: 100%;
    text-align: center;
}

.page-footer img {
    width: 60%;
    max-width: 150px;
}

</style>
<?php

include "../koneksi/koneksi.php";

$id =  addslashes($_GET['id']);
//$sql = "SELECT * FROM spt INNER JOIN pegawai ON spt.berwenang=pegawai.nip WHERE id_spt = $id_spt";
$sql = "SELECT * FROM amprahan WHERE id_amprahan = '$id'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);

$tgl = $data['tanggal'];

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

function getRekanan($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT nama_rekanan FROM rekanan WHERE id_rekanan = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return "<strong>".$row['nama_rekanan'] . "</strong>" ;
  } else {
    return "-";
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
 
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
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
<title>Surat Pesanan Barang</title>
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
            <table class="table1" border="0" width="100%" >
              <thead>
                <tr>
                  <td><center><img src="../img/logo_bireuen.jpg" width="100px"></center></td>
                  <td colspan="6">
                    <center>
                      <strong>
                        <font size="3px">PEMERINTAH KABUPATEN BIREUEN</font><br>
                        <font size="6px">SEKRETARIAT DAERAH</font><br>
                        <font size="3px">Jalan Sultan Malikussaleh Cot Gapu Bireuen 24251<br>
                        Telpon (0644) 323111, 22414 Faks. (0644) 21221, 22416<br></font>
                      </strong>
                    </center>
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
                        
                        <font size="3px"><u>SURAT PESANAN BARANG/JASA</U></font><br>
                        NOMOR : <?php echo $data['kode_item']."/".$data['no_amprahan']."/".$data['bulan_romawi']."/".$data['tahun']; ?>
                        <br><br>
                        
                      </strong>
                    </center>
                  </td>
                </tr>                             
                <tr>
                  <td valign="top" colspan="7">Kepada Yth,<br>
                    <b><?php echo ucfirst(getRekanan($data['id_rekanan'])); ?></b><br>
                    di - <br>
                    &nbsp; &nbsp; &nbsp; &nbsp;Tempat
                  </td>
                </tr>
                <tr>
                  <td><br></td>
                </tr>
                <tr>
                  <td colspan="7" align="justify"><br>Bersama ini disampaikan kiranya dapat disiapkan barang/jasa sesuai pesanan berikut :<br><br></td>
                </tr>
                <tr>
                  <td colspan="7">
                    <table class="table1" border="1" style="border: 1px solid black; border-collapse: collapse;">
                      <thead>
                        <tr>
                          <th width="20px">No.</th>
                          <th width="150px">BANYAKNYA</th>
                          <th width="400px">URAIAN BARANG</th>
                          <th width="300px">KETERANGAN</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                        $sql_item = "SELECT * FROM amprahan_detail WHERE id_amprahan = '$id'";
                        $tampil_item = mysqli_query($koneksi, $sql_item);
                        $no=1;
                        while ($data_item = mysqli_fetch_array($tampil_item)) {   
                      ?>
                        <tr>
                          <td align="center" height="20px"><?php echo $no++; ?></td>
                          <td align="center"><?php echo $data_item['banyak']." ".$data_item['satuan']; ?></td>
                          <td> &nbsp;<?php echo ucfirst($data_item['uraian']); ?></td>
                          <td align="center"><?php echo ucfirst($data_item['keterangan']); ?></td>
                        </tr>
                      <?php }?>
                      </tbody>
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="7" align="justify"><br>Demikian Pesanan ini dibuat dan untuk dilaksanakan setelah menerima Surat Pesanan ini.</td>
                </tr>
                <tr>
                  
                  <td ></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td width="350px"></td>
                  <td colspan="2" class="span3">
                    <br>
                      Bireuen, <?php echo tgl_indo($tgl); ?><br><br><center>
                      <!--<strong>KEPALA BAGIAN UMUM</strong><br>-->
                    
                      <b><?php 
                      $sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$data[id_pejabat]'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    $data_ttd = mysqli_fetch_array($tampil_ttd);

                      echo strtoupper($data_ttd['jabatan']); ?></b>
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
                      <b><?php echo ucfirst($data_ttd['nama']); ?></b><br>
                      <?php echo ucfirst($data_ttd['pangkat']); ?><br>
                      <?php if ($data_ttd['nip'] < 999999999999) { echo "-"; }else{?>
                            <?php echo "Nip. ". konversi_nip($data_ttd['nip']); }?>
                    </center>
                  </td>
                </tr>
              </tbody>
            </table>
          
            </center>
          </div>

        </div>
      </div>      
    </div>    
  </div>
 </form>
</div></div>

</div>      
<div class="page-footer">
    <img src="../img/logo_login.png" alt="Logo">
</div>

    </div>    
  </div>

</body>
</html>