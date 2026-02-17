<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";

$query = "SELECT max(kode_pesanan_barang) as maxKode FROM pesanan_barang_kode";
$hasil = mysqli_query($koneksi, $query);
$data  = mysqli_fetch_array($hasil);
$kode = $data['maxKode'];

$noUrut = (int) substr($kode, 3, 5);
$noUrut++;
$char = "PB";
$id_pb = $char . sprintf("%05s", $noUrut);

$kegiatan = [];
$qK = mysqli_query($koneksi, "SELECT * FROM kegiatan ORDER BY id_program ASC");
while ($rK = mysqli_fetch_assoc($qK)) {
    $kegiatan[$rK['id_program']][] = $rK;
}

$sub_kegiatan = [];
$qSK = mysqli_query($koneksi, "SELECT * FROM sub_kegiatan ORDER BY id_kegiatan ASC");
while ($rSK = mysqli_fetch_assoc($qSK)) {
    $sub_kegiatan[$rSK['id_kegiatan']][] = $rSK;
}

$rek = [];
$q = mysqli_query($koneksi, "SELECT * FROM rekening ORDER BY id_sub_kegiatan ASC");
while ($r = mysqli_fetch_assoc($q)) {
    $rek[$r['id_sub_kegiatan']][] = $r;
}

$uraian = [];
$qU = mysqli_query($koneksi, "SELECT * FROM uraian ORDER BY id_rekening ASC");
while ($rU = mysqli_fetch_assoc($qU)) {
    $uraian[$rU['id_rekening']][] = $rU;
}

?>

<script src="../js/jquery.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/colorpicker.css" />
<link rel="stylesheet" href="../css/datepicker.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link rel="stylesheet" href="../css/bootstrap-wysihtml5.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=nonpegawai" class="tip-bottom">Pegawai</a> <a href="#" class="current">Tambah Pegawai</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>Pegawai</h3>    
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Pegawai</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=nonpegawai_sim" name="" enctype="multipart/form-data">
        <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data Pegawai!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Pegawai Tersebut sudah ada di system!</div>       
            <?php } ?>
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nama </label>
              <div class="controls">
                <input type="text" class="span5" name="nama_nonpegawai" value="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">NIP </label>
              <div class="controls">
                <input type="text" class="span3" name="nip_nonpegawai" value="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tempat Lahir </label>
              <div class="controls">
                <input type="text" class="span3" name="tempat_lahir_nonpegawai" value="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Lahir </label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tmpt_lahir_nonpegawai" autocomplete="off" data-date-format="dd-mm-yyyy"  class="datepicker span2">
                </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nomor SK </label>
              <div class="controls">
                <input type="text" class="span1" name="no_sk" placeholder="" value="800" /> /
                <input type="text" class="span1" name="tgl_sk"  placeholder="" /> / 
                <input type="text" data-date="01-02-2013" name="tgl_sk" data-date-format="dd-mm-yyyy" placeholder="" autocomplete="off" class="datepicker span2">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Gaji/Honorarium </label>
              <div class="controls">
                <input type="text" class="span2 rupiah" name="gaji_nonpegawai" value="" autocomplete="off" inputmode="numeric"/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Status </label>
              <div class="controls">
                <select name="jenis_nonpegawai" id="jenis_nonpegawai" class="span2 row-fluid" required>
                    <option value="0" selected disabled hidden>-- Pilih Status --</option>
                    <option value="1">Paruh Waktu</option>
                    <option value="2">Pasukan Biru</option>
                    <option value="3">ASN/NON ASN</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Program</label>
              <div class="controls">
                <select name="program" id="program" class="span7 row-fluid" required>
                    <option value="" selected disabled hidden>-- Pilih Program --</option>
                  <?php
                    include "../koneksi/koneksi.php";
                    $query = mysqli_query($koneksi, "SELECT * FROM program ORDER BY nama_program ASC");
                    while ($r = mysqli_fetch_array($query)) {
                      echo "<option value='".htmlspecialchars($r['id_program'])."'>".htmlspecialchars($r['kode_program'])." - ".htmlspecialchars($r['nama_program'])."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kegiatan</label>
              <div class="controls">
                <select name="kegiatan" id="kegiatan" class="span7 row-fluid" required>
                    <option value="" selected disabled hidden>-- Pilih Kegiatan --</option>
                 
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sub Kegiatan</label>
              <div class="controls">
                <select name="sub_kegiatan" id="sub_kegiatan" class="span7 row-fluid" required>
                    <option value="" selected disabled hidden>-- Pilih Sub Kegiatan --</option>
                  
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Rekening Belanja</label>
              <div class="controls">
                <select name="rekening" id="rekening" class="span7 row-fluid" required>
                  <option value="" selected disabled hidden>-- Pilih Rekening Belanja--</option>
            
                </select>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Uraian Belanja</label>
              <div class="controls">
                <select name="uraian" id="uraian" class="span6 row-fluid" required>
                  <option value="" selected disabled hidden>-- Pilih Uraian Belanja--</option>
            
                </select>
              </div>
            </div>
           
           

            <div class="control-group">
                <div class="row-fluid">
                 <div class="form-actions">
                  <center>
                    <button type="submit" class="btn btn-success">Save</button>
                    <a href="?page=nonpegawai" class="btn btn-danger">Cancel</a>
                    </center>
                  </div>
                </div>
            </div>
      </div>      
    </div>    
  </div>
  
 </form>
</div></div></div>



<!--end-Footer-part--> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<script>
let initialState = {};
let previousJenis = null;

$(document).ready(function () {
    // Baseline saat halaman pertama kali load
    initialState = {
        program: $('#program').val(),
        kegiatan: $('#kegiatan').val(),
        sub_kegiatan: $('#sub_kegiatan').val(),
        rekening: $('#rekening').val(),
        uraian: $('#uraian').val()
    };
});

function restoreInitialState() {
    $('#program').val(initialState.program).trigger('change');

    setTimeout(() => {
        $('#kegiatan').val(initialState.kegiatan).trigger('change');

        setTimeout(() => {
            $('#sub_kegiatan').val(initialState.sub_kegiatan).trigger('change');

            setTimeout(() => {
                $('#rekening').val(initialState.rekening).trigger('change');

                setTimeout(() => {
                    $('#uraian').val(initialState.uraian).trigger('change');
                }, 50);

            }, 50);
        }, 50);
    }, 50);
}

function autoSelectChain(config) {
    $('#program').val(config.program).trigger('change');

    setTimeout(() => {
        $('#kegiatan').val(config.kegiatan).trigger('change');

        setTimeout(() => {
            $('#sub_kegiatan').val(config.sub_kegiatan).trigger('change');

            setTimeout(() => {
                $('#rekening').val(config.rekening).trigger('change');

                setTimeout(() => {
                    $('#uraian').val(config.uraian).trigger('change');
                }, 50);

            }, 50);
        }, 50);
    }, 50);
}

$('#jenis_nonpegawai').on('change', function () {
    const jenis = $(this).val();

    // JENIS 1 → AUTO
    if (jenis === '1') {
        autoSelectChain({
            program: '1',
            kegiatan: '3',
            sub_kegiatan: '13',
            rekening: '100',
            uraian: '85'
        });
    }

    // JENIS 2 → AUTO
    else if (jenis === '2') {
        autoSelectChain({
            program: '1',
            kegiatan: '3',
            sub_kegiatan: '12',
            rekening: '78',
            uraian: '67'
        });
    }

    // JENIS 3 → RESTORE JIKA DARI 1 / 2
    else if (jenis === '3') {
        if (previousJenis === '1' || previousJenis === '2') {
            restoreInitialState();
        }
        // setelah restore → manual
    }

    previousJenis = jenis;
});
</script>



<script>
function resetSelect(id, placeholder) {
    
    $('#' + id).html(`<option value="">${placeholder}</option>`);
    $('#' + id).val("").trigger("change.select2");
}



var kegiatanData = <?php echo json_encode($kegiatan); ?>;
var subkegiatanData = <?php echo json_encode($sub_kegiatan); ?>;
var rekeningData = <?php echo json_encode($rek); ?>;
var uraianData = <?php echo json_encode($uraian); ?>;

$('select').select2({
    width: 'resolve',
    allowClear: true,
    placeholder: "-- Pilih Program --"
});
 
$('#program').change(function () {
    var id = $(this).val();
    
    // RESET dropdown di bawahnya
    resetSelect('kegiatan', '-- Pilih Kegiatan --');
    resetSelect('sub_kegiatan', '-- Pilih Sub Kegiatan --');
    resetSelect('rekening', '-- Pilih Rekening --');
    resetSelect('uraian', '-- Pilih Uraian --');
    
    var html = '<option value="">-- Pilih Kegiatan --</option>';

    if (kegiatanData[id] && kegiatanData[id].length > 0) {
        kegiatanData[id].forEach(function (item) {
            html += `
                <option 
                    value="${item.id_kegiatan}"
                    data-kode="${item.kode_kegiatan}"
                    data-nama="${item.nama_kegiatan}"
                >
                    ${item.kode_kegiatan} - ${item.nama_kegiatan}
                </option>`;
        });
    }

    $('#kegiatan').html(html);

    // refresh select2 agar mau menampilkan list
    $('#kegiatan').val("").trigger("change.select2");
});
$('#kegiatan').select2({
    templateResult: function (item) {
        if (!item.id) return item.text;
        let el = $(item.element);
        // FIX: cegah undefined
        let kode = el.data('kode') || "";
        let nama = el.data('nama') || "";
        return $(`<span><strong>${kode}</strong> ${nama}</span>`);
    },
    templateSelection: function(item){
        return item.text;
    }
});

$('#kegiatan').change(function () {
    var id = $(this).val();
    resetSelect('sub_kegiatan', '-- Pilih Sub Kegiatan --');
    resetSelect('rekening', '-- Pilih Rekening --');
    resetSelect('uraian', '-- Pilih Uraian --');
    var html = '<option value="">-- Pilih Sub Kegiatan --</option>';

    if (subkegiatanData[id] && subkegiatanData[id].length > 0) {
        subkegiatanData[id].forEach(function (item) {
            html += `
                <option 
                    value="${item.id_sub_kegiatan}"
                    data-kode="${item.kode_sub_kegiatan}"
                    data-nama="${item.nama_sub_kegiatan}"
                >
                    ${item.kode_sub_kegiatan} - ${item.nama_sub_kegiatan}
                </option>`;
        });
    }

    $('#sub_kegiatan').html(html);

    // refresh select2 agar mau menampilkan list
    $('#sub_kegiatan').val("").trigger("change.select2");
});
$('#sub_kegiatan').select2({
    templateResult: function (item) {
        if (!item.id) return item.text;
        let el = $(item.element);
        // FIX: cegah undefined
        let kode = el.data('kode') || "";
        let nama = el.data('nama') || "";
        return $(`<span><strong>${kode}</strong> ${nama}</span>`);
    },
    templateSelection: function(item){
        return item.text;
    }
});

$('#sub_kegiatan').change(function () {
    var id = $(this).val();
    resetSelect('rekening', '-- Pilih Rekening --');
    resetSelect('uraian', '-- Pilih Uraian --');
    var html = '<option value="">-- Pilih Rekening --</option>';

    if (rekeningData[id] && rekeningData[id].length > 0) {
        rekeningData[id].forEach(function (item) {
            html += `
                <option 
                    value="${item.id_rekening}"
                    data-kode="${item.kode_rekening}"
                    data-nama="${item.nama_rekening}"
                    data-jumlah="${item.jumlah}"
                >
                    ${item.kode_rekening} - ${item.nama_rekening}
                </option>`;
        });
    }

    $('#rekening').html(html);

    // refresh select2 agar mau menampilkan list
    $('#rekening').val("").trigger("change.select2");
});
$('#rekening').select2({
    templateResult: function (item) {
        if (!item.id) return item.text;
        let el = $(item.element);
        // FIX: cegah undefined
        let kode = el.data('kode') || "";
        let nama = el.data('nama') || "";
        let jumlah = el.data('jumlah') || "";
        
        return $(`<span><strong>${kode}</strong> ${nama} <strong style="color:green">(${formatRupiahJs(jumlah)})</strong></span>`);
        
    },
    templateSelection: function(item){
        return item.text;
    }
});

$('#rekening').change(function () {
    var id = $(this).val();
    resetSelect('uraian', '-- Pilih Uraian --');
    var html = '<option value="">-- Pilih Uraian --</option>';

    if (uraianData[id] && uraianData[id].length > 0) {
        uraianData[id].forEach(function (item) {
            html += `
                <option 
                    value="${item.id_uraian}"
                    data-nama="${item.nama_uraian}"
                >
                    ${item.nama_uraian}
                </option>`;
        });
    }

    $('#uraian').html(html);

    // refresh select2 agar mau menampilkan list
    $('#uraian').val("").trigger("change.select2");
});
$('#uraian').select2({
    templateResult: function (item) {
        if (!item.id) return item.text;
        let el = $(item.element);
        let nama = el.data('nama') || "";
        return $(`<span>${nama}</span>`);
    },
    templateSelection: function(item){
        return item.text;
    }
});


function formatRupiahJs(angka) {
    return "Rp. " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true,
    autoclose: true
});

</script>

<script type="text/javascript">
$(document).on('input', '.rupiah', function () {
    let raw = $(this).val().replace(/[^0-9]/g, '');
    let formatted = raw === '' ? '' : formatRupiah(raw);

    $(this).val(formatted);

    // update hidden input di sebelahnya
    $(this).next('input[type=hidden]').val(raw);
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
}

</script>
<script>
document.querySelector("form").addEventListener("submit", function(e){
    let tujuan = document.querySelector("[name='tujuan']");
    if(tujuan.value === ""){
        e.preventDefault();
        tujuan.style.border = "2px solid red";
        tujuan.focus();
        return false;
    }
});
</script>
