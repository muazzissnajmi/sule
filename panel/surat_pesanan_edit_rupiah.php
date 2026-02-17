<?php include 'session.php'; ?>
<?php
include "../koneksi/koneksi.php";

// ID amprahan yang mau diedit
$id = intval($_GET['id']);

// Ambil data header
$q = mysqli_query($koneksi, "SELECT * FROM amprahan WHERE id_amprahan='$id'");
$h = mysqli_fetch_assoc($q);

// Ambil detail
$qD = mysqli_query($koneksi, "SELECT * FROM amprahan_detail WHERE id_amprahan='$id'");

// Ambil semua data untuk dropdown (sama seperti tambah)
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
$qR = mysqli_query($koneksi, "SELECT * FROM rekening ORDER BY id_sub_kegiatan ASC");
while ($rR = mysqli_fetch_assoc($qR)) {
    $rek[$rR['id_sub_kegiatan']][] = $rR;
}

$uraian = [];
$qU = mysqli_query($koneksi, "SELECT * FROM uraian ORDER BY id_rekening ASC");
while ($rU = mysqli_fetch_assoc($qU)) {
    $uraian[$rU['id_rekening']][] = $rU;
}
?>


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
.item-row {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
}

.item-row label {
    margin: 0;
    white-space: nowrap;
}

.item-row input {
    margin: 0;
}

.item-scroll {
    overflow-x: auto;
    padding-bottom: 8px;      /* biar scrollbar ga nempel */
}

.item-row {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 1000px;        /* ⬅️ trigger scroll */
    margin-bottom: 10px;
}

.item-row label {
    white-space: nowrap;
}

.item-row input {
    margin: 0;
}
.foto-thumb-wrapper {
    margin-top: 5px;
}

.foto-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border: 1px solid #ccc;
    margin-right: 5px;
    cursor: pointer;
    transition: 0.2s;
}

.foto-thumb:hover {
    transform: scale(1.05);
    border-color: #007bff;
}
</style>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=sups" class="tip-bottom">Amprahan</a> <a href="#" class="current">Edit Faktur</a></div>
  
</div>
<div class="container-fluid">
<h3>Edit Faktur</h3>

<form class="form-horizontal" method="post" action="?page=supesr" enctype="multipart/form-data">

<input type="hidden" name="id_amprahan" value="<?= $h['id_amprahan'] ?>">

<div class="widget-content nopadding form-horizontal">

<div class="control-group">
    <label class="control-label">Nomor Faktur</label>
        
        <div class="controls">
            
            <input type="text" class="span1" name="no_faktur"  placeholder="" value="<?= $h['no_faktur'] ?>" /> /  
            <strong><?php echo date('Y'); ?></strong>
          </div>

</div>


<div class="control-group">
              <label class="control-label">Tanggal Pesanan </label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_pesanan" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y', strtotime($h['tanggal'])); ?>" class="datepicker span4" disabled>
                  <input type="hidden" data-date="01-02-2013" name="tahun_" data-date-format="dd-mm-yyyy" value="<?php echo date('Y', strtotime($h['tanggal'])); ?>" class="datepicker span4">
                </div>
              </div>
            </div>
<div class="control-group" >
    <label class="control-label">Rekanan</label>
    <div class="controls">
        <select name="tujuan" class="span6 select2" disabled>
            <option value="">-- Pilih Rekanan --</option>
            <?php
            $qR = mysqli_query($koneksi, "SELECT * FROM rekanan ORDER BY nama_rekanan ASC");
            while ($r = mysqli_fetch_assoc($qR)) {
                $sel = ($r['id_rekanan'] == $h['id_rekanan']) ? "selected" : "";
                echo "<option value='{$r['id_rekanan']}' $sel>{$r['nama_rekanan']}</option>";
            }
            ?>
        </select>
    </div>
</div>
<div class="control-group">
    <label class="control-label">Pejabat Berwenang</label>
    <div class="controls">
        <select name="pejabat_berwenang" class="span6 select2" disabled>
            <option value="">-- Pilih Pejabat --</option>
            <?php
            $sqlP = "SELECT * FROM ttd_pejabat 
                     INNER JOIN pegawai ON ttd_pejabat.nip_pejabat = pegawai.nip 
                     WHERE defult='umum'
                     ORDER BY id_ttd_pejabat ASC";
            
            $qP = mysqli_query($koneksi, $sqlP);
            
            while ($r = mysqli_fetch_assoc($qP)) {
                $sel = ($r['id_ttd_pejabat'] == $h['id_pejabat']) ? "selected" : "";
                echo "<option value='{$r['id_ttd_pejabat']}' $sel>{$r['nama']}</option>";
            }

            ?>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Program</label>
    <div class="controls">
        <select name="program" id="program" class="span6 select2" disabled>
            <option value="">-- Pilih Program --</option>
            <?php
            $qP = mysqli_query($koneksi, "SELECT * FROM program ORDER BY nama_program ASC");
            while ($r = mysqli_fetch_array($qP)) {
                $sel = ($r['id_program'] == $h['id_program']) ? "selected" : "";
                echo "<option value='{$r['id_program']}' $sel>
                        {$r['kode_program']} - {$r['nama_program']}
                      </option>";
            }
            ?>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Kegiatan</label>
    <div class="controls">
        <select name="kegiatan" id="kegiatan" class="span6 select2" disabled>
            <option value="">-- Pilih Kegiatan --</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Sub Kegiatan</label>
    <div class="controls">
        <select name="sub_kegiatan" id="sub_kegiatan" class="span6 select2" disabled>
            <option value="">-- Pilih Sub Kegiatan --</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Rekening</label>
    <div class="controls">
        <select name="rekening" id="rekening" class="span6 select2" disabled>
            <option value="">-- Pilih Rekening --</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Uraian Belanja</label>
    <div class="controls">
        <select name="uraian" id="uraian" class="span6 select2" disabled>
            <option value="">-- Pilih Uraian --</option>
        </select>
    </div>
</div>

<!-- DETAIL -->
<div class="control-group">
    <label class="control-label">Item Pesanan</label>
    <div class="controls">
        <input id="idf" type="hidden" value="1000">
        <div id="div">
            <?php while ($d = mysqli_fetch_array($qD)) : 
            
            $qFoto = mysqli_query($koneksi, "
                SELECT filename 
                FROM amprahan_foto 
                WHERE id_detail = '{$d['id_detail']}'
            ");

            ?>
                <p id="row<?= $d['id_detail'] ?>" class="item-row">
                    
                    <label style="margin-right:5px;">Item:</label>
                    <input type="text" 
                           name="uraian_edit[<?= $d['id_detail'] ?>]" 
                           value="<?= htmlspecialchars($d['uraian']) ?>" 
                           class="span3" disabled>
                           
                    <label style="margin-left:15px;margin-right:5px;">Harga:</label>
                    <input type="text" style="width: 80px;"
                           name="harga_view[<?= $d['id_detail'] ?>]"
                           value="<?= number_format($d['harga'], 0, ',', '.') ?>"
                           class="rupiah"
                           autocomplete="off"
                           inputmode="numeric">
                    
                    <input type="hidden"
                           name="harga_edit[<?= $d['id_detail'] ?>]"
                           value="<?= $d['harga'] ?>">
                           
                    <label style="margin-right:5px;">Foto:</label>
                    <input type="file"
                       name="foto_edit[<?= $d['id_detail'] ?>][]"
                       multiple
                       accept=".jpg,.jpeg,.png,image/jpeg,image/png">

                    <!--<div class="foto-thumb-wrapper">-->
                    <!--    <?php while ($f = mysqli_fetch_assoc($qFoto)) : ?>-->
                    <!--        <img -->
                    <!--            src="../uploads/amprahan/<?= $f['filename'] ?>"-->
                    <!--            class="foto-thumb"-->
                    <!--            data-full="../uploads/amprahan/<?= $f['filename'] ?>"-->
                    <!--            alt="Foto item"-->
                    <!--        >-->
                    <!--    <?php endwhile; ?>-->
                    <!--</div>-->


                </p>
            <?php endwhile; ?>
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="?page=sups" class="btn btn-danger">Batal</a>
</div>

</div>
</form>
</div>
</div>
<div id="modalFoto" class="modal hide fade" tabindex="-1">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">×</button>
    <h4>Preview Foto</h4>
  </div>
  <div class="modal-body" style="text-align:center">
    <img id="modalFotoImg" src="" style="max-width:100%; max-height:80vh;">
  </div>
</div>


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
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
var kegiatanData     = <?= json_encode($kegiatan) ?>;
var subData          = <?= json_encode($sub_kegiatan) ?>;
var rekeningData     = <?= json_encode($rek) ?>;
var uraianData       = <?= json_encode($uraian) ?>;

// INIT SELECT2
$('select').select2({ width:'resolve' });

$('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    todayHighlight: true,
    autoclose: true
});

// AUTOFILL DROPDOWN (mode edit)
var sel_program       = "<?= $h['id_program'] ?>";
var sel_kegiatan      = "<?= $h['id_kegiatan'] ?>";
var sel_sub           = "<?= $h['id_sub_kegiatan'] ?>";
var sel_rekening      = "<?= $h['id_rekening'] ?>";
var sel_uraian        = "<?= $h['id_uraian'] ?>";


// ============= PROGRAM CHANGE =============
$('#program').change(function(){
    let id = $(this).val();
    let html = '<option value="">-- Pilih Kegiatan --</option>';

    if(kegiatanData[id]) {
        kegiatanData[id].forEach(function(item){
            html += `<option value="${item.id_kegiatan}">${item.kode_kegiatan} - ${item.nama_kegiatan}</option>`;
        });
    }

    $('#kegiatan').html(html).val(sel_kegiatan).trigger("change");
});

// ============= KEGIATAN CHANGE =============
$('#kegiatan').change(function(){
    let id = $(this).val();
    let html = '<option value="">-- Pilih Sub Kegiatan --</option>';

    if(subData[id]) {
        subData[id].forEach(function(item){
            html += `<option value="${item.id_sub_kegiatan}">${item.kode_sub_kegiatan} - ${item.nama_sub_kegiatan}</option>`;
        });
    }

    $('#sub_kegiatan').html(html).val(sel_sub).trigger("change");
});

// ============= SUB KEGIATAN CHANGE =============
$('#sub_kegiatan').change(function(){
    let id = $(this).val();
    let html = '<option value="">-- Pilih Rekening --</option>';

    if(rekeningData[id]) {
        rekeningData[id].forEach(function(item){
            html += `<option value="${item.id_rekening}">${item.kode_rekening} - ${item.nama_rekening}</option>`;
        });
    }

    $('#rekening').html(html).val(sel_rekening).trigger("change");
});

// ============= REKENING CHANGE =============
$('#rekening').change(function(){
    let id = $(this).val();
    let html = '<option value="">-- Pilih Uraian --</option>';

    if(uraianData[id]) {
        uraianData[id].forEach(function(item){
            html += `<option value="${item.id_uraian}">${item.nama_uraian}</option>`;
        });
    }

    $('#uraian').html(html).val(sel_uraian).trigger("change");
});

// ============= ITEM TAMBAH/HAPUS =============
function tambah() {
    let idf = parseInt($('#idf').val()) + 1;
    $('#idf').val(idf);

    $('#div').append(`
        <p id="new${idf}" class="item-row">

            <label style="margin-left:5px;">Item:</label>
            <input type="text" name="uraian_new[]" class="span3">
            
            <label style="margin-left:15px;margin-right:5px;">Harga:</label>
            <input type="number" name="harga_new[]" class="span3">

            <label style="margin-left:15px;margin-right:5px;">Banyak:</label>
            <input type="number" name="banyak_new[]" class="span1" value="1">

            <label style="margin-left:15px;margin-right:5px;">Satuan:</label>
            <input type="text" name="satuan_new[]" class="span2">

            <label style="margin-left:15px;margin-right:5px;">Ket:</label>
            <input type="text" name="ket_new[]" class="span3">

            <a href="#" onclick='hapusElemen("#new${idf}"); return false;'>
                <span class="label label-important">
                    <i class="icon-trash"></i>
                </span>
            </a>
        </p>
    `);
}



function hapusElemen(id) {
    $(id).find('input').remove(); // hapus semua input
    $(id).remove(); // hapus bungkusnya
}


initEditMode();

function initEditMode() {

    // --- PRE-FILL KEGIATAN ---
    if (sel_program) {
        $('#program').val(sel_program).trigger('change.select2');

        let htmlK = '<option value="">-- Pilih Kegiatan --</option>';
        if (kegiatanData[sel_program]) {
            kegiatanData[sel_program].forEach(function(item){
                htmlK += `<option value="${item.id_kegiatan}">${item.kode_kegiatan} - ${item.nama_kegiatan}</option>`;
            });
        }
        $('#kegiatan').html(htmlK).val(sel_kegiatan).trigger('change.select2');
    }

    // --- PRE-FILL SUB KEGIATAN ---
    let htmlSK = '<option value="">-- Pilih Sub Kegiatan --</option>';
    if (subData[sel_kegiatan]) {
        subData[sel_kegiatan].forEach(function(item){
            htmlSK += `<option value="${item.id_sub_kegiatan}">${item.kode_sub_kegiatan} - ${item.nama_sub_kegiatan}</option>`;
        });
    }
    $('#sub_kegiatan').html(htmlSK).val(sel_sub).trigger('change.select2');


    // --- PRE-FILL REKENING ---
    let htmlR = '<option value="">-- Pilih Rekening --</option>';
    if (rekeningData[sel_sub]) {
        rekeningData[sel_sub].forEach(function(item){
            htmlR += `<option value="${item.id_rekening}">${item.kode_rekening} - ${item.nama_rekening}</option>`;
        });
    }
    $('#rekening').html(htmlR).val(sel_rekening).trigger('change.select2');


    // --- PRE-FILL URAIAN ---
    let htmlU = '<option value="">-- Pilih Uraian --</option>';
    if (uraianData[sel_rekening]) {
        uraianData[sel_rekening].forEach(function(item){
            htmlU += `<option value="${item.id_uraian}">${item.nama_uraian}</option>`;
        });
    }
    $('#uraian').html(htmlU).val(sel_uraian).trigger('change.select2');
}

function formatRupiah(angka) {
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

$(document).on('input', '.rupiah', function () {
    let raw = $(this).val().replace(/[^0-9]/g, '');
    let formatted = raw === '' ? '' : formatRupiah(raw);

    $(this).val(formatted);

    // update hidden input di sebelahnya
    $(this).next('input[type=hidden]').val(raw);
});

$(document).on('click', '.foto-thumb', function () {
    let src = $(this).data('full');
    $('#modalFotoImg').attr('src', src);
    $('#modalFoto').modal('show');
});

</script>
