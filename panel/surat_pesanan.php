<?php 
include 'session.php' ;

$mapRekananRekening = [];

$q = mysqli_query($koneksi, "
    SELECT DISTINCT 
        a.id_rekanan,
        r.id_rekening,
        r.kode_rekening,
        r.nama_rekening
    FROM amprahan a
    JOIN rekening r ON r.id_rekening = a.id_rekening
    ORDER BY r.kode_rekening
");

while ($r = mysqli_fetch_assoc($q)) {
    $mapRekananRekening[$r['id_rekanan']][] = $r;
}


$rekeningByRekanan = [];

$q = mysqli_query($koneksi, "
  SELECT DISTINCT
    a.id_rekanan,
    r.id_rekening,
    r.kode_rekening,
    r.nama_rekening,
    r.jumlah
  FROM amprahan a
  JOIN rekening r ON r.id_rekening = a.id_rekening
  ORDER BY a.id_rekanan, r.kode_rekening
");

while ($r = mysqli_fetch_assoc($q)) {
    $rekeningByRekanan[$r['id_rekanan']][$r['id_rekening']] = [
        'id_rekening'   => $r['id_rekening'],
        'kode_rekening' => $r['kode_rekening'],
        'nama_rekening' => $r['nama_rekening'],
        'jumlah' => $r['jumlah'],
    ];
}

function getRekanan($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT * FROM rekanan WHERE id_rekanan = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return  $row['nama_rekanan'];
  } else {
    return "-";
  }
}
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
function getRekening($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT kode_rekening, nama_rekening, jumlah FROM rekening WHERE id_rekening = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return "<strong>".$row['kode_rekening'] . "</strong> - " . $row['nama_rekening'] . " (Rp. " . number_format($row['jumlah'],0,',','.') .") "; // number_format($total_sisa,0,',','.')
  } else {
    return "-";
  }
}
?>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Daftar Amprahan</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Daftar Amprahan</h3>
    <a href="?page=supst" class="btn btn-success btn-mini"><span class="icon-plus"></span> &nbsp; Input Amprahan</a>
    
    <!-- Tombol -->
<a href="#" class="btn btn-danger btn-mini" id="btnFaktur">
  <span class="icon-plus"></span> &nbsp; Dokumen Amprahan
</a>



          <button class="btn btn-info btn-mini" id="printBtn">Print Table</button>
<!-- Popup Pilih Tanggal -->
<div id="popupTanggal" style="display:none; padding:10px;white-space:nowrap;">
  <label>Dari Tanggal</label>
  <input type="date" id="tgl_dari" class="span3" />

  <label>Sampai Tanggal</label>
  <input type="date" id="tgl_sampai" class="span3" />
  
  <label >Rekanan/Penyedia</label>
  <select style="width:280px" name="rekanan" id="rekanan" required > 
    <option value="" selected disabled hidden>-- Pilih Rekanan --</option>
      <?php
        include "../koneksi/koneksi.php";
        $query = mysqli_query($koneksi, "SELECT * FROM rekanan ORDER BY nama_rekanan ASC");
        while ($r = mysqli_fetch_array($query)) {
          echo "<option value='".htmlspecialchars($r['id_rekanan'])."'>".htmlspecialchars($r['nama_rekanan'])."</option>";
        }
      ?>
  </select>
  
  <label >Rekening</label>
    <select style="width:600px" id="rekening" required>
      <option value="" selected disabled hidden>-- Pilih rekening --</option>
    </select>


  <br>
  <br>
  <button id="btnCetak" class="btn btn-success btn-mini">Cetak</button>
</div>

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
            
            <?php }else if ($msg == 5) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Amprahan Berhasil Diedit!</div>  
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Surat Pesanan</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="tablePesanan">
              <thead>
                <tr>
                  <th>No Surat </th>
                  <th>Tanggal</th>
                  <th>Rekanan</th>
                  <th>Sub Kegiatan</th>
                  <th>Rekening</th>
                  <th>Item Pesanan</th>
                  <th>Harga</th>
                  <th>Keterangan</th>
                  <th class="no-print">Status</th>
                  <th class="no-print">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";

                  $sql = "SELECT * FROM amprahan ORDER BY id_amprahan DESC";
                  $tampil = mysqli_query($koneksi, $sql);

                  while ($data = mysqli_fetch_array($tampil)) {   
                ?>
                <tr>
                    <td class="span2"><center>
                    <?php if ($data['no_amprahan'] == '') {
                        echo "<span class='badge badge-important'>New</span>";
                    }else{
                        echo $data['kode_item']."/".$data['no_amprahan']."/".$data['tahun']; 
                    }?> 
                    </center>
                    </td>
                    <td class="span2"><center><?php echo $data['tanggal']; ?></center></td>
                    <td class="span2"><center><?php echo getRekanan($data['id_rekanan']); ?></center></td>
                    <td class="span2"><?php echo getKodeSubKegiatan($data['id_sub_kegiatan']); ?></td>
                    <td class="span2"><?php echo getRekening($data['id_rekening']); ?></td>
                    <?php
                        $sql_kat = "
                        SELECT 
                            d.id_detail,
                            d.uraian,
                            d.banyak,
                            d.satuan,
                            f.filename
                        FROM amprahan_detail d
                        LEFT JOIN amprahan_foto f
                            ON f.id_detail = d.id_detail
                        WHERE d.id_amprahan = '$data[id_amprahan]'
                        ORDER BY d.id_detail
                        ";
                        
                        $tampil_kat = mysqli_query($koneksi, $sql_kat);
                        
                        $items = [];
                        
                        while ($row = mysqli_fetch_assoc($tampil_kat)) {
                            $id = $row['id_detail'];
                        
                            if (!isset($items[$id])) {
                                $items[$id] = [
                                    'uraian' => $row['uraian'],
                                    'banyak' => $row['banyak'],
                                    'satuan' => $row['satuan'],
                                    'foto'   => []
                                ];
                            }
                        
                            if ($row['filename']) {
                                $items[$id]['foto'][] = $row['filename'];
                            }
                        }
                    ?>
                    <td class="span6">
                        <ul style="margin:0; padding-left:18px;">
                            <?php foreach ($items as $id => $row): ?>
                                <li>
                                    <a href="#"
                                       class="lihat-foto"
                                       data-id="<?= $id ?>">
                                        <?= htmlspecialchars($row['uraian']) ?>
                                        <?= htmlspecialchars($row['banyak']) ?>
                                        <?= htmlspecialchars($row['satuan']) ?>
                                    </a>
                                    
                    
                                    <!-- foto disiapkan, disembunyikan -->
                                    <div id="foto-<?= $id ?>" style="display:none">
                                        <?php if (empty($row['foto'])): ?>
                                            <p>Tidak ada foto</p>
                                        <?php else: ?>
                                            <?php foreach ($row['foto'] as $f): ?>
                                                <img src="../uploads/amprahan/<?= $f ?>"
                                                     style="max-width:100%; margin-bottom:10px;">
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>

                       
                    <td class="span2">
                        <ul style="margin:0; padding-left:18px;">
                            <?php
                            $sql_kat = "SELECT * FROM amprahan_detail WHERE id_amprahan = '$data[id_amprahan]'";
                            $tampil_kat = mysqli_query($koneksi, $sql_kat);
                            

                            while ($row = mysqli_fetch_array($tampil_kat)) {
                                $harga = number_format($row['harga'], 0, ',', '.');
                                echo "<li>" . $harga ." </li>";
                            }
                            ?>
                        </ul>
                    </td>
                    <td class="span3">
                        <ul style="margin:0; padding-left:18px;">
                            <?php
                            $sql_kat = "SELECT * FROM amprahan_detail WHERE id_amprahan = '$data[id_amprahan]'";
                            $tampil_kat = mysqli_query($koneksi, $sql_kat);
                    
                            while ($row = mysqli_fetch_array($tampil_kat)) {
                                echo "<li>" . htmlspecialchars($row['keterangan']) ." </li>";
                            }
                            ?>
                        </ul>
                    </td>

                    <td class="span1 no-print"><center>
                      <?php 
                    
                    $sql_pes = "SELECT COUNT(*) AS total, 
                                       SUM(CASE WHEN harga IS NULL OR harga = '' THEN 1 ELSE 0 END) AS belum
                                FROM amprahan_detail 
                                WHERE id_amprahan = '$data[id_amprahan]'";
                    $tampil_pes = mysqli_query($koneksi, $sql_pes);
                    $data_pes = mysqli_fetch_array($tampil_pes);
                    
                    if ($data_pes['belum'] == 0 && $data_pes['total'] > 0) {
                        echo "<span style='color:green; font-weight:bold;'><span class='icon-check' ></span></span>";
                    } else {
                        echo "<span style='color:red; font-weight:bold;'><span class='icon-remove-sign' ></span></span>";
                    }
                    ?>
                    
                      
                    </center></td>

                    <td class="span2 no-print">
                      <center>
                    
                        <div style="margin-bottom:6px;">
                          <a href="surat_pesanan_print.php?id=<?= $data['id_amprahan']; ?>" target="_blank">
                            <span class="badge badge-success tip-bottom" data-original-title="Print Surat Pesanan">
                              <span class="icon-print"></span>
                            </span>
                          </a>
                        </div>
                    
                        <div style="margin-bottom:6px;">
                          <a href="?page=supe&id=<?= $data['id_amprahan']; ?>">
                            <span class="badge badge-info tip-bottom" data-original-title="Edit Pesanan">
                              <span class="icon-edit"></span>
                            </span>
                          </a>
                        </div>
                    
                        <div style="margin-bottom:6px;">
                          <a href="?page=super&id=<?= $data['id_amprahan']; ?>">
                            <span class="badge badge-warning tip-bottom" data-original-title="Edit Faktur">
                              <span class="icon-edit"></span>
                            </span>
                          </a>
                        </div>
                    
                        <div>
                          <a href="?page=suph&id=<?= $data['id_amprahan']; ?>"
                             onclick="return confirm('Yakin Ingin Menghapus Amprahan Tersebut ?')">
                            <span class="badge badge-important tip-bottom" data-original-title="Delete">
                              <span class="icon-trash"></span>
                            </span>
                          </a>
                        </div>
                    
                      </center>
                    </td>

                </tr>
                <div id="modalFoto" class="modal hide fade" tabindex="-1">
                    <center>
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal">×</button>
                        
                        <h3>Preview Foto</h3>
                    </div>
                    <div class="modal-body" id="modalBody"></div>
                    </center>
                </div>

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
var tablePesanan;

$(document).ready(function () {

    if (!$.fn.dataTable.fnIsDataTable('#tablePesanan')) {
        tablePesanan = $('#tablePesanan').dataTable();
    } else {
        tablePesanan = $('#tablePesanan').dataTable();
    }

    $('#rekanan').on('change', function () {
        var rekananText = $('#rekanan option:selected').text();
        console.log(rekananText);
        tablePesanan.fnFilter(rekananText, 2);
    });
    

});

var rekeningMap = <?= json_encode($rekeningByRekanan); ?>;



$('#rekanan').on('change', function () {
    $('#rekening').val('').trigger('change');

    var id = $(this).val();
    var html = '<option value="" selected disabled hidden>-- Pilih rekening --</option>';

    if (rekeningMap[id]) {
        Object.values(rekeningMap[id]).forEach(function (r) {
            html += `
              <option value="${r.id_rekening}">
                ${r.kode_rekening} - ${r.nama_rekening} (${formatRupiahJs(r.jumlah)})
              </option>
            `;
        });
    } else {
        html += '<option disabled>Tidak ada rekening</option>';
    }

    $('#rekening').html(html);
});

$('#rekening').on('change', function () {
    var idRekening = $(this).val();
    var idRekanan  = $('#rekanan').val();

    if (!idRekening) return;

    $.ajax({
        url: 'ajax_pesanan_by_rekening.php',
        type: 'GET',
        data: {
            rekening: idRekening,
            rekanan: idRekanan
        },
        success: function (res) {
            var data = JSON.parse(res);

            // bersihkan isi table (AMAN utk 1.9.4)
            tablePesanan.fnClearTable();

            for (var i = 0; i < data.length; i++) {
                tablePesanan.fnAddData(data[i]);
            }
        }
    });
});


function formatRupiahJs(angka) {
    return "Rp. " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
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
    let rekanan = $('#rekanan').val();
    let rekening = $('#rekening').val();

    if (!tglDari || !tglSampai) {
      alert('Silakan pilih kedua tanggal!');
      return;
    }

    // ubah format
    let dari = formatTanggal(tglDari);
    let sampai = formatTanggal(tglSampai);

    // buka halaman print di tab baru
    window.open(`surat_pesanan_faktur_print.php?tgl_dari=${dari}&tgl_sampai=${sampai}&rekanan=${rekanan}&rekening=${rekening}`, '_blank');
    
  });
});

document.getElementById("printBtn").addEventListener("click", function () {
    var table = document.getElementById("tablePesanan").outerHTML;

    var win = window.open('', '_blank');

    win.document.write(`
        <html>
        <head>
            <title>Pesanan </title>
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
$('.lihat-foto').on('click', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#modalBody').html($('#foto-' + id).html());
    $('#modalFoto').modal('show');
});
</script>

