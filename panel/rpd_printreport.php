<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE - Sistem Unit Layanan Elektronik Kab. Bireuen</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../img/logo_.png" rel='shortcut icon'>

</head>
<?php //include 'session.php' ?>
<?php $page = 'lpd'; 
error_reporting(1);
// Fungsi header dengan mengirimkan raw data excel
//header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
//header("Content-Disposition: attachment; filename=Report_LPD.xls");


//$asn = '196005101989031007';
//$tgl_awal = '10';
//$tgl_akhir = '11';

$asn = addslashes($_POST['asn']);
$tgl_awal = addslashes($_POST['tgl_awal']);
$tgl_akhir = addslashes($_POST['tgl_akhir']);

$pagu = addslashes($_POST['pagu']);

if ($pagu == 'luar_kota') {
  $tmp_pagu = 'Setdakab Luar Daerah';
}elseif ($pagu == 'dalam_kota') {
  $tmp_pagu = 'Setdakab Dalam Daerah';
}elseif ($pagu == 'kdh_luar_kota') {
  $tmp_pagu = 'KDH/WKDH Luar Daerah';
}elseif ($pagu == 'kdh_dalam_kota') {
  $tmp_pagu = 'KDH/WKDH Dalam Daerah';
}elseif ($pagu == 'semua') {
  $tmp_pagu = 'Semua Tujuan';
}

function rupiah($angka){
  
$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
return $hasil_rupiah;
 }

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

/* konversi tanggal */
function tgl_indo($tgl_spt){
  $bulan = array (
    1 =>   'Jan',
    'Feb',
    'Mar',
    'Apr',
    'Mei',
    'Jun',
    'Jul',
    'Agus',
    'Sep',
    'Okt',
    'Nov',
    'Des'
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

<style type="text/css">
  table {
  border-collapse: collapse;
}
  table, th, td {
  border: 1px solid black;
  
}

</style>

     
         <strong style="font-size: 12px;">          

            REKAPITULASI PERJALANAN DINAS <?php echo strtoupper($tmp_pagu); ?>
          <?php if ($asn == '...') { ?>
            KESELURUHAN ASN DI LINGKUNGAN SETDAKAB BIREUEN
          <?php }else{ ?>
            ASN PERORANGAN DI LINGKUNGAN SETDAKAB BIREUEN
          <?php } ?>
        </strong><br>
            <table style="font: 10pt 'Tahoma';">
              <strong>
                <tr>
                  <th rowspan="2" style="vertical-align: middle;" >No.</th>
                  <th rowspan="2" style="vertical-align: middle;" >Nama</th>
                  <th rowspan="2" style="vertical-align: middle;">Jabatan</th>
                  <th rowspan="2" style="vertical-align: middle;" >Tujuan</th>
                  <th rowspan="2" style="vertical-align: middle;" >No SPT</th>
                  <th colspan="2">Tanggal</th>
                  <th rowspan="2" style="vertical-align: middle;" >Jumlah Hari</th>
                  <th rowspan="2" style="vertical-align: middle;">Anggaran</th>
                  <th rowspan="2" style="vertical-align: middle;" >Keterangan</th>
                </tr>
                <tr>
                  
                  <th width="100px">Dari</th>
                  <th width="100px">Pulang</th>
                </tr>
              </strong>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  $tahun = date('Y');
                  $sql = "SELECT * FROM spd WHERE bulan BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tahun = '$tahun'";
                  $tampil = mysqli_query($koneksi, $sql);
                  $no=1;
                  $total = 0;
                  while ($data = mysqli_fetch_array($tampil)) { 
                  $id_spt = $data['id_spt'];
                   
                  if ($asn == '...') {
                  	if($pagu == 'semua'){
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE id_spt='$id_spt'";
                    }else{
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE pagu = '$_POST[pagu]' AND id_spt='$id_spt'";
                    }
                  }else{
                  	if($pagu == 'semua'){
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE nip = '$asn' AND id_spt='$id_spt' ";
                    }else{
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE nip = '$asn' AND pagu = '$_POST[pagu]' AND id_spt='$id_spt' ";
                    }
                  }
                  $tampil_pagu = mysqli_query($koneksi, $sql_pagu); 
                  while($data_pagu = mysqli_fetch_array($tampil_pagu)){
                  $nip = $data_pagu['nip'];

                ?>
                <tr>
                <td class="span1" style="vertical-align: top;"><center><?php echo $no++; ?></center></td>                                   
                  <td class="span3">
                    <?php 
                    $sql_pegawai = "SELECT * FROM pegawai WHERE nip='$nip'";
                      $tampil_pegawai = mysqli_query($koneksi, $sql_pegawai);     
                      $data_pegawai = mysqli_fetch_array($tampil_pegawai);
                      echo ucfirst($data_pegawai['nama']);
                      echo "<br>";
                      //echo "Nip. ".konversi_nip($data_pagu['nip']);
                      if ($data_pagu['nip'] < 999999999999) { 
                        echo ""; 
                      }else{
                        echo "Nip. ".konversi_nip($data_pagu['nip']); }
                    ?>
                  </td>
                  <td><?php echo ucfirst($data_pegawai['jabatan']); ?></td>
                    
                  <td class="span2">
                    <?php 
                      $sql_kota = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt='$id_spt'";
                      $tampil_kota = mysqli_query($koneksi, $sql_kota);     
                      $data_kota = mysqli_fetch_array($tampil_kota);
                    ?>
                    <center>
                      <?php echo $data_kota['kota']; ?></center></td>

                  <td><center><?php 
                      $sql_spt = "SELECT * FROM spt WHERE id_spt='$id_spt'";
                      $sql_spt = mysqli_query($koneksi, $sql_spt);     
                      $sql_spt = mysqli_fetch_array($sql_spt);
                    ?>
                    <?php echo $sql_spt['no_spt']; ?></center></td>

                  <td class="span2">
                    <?php 
                      $sql_spd = "SELECT * FROM spd WHERE id_spt='$id_spt'";
                      $tampil_spd = mysqli_query($koneksi, $sql_spd);     
                      $data_spd = mysqli_fetch_array($tampil_spd);
                    ?>
                    <center>
                      
                      <?php echo tgl_indo($data_spd['tgl_berangkat']); ?></center></td>

                  <td class="span2"><center><?php echo tgl_indo($data_spd['tgl_kembali']); ?></center></td>
                  <td><center><?php echo $data_spd['lama_perjalanan']; ?> Hari</center></td>

                  <td class="span2" style="text-align: right;"><center>
                    <?php
                      $jumlah = 0;
                      $sql_kw = "SELECT * FROM kwitansi_nilai WHERE nip = '$nip' AND id_spt='$id_spt'";
                      $tampil_kw = mysqli_query($koneksi, $sql_kw);     
                      while($data_kw = mysqli_fetch_array($tampil_kw)){

                        $hari = $data_kw['hari'];
                  
                        if ($data_kw['hari'] == '0') {
                          $hari2 = $data_kw['hari']+1;
                        }else{
                          $hari2 = $data_kw['hari'];
                        }

                        $nominal = $hari2*$data_kw['nominal'];
                        $jumlah+=$nominal;

                      }
                    ?>

                    <?php echo rupiah($jumlah); ?>
                  <center></td>
                  <td><?php 
                      $sql_spt = "SELECT * FROM spt WHERE id_spt='$id_spt'";
                      $sql_spt = mysqli_query($koneksi, $sql_spt);     
                      $sql_spt = mysqli_fetch_array($sql_spt);
                    ?>
                    
                    <?php
                    // Get the content from $data['dasar_penugasan']
                    $content = $sql_spt['keterangan'];
                    
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

                  <?php $total+=$jumlah; ?>
                </tr>
                <?php
                  }}
                ?>
                <tr>
                  <td colspan="9" style="text-align: right;"><strong>JUMLAH</strong></td>
                  <td  style="text-align: right;"><strong><?php echo rupiah($total); ?></strong></td>
              </tbody>
            </table>
         

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/jquery.toggle.buttons.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 

