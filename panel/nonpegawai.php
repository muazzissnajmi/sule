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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pegawai</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Daftar Pegawai</h3>
    <a href="?page=npt" class="btn btn-success btn-mini"><span class="icon-plus"></span> &nbsp; Input Pegawai</a>


<button class="btn btn-info btn-mini" id="printBtn">Print Table</button>

    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data Pegawai!</div>       
            <?php }  else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Data Pegawai Gagal disimpan!</div>       
            <?php }else if ($msg == 4) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil Disimpan!</div>  
            
            <?php }else if ($msg == 5) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil Diedit!</div>  
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Pegawai</h5>
            
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table" id="tablePesanan">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Jenis</th>
                  <th>Gaji </th>
                  <th>Rekening</th>
                  <th class="no-print">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";

                  $sql = "SELECT * FROM non_pegawai ORDER BY id_nonpegawai DESC";
                  $tampil = mysqli_query($koneksi, $sql);
                  $no = 1;
                  while ($data = mysqli_fetch_array($tampil)) {   
                ?>
                <tr>
                    <td class="span1"><center><?php echo $no; ?></td>
                    <td class="span2"><center><?php echo $data['nama_nonpegawai']; ?></td>
                    <td class="span2"><center><?php echo $data['nip_nonpegawai']; ?></center></td>
                    <td class="span2">
                        <center>
                            <?php
                            if ($data['jenis_nonpegawai'] == 1) {
                                echo 'Paruh Waktu';
                            } elseif ($data['jenis_nonpegawai'] == 2) {
                                echo 'Pasukan Biru';
                            } elseif ($data['jenis_nonpegawai'] == 3) {
                                echo 'ASN / NON ASN';
                            } else {
                                echo '-';
                            }
                            ?>
                        </center>
                    </td>

                    <td class="span2"><center><?php echo number_format($data['gaji_nonpegawai'], 0, ',', '.');  ?></center></td>
                    <td class="span3"><?php echo getRekening($data['id_rekening']); ?></td>
                    

                    <td class="span2 no-print">
                      <center>
                    
                    
                        <div style="margin-bottom:6px;">
                          <a href="?page=supe&id=<?= $data['id_nonpegawai']; ?>">
                            <span class="badge badge-info tip-bottom" data-original-title="Edit Pesanan">
                              <span class="icon-edit"></span>
                            </span>
                          </a>
                        </div>
                    
                        <div>
                          <a href="?page=suph&id=<?= $data['id_nonpegawai']; ?>"
                             onclick="return confirm('Yakin Ingin Menghapus Amprahan Tersebut ?')">
                            <span class="badge badge-important tip-bottom" data-original-title="Delete">
                              <span class="icon-trash"></span>
                            </span>
                          </a>
                        </div>
                    
                      </center>
                    </td>

                </tr>
                

                <?php
                $no++;
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

</script>

