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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Rekening</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Rekening</h3>
    
    <button class="btn btn-success btn-mini" data-toggle="modal" data-target="#tambahRekeningModal">
        <span class="icon-plus"></span> Tambah Rekening
      </button>
      <button class="btn btn-info btn-mini" id="printBtn">Print Table</button>
      <!-- Modal Tambah Rekening -->
    <div id="tambahRekeningModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="tambahRekeningLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h3 id="tambahRekeningLabel">Tambah Rekening</h3>
  </div>
  <form action="" method="post">
    <div class="modal-body">
       <div class="control-group">
        <label class="control-label">Sub Kegiatan</label>
        <div class="controls">
          <select name="id_sub_kegiatan" required>
            <option value="">-- Pilih Sub Kegiatan --</option>
            <?php
              include "../koneksi/koneksi.php";
              $kegiatan = mysqli_query($koneksi, "SELECT * FROM sub_kegiatan ORDER BY id_sub_kegiatan ASC");
              while ($r = mysqli_fetch_array($kegiatan)) {
                echo "<option value='$r[id_sub_kegiatan]'>$r[kode_sub_kegiatan] - $r[nama_sub_kegiatan]</option>";
              }
            ?>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Kode Rekening</label>
        <div class="controls">
          <input type="text" name="kode_rekening" class="span3" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Nama Rekening</label>
        <div class="controls">
          <input type="text" name="nama_rekening" class="span5" required>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Pagu</label>
        <div class="controls">
          <input type="number" name="jumlah" class="span3" required>
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
function getKodeSubKegiatan($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT kode_sub_kegiatan, nama_sub_kegiatan FROM sub_kegiatan WHERE id_sub_kegiatan = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return "<strong>".$row['kode_sub_kegiatan'] . "</strong> - " . $row['nama_sub_kegiatan'];
  } else {
    return "-";
  }
}

if (isset($_POST['simpan'])) {
  include "../koneksi/koneksi.php";
  $kegiatan = trim($_POST['id_sub_kegiatan']);
  $kode = trim($_POST['kode_rekening']);
  $nama = trim($_POST['nama_rekening']);
  $jumlah = trim($_POST['jumlah']);

  $insert = mysqli_query($koneksi, "INSERT INTO rekening (id_sub_kegiatan, kode_rekening, nama_rekening, jumlah) VALUES ('$kegiatan', '$kode', '$nama', '$jumlah')");
  if (!$insert) {
      die('Query gagal: ' . mysqli_error($koneksi));
    }

  if ($insert) {
    echo "<script>window.location='?page=rekening&msg=3';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan rekening!');</script>";
  }
}


if (isset($_POST['update'])) {
  include "../koneksi/koneksi.php";
  $id          = intval($_POST['id_rekening']);
  $id_sub_kegiatan = intval($_POST['id_sub_kegiatan']);
  $kode        = trim($_POST['kode_rekening']);
  $nama        = trim($_POST['nama_rekening']);
  $jumlah      = trim($_POST['jumlah']);

  $update = mysqli_query($koneksi, "UPDATE rekening 
                         SET id_sub_kegiatan='$id_sub_kegiatan',
                             kode_rekening='$kode', 
                             nama_rekening='$nama', 
                             jumlah='$jumlah' 
                         WHERE id_rekening='$id'");

  if ($update) {
    echo "<script>window.location='?page=rekening&msg=4';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui rekening!');</script>";
  }
}

if (isset($_POST['hapus'])) {
  include "../koneksi/koneksi.php";
  $id = intval($_POST['id_hapus']);

  $hapus = mysqli_query($koneksi, "DELETE FROM rekening WHERE id_rekening='$id'");
  if ($hapus) {
    echo "<script>window.location='?page=rekening&msg=5';</script>";
  } else {
    echo "<script>alert('Gagal menghapus rekening!');</script>";
  }
}


?>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 3) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Rekening Berhasil Ditambah!</div>
            <?php } else if ($msg == 4) {?>
              <div class="alert alert-warning alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Update!</h4>Rekening Berhasil Diupdate!</div>       
            <?php } 
            else if ($msg == 5) { ?>
              <div class="alert alert-danger alert-block"> 
                <a class="close" data-dismiss="alert" href="#">×</a>
                <h4 class="alert-heading">Hapus!</h4>Rekening Berhasil Dihapus!
              </div>
            <?php } ?>

      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Rekening</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered rekening-table" id="tableRekening">
              <thead>
                <tr>
                  <th>Sub Kegiatan</th>
                  <th>Rekening</th>
                  <th>Pagu </th>
                  <th>Terpakai </th>
                  <th>Sisa Pagu</th>
                  <th>Tahun </th>
                  <th class="no-print">Opsi </th>
                  <!--<th>Action</th>-->
                </tr>
              </thead>
              <tbody>
                <?php
                include "../koneksi/koneksi.php";
                
                $sql = "
SELECT 
    r.*,
    IFNULL(SUM(d.harga * d.banyak), 0) AS terpakai_real
FROM rekening r
LEFT JOIN amprahan a 
    ON a.id_rekening = r.id_rekening
LEFT JOIN amprahan_detail d 
    ON d.id_amprahan = a.id_amprahan
GROUP BY r.id_rekening
ORDER BY r.id_sub_kegiatan ASC, r.id_rekening ASC
";
$tampil = mysqli_query($koneksi, $sql);

                
                // ambil data rekening urutkan by kegiatan
                // $sql = "SELECT * FROM rekening ORDER BY id_sub_kegiatan ASC, id_rekening ASC";
                // $tampil = mysqli_query($koneksi, $sql);
                
                // hitung jumlah row per kegiatan
                $counts = [];
                $result = mysqli_query($koneksi, "SELECT id_sub_kegiatan, COUNT(*) as jml FROM rekening GROUP BY id_sub_kegiatan");
                while ($r = mysqli_fetch_array($result)) {
                  $counts[$r['id_sub_kegiatan']] = $r['jml'];
                }
                
                $no=0;
                $lastKegiatan = null;
                $total_jumlah = 0;
                $total_terpakai = 0;
                $total_sisa = 0;

                
                while ($data = mysqli_fetch_array($tampil)) {
                ?>
                <tr>
                  <?php if ($data['id_sub_kegiatan'] != $lastKegiatan) { ?>
                    <td class="span5" rowspan="<?= $counts[$data['id_sub_kegiatan']] ?>">
                      <?= ucfirst(getKodeSubKegiatan($data['id_sub_kegiatan'])); ?>
                    </td>
                  <?php } ?>
                
                  <td class="span5"><strong><?= ucfirst($data['kode_rekening']); ?></strong> - <?= ucfirst($data['nama_rekening']); ?></td>
                  <td class="span3">Rp. <?= number_format($data['jumlah'],0,',','.'); ?></td>
                  <td class="span3">Rp. <?= number_format($data['terpakai_real'],0,',','.'); ?></td>
                  <td class="span3">Rp. <?= number_format($data['jumlah']-$data['terpakai_real'],0,',','.'); ?></td>
                  <td class="span1"><strong><?= ucfirst($data['tahun']); ?></strong></td>
                  <td class="span2 no-print">
                    <a href="#modalEditRekening"
                       data-toggle="modal"
                       class="editRekening"
                       data-id="<?= $data['id_rekening']; ?>"
                       data-id_sub_kegiatan="<?= $data['id_sub_kegiatan']; ?>"
                       data-kode="<?= htmlspecialchars($data['kode_rekening']); ?>"
                       data-nama="<?= htmlspecialchars($data['nama_rekening']); ?>"
                       data-jumlah="<?= $data['jumlah']; ?>">
                      <span class="badge badge-warning tip-bottom" data-original-title="Edit">
                        <span class="icon-edit"></span>
                      </span>
                    </a>
                    
                    <a href="#modalHapusRekening"
                       data-toggle="modal"
                       class="hapusRekening"
                       data-id="<?= $data['id_rekening']; ?>"
                       data-nama="<?= htmlspecialchars($data['nama_rekening']); ?>">
                      <span class="badge badge-important tip-bottom" data-original-title="Hapus">
                        <span class="icon-trash"></span>
                      </span>
                    </a>
                  </td>
                </tr>
                

                <?php
                $no++;
                $total_jumlah   += $data['jumlah'];
                $total_terpakai += $data['terpakai_real'];
                $total_sisa     += ($data['jumlah'] - $data['terpakai_real']);
                $lastKegiatan = $data['id_sub_kegiatan'];
                }
                ?>
                <tr style="font-weight:bold; background:#f0f0f0;">
                    <td colspan="1" text-align="right">TOTAL</td>
                    <td><?= $no; ?> Rekening</td>
                    <td>Rp. <?= number_format($total_jumlah,0,',','.'); ?></td>
                    <td>Rp. <?= number_format($total_terpakai,0,',','.'); ?></td>
                    <td>Rp. <?= number_format($total_sisa,0,',','.'); ?></td>
                    <td></td>
                    <td></td> <!-- kolom Opsi biarkan kosong -->
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="modalEditRekening" class="modal hide fade" tabindex="-1" role="dialog">
  <form method="POST" action="">
    <div class="modal-header">
      <h3>Edit Rekening</h3>
    </div>
    <div class="modal-body">
      <?php
        include "../koneksi/koneksi.php";
        $qKegiatan = mysqli_query($koneksi, "SELECT * FROM sub_kegiatan ORDER BY nama_sub_kegiatan ASC");
      ?>

      <input type="hidden" name="id_rekening" id="edit_id_rekening">

      <div class="control-group">
      <label class="control-label">Sub Kegiatan</label>
      <div class="controls">
        <select name="id_sub_kegiatan" id="edit_id_sub_kegiatan" required>
          <option value="">Pilih Kegiatan</option>
          <?php 
          while ($k = mysqli_fetch_array($qKegiatan)) { 
              // cek apakah id_kegiatan di tabel rekening sama dengan yang sedang di-loop
              $selected = '';
          ?>
            <option value="<?php echo $k['id_sub_kegiatan']; ?>" <?php echo $selected; ?>>
              <?php echo htmlspecialchars($k['kode_sub_kegiatan'])." - ".htmlspecialchars($k['nama_sub_kegiatan']); ?> 
            </option>
          <?php } ?>
        </select>
      </div>
    </div>



      <div class="control-group">
        <label class="control-label">Kode Rekening</label>
        <div class="controls">
          <input type="text" name="kode_rekening" id="edit_kode_rekening" class="span3" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Nama Rekening</label>
        <div class="controls">
          <input type="text" name="nama_rekening" id="edit_nama_rekening" class="span" required>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label">Jumlah</label>
        <div class="controls">
          <input type="number" name="jumlah" id="edit_jumlah" class="span4" required>
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
      <h3>Hapus Rekening</h3>
    </div>
    <div class="modal-body">
      <input type="hidden" name="id_hapus" id="hapus_id_rekening">
      <p>Apakah Anda yakin ingin menghapus rekening berikut?</p>
      <h4 id="hapus_nama_rekening" style="color:#b94a48;"></h4>
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
document.getElementById("printBtn").addEventListener("click", function () {
    var table = document.getElementById("tableRekening").outerHTML;

    var win = window.open('', '_blank');

    win.document.write(`
        <html>
        <head>
            <title>Rekening </title>
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

$(document).ready(function() {
  $(document).on('click', '.editRekening', function() {
    var id          = $(this).data('id');
    var kode        = $(this).data('kode');
    var nama        = $(this).data('nama');
    var jumlah      = $(this).data('jumlah');
    var id_sub_kegiatan = $(this).data('id_sub_kegiatan');

    $('#edit_id_rekening').val(id);
    $('#edit_kode_rekening').val(kode);
    $('#edit_nama_rekening').val(nama);
    $('#edit_jumlah').val(jumlah);
    $('#edit_id_sub_kegiatan').val(id_sub_kegiatan).trigger('change'); // ini yang bikin selected otomatis
  });
  
});
$(document).on('click', '.hapusRekening', function() {
  var id = $(this).data('id');
  var nama = $(this).data('nama');
  $('#hapus_id_rekening').val(id);
  $('#hapus_nama_rekening').text(nama);
});


</script>
