<?php include 'session.php' ?>
<?php $page = 'subkegiatan'; 

?>


<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Sub Kegiatan</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Sub Kegiatan</h3>
    
    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahSubKegiatanModal">
        <span class="icon-plus"></span> Tambah Sub Kegiatan
      </button>
      <!-- Modal Tambah Sub Kegiatan -->
<div id="tambahSubKegiatanModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahSubKegiatanLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="tambahSubKegiatanLabel">Tambah Sub Kegiatan</h3>
  </div>
  <form action="" method="post">
    <div class="modal-body">
        <div class="control-group">
            <label class="control-label">Kegiatan</label>
            <div class="controls">
              <select name="id_kegiatan" required hidden>
                <option value="0">-- Pilih Kegiatan --</option>
                <?php
                  include "../koneksi/koneksi.php";
                  $program = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY id_kegiatan ASC");
                  while ($r = mysqli_fetch_array($program)) {
                    echo "<option value='$r[id_kegiatan]'>$r[kode_kegiatan] - $r[nama_kegiatan]</option>";
                  }
                ?>
              </select>
            </div>
            
         </div>
      <div class="control-group">
        <label class="control-label">Kode Sub Kegiatan</label>
        <div class="controls">
          <input type="text" name="kode_sub_kegiatan" class="span3" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Nama Sub Kegiatan</label>
        <div class="controls">
          <input type="text" name="nama_sub_kegiatan" class="span5" required>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
</div>

<?php
function getKegiatan($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT kode_kegiatan, nama_kegiatan FROM kegiatan WHERE id_kegiatan = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return "<strong>".$row['kode_kegiatan'] . "</strong> - " . $row['nama_kegiatan'];
  } else {
    return "-";
  }
}
if (isset($_POST['simpan'])) {
  include "../koneksi/koneksi.php";
  $kegiatan = trim($_POST['id_kegiatan']);
  $kode = trim($_POST['kode_sub_kegiatan']);
  $nama = trim($_POST['nama_sub_kegiatan']);

  $insert = mysqli_query($koneksi, "INSERT INTO sub_kegiatan (kode_sub_kegiatan, id_kegiatan, nama_sub_kegiatan) VALUES ('$kode', '$kegiatan', '$nama')");
  if (!$insert) {
      die('Query gagal: ' . mysqli_error($koneksi));
    }

  if ($insert) {
    echo "<script>window.location='?page=subkegiatan&msg=3';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan subkegiatan!');</script>";
  }
}


if (isset($_POST['update'])) {
  include "../koneksi/koneksi.php";
  $id      = intval($_POST['id_sub_kegiatan']);
  $kode    = trim($_POST['kode_sub_kegiatan']);
  $nama    = trim($_POST['nama_sub_kegiatan']);
  $kegiatan = trim($_POST['id_kegiatan']);

  $update = mysqli_query($koneksi, "UPDATE sub_kegiatan 
                         SET id_kegiatan='$kegiatan',
                             kode_sub_kegiatan='$kode', 
                             nama_sub_kegiatan='$nama'
                         WHERE id_sub_kegiatan='$id'");

  if ($update) {
    echo "<script>window.location='?page=subkegiatan&msg=4';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui sub kegiatan!');</script>";
  }
}

if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM sub_kegiatan WHERE id_sub_kegiatan='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=subkegiatan&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus sub kegiatan!');</script>";
  }
}

?>
    <div class="row-fluid">

        <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Sub Kegiatan Berhasil Ditambah!</div>
            <?php } else if ($msg == 4) {?>
              <div class="alert alert-warning alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Update!</h4>Sub Kegiatan Berhasil Diupdate!</div>       
            <?php } 
            else if ($msg == 5) { ?>
              <div class="alert alert-danger alert-block"> 
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Hapus!</h4>Sub Kegiatan Berhasil Dihapus!
              </div>
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Sub Kegiatan</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered rekening-table">
              <thead>
                <tr>
                  <th>Program</th>
                  <th>Nama Sub Kegiatan</th>
                  <th>Opsi </th>
                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                include "../koneksi/koneksi.php";
                
                // ambil data kegiatan urutkan by kegiatan
                $sql = "SELECT * FROM sub_kegiatan ORDER BY id_kegiatan ASC, id_sub_kegiatan ASC";
                $tampil = mysqli_query($koneksi, $sql);
                
                // hitung jumlah row per kegiatan
                $counts = [];
                $result = mysqli_query($koneksi, "SELECT id_kegiatan, COUNT(*) as jml FROM sub_kegiatan GROUP BY id_kegiatan");
                while ($r = mysqli_fetch_array($result)) {
                  $counts[$r['id_kegiatan']] = $r['jml'];
                }
                
                $lastKegiatan = null;
                
                while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                  <?php if ($data['id_kegiatan'] != $lastKegiatan) { ?>
                    <td class="span5" rowspan="<?= $counts[$data['id_kegiatan']] ?>">
                      <?= ucfirst(getKegiatan($data['id_kegiatan'])); ?>
                    </td>
                  <?php } ?>
                
                  <td class="span5"><strong><?= ucfirst($data['kode_sub_kegiatan']); ?></strong> - <?= ucfirst($data['nama_sub_kegiatan']); ?></td>
                  <td class="span2 no-print">
                    <a href="#modalEditSubKegiatan"
                       data-toggle="modal"
                       class="editSubKegiatan"
                       data-id="<?= $data['id_sub_kegiatan']; ?>"
                       data-kegiatan="<?= $data['id_kegiatan']; ?>"
                       data-kode="<?= htmlspecialchars($data['kode_sub_kegiatan']); ?>"
                       data-nama="<?= htmlspecialchars($data['nama_sub_kegiatan']); ?>">
                      <span class="badge badge-warning tip-bottom" data-original-title="Edit">
                        <span class="icon-edit"></span>
                      </span>
                    </a>
                    <a href="#modalHapusSubKegiatan"
                       data-toggle="modal"
                       class="hapusSubKegiatan"
                       data-id="<?= $data['id_sub_kegiatan']; ?>"
                       data-nama="<?= htmlspecialchars($data['nama_sub_kegiatan']); ?>">
                      <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                        <span class="icon-trash"></span>
                      </span>
                    </a>
                    
                  </td>
                </tr>
                <?php
                $lastKegiatan = $data['id_kegiatan'];
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
<div id="modalEditSubKegiatan" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Edit Sub Kegiatan</h3>
    </div>
    <div class="modal-body">
      
      <?php
        include "../koneksi/koneksi.php";
        $qKegiatan = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY nama_kegiatan ASC");
      ?>
      
      <input type="hidden" name="id_sub_kegiatan" id="edit_id_sub_kegiatan">
      <div class="control-group">
      <label class="control-label">Kegiatan</label>
      <div class="controls">
        <select name="id_kegiatan" id="edit_id_kegiatan" required>
          <option value="0">Pilih Kegiatan</option>
          <?php 
          while ($k = mysqli_fetch_array($qKegiatan)) { 
              // cek apakah id_kegiatan di tabel rekening sama dengan yang sedang di-loop
              $selected = '';
          ?>
            <option value="<?php echo $k['id_kegiatan']; ?>" <?php echo $selected; ?>>
              <?php echo htmlspecialchars($k['kode_kegiatan'])." - ".htmlspecialchars($k['nama_kegiatan']); ?>
            </option>
          <?php } ?>
        </select>
      </div>
    </div>

      <div class="control-group">
        <label class="control-label">Kode Sub Kegiatan</label>
        <div class="controls">
          <input type="text" name="kode_sub_kegiatan" id="edit_kode_sub_kegiatan" class="span2" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Nama Sub Kegiatan</label>
        <div class="controls">
          <input type="text" name="nama_sub_kegiatan" id="edit_nama_sub_kegiatan" class="span5" required>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
</div>
<div id="modalHapusSubKegiatan" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Hapus Uraian</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_sub_kegiata">
      <p>Apakah Anda yakin ingin menghapus sub kegiatan berikut?</p>
      <h4 id="hapus_nama_sub_kegiatan" style="color:#b94a48;"></h4>
    </div>
    <div class="modal-footer">
      <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
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
  // Gunakan event delegation agar tetap berfungsi meski datanya di-load oleh plugin datatable
  $(document).on('click', '.editSubKegiatan', function() {
    var id      = $(this).data('id');
    var kode    = $(this).data('kode');
    var nama    = $(this).data('nama');
    var kegiatan    = $(this).data('kegiatan');

    // isi field di modal
    
    $('#edit_id_sub_kegiatan').val(id);
    $('#edit_kode_sub_kegiatan').val(kode);
    $('#edit_nama_sub_kegiatan').val(nama);
    $('#edit_id_kegiatan').val(kegiatan).trigger('change');
  });
  
  $(document).on('click', '.hapusSubKegiatan', function() {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      $('#hapus_id_sub_kegiatan').val(id);
      $('#hapus_nama_sub_kegiatan').text(nama);
    });
});
</script>
