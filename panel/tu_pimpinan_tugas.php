<?php include 'session.php' ?>
<?php $page = 'rekening'; 
function tgl_indo($tgl_spt){
  $bulan = array (
    1 =>   'Jan',
    'Feb',
    'Mar',
    'Apr',
    'Mei',
    'Juni',
    'Juli',
    'Agt',
    'Sep',
    'Okt',
    'Nov',
    'Des'
  );
  $pecahkan = explode('-', $tgl_spt);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="../css/select2.css" />
<script src="../js/jquery.js"></script>
<style>

select:invalid {
    border: 1px solid red !important;
    background-color: #ffe6e6; /* optional biar lebih jelas */
}


/* tampilkan dropdown select2 */
.select2-dropdown { 
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Fix tingginya */
.select2-results__options {
    max-height: 200px !important;
}

/* Perbaikan container yang tertutup matrix.css */
.select2-container .select2-selection--single {
    height: 34px !important;
    padding: 4px 8px !important;
}

.select2-container {
    position: relative;
    display: inline-block;
    zoom: 1;
    vertical-align: super;
    width: 30%;
}

.select2-container--default .select2-results > .select2-results__options {
    max-height: 300px !important;
    overflow-y: auto !important;
}

</style>
<style>

select:invalid {
    border: 1px solid red !important;
    background-color: #ffe6e6; /* optional biar lebih jelas */
}


/* tampilkan dropdown select2 */
.select2-dropdown { 
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Fix tingginya */
.select2-results__options {
    max-height: 200px !important;
}

/* Perbaikan container yang tertutup matrix.css */
.select2-container .select2-selection--single {
    height: 34px !important;
    padding: 4px 8px !important;
}

.select2-container--default .select2-results > .select2-results__options {
    max-height: 300px !important;
    overflow-y: auto !important;
}

</style>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">TU Pimpinan</a></div>
  
</div>
  <div class="container-fluid">
    <h3>KARTU KENDALI NASKAH SURAT TUGAS</h3>
    
    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahRekeningModal">
        <span class="icon-plus"></span> Tambah Data
      </button>
      <button class="btn btn-info btn-mini" id="printBtn">Print Table</button>
      <!-- Modal Tambah Rekening -->
<div id="tambahRekeningModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahRekeningLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="tambahRekeningLabel">Tambah Data</h3>
  </div>
  <form method="POST" enctype="multipart/form-data">

      <div class="modal-body">
        <div class="row-fluid">
          <!-- KOLOM KIRI -->
          <div class="span6">
            <div class="control-group">
              <label class="control-label">No SPT</label>
              <div class="controls">
                Peg.800.1.11.1/ST/<input type="text" class="span2" name="no_spt" id="no_spt" placeholder="" required/> /<?php echo date('Y');?><br>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">Tanggal SPT</label>
              <div class="controls">
                <input type="date" name="tanggal_spt" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
                <div class="control-group">
                  <label class="control-label">Dasar Surat</label>
                  <div class="controls">
                    <textarea name="dasar_surat" class="span12" required></textarea>
                  </div>
                </div>
          </div>
        </div>
        <div class="row-fluid">
          <!-- KOLOM KIRI -->
          <div class="span6">
            <div class="control-group">
              <label class="control-label">Nama</label>
              <div class="controls">
                <input type="text" name="nama" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">NIP</label>
              <div class="controls">
                <input type="text" name="nip" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row-fluid">
          <!-- KOLOM KANAN -->
          <div class="span6">
              
            <div class="control-group">
              <label class="control-label">Jabatan</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="jabatan" class="span12" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Pergi</label>
              <div class="controls">
                <input type="date" name="tanggal_pergi" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">Instansi</label>
              <div class="controls">
                <input type="text" autocomplete="off"  name="instansi" class="span12" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Pulang</label>
              <div class="controls">
                <input type="date" name="tanggal_pulang" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
                <div class="control-group">
                  <label class="control-label">Tujuan</label>
                  <div class="controls">
                      <input type="text" autocomplete="off"  name="tujuan" class="span12" required>
                  </div>
                </div>
          </div>
        </div>
        
        <div class="row-fluid">
          <div class="span12">
                <div class="control-group">
                  <label class="control-label">Keterangan</label>
                  <div class="controls">
                      <textarea name="keterangan" class="span12" required></textarea>
                  </div>
                </div>
          </div>
        </div>
    
        <div class="control-group">
          <label class="control-label">Upload Dokumen</label>
          <div class="controls">
            <input type="file" name="dokumen" >
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

    $no_spt        = mysqli_real_escape_string($koneksi, $_POST['no_spt']);
    $tanggal_spt  = mysqli_real_escape_string($koneksi, $_POST['tanggal_spt']);
    $dasar_surat  = mysqli_real_escape_string($koneksi, ucwords($_POST['dasar_surat']));
    $nama         = mysqli_real_escape_string($koneksi, ucwords(strtolower($_POST['nama'])));
    $nip          = mysqli_real_escape_string($koneksi, $_POST['nip']); // NIP jangan diubah
    $jabatan      = mysqli_real_escape_string($koneksi, ucwords(strtolower($_POST['jabatan'])));
    $tanggal_pergi  = mysqli_real_escape_string($koneksi, $_POST['tanggal_pergi']);
    $tanggal_pulang = mysqli_real_escape_string($koneksi, $_POST['tanggal_pulang']);
    $instansi     = mysqli_real_escape_string($koneksi, ucwords($_POST['instansi']));
    $tujuan       = mysqli_real_escape_string($koneksi, ucwords($_POST['tujuan']));
    $keterangan   = mysqli_real_escape_string($koneksi, ucwords($_POST['keterangan']));
    
    $path = "../uploads/tu_pimpinan_tugas/";
    $dokumen = "";
    
    if (!empty($_FILES['dokumen']['name'])) {
    
        if ($_FILES['dokumen']['error'] == 0) {
    
            $ext = pathinfo($_FILES['dokumen']['name'], PATHINFO_EXTENSION);
            $nama_baru = time() . "_tupim_tugas." . $ext;
            
            $allowed = array('pdf','doc','docx','jpg','png','jpeg');

            if (!in_array(strtolower($ext), $allowed)) {
                die("Format file tidak diizinkan.");
            }

            if (move_uploaded_file($_FILES['dokumen']['tmp_name'], $path . $nama_baru)) {
                $dokumen = $nama_baru;
            } else {
                die("Gagal upload file.");
            }
    
        } else {
            die("Terjadi error saat upload file.");
        }
    }

    $sql = "
        INSERT INTO tupim_tugas 
        (no_spt, tanggal_spt, dasar_surat, nama, nip, jabatan, tanggal_pergi, tanggal_pulang, instansi, tujuan, keterangan, dokumen)
        VALUES
        ('$no_spt','$tanggal_spt','$dasar_surat','$nama','$nip','$jabatan','$tanggal_pergi','$tanggal_pulang', '$instansi', '$tujuan', '$keterangan', '$dokumen')
    ";

    $insert = mysqli_query($koneksi, $sql);

    if ($insert) {
        echo "<script>location='?page=tupimst&msg=3';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}
if (isset($_POST['update'])) {

    include "../koneksi/koneksi.php";

    $id = intval($_POST['id']);
    $no_spt = mysqli_real_escape_string($koneksi, $_POST['no_spt_edit']);
    $tanggal_spt = mysqli_real_escape_string($koneksi, $_POST['tanggal_spt_edit']);
    $dasar_surat = mysqli_real_escape_string($koneksi, $_POST['dasar_surat_edit']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_edit']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip_edit']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan_edit']);
    $tanggal_pergi = mysqli_real_escape_string($koneksi, $_POST['tanggal_pergi_edit']);
    $tanggal_pulang = mysqli_real_escape_string($koneksi, $_POST['tanggal_pulang_edit']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi_edit']);
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['tujuan_edit']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan_edit']);
    
    $path = "../uploads/tu_pimpinan_tugas/";
    $dokumen = $_POST['dokumen_lama'];
    
    if (!empty($_FILES['dokumen']['name'])) {
    
        if ($_FILES['dokumen']['error'] == 0) {
    
            // hapus file lama kalau ada
            if (!empty($dokumen) && file_exists($path . $dokumen)) {
                unlink($path . $dokumen);
            }
    
            $ext = pathinfo($_FILES['dokumen']['name'], PATHINFO_EXTENSION);
            $nama_baru = time() . "_tupim_tugas." . $ext;
            
            $allowed = array('pdf','doc','docx','jpg','png','jpeg');

            if (!in_array(strtolower($ext), $allowed)) {
                die("Format file tidak diizinkan.");
            }
    
            if (move_uploaded_file($_FILES['dokumen']['tmp_name'], $path . $nama_baru)) {
                $dokumen = $nama_baru;
            } else {
                die("Gagal upload file.");
            }
    
        } else {
            die("Terjadi error saat upload file.");
        }
    }

    $sql = "
        UPDATE tupim_tugas SET
            no_spt='$no_spt',
            tanggal_spt='$tanggal_spt',
            dasar_surat='$dasar_surat',
            nama='$nama',
            nip='$nip',
            jabatan='$jabatan',
            tanggal_pergi='$tanggal_pergi',
            tanggal_pulang='$tanggal_pulang',
            instansi='$instansi',
            tujuan='$tujuan',
            keterangan='$keterangan',
            dokumen='$dokumen'
        WHERE id='$id'
    ";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>location='?page=tupimst&msg=4';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}



if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM tupim_tugas WHERE id='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=tupimst&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus surat tugas!');</script>";
  }
}
if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $cek = mysqli_fetch_array(mysqli_query($koneksi, "SELECT dokumen FROM tupim_tugas WHERE id='$id'"));
  
  if (!empty($cek['dokumen'])) {
      $path = "../uploads/tu_pimpinan_tugas/";
      if (file_exists($path.$cek['dokumen'])) {
          unlink($path.$cek['dokumen']);
      }
  }

  $hapus = mysqli_query($koneksi, "DELETE FROM tupim_tugas WHERE id='$id'");

  if ($hapus) {
    echo "<script>window.location='?page=tupimst&msg=5';</script>";
  }
}

?>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Surat Tugas Berhasil Ditambahkan!</div>
            <?php } else if ($msg == 2){?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Surat Tugas!</div>       
            <?php } 
        if ($msg == 4) { ?>
        <div class="alert alert-success alert-block">
          <a class="close" data-dismiss="alert">×</a>
          <h4>Success!</h4>Data Surat Tugas berhasil diupdate
        </div>
        <?php } ?>

      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Surat Tugas</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="tablePesanan">
              <thead>
                <tr>
                    <th rowspan="2" style="vertical-align: middle;">No</th>
                    <th rowspan="2" style="vertical-align: middle;">Tanggal SPT</th>
                    <th rowspan="2" style="vertical-align: middle;">Nomor SPT</th>
                    <th rowspan="2" style="vertical-align: middle;">Dasar Surat</th>
                    <th rowspan="2" style="vertical-align: middle;">Nama/NIP</th>
                    <th rowspan="2" style="vertical-align: middle;">Instansi</th>
                    <th rowspan="2" style="vertical-align: middle;">Jabatan</th>
                    <th colspan="2">Tanggal</th>
                    <th class="span1" rowspan="2" style="vertical-align: middle;">Jumlah Hari</th>
                    <th rowspan="2" style="vertical-align: middle;">Tujuan</th>
                    <th rowspan="2" style="vertical-align: middle;">Keterangan</th>
                    <th rowspan="2" style="vertical-align: middle;" class="no-print">Action</th>
                </tr>
                <tr>
                    <th style="vertical-align: middle;">Dari</th>
                    <th style="vertical-align: middle;">Pulang</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM tupim_tugas";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) {
                    $tgl_pergi  = new DateTime($data['tanggal_pergi']);
                    $tgl_pulang = new DateTime($data['tanggal_pulang']);
                    $selisih = $tgl_pergi->diff($tgl_pulang)->days + 1;

                ?>
                <tr>
                    
                    <td><center><?= $no++; ?></center></td>
                    <td class="span2"><center><?= tgl_indo($data['tanggal_spt']); ?></center></td>
                    <td class="span1"><center>Peg.800.1.11.1/ST/<?= $data['no_spt']; ?>/<?php echo date('Y');?></center></td>
                    <td class="span2"><?= $data['dasar_surat']; ?></td>
                    <td class="span3"><strong><?= $data['nama']; ?></strong><br>NIP: <?= $data['nip']; ?></td>
                    <td class="span2"><center><?= $data['instansi']; ?></center></td>
                    <td><?= $data['jabatan']; ?></td>
                    <td class="span2"><?= tgl_indo($data['tanggal_pergi']); ?></td>
                    <td class="span2"><?= tgl_indo($data['tanggal_pulang']); ?></td>
                    <td><?= $selisih ;?> Hari</td>
                    <td><?= $data['tujuan']; ?></td>
                    <td class="span3"><?= $data['keterangan']; ?></td>
                   
                    <td class="span2 no-print">
                        <a href="#editRekananModal"
                           data-toggle="modal"
                           class="editRekanan"
                           data-id="<?= $data['id']; ?>"
                           data-no_spt="<?= $data['no_spt']; ?>"
                            data-tanggal_spt="<?= $data['tanggal_spt']; ?>"
                            data-dasar_surat="<?= htmlspecialchars($data['dasar_surat']); ?>"
                            data-nama="<?= htmlspecialchars($data['nama']); ?>"
                            data-nip="<?= $data['nip']; ?>"
                            data-jabatan="<?= htmlspecialchars($data['jabatan']); ?>"
                            data-tanggal_pergi="<?= $data['tanggal_pergi']; ?>"
                            data-tanggal_pulang="<?= $data['tanggal_pulang']; ?>"
                            data-instansi="<?= htmlspecialchars($data['instansi']); ?>"
                            data-tujuan="<?= htmlspecialchars($data['tujuan']); ?>"
                            data-keterangan="<?= htmlspecialchars($data['keterangan']); ?>"
                            data-dokumen="<?= $data['dokumen']; ?>" >

                           <span class="badge badge-warning">
                             <span class="icon-edit"></span>
                           </span>
                        </a>

                         <a href="#modalHapusRekanan"
                           data-toggle="modal"
                           class="hapusRekanan"
                           data-id="<?= $data['id']; ?>"
                           data-nama="<?= htmlspecialchars($data['no_spt']); ?>">
                          <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                            <span class="icon-trash"></span>
                          </span>
                        </a>
                        
                        <?php if(!empty($data['dokumen'])) { ?>
                        <a href="../uploads/tu_pimpinan_tugas/<?= $data['dokumen']; ?>" target="_blank">
                            <span class="badge">
                                <span class="icon-print"></span>
                            </span>
                        </a>
                        <?php } ?>

                    
                    
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
    <h3>Edit Surat Tugas</h3>
</div>

<div class="modal-body">
<input type="hidden" name="id" id="edit_id">

<div class="control-group">
<label>No SPT</label>
<input type="text" name="no_spt_edit" id="edit_no_spt" class="span4" required>
</div>

<div class="control-group">
<label>Tanggal SPT</label>
<input type="date" name="tanggal_spt_edit" id="edit_tanggal_spt" required>
</div>

<div class="control-group">
<label>Dasar Surat</label>
<textarea name="dasar_surat_edit" id="edit_dasar_surat" class="span5" required></textarea>
</div>

<div class="control-group">
<label>Nama</label>
<input type="text" name="nama_edit" id="edit_nama" class="span4" required>
</div>

<div class="control-group">
<label>NIP</label>
<input type="text" name="nip_edit" id="edit_nip" class="span4" required>
</div>

<div class="control-group">
<label>Jabatan</label>
<input type="text" name="jabatan_edit" id="edit_jabatan" class="span4" required>
</div>

<div class="control-group">
<label>Tanggal Pergi</label>
<input type="date" name="tanggal_pergi_edit" id="edit_tanggal_pergi" required>
</div>

<div class="control-group">
<label>Tanggal Pulang</label>
<input type="date" name="tanggal_pulang_edit" id="edit_tanggal_pulang" required>
</div>

<div class="control-group">
<label>Instansi</label>
<input type="text" name="instansi_edit" id="edit_instansi" class="span4" required>
</div>

<div class="control-group">
<label>Tujuan</label>
<input type="text" name="tujuan_edit" id="edit_tujuan" class="span4" required>
</div>

<div class="control-group">
<label>Keterangan</label>
<textarea name="keterangan_edit" id="edit_keterangan" class="span5" required></textarea>
</div>

<hr>

<div class="control-group">
<label>Dokumen (opsional)</label>
<input type="file" name="dokumen">
<input type="hidden" name="dokumen_lama" id="edit_dokumen_lama">
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
      <h3>Hapus Surat Tugas</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_rekanan">
      <p>Apakah Anda yakin ingin menghapus surat tugas berikut?</p>
      <h4 id="hapus_nama_rekanan" style="color:#b94a48;"></h4>
    </div>
    <div class="modal-footer">
      <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
</div>


<!--end-Footer-part--> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.tables.js"></script>


<script>

$(document).on('click', '.editRekanan', function () {

  $('#edit_id').val($(this).data('id'));
  $('#edit_no_spt').val($(this).data('no_spt'));
  $('#edit_tanggal_spt').val($(this).data('tanggal_spt'));
  $('#edit_dasar_surat').val($(this).data('dasar_surat'));
  $('#edit_nama').val($(this).data('nama'));
  $('#edit_nip').val($(this).data('nip'));
  $('#edit_jabatan').val($(this).data('jabatan'));
  $('#edit_tanggal_pergi').val($(this).data('tanggal_pergi'));
  $('#edit_tanggal_pulang').val($(this).data('tanggal_pulang'));
  $('#edit_instansi').val($(this).data('instansi'));
  $('#edit_tujuan').val($(this).data('tujuan'));
  $('#edit_keterangan').val($(this).data('keterangan'));
  $('#edit_dokumen_lama').val($(this).data('dokumen'));

});



$(document).on('click', '.hapusRekanan', function() {
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  $('#hapus_id_rekanan').val(id);
  $('#hapus_nama_rekanan').text(nama);
});

document.getElementById("printBtn").addEventListener("click", function () {
    var table = document.getElementById("tablePesanan").outerHTML;

    var win = window.open('', '_blank');

    win.document.write(`
        <html>
        <head>
            <title>Surat Tugas </title>
            <style>
                table { width:100%; border-collapse: collapse; }
                table, th, td { border:1px solid black; padding:5px; }
                body { font-family: Arial, sans-serif; font-size:10px; }
                .no-print,
                .no-print * {
                    display: none !important;
                }
                .table td.span3, .table th.span3 {
                    float: none;
                    width: 120px;
                    margin-left: 0;
                    text-align: start;
                }
                .table td.span2, .table th.span2 {
                    float: none;
                    width: 120px;
                    margin-left: 0;
                    text-align: start;
                }
            </style>
        </head>
        <body>
            ${table}
        </body>
        </html>
    `);

    win.document.close();

    // Tunggu halaman selesai load sebelum print
    win.onload = function() {
        win.print();
        win.focus();
    };
});
</script>

