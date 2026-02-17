<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE - Sistem Unit Layanan Elektronik Kab. Bireuen</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../img/logo_.png" rel='shortcut icon'>

</head>

<style type="text/css">
  table {
  border-collapse: collapse;
}
  table, th, td {
  border: 1px solid black;
  
}

</style>
<script>
    window.print();
</script>
<?php //include 'session.php' 
error_reporting(0);


        include "../koneksi/koneksi.php";

        $tahun = addslashes($_POST['tahun']);
        $tgl_awal = addslashes($_POST['tgl_awal']);
        $tgl_akhir = addslashes($_POST['tgl_akhir']);
        $kategori = addslashes($_POST['kategori']);
        $subkatergori = addslashes($_POST['subkatergori']);

        
        if ($subkatergori == '-- Pilih Subkategori --') {          
        $sql = "SELECT * FROM pesanan_barang_kode WHERE bulan_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tahun_pesanan = '$tahun' AND id_kategori = '$kategori'";        
        }else{
        $sql = "SELECT * FROM pesanan_barang_kode WHERE bulan_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tahun_pesanan = '$tahun' AND id_kategori = '$kategori' AND id_subkategori = '$subkatergori'";
        }

        $tampil = mysqli_query($koneksi, $sql);

        $total = 0;        

        $tampil_c=mysqli_query($koneksi, "SELECT * FROM kategori_pesanan WHERE id_pesanan = '$kategori'");
        $cek=mysqli_fetch_array($tampil_c);

        $tampil_d=mysqli_query($koneksi, "SELECT * FROM kategori_subpesanan WHERE id_sub_pesanan = '$subkatergori'");
        $cek_d=mysqli_fetch_array($tampil_d);
        
      ?>
      <strong>
        LAPORAN SURAT PESANAN BARANG/JASA <br>
        Rincian :  <?php echo $cek['pesanan']; ?> <?php echo $cek_d['sub_pesanan']; ?>
      </strong>
            <table class="table table-bordered">
              <thead>
              <tr>
                <!--<th width="35px">No. </th>-->
                <th width="150px">No Pesanan</th>
                <th width="120px">Tanggal</th>
                <th width="250px">Uraian</th>
                <th width="85px">Volume</th>
                <th width="85px">Satuan</th>
                <th width="250px">Yang dituju</th>
                <th width="150px">Keterangan</th>
              </tr>
              </thead>
              <?php 
                while ($data = mysqli_fetch_array($tampil)) { 

                $sql_sub = "SELECT * FROM pesanan_barang WHERE kode_pesanan_barang = '$data[kode_pesanan_barang]'";
                $tampil_sub = mysqli_query($koneksi, $sql_sub);
                $rowspan = mysqli_num_rows($tampil_sub);
                $no=1;
                while ($data_sub = mysqli_fetch_array($tampil_sub)) { 
              ?>
              
                <tr>

                  <?php if($jum <= 1) { ?>
                  <!--<td rowspan="<?php echo $rowspan; ?>" style="vertical-align: middle;"><center><?php echo $no++; ?>--></center></td>
                  <td rowspan="<?php echo $rowspan; ?>" style="vertical-align: middle;"><center><?php echo $data['kode_item']."/".$data['no_pesanan']."/".$data['bulan_pesanan']."/".$data['tahun_pesanan']; ?></td>                  
                  <td rowspan="<?php echo $rowspan; ?>" style="vertical-align: middle;"><center><?php echo $data['tgl']; ?></center></td>
                  <?php 
                    $jum = $rowspan;      
                    } else {
                      $jum = $jum - 1;
                    }?>
                  <td><center><?php echo $data_sub['uraian']; ?></center></td>
                  <td><center><?php echo $data_sub['banyaknya']; ?></center></td>
                  <td><center><?php echo $data_sub['satuan']; ?></center></td>
                  <td><center><?php echo $data['tujuan']; ?></center></td>
                  <td><center><?php echo $data_sub['keterangan']; ?></center></td>
                </tr>
              
            <?php }}?>
            </table>