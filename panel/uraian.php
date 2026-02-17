<?php include 'session.php' ?>
<?php $page = 'uraian'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />

<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<style>
.select2-container {
    z-index: 999999 !important;
}
.select2-dropdown {
    z-index: 999999 !important;
}
</style>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> 
      <a href="?page=home" class="tip-bottom"><i class="icon-home"></i> Home</a> 
      <a href="#" class="tip-bottom">Uraian</a>
    </div>
  </div>

  <div class="container-fluid">
    <h3>Uraian</h3>

    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahUraianModal">
      <span class="icon-plus"></span> Tambah Uraian Belanja
    </button>
    <button class="btn btn-info btn-mini" id="printBtn">Print Table</button>

    <!-- Modal Tambah Uraian -->
    <div id="tambahUraianModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahUraianLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h3 id="tambahUraianLabel">Tambah Uraian Belanja</h3>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="control-group">
              <label class="control-label">Rekening</label>
              <div class="controls">
                <select name="id_rekening" id="select-rekening" style="width: 100%;" class="span row-fluid" required>
                  <option value="0">-- Pilih Rekening --</option>
                  <?php
                    include "../koneksi/koneksi.php";
                    $kegiatan = mysqli_query($koneksi, "SELECT * FROM rekening ORDER BY id_rekening ASC");
                    
                    while ($r = mysqli_fetch_array($kegiatan)) {
  $jumlah = "Rp. ". number_format($r['jumlah'],0,',','.');
  
  // PERUBAHAN: Masukkan jumlah ke dalam teks dipisah tanda ||
  echo "<option value='$r[id_rekening]'>$r[kode_rekening] - $r[nama_rekening] || $jumlah</option>";
}
                  ?>
                </select>
              </div>
            </div>
          <div class="control-group">
            <label class="control-label">Nama Uraian</label>
            <div class="controls">
              <input type="text" name="nama_uraian" class="span5" required>
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
function getRekening($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT kode_rekening, nama_rekening FROM rekening WHERE id_rekening = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return "<strong>".$row['kode_rekening'] . "</strong> - " . $row['nama_rekening'];
  } else {
    return "-";
  }
}

    // Proses Simpan Data
    if (isset($_POST['simpan'])) {
      include "../koneksi/koneksi.php";
      $id_rekening = trim($_POST['id_rekening']);
      $nama = trim($_POST['nama_uraian']);

      $insert = mysqli_query($koneksi, "INSERT INTO uraian (id_rekening, nama_uraian) VALUES ('$id_rekening', '$nama')");
      if ($insert) {
        echo "<script>window.location='?page=uraian&msg=3';</script>";
      } else {
        echo "<script>alert('Gagal menambahkan uraian!');</script>";
      }
    }
    
if (isset($_POST['update'])) {
  include "../koneksi/koneksi.php";
  $id          = intval($_POST['id_uraian']);
  $rekening  = intval($_POST['id_rekening']);
  $nama        = trim($_POST['nama_uraian']);

  $update = mysqli_query($koneksi, "UPDATE uraian 
                         SET id_rekening='$rekening',
                             nama_uraian='$nama'
                         WHERE id_uraian='$id'");

  if ($update) {
    echo "<script>window.location='?page=uraian&msg=4';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui uraian!');</script>";
  }
}

if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM uraian WHERE id_uraian='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=uraian&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus uraian!');</script>";
  }
}

    ?>

    <div class="row-fluid">
      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Uraian Berhasil Ditambah!</div>
            <?php } else if ($msg == 4) {?>
              <div class="alert alert-warning alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Update!</h4>Uraian Berhasil Diupdate!</div>       
            <?php } 
            else if ($msg == 5) { ?>
              <div class="alert alert-danger alert-block"> 
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Hapus!</h4>Uraian Berhasil Dihapus!
              </div>
            <?php } ?>

      <div class="widget-box">
        <div class="widget-title"> 
          <span class="icon"><i class="icon-th"></i></span>
          <h5>Data Table Uraian</h5>
        </div>
        <div class="widget-content nopadding">
          <table class="table table-bordered rekening-table" id="tableRekening">
            <thead>
              <tr>
                <th>Rekening</th>
                <th>Nama Uraian</th>
                <th class="no-print">Opsi </th>
              </tr>
            </thead>
            <tbody>
                <?php
                include "../koneksi/koneksi.php";
                
                // ambil data rekening urutkan by kegiatan
                $sql = "SELECT * FROM uraian ORDER BY id_rekening ASC, id_uraian ASC";
                $tampil = mysqli_query($koneksi, $sql);
                
                // hitung jumlah row per kegiatan
                $counts = [];
                $result = mysqli_query($koneksi, "SELECT id_rekening, COUNT(*) as jml FROM uraian GROUP BY id_rekening");
                while ($r = mysqli_fetch_array($result)) {
                  $counts[$r['id_rekening']] = $r['jml'];
                }
                
                $lastKegiatan = null;

                
                while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                  <?php if ($data['id_rekening'] != $lastKegiatan) { ?>
                    <td class="span5" rowspan="<?= $counts[$data['id_rekening']] ?>">
                      <?= ucfirst(getRekening($data['id_rekening'])); ?>
                    </td>
                  <?php } ?>
                
                  <td class="span5"><?= ucfirst($data['nama_uraian']); ?></td>
                  <td class="span2 no-print">
                    <a href="#modalEditUraian"
                       data-toggle="modal"
                       class="editRekening"
                       data-id="<?= $data['id_uraian']; ?>"
                       data-rekening="<?= $data['id_rekening']; ?>"
                       data-nama="<?= htmlspecialchars($data['nama_uraian']); ?>" >
                      <span class="badge badge-warning tip-bottom" data-original-title="Edit">
                        <span class="icon-edit"></span>
                      </span>
                    </a>
                    
                    <a href="#modalHapusRekening"
                       data-toggle="modal"
                       class="hapusRekening"
                       data-id="<?= $data['id_uraian']; ?>"
                       data-nama="<?= htmlspecialchars($data['nama_uraian']); ?>">
                      <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                        <span class="icon-trash"></span>
                      </span>
                    </a>
                  </td>
                </tr>
                

                <?php
                
                $lastKegiatan = $data['id_rekening'];
                }
                ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modalEditUraian" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Edit Rekening</h3>
    </div>
    <div class="modal-body">
      <?php
        include "../koneksi/koneksi.php";
        $qKegiatan = mysqli_query($koneksi, "SELECT * FROM rekening ORDER BY nama_rekening ASC");
      ?>

      <input type="hidden" name="id_uraian" id="edit_id_uraian">

      <div class="control-group">
  <label class="control-label">Rekening</label>
  <div class="controls">
    <select name="id_rekening" id="edit_id_rekening" style="width:100%" required>
        <option value="">Pilih Rekening</option>
        <?php 
        // Reset pointer data jika perlu, atau query ulang
        mysqli_data_seek($qKegiatan, 0); 
        while ($k = mysqli_fetch_array($qKegiatan)) { 
    $jumlah = "Rp. " . number_format($k['jumlah'], 0, ',', '.');
    $selected = ($k['id_rekening'] == $rekening_edit_val) ? 'selected' : ''; // (Opsional logic selected)

    // PERUBAHAN: Sama, gunakan pemisah ||
    echo "<option value='$k[id_rekening]'>$k[kode_rekening] - $k[nama_rekening] || $jumlah</option>";
} 
        ?>
    </select>
  </div>
</div>


      <div class="control-group">
        <label class="control-label">Nama Uraian</label>
        <div class="controls">
          <input type="text" name="nama_uraian" id="edit_nama_uraian" class="span5" required>
        </div>
      </div>

    </div>

    <div class="modal-footer">
      <button type="submit" name="update" class="btn btn-primary">Simpan</button>
      <button type="button" class="btn" data-dismiss="modal">Batal</button>
    </div>
  </form>
</div>
<div id="modalHapusRekening" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Hapus Uraian</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_uraian">
      <p>Apakah Anda yakin ingin menghapus uraian berikut?</p>
      <h4 id="hapus_nama_uraian" style="color:#b94a48;"></h4>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
<script>
$(document).ready(function() {
    
    // Konfigurasi Select2
    var select2Config = {
        templateResult: formatState,      // Tampilan saat list dibuka
        templateSelection: formatState,   // Tampilan setelah dipilih
        width: '100%'                     // Pastikan lebar 100%
    };

    // 1. Aktifkan Select2 di Modal Tambah
    $('#select-rekening').select2(select2Config);

    // 2. Aktifkan Select2 di Modal Edit
    $('#edit_id_rekening').select2(select2Config);

    // Logic Tombol Edit
    $(document).on('click', '.editRekening', function() {
        var id       = $(this).data('id');
        var rekening = $(this).data('rekening');
        var nama     = $(this).data('nama');

        $('#edit_id_uraian').val(id);
        $('#edit_nama_uraian').val(nama);
        
        // Set value dan trigger change agar Select2 merender ulang
        $('#edit_id_rekening').val(rekening).trigger('change');
    });

    // Logic Tombol Hapus
    $(document).on('click', '.hapusRekening', function() {
        $('#hapus_id_uraian').val($(this).data('id'));
        $('#hapus_nama_uraian').text($(this).data('nama'));
    });
});

// FUNGSI FORMAT BARU (Lebih Stabil)
// FUNGSI FORMAT TAMPILAN
function formatState(opt) {
    if (!opt.id) {
        return opt.text;
    }

    var textAsli = opt.text;
    
    // Pecah text berdasarkan tanda " || "
    var splitText = textAsli.split("||");

    if (splitText.length > 1) {
        var nama  = splitText[0]; // Bagian Nama
        var harga = splitText[1]; // Bagian Harga

        // Tampilkan Nama, lalu strip (-), lalu Harga warna HIJAU
        // Saya tambahkan font-size sedikit biar lebih jelas
        return $(
            '<span>' + nama + ' - <strong style="color: green; font-weight: bold;">' + harga + '</strong></span>'
        );
    }

    return opt.text;
}

document.getElementById("printBtn").addEventListener("click", function () {
    var table = document.getElementById("tableRekening").outerHTML;

    var win = window.open('', '_blank');

    win.document.write(`
        <html>
        <head>
            <title>Uraian Belanja </title>
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
                    text-align: end;
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

