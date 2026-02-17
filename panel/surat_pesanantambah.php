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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=sups" class="tip-bottom">Surat Pesanan</a> <a href="#" class="current">Tambah Surat Pesanan</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>Surat Pesanan</h3>    
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Surat Pesanan</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=supsi" name="" enctype="multipart/form-data">
        <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Surat Pesanan Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data Surat Pesanan!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              No Pesanan Tersebut sudah ada di system!</div>       
            <?php } ?>
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nomor Pesanan </label>
              <div class="controls">
                <input type="hidden" class="span1" name="kode_pesanan" value="<?php echo $id_pb; ?>" />
                <input type="text" class="span1" name="kode_item"  placeholder="" /> / 
                <input type="text" class="span2" name="no_pesanan"  placeholder="" /> /  
                <strong><?php echo date('Y'); ?></strong>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Pesanan </label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_pesanan" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" class="datepicker span4">
                  <input type="hidden" data-date="01-02-2013" name="tahun_" data-date-format="dd-mm-yyyy" value="<?php echo date('Y'); ?>" class="datepicker span4">
                </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Rekanan/Penyedia</label>
              <div class="controls">
                <select name="tujuan" class="span5" required>
                    <option value="" selected disabled hidden>-- Pilih Rekanan --</option>
                  <?php
                    include "../koneksi/koneksi.php";
                    $query = mysqli_query($koneksi, "SELECT * FROM rekanan ORDER BY nama_rekanan ASC");
                    while ($r = mysqli_fetch_array($query)) {
                      echo "<option value='".htmlspecialchars($r['id_rekanan'])."'>".htmlspecialchars($r['nama_rekanan'])."</option>";
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Pejabat Berwenang </label>
              <div class="controls">
                <select name="pejabat_berwenang"class="span5" required> 
                  <?php
                  $sql = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult='umum' ORDER BY id_ttd_pejabat ASC";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_ttd_pejabat']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Program</label>
              <div class="controls">
                <select name="program" id="program" class="span row-fluid" required>
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
                <select name="kegiatan" id="kegiatan" class="span row-fluid" required>
                    <option value="" selected disabled hidden>-- Pilih Kegiatan --</option>
                 
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sub Kegiatan</label>
              <div class="controls">
                <select name="sub_kegiatan" id="sub_kegiatan" class="span row-fluid" required>
                    <option value="" selected disabled hidden>-- Pilih Sub Kegiatan --</option>
                  
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Rekening Belanja</label>
              <div class="controls">
                <select name="rekening" id="rekening" class="span row-fluid" required>
                  <option value="" selected disabled hidden>-- Pilih Rekening Belanja--</option>
            
                </select>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Uraian Belanja</label>
              <div class="controls">
                <select name="uraian" id="uraian" class="span row-fluid" required>
                  <option value="" selected disabled hidden>-- Pilih Uraian Belanja--</option>
            
                </select>
              </div>
            </div>
           
           

            <div class="control-group">
              <label class="control-label">Item Pesanan </label>
              <div class="controls">
            <input id="idf" value="" type="hidden" />
            <div id="div"></div>
            <button type="button" onclick="tambah(); " class="btn btn-success"><span class="icon-plus"></span> Item Pesanan</button>
             </div>
            
            
            <div class="row-fluid">
             <div class="form-actions">
              <center>
                        <button type="submit" class="btn btn-success">Save</button>
                        <!--<button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-info">Edit</button>-->
                        <a href="?page=sups" class="btn btn-danger">Cancel</a>
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
    placeholder: "-- Pilih --"
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

<script>
function tambah() {
  let idf = parseInt(document.getElementById("idf").value || 0);
  const tahun = "<?= date('Y') ?>";

  const stre = `
    <p id='srow${idf}'>
      <label>Banyaknya :</label>
      <input type='hidden' name='tahun[]' value='${tahun}'>
      
      <input type='number' class='span2' name='banyak[]' value='1' />

      <label>Satuan :</label>
      <input type='text' class='span2' name='satuan[]' placeholder='Satuan' /><br>

      <label>Uraian Barang/Jasa :</label>
      <input type='text' class='span5' name='uraian_detail[]' placeholder='Uraian Barang/Jasa' />

      <label>Keterangan :</label>
      <input type='text' class='span5' name='ket[]' placeholder='Keterangan' />

      <a href='#' style='color:#3399FD;' onclick='hapusElemen("#srow${idf}"); return false;'>
        <span class='label label-important tip-bottom'><span class='icon-trash'></span></span>
      </a>

      <br><br>
    </p>`;

  $("#div").append(stre);
  document.getElementById("idf").value = idf + 1;
}


function hapusElemen(idf) {
  $(idf).remove();
}
</script>

<script type="text/javascript">


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
