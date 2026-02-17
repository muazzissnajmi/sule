<?php include 'session.php' ?>
<?php $page = 'rekening'; 
function tgl_indo($tgl_spt){
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
    <h3>KARTU KENDALI NASKAH SURAT MASUK</h3>
    
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
              <label class="control-label">No Indeks</label>
              <div class="controls">
                <input type="text" name="no_indeks" class="span12" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sifat</label>
              <div class="controls">
                <select name="sifat" class="span12" required>
                  <option value="" disabled selected>-- Pilih Sifat --</option>
                  <option value="Berlaku">Berlaku</option>
                  <option value="Tidak Berlaku">Tidak Berlaku</option>
                </select>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">No Agenda</label>
              <div class="controls">
                <input type="text" name="no_agenda" class="span12" required>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Tanggal Terima</label>
              <div class="controls">
                <input type="date" name="tanggal_terima" class="span12" required>
              </div>
            </div>
    
          </div>
        </div>
        <div class="row-fluid">
          <div class="span12">
                <div class="control-group">
                  <label class="control-label">Isi Ringkas</label>
                  <div class="controls">
                    <textarea name="isi_ringkas" class="span12" required></textarea>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Lampiran</label>
                  <div class="controls">
                    <input type="text" name="lampiran" class="span12" required>
                  </div>
                </div>
          </div>
        </div>
        <div class="row-fluid">
          <!-- KOLOM KANAN -->
          <div class="span6">
              
            <div class="control-group">
              <label class="control-label">Dari</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="dari" class="span12" required>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Tanggal Surat</label>
              <div class="controls">
                <input type="date" autocomplete="off" name="tanggal_surat" class="span12" required>
              </div>
            </div>
    
            <div class="control-group">
              <label class="control-label">No Kontak/Hp</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="no_hp" class="span12" required>
              </div>
            </div>
    
            <div class="control-group">
              <label class="control-label">Pengolah</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="pengolah" class="span12" required>
              </div>
            </div>
          </div>
          <div class="span6">
            <div class="control-group">
              <label class="control-label">Kepada</label>
              <div class="controls">
                <input type="text" autocomplete="off"  name="kepada" class="span12" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No Surat</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="no_surat" class="span12" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Hubungan No</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="hubungan_no" class="span12" required>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Arsip Di</label>
              <div class="controls">
                <input type="text" autocomplete="off" name="arsip_di" class="span12" required>
              </div>
            </div>
          </div>
        </div>
    
        <hr>
    
        <div class="control-group">
          <label class="control-label">Upload Dokumen</label>
          <div class="controls">
            <input type="file" name="dokumen" required>
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

    $judul     = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $status   = mysqli_real_escape_string($koneksi, $_POST['status']);
    $no_peraturan    = mysqli_real_escape_string($koneksi, $_POST['no_peraturan']);
    $tahun    = mysqli_real_escape_string($koneksi, $_POST['tahun']);
    $tempat    = mysqli_real_escape_string($koneksi, $_POST['tempat']);
    $tanggal    = mysqli_real_escape_string($koneksi, $_POST['tanggal']);

    // Folder upload
    $path = "../uploads/produk_hukum/";

    $dokumen = time().'_produk_hukum_'.$_FILES['dokumen']['name'];

    move_uploaded_file($_FILES['dokumen']['tmp_name'], $path.$dokumen);

    $sql = "
        INSERT INTO produk_hukum 
        (judul, kategori, status, no_peraturan, tahun, tempat, tanggal, dokumen)
        VALUES
        ('$judul','$kategori','$status','$no_peraturan','$tahun','$tempat','$tanggal','$dokumen')
    ";

    $insert = mysqli_query($koneksi, $sql);

    if ($insert) {
        echo "<script>location='?page=prohu&msg=3';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}
if (isset($_POST['update'])) {
    include "../koneksi/koneksi.php";

    $id = intval($_POST['id']);
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul_edit']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori_edit']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status_edit']);
    $no_peraturan = mysqli_real_escape_string($koneksi, $_POST['no_peraturan_edit']);
    $tahun = mysqli_real_escape_string($koneksi, $_POST['tahun_edit']);
    $tempat = mysqli_real_escape_string($koneksi, $_POST['tempat_edit']);
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal_edit']);

    $dokumen = $_POST['dokumen_lama'];
    $path = "../uploads/produk_hukum/";

    if (!empty($_FILES['dokumen']['name'])) {
        $dokumen = time().'_produk_hukum_'.$_FILES['dokumen']['name'];
        move_uploaded_file($_FILES['dokumen']['tmp_name'], $path.$dokumen);
    }

    $sql = "
      UPDATE produk_hukum SET
        judul='$judul',
        kategori='$kategori',
        status='$status',
        no_peraturan='$no_peraturan',
        tahun='$tahun',
        tempat='$tempat',
        tanggal='$tanggal',
        dokumen='$dokumen'
      WHERE id='$id'
    ";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>location='?page=prohu&msg=4';</script>";
    } else {
        die(mysqli_error($koneksi));
    }
}


if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM produk_hukum WHERE id='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=prohu&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus produk hukum!');</script>";
  }
}

?>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Produk Hukum Berhasil Ditambahkan!</div>
            <?php } else if ($msg == 2){?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Rekening!</div>       
            <?php } 
            
        ?>
        <?php if ($msg == 4) { ?>
<div class="alert alert-success alert-block">
  <a class="close" data-dismiss="alert">×</a>
  <h4>Success!</h4>Data Produk Hukum berhasil diupdate
</div>
<?php } ?>

      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Surat Masuk</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="tablePesanan">
              <thead>
                <tr>
                <th>No</th>
                <th>Indeks</th>
                <th>Isi Ringkas</th>
                <th>Dari</th>
                <th>Tanggal Surat</th>
                <th>Nomor Surat</th>
                <th>Kepada</th>
                <th>Tanggal Terima</th>
                <th class="no-print">Action</th>

                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM tupim_masuk";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 

                ?>
                <tr>
                    
                    <td><center><?= $no++; ?></center></td>
                    <td><center><?= $data['kategori']; ?></center></td>
                    <td class="span5"><center><?= $data['status']; ?></center></td>
                    <td><?= $data['no_peraturan']; ?></td>
                    <td class="span2"><center><?= $data['tahun']; ?></center></td>
                    <td><?= $data['tempat']; ?></td>
                    <td><?= $data['tempat']; ?></td>
                    <td><center><?= tgl_indo($data['tanggal']); ?></center></td>
                   
                    <td class="span2 no-print">
                        <a href="#editRekananModal"
                           data-toggle="modal"
                           class="editRekanan"
                           data-id="<?= $data['id']; ?>"
                           data-judul="<?= htmlspecialchars($data['judul']); ?>"
                           data-kategori="<?= htmlspecialchars($data['kategori']); ?>"
                           data-status="<?= htmlspecialchars($data['status']); ?>"
                           data-no_peraturan="<?= $data['no_peraturan']; ?>"
                           data-tahun="<?= $data['tahun']; ?>"
                           data-tempat="<?= $data['tempat']; ?>"
                           data-tanggal="<?= $data['tanggal']; ?>"
                           data-dokumen="<?= $data['dokumen']; ?>">
                           <span class="badge badge-warning">
                             <span class="icon-edit"></span>
                           </span>
                        </a>

                         <a href="#modalHapusRekanan"
                           data-toggle="modal"
                           class="hapusRekanan"
                           data-id="<?= $data['id']; ?>"
                           data-nama="<?= htmlspecialchars($data['judul']); ?>">
                          <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                            <span class="icon-trash"></span>
                          </span>
                        </a>
                    <a href="../uploads/produk_hukum/<?= $data['dokumen']; ?>" target="_blank">
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
      <h3>Edit Produk Hukum</h3>
    </div>

    <div class="modal-body">
      <input type="hidden" name="id" id="edit_id">

      <div class="control-group">
        <label class="control-label">Judul</label>
        <div class="controls">
          <textarea name="judul_edit" id="edit_judul" class="span5" required></textarea>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Kategori</label>
        <div class="controls">
          <input type="text" name="kategori_edit" id="edit_kategori" class="span4" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Status</label>
        <div class="controls">
          <select name="status_edit" id="edit_status" required>
            <option value="Berlaku">Berlaku</option>
            <option value="Tidak Berlaku">Tidak Berlaku</option>
          </select>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">No Peraturan</label>
        <div class="controls">
          <input type="text" name="no_peraturan_edit" id="edit_no_peraturan" class="span3" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Tahun Terbit</label>
        <div class="controls">
          <input type="number" name="tahun_edit" id="edit_tahun" class="span2" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Tempat Pengundangan</label>
        <div class="controls">
          <input type="text" name="tempat_edit" id="edit_tempat" class="span4" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Tanggal Pengundangan</label>
        <div class="controls">
          <input type="date" name="tanggal_edit" id="edit_tanggal" class="span2" required>
        </div>
      </div>

      <hr>

      <div class="control-group">
        <label class="control-label">Dokumen (opsional)</label>
        <div class="controls">
          <input type="file" name="dokumen">
          <input type="hidden" name="dokumen_lama" id="edit_dokumen_lama">
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
      <h3>Hapus Produk Hukum</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_rekanan">
      <p>Apakah Anda yakin ingin menghapus produk hukum berikut?</p>
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
  $('#edit_judul').val($(this).data('judul'));
  $('#edit_kategori').val($(this).data('kategori'));
  $('#edit_status').val($(this).data('status'));
  $('#edit_no_peraturan').val($(this).data('no_peraturan'));
  $('#edit_tahun').val($(this).data('tahun'));
  $('#edit_tempat').val($(this).data('tempat'));
  $('#edit_tanggal').val($(this).data('tanggal'));
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
            <title>Produk Hukum </title>
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

