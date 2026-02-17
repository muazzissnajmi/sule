<?php include 'session.php'; ?>
<?php $page = 'suburaian'; ?>

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
    <div id="breadcrumb"> 
      <a href="?page=home" title="Go to Home" class="tip-bottom">
        <i class="icon-home"></i> Home
      </a> 
      <a href="#" class="tip-bottom">Sub Uraian</a>
    </div>
  </div>

  <div class="container-fluid">
    <h3>Sub Uraian</h3>
    
    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahSubUraianModal">
      <span class="icon-plus"></span> Tambah Sub Uraian
    </button>

    <!-- Modal Tambah Sub Uraian -->
    <div id="tambahSubUraianModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahSubUraianLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 id="tambahSubUraianLabel">Tambah Sub Uraian</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          
          <div class="control-group">
            <label class="control-label">Pilih Uraian</label>
            <div class="controls">
              <select name="id_uraian" id="id_uraian" required>
                <option value="">-- Pilih Uraian --</option>
                <?php
                  include "../koneksi/koneksi.php";
                  $uraian = mysqli_query($koneksi, "SELECT * FROM uraian ORDER BY nama_uraian ASC");
                  while($u = mysqli_fetch_array($uraian)) {
                    echo "<option value='$u[id_uraian]'>$u[nama_uraian]</option>";
                  }
                ?>
              </select>
            </div>
          </div>


          <div class="control-group">
            <label class="control-label">Nama Sub Uraian</label>
            <div class="controls">
              <input type="text" name="nama_suburaian" class="span5" required>
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
        $id_uraian = $_POST['id_uraian'];
        $kode = null;
        $nama = trim($_POST['nama_suburaian']);

        $insert = mysqli_query($koneksi, "INSERT INTO sub_uraian (id_uraian, kode_suburaian, nama_suburaian) VALUES ('$id_uraian', '$kode', '$nama')");
        if ($insert) {
          echo "<script>window.location='?page=suburaian&msg=3';</script>";
        } else {
          echo "<script>alert('Gagal menambahkan sub uraian!');</script>";
        }
      }
    ?>

    <div class="row-fluid">
      <?php
        $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
        if ($msg == 1) {
          echo '<div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Success!</h4>Data berhasil dihapus!</div>';
        } else if ($msg == 2) {
          echo '<div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a><h4 class="alert-heading">Error!</h4>Gagal menghapus data!</div>';
        }
      ?>
      
      <div class="widget-box">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Data Table Sub Uraian</h5>
        </div>

        <div class="widget-content nopadding">
          <table class="table table-bordered data-table">
            <thead>
              <tr>
                <th>Uraian</th>
                <th>Nama Sub Uraian</th>
              </tr>
            </thead>
            <tbody>
              <?php
                include "../koneksi/koneksi.php";
                $sql = "SELECT s.*, u.nama_uraian 
                        FROM sub_uraian s 
                        JOIN uraian u ON s.id_uraian = u.id_uraian 
                        ORDER BY u.nama_uraian ASC, s.nama_suburaian ASC";
                $tampil = mysqli_query($koneksi, $sql);
                while ($data = mysqli_fetch_array($tampil)) {
              ?>
              <tr>
                <td><?php echo $data['nama_uraian']; ?></td>
                <td><?php echo $data['nama_suburaian']; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
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
