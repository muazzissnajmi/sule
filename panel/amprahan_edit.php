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

<script src="../js/jquery.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />

<div id="content">
<h3>Edit Amprahan</h3>

<form class="form-horizontal" method="post" action="amprahan_update.php">

<input type="hidden" name="id_amprahan" value="<?= $h['id_amprahan'] ?>">

<div class="widget-content nopadding form-horizontal">

<div class="control-group">
    <label class="control-label">Nomor Amprahan</label>
    <div class="controls">
        <input type="text" class="span2" disabled value="<?= $h['kode_amprahan'] ?>">
        <input type="hidden" name="kode_amprahan" value="<?= $h['kode_amprahan'] ?>">
    </div>
</div>

<div class="control-group">
    <label class="control-label">Tanggal</label>
    <div class="controls">
        <input type="text" name="tgl_pesanan"
               value="<?= date('d-m-Y', strtotime($h['tanggal'])) ?>"
               class="datepicker span4">
    </div>
</div>

<div class="control-group">
    <label class="control-label">Program</label>
    <div class="controls">
        <select name="program" id="program" class="span6 select2">
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
        <select name="kegiatan" id="kegiatan" class="span6 select2">
            <option value="">-- Pilih Kegiatan --</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Sub Kegiatan</label>
    <div class="controls">
        <select name="sub_kegiatan" id="sub_kegiatan" class="span6 select2">
            <option value="">-- Pilih Sub Kegiatan --</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Rekening</label>
    <div class="controls">
        <select name="rekening" id="rekening" class="span6 select2">
            <option value="">-- Pilih Rekening --</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label">Uraian Belanja</label>
    <div class="controls">
        <select name="uraian" id="uraian" class="span6 select2">
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
            <?php
            while ($d = mysqli_fetch_array($qD)) {
                echo "
                <p id='row{$d['id_detail']}'>
                    <label>Banyak:</label>
                    <input type='number' name='banyak_edit[{$d['id_detail']}]' 
                           value='{$d['banyak']}' class='span1'>

                    <label>Satuan:</label>
                    <input type='text' name='satuan_edit[{$d['id_detail']}]'
                           value='{$d['satuan']}' class='span2'>

                    <label>Uraian:</label>
                    <input type='text' name='uraian_edit[{$d['id_detail']}]' 
                           value='{$d['uraian']}' class='span4'>

                    <label>Ket:</label>
                    <input type='text' name='ket_edit[{$d['id_detail']}]'
                           value='{$d['keterangan']}' class='span3'>

                    <a href='#' onclick='hapusElemen(\"#row{$d['id_detail']}\")'>
                        <span class='label label-important'><i class='icon-trash'></i></span>
                    </a>
                </p>";
            }
            ?>
        </div>

        <button type="button" onclick="tambah()" class="btn btn-success">
            <i class="icon-plus"></i> Tambah Item
        </button>
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="?page=sups" class="btn btn-danger">Batal</a>
</div>

</div>
</form>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>
var kegiatanData     = <?= json_encode($kegiatan) ?>;
var subData          = <?= json_encode($sub_kegiatan) ?>;
var rekeningData     = <?= json_encode($rek) ?>;
var uraianData       = <?= json_encode($uraian) ?>;

// INIT SELECT2
$('select').select2({ width:'resolve' });

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
        <p id='new${idf}'>
            <input type='number' name='banyak_new[]' class='span1' value='1'>
            <input type='text' name='satuan_new[]' class='span2'>
            <input type='text' name='uraian_new[]' class='span4'>
            <input type='text' name='ket_new[]' class='span3'>
            <a href='#' onclick='hapusElemen("#new${idf}")'>
                <span class='label label-important'><i class='icon-trash'></i></span>
            </a>
        </p>
    `);
}

function hapusElemen(id){
    $(id).remove();
}
</script>
