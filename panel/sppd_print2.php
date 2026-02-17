<?php include 'session.php' ?>
<style type="text/css">
  
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
 </style>
<?php

include "../koneksi/koneksi.php";

$id_spd =  addslashes($_GET['id']);
//$no_spt = addslashes($_POST['no_spt']);
$sql = "SELECT * FROM spd INNER JOIN spt ON spd.no_spt=spt.no_spt INNER JOIN kota on spd.id_kota_tujuan=kota.id_kota WHERE no_spd='$id_spd'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
$no_spt = $data['no_spt'];
$tgl_spd = $data['tgl_spd'];

$nip = $data['berwenang'];
$id_kota_tujuan = $data['id_kota_tujuan'];
$tiba_di_1 = $data['tiba_di_1'];
$berangkat_dari_1 = $data['berangkat_dari_1'];
$ke_1 = $data['ke_1'];
$tiba_di_2 = $data['tiba_di_2'];
$berangkat_dari_2 = $data['berangkat_dari_2'];
$ke_2 = $data['ke_2'];

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
 

?>
<script>
    window.print();
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE REPORT SPD <?php echo $data['no_spt']; ?></title>
<link rel="stylesheet" href="../css/report.css" />
</head>
<body>

<!--<link rel="stylesheet" href="../css/bootstrap.min.css" />-->


<table border="1" width="1000px">
  <tr>
    <td></td>
    <td></td>
  </tr>

</table>

<div id="content">

<div class="container-fluid">
  
 
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        
        <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">           
                        
            <div class="widget-content nopadding">
              <center>
            <table class="table1" border="0" rules="all">
              <thead>
                <tr class="border3">
                  <td colspan="8"><center><img src="../img/kops_surat.jpg" width="800px"></center></td>
                  <tr class="border3">
                  <td colspan="8"><hr style="border:0; border-top: 3px double #8c8c8c;"></td>
                </tr>
                </tr>
              </thead>
              <tbody>                
                <tr class="border3">
                  <td></td>
                  <td></td><!--  width="130px" -->
                  <td></td><!--  width="240px" -->
                  <td></td>
                  <td></td>
                  <td align="right">Lembaran Ke</td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr class="border3">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td align="right">Kode No</td>
                  <td>:</td>
                  <td><?php echo $data['no_spt']; ?></td>
                </tr>
                <tr class="border3">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td align="right">Nomor</td>
                  <td>:</td>
                  <td><?php echo $data['no_spd']; ?></td>
                </tr>
                 <tr class="border3">
                  <td colspan="8" height="20px"></td>
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
                  <td colspan="3" width="950px">Pejabat Pembuat Komitmen</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3" width="270px"><?php echo $data['memberi_perintah']; ?></td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">2.</td>
                  <td colspan="3">Nama/Nip Pegawai yang melaksanakan<br>Perjalanan Dinas</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3" valign="top">
                     <?php
                  $sql1 = "SELECT * FROM pegawai where nip = $nip";
                  $tampil1 = mysqli_query($koneksi, $sql1);     
                  $data1 = mysqli_fetch_array($tampil1);
                      
                     echo $data1['nama']; 
                  ?>
                  </td>
                </tr>               
                <tr>
                  <td class="border2" align="right" valign="top">3.</td>
                  <td colspan="3">a. Pangkat dan Golongan Menurut</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data1['pangkat']; ?>/<?php echo $data1['golongan']; ?></td>
                </tr>
                 <tr>
                  <td class="border2"></td>                  
                  <td colspan="3">b. Jabatan/Instansi</td>
                  <td class="border1" valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data1['jabatan']; ?>/<?php echo $data['instansi']; ?></td>
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
                  <td class="border1" colspan="3"><?php echo $data['dasar_penugasan']; ?></td>
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
                  <td colspan="3">b. Tempat Tujuan</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['kota']; ?></td>
                </tr>
                <tr>
                  <td class="border2" align="right" valign="top">7.</td>
                  <td colspan="3">a. Lamanya Pejalanan Dinas</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['lama_perjalanan']; ?> Hari</td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">b. Tanggal Berangkat</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['tgl_berangkat']; ?></td>
                </tr>
                <tr>
                  <td class="border2"></td>
                  <td colspan="3">c. Tanggal Kembali</td>
                  <td class="border1"  valign="top"> </td>
                  <td class="border1" colspan="3"><?php echo $data['tgl_kembali']; ?></td>
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

                      echo $no++.". ".$data2['nama']." (".$data2['golongan']." | ".$data2['jabatan'].")<br>"; 
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
                  <td class="border1" colspan="3"><?php echo $data['instansi']; ?></td>
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
                  <td class="border1"  colspan="3"><?php echo $data['keterangan']; ?></td>
                </tr>
                <tr>
                  <td class="border3" colspan="8" height="20px"></td>
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
                  <td class="border3"><?php echo tgl_indo($tgl_spd); ?></td>
                </tr>
                <tr>
                  <td class="border3" colspan="5"></td>
                  <td class="border3" colspan="3">Pejabat Yang Berwenang</td>
                </tr>
                <tr>                  
                  <td colspan="5" class="border3"></td>                  
                  <td colspan="3" class="border3"><br></td>
                </tr>
                <tr>                  
                  <td colspan="5" class="border3"></td>                  
                  <td colspan="3" class="border3">
                    <center>
                      <b>Sekretaris Daerah</b>
                    </center>
                  </td>
                </tr>                
                <tr>
                  <td colspan="5" class="border3" height="50px"></td>
                  <td colspan="3" class="border3"></td>
                </tr>
                <tr>
                  <td colspan="5" class="border3"></td>
                  <td colspan="3" class="border3">
                    <center>
                      <b><?php echo ucfirst($data1['nama']); ?></b><br>
                      <?php echo ucfirst($data1['jabatan']); ?><br>
                      Nip. <?php echo konversi_nip($data1['nip']); ?>
                    </center>
                  </td>
                </tr>
              </tbody>
            </table>
            
            <br><br><br><br><br><br><br><br>
            

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
                  <td class="border5" width="25px" align="right">I.</td>
                  <td class="border5" width="100px"></td>
                  <td class="border5" width="120px"></td>
                  <td class="border6" width="150px"></td>
                  <td class="border5"></td>
                  <td class="border5" width="120px">Berangkat Dari</td>
                  <td class="border5" width="10px">:</td>
                  <td class="border5" width="150px"></td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border4"></td>
                  <td class="border3"></td>
                  <td class="border3">Ke</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border3" colspan="3"></td>
                  <td class="border4"></td>
                  <td class="border5"></td>
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border2" colspan="3" height="120px"></td>
                  <td></td>
                  <td class="border2" colspan="5"></td>
                </tr>
                <tr>
                  <td class="border5" align="right">II.</td>
                  <td class="border5">Tiba di</td>
                  <td class="border5">:</td>
                  <td class="border4"></td>
                  <td class="border5"></td>
                  <td class="border5">Berangkat Dari</td>
                  <td class="border5">:</td>
                  <td class="border5"></td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5">Pada Tanggal</td>
                  <td class="border5">:</td>
                  <td class="border4"></td>
                  <td class="border3"></td>
                  <td class="border3">Ke</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="3" height="120px"></td>
                  <td></td>
                  <td class="border1" colspan="5"></td>
                </tr>
                <tr>
                  <td class="border5" align="right">III.</td>
                  <td class="border5">Tiba di</td>
                  <td class="border5">:</td>
                  <td class="border4"></td>
                  <td class="border5"></td>
                  <td class="border5">Berangkat Dari</td>
                  <td class="border5">:</td>
                  <td class="border5"></td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5">Pada Tanggal</td>
                  <td class="border5">:</td>
                  <td class="border4"></td>
                  <td class="border3"></td>
                  <td class="border3">Ke</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" align="right">IV.</td>
                  <td class="border5">Tiba di</td>
                  <td class="border5">:</td>
                  <td class="border4"></td>
                  <td class="border5"></td>
                  <td class="border5">Berangkat Dari</td>
                  <td class="border5">:</td>
                  <td class="border5"></td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5">Pada Tanggal</td>
                  <td class="border5">:</td>
                  <td class="border4"></td>
                  <td class="border3"></td>
                  <td class="border3">Ke</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="3" height="120px"></td>
                  <td></td>
                  <td class="border1" colspan="5"></td>
                </tr>
                <tr>
                  <td class="border3" colspan="4"></td>
                  <td class="border3" width="10px">V.</td>
                  <td class="border3">Tiba Kembali di</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>                  
                </tr>
                <tr>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3">Pada Tanggal</td>
                  <td class="border3">:</td>
                  <td class="border3"></td>
                  <td class="border3"></td>                  
                </tr>
                <tr>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3" colspan="4">
                    Telah diperiksa, dengan keterangan bahwa<br>
                    Perjalanan tersebut di atas benar dilakukan atas<br>
                    Perintahnya dan semata-mata untuk kepentingan<br>
                    Jabatan dalam waktu yang sesingkat-singkatnya
                  </td>             
                </tr>
                <tr>
                  <td class="border2" colspan="9" align="right"><br><br><br><br></td>                  
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