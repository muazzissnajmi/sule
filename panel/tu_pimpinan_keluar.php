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
    <h3>KARTU KENDALI NASKAH SURAT KELUAR</h3>
    
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
              <label class="control-label">No Surat</label>
              <div class="controls">
                <input type="text" class="span6" name="no_surat" id="no_surat" placeholder="" required/>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">Tanggal Surat</label>
              <div class="controls">
                <input type="date" name="tanggal_surat" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
                <div class="control-group">
                  <label class="control-label">Perihal</label>
                  <div class="controls">
                    <textarea name="perihal" class="span12" required></textarea>
                  </div>
                </div>
          </div>
        </div>
        <div class="row-fluid">
          <!-- KOLOM KIRI -->
          <div class="span12">
            <div class="control-group">
              <label class="control-label">Nama SKPD</label>
              <div class="controls">
                <input type="text" name="nama_skpd" autocomplete="off" class="span12" required>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">NIP</label>
              <div class="controls">
                <input type="text" name="nip" autocomplete="off" class="span12" >
              </div>
            </div>
          </div>
        </div>
        
        <div class="row-fluid">
          <!-- KOLOM KANAN -->
          <div class="span6">
              
            <div class="control-group">
              <label class="control-label">Pejabat TTD</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="jabatan" class="span12" required>
              </div>
            </div>
            
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">Instansi</label>
              <div class="controls">
                <input type="text" autocomplete="off"  value="Pemerintah Kabupaten Bireuen" name="instansi" class="span12" required>
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
        
        <div class="row-fluid">
          <div class="span12">
                <div class="control-group">
                  <label class="control-label">Status</label>
                  <div class="controls">
                      <select name="status" class="span6" required>
                            <option value="0">Belum Selesai</option>
                            <option value="1">Selesai</option>
                        </select>
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

    $no_surat        = mysqli_real_escape_string($koneksi, $_POST['no_surat']);
    $tanggal_surat  = mysqli_real_escape_string($koneksi, $_POST['tanggal_surat']);
    $perihal  = mysqli_real_escape_string($koneksi, ucwords($_POST['perihal']));
    $nama_skpd         = mysqli_real_escape_string($koneksi, ucwords($_POST['nama_skpd']));
    $nip          = mysqli_real_escape_string($koneksi, $_POST['nip']); // NIP jangan diubah
    $jabatan      = mysqli_real_escape_string($koneksi, ucwords(strtolower($_POST['jabatan'])));
    $instansi     = mysqli_real_escape_string($koneksi, ucwords($_POST['instansi']));
    $tujuan       = mysqli_real_escape_string($koneksi, ucwords($_POST['tujuan']));
    $keterangan   = mysqli_real_escape_string($koneksi, ucwords($_POST['keterangan']));
    $status = intval($_POST['status']);

    
    $path = "../uploads/tu_pimpinan_keluar/";
    $dokumen = "";
    
    if (!empty($_FILES['dokumen']['name'])) {
    
        if ($_FILES['dokumen']['error'] == 0) {
    
            $ext = pathinfo($_FILES['dokumen']['name'], PATHINFO_EXTENSION);
            $nama_baru = time() . "_tupim_keluar." . $ext;
            
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
        INSERT INTO tupim_keluar 
        (no_surat, tanggal_surat, perihal, nama_skpd, nip, jabatan, instansi, tujuan, keterangan, dokumen, status)
        VALUES
        ('$no_surat','$tanggal_surat','$perihal','$nama_skpd','$nip','$jabatan', '$instansi', '$tujuan', '$keterangan', '$dokumen', '$status')
    ";

    $insert = mysqli_query($koneksi, $sql);

    if ($insert) {
        echo "<script>location='?page=tupimsk&msg=3';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}
if (isset($_POST['update'])) {

    include "../koneksi/koneksi.php";

    $id = intval($_POST['id']);
    $no_surat = mysqli_real_escape_string($koneksi, $_POST['no_surat_edit']);
    $tanggal_surat = mysqli_real_escape_string($koneksi, $_POST['tanggal_surat_edit']);
    $perihal = mysqli_real_escape_string($koneksi, $_POST['perihal_edit']);
    $nama_skpd = mysqli_real_escape_string($koneksi, $_POST['nama_skpd_edit']);
    $nip = mysqli_real_escape_string($koneksi, $_POST['nip_edit']);
    $jabatan = mysqli_real_escape_string($koneksi, $_POST['jabatan_edit']);
    $instansi = mysqli_real_escape_string($koneksi, $_POST['instansi_edit']);
    $tujuan = mysqli_real_escape_string($koneksi, $_POST['tujuan_edit']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan_edit']);
    $status = intval($_POST['status_edit']);

    
    $path = "../uploads/tu_pimpinan_keluar/";
    $dokumen = $_POST['dokumen_lama'];
    
    if (!empty($_FILES['dokumen']['name'])) {
    
        if ($_FILES['dokumen']['error'] == 0) {
    
            // hapus file lama kalau ada
            if (!empty($dokumen) && file_exists($path . $dokumen)) {
                unlink($path . $dokumen);
            }
    
            $ext = pathinfo($_FILES['dokumen']['name'], PATHINFO_EXTENSION);
            $nama_baru = time() . "_tupim_keluar." . $ext;
            
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
        UPDATE tupim_keluar SET
            no_surat='$no_surat',
            tanggal_surat='$tanggal_surat',
            perihal='$perihal',
            nama_skpd='$nama_skpd',
            nip='$nip',
            jabatan='$jabatan',
            instansi='$instansi',
            tujuan='$tujuan',
            keterangan='$keterangan',
            dokumen='$dokumen',
            status='$status'
        WHERE id='$id'
    ";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>location='?page=tupimsk&msg=4';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}

if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $cek = mysqli_fetch_array(mysqli_query($koneksi, "SELECT dokumen FROM tupim_keluar WHERE id='$id'"));
  
  if (!empty($cek['dokumen'])) {
      $path = "../uploads/tu_pimpinan_keluar/";
      if (file_exists($path.$cek['dokumen'])) {
          unlink($path.$cek['dokumen']);
      }
  }

  $hapus = mysqli_query($koneksi, "DELETE FROM tupim_keluar WHERE id='$id'");

  if ($hapus) {
    echo "<script>window.location='?page=tupimsk&msg=5';</script>";
  }
}


?>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Surat Keluar Berhasil Ditambahkan!</div>
            <?php } else if ($msg == 2){?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Surat Keluar!</div>       
            <?php } 
        if ($msg == 4) { ?>
        <div class="alert alert-success alert-block">
          <a class="close" data-dismiss="alert">×</a>
          <h4>Success!</h4>Data Surat Keluar berhasil diupdate
        </div>
        <?php } ?>

      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Surat Keluar</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="tablePesanan">
              <thead>
                <tr>
                    <th style="vertical-align: middle;">No</th>
                    <th style="vertical-align: middle;">Tanggal Surat</th>
                    <th style="vertical-align: middle;">Nomor Surat</th>
                    <th style="vertical-align: middle;">Perihal</th>
                    <th style="vertical-align: middle;">Nama SKPD</th>
                    <th style="vertical-align: middle;">Instansi</th>
                    <th style="vertical-align: middle;">Pejabat TTD</th>
                    <th style="vertical-align: middle;">Tujuan</th>
                    <th style="vertical-align: middle;">Keterangan</th>
                    <th style="vertical-align: middle;">Status</th>
                    <th style="vertical-align: middle;" class="no-print">Action</th>

                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM tupim_keluar";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) {
                      

                ?>
                <tr>
                    
                    <td><center><?= $no++; ?></center></td>
                    <td class="span2"><center><?= tgl_indo($data['tanggal_surat']); ?></center></td>
                    <td class="span3"><?php
                    $pecah = explode("/", htmlspecialchars($data['no_surat']));
                    echo $pecah[0] . "/<strong><span class='badge badge-warning'>" . $pecah[1] . "</span></strong>/" . $pecah[2];
                    ?></td>
                    <td class="span2"><?= $data['perihal']; ?></td>
                    <td class="span2"><?= $data['nama_skpd']; ?></td>
                    <td class="span2"><center><?= $data['instansi']; ?></center></td>
                    <td class="span2"><?= $data['jabatan']; ?></td>
                    <td class="span3"><?= $data['tujuan']; ?></td>
                    <td><?= $data['keterangan']; ?></td>
                    <td>
                    <?php if ($data['status'] == 1) { ?>
                        <span class="badge badge-success"><span class='icon-check'></span> Selesai</span>
                    <?php } else { ?>
                        <span class="badge badge-important"><span class='icon-remove-sign'></span> Belum Selesai</span>
                    <?php } ?>
                    </td>

                    
                   
                    <td class="span2 no-print">
                        <a href="#editRekananModal"
                           data-toggle="modal"
                           class="editRekanan"
                           data-id="<?= $data['id']; ?>"
                           data-no_surat="<?= $data['no_surat']; ?>"
                            data-tanggal_surat="<?= $data['tanggal_surat']; ?>"
                            data-perihal="<?= htmlspecialchars($data['perihal']); ?>"
                            data-nama_skpd="<?= htmlspecialchars($data['nama_skpd']); ?>"
                            data-nip="<?= $data['nip']; ?>"
                            data-jabatan="<?= htmlspecialchars($data['jabatan']); ?>"
                            data-instansi="<?= htmlspecialchars($data['instansi']); ?>"
                            data-tujuan="<?= htmlspecialchars($data['tujuan']); ?>"
                            data-keterangan="<?= htmlspecialchars($data['keterangan']); ?>"
                            data-dokumen="<?= $data['dokumen']; ?>" 
                            data-status="<?= $data['status']; ?>">

                           <span class="badge badge-warning">
                             <span class="icon-edit"></span>
                           </span>
                        </a>

                         <a href="#modalHapusRekanan"
                           data-toggle="modal"
                           class="hapusRekanan"
                           data-id="<?= $data['id']; ?>"
                           data-nama="<?= htmlspecialchars($data['perihal']); ?>">
                          <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                            <span class="icon-trash"></span>
                          </span>
                        </a>
                        
                        <?php if(!empty($data['dokumen'])) { ?>
                        <a href="../uploads/tu_pimpinan_keluar/<?= $data['dokumen']; ?>" target="_blank">
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
    <h3>Edit Surat Keluar</h3>
</div>

<div class="modal-body">
<input type="hidden" name="id" id="edit_id">

<div class="control-group">
<label>No Surat</label>
<input type="text" name="no_surat_edit" id="edit_no_surat" class="span4" required>
</div>

<div class="control-group">
<label>Tanggal Surat</label>
<input type="date" name="tanggal_surat_edit" id="edit_tanggal_surat" required>
</div>

<div class="control-group">
<label>Perihal</label>
<textarea name="perihal_edit" id="edit_perihal" class="span5" required></textarea>
</div>

<div class="control-group">
<label>Nama</label>
<input type="text" name="nama_skpd_edit" id="edit_nama_skpd" class="span4" required>
</div>

<div class="control-group">
<label>NIP</label>
<input type="text" name="nip_edit" id="edit_nip" class="span4" >
</div>

<div class="control-group">
<label>Jabatan</label>
<input type="text" name="jabatan_edit" id="edit_jabatan" class="span4" required>
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

<div class="control-group">
    <label>Status</label>
    <div class="controls">
        <select name="status_edit" id="edit_status" class="span3" required>
            <option value="0">Belum Selesai</option>
            <option value="1">Selesai</option>
        </select>
    </div>
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
      <h3>Hapus Surat Keluar</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_rekanan">
      <p>Apakah Anda yakin ingin menghapus surat keluar berikut?</p>
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
  $('#edit_no_surat').val($(this).data('no_surat'));
  $('#edit_tanggal_surat').val($(this).data('tanggal_surat'));
  $('#edit_perihal').val($(this).data('perihal'));
  $('#edit_nama_skpd').val($(this).data('nama_skpd'));
  $('#edit_nip').val($(this).data('nip'));
  $('#edit_jabatan').val($(this).data('jabatan'));
  $('#edit_instansi').val($(this).data('instansi'));
  $('#edit_tujuan').val($(this).data('tujuan'));
  $('#edit_keterangan').val($(this).data('keterangan'));
  $('#edit_dokumen_lama').val($(this).data('dokumen'));
  $('#edit_status').val($(this).data('status'));


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
            <title>Surat Keluar </title>
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

