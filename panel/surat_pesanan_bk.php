<?php include 'session.php' ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/colorpicker.css" />
<link rel="stylesheet" href="../css/datepicker.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Buku Kontrol</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Buku Kontrol</h3>
    <a href="?page=supsbk" class="btn btn-success btn-mini"><span class="icon-plus"></span> &nbsp; Tambah Data</a>
    

    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Surat Pesanan Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data Surat Pesanan!</div>       
            <?php }  else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Data Surat Pesanan Gagal disimpan!</div>       
            <?php }else if ($msg == 4) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Surat Pesanan Berhasil Disimpan!</div>  
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Buku Kontrol</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No Surat Pesanan</th>
                  <th>Yang Dituju</th>
                  <th>Tgl Pesanan</th>
                  <th>Item Pesanan</th>
                  <th>Faktur</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";

                  $sql = "SELECT * FROM pesanan_barang_kode ORDER BY kode_pesanan_barang ASC";
                  $tampil = mysqli_query($koneksi, $sql);

                  while ($data = mysqli_fetch_array($tampil)) {   
                ?>
                <tr>
                  <td class="span2"><center>
                    <?php if ($data['no_pesanan'] == '') {
                      echo "<span class='badge badge-important'>New</span>";
                    }else{
                    echo $data['kode_item']."/".$data['no_pesanan']."/".$data['bulan_pesanan']."/".$data['tahun_pesanan']; }?> </center></td>
                  <td class="span3"><center><?php echo $data['tujuan']; ?></center></td>
                  <td class="span1"><center><?php echo $data['tgl']; ?></center></td>
                  <td class="span2">
                  <?php
                  $sql_kat = "SELECT * FROM kategori_pesanan WHERE id_pesanan = '$data[id_kategori]'";
                  $tampil_kat = mysqli_query($koneksi, $sql_kat);
                  $data_kat = mysqli_fetch_array($tampil_kat);

                  $sql_sub = "SELECT * FROM kategori_subpesanan WHERE id_sub_pesanan = '$data[id_subkategori]'";
                  $tampil_sub = mysqli_query($koneksi, $sql_sub);
                  $data_sub = mysqli_fetch_array($tampil_sub);
                  
                  
                  ?>
                    <center><?php  ?> 
                    <?php if($data['id_subkategori'] == ''){ echo $data_kat['pesanan']; }else{ echo $data_kat['pesanan']; }?></center></td>
                  <td class="span1"><center>
  <?php 

$sql_pes = "SELECT COUNT(*) AS total, 
                   SUM(CASE WHEN harga IS NULL OR harga = '' THEN 1 ELSE 0 END) AS belum
            FROM pesanan_barang 
            WHERE kode_pesanan_barang = '$data[kode_pesanan_barang]'";
$tampil_pes = mysqli_query($koneksi, $sql_pes);
$data_pes = mysqli_fetch_array($tampil_pes);

if ($data_pes['belum'] == 0 && $data_pes['total'] > 0) {
    echo "<span style='color:green; font-weight:bold;'>Selesai</span>";
} else {
    echo "<span style='color:red; font-weight:bold;'>Belum Selesai</span>";
}
?>

  
</center></td>

                  <td class="span2"><center>                    
                      <a href="surat_pesanan_print.php?id=<?php echo $data['kode_pesanan_barang']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="?page=supe&id=<?php echo $data['kode_pesanan_barang']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                      <a href="?page=super&id=<?php echo $data['kode_pesanan_barang']; ?>"><span class="badge badge-warning tip-bottom" data-original-title="faktur"><span class="icon-edit" ></span></span></a>
                      <a href="?page=suph&id=<?php echo $data['kode_pesanan_barang']; ?>" onclick="return confirm('Yakin Ingin Menghapus Surat Pesanan Tersebut ?')"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a>
                    </center>
                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
<script>
$(document).ready(function() {
  // Saat tombol Buat Faktur diklik
  $('#btnFaktur').on('click', function(e) {
    e.preventDefault();
    $('#popupTanggal').fadeIn(); // tampilkan popup
  });

  // Fungsi konversi format yyyy-mm-dd ke dd-mm-yyyy
  function formatTanggal(tgl) {
    const [year, month, day] = tgl.split('-');
    return `${day}-${month}-${year}`;
  }

  // Saat tombol Cetak diklik
  $('#btnCetak').on('click', function() {
    let tglDari = $('#tgl_dari').val();
    let tglSampai = $('#tgl_sampai').val();

    if (!tglDari || !tglSampai) {
      alert('Silakan pilih kedua tanggal!');
      return;
    }

    // ubah format
    let dari = formatTanggal(tglDari);
    let sampai = formatTanggal(tglSampai);

    // buka halaman print di tab baru
    window.open(`surat_pesanan_faktur_print.php?tgl_dari=${dari}&tgl_sampai=${sampai}`, '_blank');
    $('#popupTanggal').fadeOut(); // tutup popup
  });
});
</script>

