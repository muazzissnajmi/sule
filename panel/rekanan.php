<?php include 'session.php' ?>
<?php $page = 'rekening'; ?>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Rekanan</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Rekanan</h3>
    
    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahRekeningModal">
        <span class="icon-plus"></span> Tambah Rekanan
      </button>
      <!-- Modal Tambah Rekening -->
<div id="tambahRekeningModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahRekeningLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="tambahRekeningLabel">Tambah Rekanan</h3>
  </div>
  <form method="POST" enctype="multipart/form-data">

    <div class="modal-body">
        
        
        <div class="control-group">
          <label class="control-label">Nama Perusahaan</label>
          <div class="controls">
            <input type="text" name="nama_rekanan" class="span5" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Nama Direktur</label>
          <div class="controls">
            <input type="text" name="nama_direktur" class="span5" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Alamat</label>
          <div class="controls">
            <textarea name="alamat" class="span5" required></textarea>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Nomor Kontak</label>
          <div class="controls">
            <input type="text" name="no_hp" class="span4" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Email</label>
          <div class="controls">
            <input type="text" name="email" class="span4" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Nomor NIB</label>
          <div class="controls">
            <input type="text" name="nib" class="span4" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Nomor NPWP</label>
          <div class="controls">
            <input type="text" name="npwp" class="span4" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Nama Bank</label>
          <div class="controls">
            <input type="text" name="bank" class="span4" required>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Nomor Rekening</label>
          <div class="controls">
            <input type="text" name="norek" class="span4" required>
          </div>
        </div>
        
        <hr>
        
        <div class="control-group">
          <label class="control-label">Upload Dokumen Peerusahaan</label>
          <div class="controls">
            <input type="file" name="akta" required>
          </div>
        </div>
        
        

    <div class="modal-footer">
      <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>  
    </div>
  </form>
</div>

<?php
if (isset($_POST['simpan'])) {
    include "../koneksi/koneksi.php";

    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_rekanan']);
    $direktur = mysqli_real_escape_string($koneksi, $_POST['nama_direktur']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nib    = mysqli_real_escape_string($koneksi, $_POST['nib']);
    $npwp    = mysqli_real_escape_string($koneksi, $_POST['npwp']);
    $bank    = mysqli_real_escape_string($koneksi, $_POST['bank']);
    $norek    = mysqli_real_escape_string($koneksi, $_POST['norek']);

    // Folder upload
    $path = "../uploads/rekanan/";

    $akta = time().'_akta_'.$_FILES['akta']['name'];
    $filenib  = time().'_nib_'.$_FILES['filenib']['name'];
    $filenpwp = time().'_npwp_'.$_FILES['filenpwp']['name'];

    move_uploaded_file($_FILES['akta']['tmp_name'], $path.$akta);
    move_uploaded_file($_FILES['filenib']['tmp_name'],  $path.$filenib);
    move_uploaded_file($_FILES['filenpwp']['tmp_name'], $path.$npwp);

    $sql = "
        INSERT INTO rekanan 
        (nama_rekanan, nama_direktur, alamat, no_hp, email, nib, npwp, bank, norek, file_akta, file_nib, file_npwp)
        VALUES
        ('$nama','$direktur','$alamat','$no_hp','$email','$nib','$npwp','$bank','$norek','$akta','$filenib','$filenpwp')
    ";

    $insert = mysqli_query($koneksi, $sql);

    if ($insert) {
        echo "<script>location='?page=rekanan&msg=3';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}
if (isset($_POST['update'])) {
  include "../koneksi/koneksi.php";

  $id       = intval($_POST['id_rekanan']);
  $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_rekanan_edit']);
  $direktur = mysqli_real_escape_string($koneksi, $_POST['nama_direktur_edit']);
  $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat_edit']);
  $email   = mysqli_real_escape_string($koneksi, $_POST['email_edit']);
  $no_hp    = mysqli_real_escape_string($koneksi, $_POST['no_hp_edit']);
  $nib    = mysqli_real_escape_string($koneksi, $_POST['nib_edit']);
  $npwp    = mysqli_real_escape_string($koneksi, $_POST['npwp_edit']);
  $bank    = mysqli_real_escape_string($koneksi, $_POST['bank_edit']);
  $norek    = mysqli_real_escape_string($koneksi, $_POST['norek_edit']);
  

  $path = "../uploads/rekanan/";
  $akta = $_POST['akta_lama'];

  if (!empty($_FILES['akta']['name'])) {
    $akta = time().'_akta_'.$_FILES['akta']['name'];
    move_uploaded_file($_FILES['akta']['tmp_name'], $path.$akta);
  }

  $sql = "
    UPDATE rekanan SET
      nama_rekanan='$nama',
      nama_direktur='$direktur',
      alamat='$alamat',
      no_hp='$no_hp',
      email='$email',
      nib='$nib',
      npwp='$npwp',
      bank='$bank',
      norek='$norek',
      file_akta='$akta'
    WHERE id_rekanan='$id'
  ";

  if (mysqli_query($koneksi, $sql)) {
    echo "<script>location='?page=rekanan&msg=4';</script>";
  } else {
    die(mysqli_error($koneksi));
  }
}


if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM rekanan WHERE id_rekanan='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=rekanan&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus rekanan!');</script>";
  }
}

?>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Rekanan Berhasil Ditambahkan!</div>
            <?php } else if ($msg == 2){?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Rekening!</div>       
            <?php } 
            
        ?>
        <?php if ($msg == 4) { ?>
<div class="alert alert-success alert-block">
  <a class="close" data-dismiss="alert">×</a>
  <h4>Success!</h4>Data Rekanan berhasil diupdate
</div>
<?php } ?>

      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Rekanan</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Perusahaan</th>
                  <th>Direktur</th>
                  <th>Alamat</th>
                  <th>Hp</th>
                  <th>Email</th>
                  <th>Bank</th>
                  <th>Rekening</th>
                  <th>NIB</th>
                  <th>NPWP</th>
                  <th>Action</th>

                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM rekanan";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 

                ?>
                <tr>
                    
                    <td><?= $data['nama_rekanan']; ?></td>
                    <td><?= $data['nama_direktur']; ?></td>
                    <td><?= $data['alamat']; ?></td>
                    <td><?= $data['no_hp']; ?></td>
                    <td><?= $data['email']; ?></td>
                    <td><?= $data['bank']; ?></td>
                    <td><?= $data['norek']; ?></td>
                    <td><?= $data['nib']; ?></td>
                    <td><?= $data['npwp']; ?></td>
                   
                    <td class="span2 no-print">
                        <a href="#editRekananModal"
                           data-toggle="modal"
                           class="editRekanan"
                           data-id="<?= $data['id_rekanan']; ?>"
                           data-nama="<?= htmlspecialchars($data['nama_rekanan']); ?>"
                           data-direktur="<?= htmlspecialchars($data['nama_direktur']); ?>"
                           data-alamat="<?= htmlspecialchars($data['alamat']); ?>"
                           data-hp="<?= $data['no_hp']; ?>"
                           data-email="<?= $data['email']; ?>"
                           data-npwp="<?= $data['npwp']; ?>"
                           data-nib="<?= $data['nib']; ?>"
                           data-bank="<?= $data['bank']; ?>"
                           data-norek="<?= $data['norek']; ?>"
                           data-akta="<?= $data['file_akta']; ?>">
                           <span class="badge badge-warning">
                             <span class="icon-edit"></span>
                           </span>
                        </a>

                         <a href="#modalHapusRekanan"
                           data-toggle="modal"
                           class="hapusRekanan"
                           data-id="<?= $data['id_rekanan']; ?>"
                           data-nama="<?= htmlspecialchars($data['nama_rekanan']); ?>">
                          <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                            <span class="icon-trash"></span>
                          </span>
                        </a>
                    <a href="../uploads/rekanan/<?= $data['file_akta']; ?>" target="_blank">
                    <span class="badge tip-bottom" data-original-title="Dokumen">
                        <span class="icon-print"></span></span></a> 
                    
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
<!-- Modal Edit Rekanan -->
<div id="editRekananModal" class="modal hide fade" tabindex="-1">
  <form method="POST" enctype="multipart/form-data">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">×</button>
      <h3>Edit Rekanan</h3>
    </div>

    <div class="modal-body">
      <input type="hidden" name="id_rekanan" id="edit_id">

      <div class="control-group">
        <label class="control-label">Nama Perusahaan</label>
        <div class="controls">
          <input type="text" name="nama_rekanan_edit" id="edit_nama" class="span4" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Nama Direktur</label>
        <div class="controls">
          <input type="text" name="nama_direktur_edit" id="edit_direktur" class="span4" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Alamat</label>
        <div class="controls">
          <textarea name="alamat_edit" id="edit_alamat" class="span5" required></textarea>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Nomor HP</label>
        <div class="controls">
          <input type="text" name="no_hp_edit" id="edit_hp" class="span4" required>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Email</label>
        <div class="controls">
          <input type="text" name="email_edit" id="edit_email" class="span4" required>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Nomor NIB</label>
        <div class="controls">
          <input type="text" name="nib_edit" id="edit_nib" class="span4" required>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Nomor NPWP</label>
        <div class="controls">
          <input type="text" name="npwp_edit" id="edit_npwp" class="span4" required>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Nama Bank</label>
        <div class="controls">
          <input type="text" name="bank_edit" id="edit_bank" class="span4" required>
        </div>
      </div>
      
      <div class="control-group">
        <label class="control-label">Nomor Rekening</label>
        <div class="controls">
          <input type="text" name="norek_edit" id="edit_norek" class="span4" required>
        </div>
      </div>

      <hr>

      <p><strong>Upload Dokumen (opsional, ganti jika diupload)</strong></p>

      <div class="control-group">
        <div class="controls">
          <input type="file" name="akta">
          <input type="hidden" name="akta_lama" id="edit_akta_lama">
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" name="update" class="btn btn-primary">Update</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
</div>

<div id="modalHapusRekanan" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Hapus Rekanan</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_rekanan">
      <p>Apakah Anda yakin ingin menghapus rekanan berikut?</p>
      <h4 id="hapus_nama_rekanan" style="color:#b94a48;"></h4>
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
$(document).on('click', '.editRekanan', function () {
  $('#edit_id').val($(this).data('id'));
  $('#edit_nama').val($(this).data('nama'));
  $('#edit_direktur').val($(this).data('direktur'));
  $('#edit_alamat').val($(this).data('alamat'));
  $('#edit_hp').val($(this).attr('data-hp'));
  $('#edit_email').val($(this).attr('data-email'));
  $('#edit_nib').val($(this).attr('data-nib'));
  $('#edit_npwp').val($(this).attr('data-npwp'));
  $('#edit_norek').val($(this).attr('data-norek'));
  $('#edit_bank').val($(this).data('bank'));
  $('#edit_akta_lama').val($(this).data('akta'));
});

$(document).on('click', '.hapusRekanan', function() {
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  $('#hapus_id_rekanan').val(id);
  $('#hapus_nama_rekanan').text(nama);
});
</script>

