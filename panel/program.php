<?php include 'session.php' ?>
<?php $page = 'program'; 

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Program</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Program</h3>
    
    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahProgramModal">
        <span class="icon-plus"></span> Tambah Program
      </button>
      <!-- Modal Tambah Program -->
<div id="tambahProgramModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahProgramLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="tambahProgramLabel">Tambah Program</h3>
  </div>
  <form action="" method="post">
    <div class="modal-body">
      <div class="control-group">
        <label class="control-label">Kode Program</label>
        <div class="controls">
          <input type="text" name="kode_program" class="span3" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Nama Program</label>
        <div class="controls">
          <input type="text" name="nama_program" class="span5" required>
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
if (isset($_POST['simpan'])) {
  include "../koneksi/koneksi.php";
  $kode = trim($_POST['kode_program']);
  $nama = trim($_POST['nama_program']);

  $insert = mysqli_query($koneksi, "INSERT INTO program (kode_program, nama_program) VALUES ('$kode', '$nama')");
  if (!$insert) {
      die('Query gagal: ' . mysqli_error($koneksi));
    }

  if ($insert) {
    echo "<script>window.location='?page=program&msg=3';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan program!');</script>";
  }
}


if (isset($_POST['update'])) {
  include "../koneksi/koneksi.php";
  $id      = intval($_POST['id_program']);
  $kode    = trim($_POST['kode_program']);
  $nama    = trim($_POST['nama_program']);

  $update = mysqli_query($koneksi, "UPDATE program 
                         SET kode_program='$kode', 
                             nama_program='$nama'
                         WHERE id_program='$id'");

  if ($update) {
    echo "<script>window.location='?page=program&msg=4';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui program!');</script>";
  }
}

if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM program WHERE id_program='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=program&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus program!');</script>";
  }
}

?>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Program Berhasil Ditambah!</div>
            <?php } else if ($msg == 4) {?>
              <div class="alert alert-warning alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Update!</h4>Program Berhasil Diupdate!</div>       
            <?php } 
            else if ($msg == 5) { ?>
              <div class="alert alert-danger alert-block"> 
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Hapus!</h4>Program Berhasil Dihapus!
              </div>
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table program</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered rekening-table">
              <thead>
                <tr>
                  <th>Kode Program</th>
                  <th>Nama Program</th>
                  <th>Opsi </th>
                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM program ORDER BY id_program ASC";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 

                ?>
                <tr>
                  <td class="span4"><?php echo ucfirst($data['kode_program']); ?></td>
                  <td class="span6"><?php echo ucfirst($data['nama_program']); ?></td>
                 
                  <td class="span2">
                  <a href="#modalEditProgram"
                     data-toggle="modal"
                     class="editProgram"
                     data-id="<?= $data['id_program']; ?>"
                     data-kode="<?= htmlspecialchars($data['kode_program']); ?>"
                     data-nama="<?= htmlspecialchars($data['nama_program']); ?>">
                    <span class="badge badge-warning tip-bottom" data-original-title="Edit">
                      <span class="icon-edit"></span>
                    </span>
                  </a>
                  <a href="#modalHapusProgram"
                       data-toggle="modal"
                       class="hapusProgram"
                       data-id="<?= $data['id_program']; ?>"
                       data-nama="<?= htmlspecialchars($data['nama_program']); ?>">
                      <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                        <span class="icon-trash"></span>
                      </span>
                    </a>
                </td>

<div id="modalEditProgram" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Edit Program</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_program" id="edit_id_program">

      <div class="control-group">
        <label class="control-label">Kode Program</label>
        <div class="controls">
          <input type="text" name="kode_program" id="edit_kode_program" class="span3" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Nama Program</label>
        <div class="controls">
          <input type="text" name="nama_program" id="edit_nama_program" class="span" required>
        </div>
      </div>
      
    </div>
    <div class="modal-footer">
      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
</div>



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
<div id="modalHapusProgram" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Hapus Uraian</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_program">
      <p>Apakah Anda yakin ingin menghapus program berikut?</p>
      <h4 id="hapus_nama_program" style="color:#b94a48;"></h4>
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
  $(document).on('click', '.editProgram', function() {
    var id      = $(this).data('id');
    var kode    = $(this).data('kode');
    var nama    = $(this).data('nama');

    // isi field di modal
    $('#edit_id_program').val(id);
    $('#edit_kode_program').val(kode);
    $('#edit_nama_program').val(nama);
  });
  $(document).on('click', '.hapusProgram', function() {
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      $('#hapus_id_program').val(id);
      $('#hapus_nama_program').text(nama);
    });
});
</script>
