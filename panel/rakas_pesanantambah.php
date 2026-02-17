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
?>

<script src="../js/jquery.js"></script>

<script>
$(document).ready(function() {
  $('#kategori').change(function() { // Jika Select Box id kategori dipilih
    var kategori = $(this).val(); // Ciptakan variabel kategori
    $.ajax({
      type: 'POST', // Metode pengiriman data menggunakan POST
      url: 'katergori_subpesanan.php', // File yang akan memproses data
      data: 'kategori_pesanan=' + kategori, // Data yang akan dikirim ke file pemroses
      success: function(response) { // Jika berhasil
        $('#subkatergori').html(response); // Berikan hasil ke id subkatergori
      }
    });
    });

});
</script>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/colorpicker.css" />
<link rel="stylesheet" href="../css/datepicker.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link rel="stylesheet" href="../css/bootstrap-wysihtml5.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=sups" class="tip-bottom">Surat Pesanan</a> <a href="#" class="current">Tambah Surat Pesanan</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>Rancangan Anggaran</h3>    
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Rancangan Anggaran</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=supsi" name="" enctype="multipart/form-data">
        <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Rancangan Anggaran Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data Rancangan Anggaran!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              No Pesanan Tersebut sudah ada di system!</div>       
            <?php } ?>
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Tahun Anggaran </label>
              <div class="controls">
                <input type="number" class="span1" name="tahun" value="<?php echo $id_pb; ?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Program  </label>
              <div class="controls">
                <input type="text" class="span5" name="program"  placeholder="Program" value="4.01.01-PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KAB/KOTA" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kegiatan  </label>
              <div class="controls">
                <input type="text" class="span5" name="kegiatan"  placeholder="Kegiatan" value="4.01.2.06-ADMINISTRASI UMUM PERANGKAT DAERAH" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Sub-Kegiatan  </label>
              <div class="controls">
                <input type="text" class="span5" name="subkegiatan"  placeholder="Sub-Kegiatan" value="4.01.2.06.00001-PENYEDIAAN KOMPONEN INSTALASI LISTRIK/PENERANGAN BANGUNAN KANTOR" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nilai Anggaran  </label>
              <div class="controls">
                <input type="number" class="span5" name="nilaianggaran"  placeholder="Nilai Anggaran" value="" required />
              </div>
            </div>
            
            
<?php
// Ambil semua pilihan item
$sql_item = mysqli_query($koneksi, "SELECT * FROM pesanan_item");
$options_item = '';
while ($data_item = mysqli_fetch_array($sql_item)) {
  $options_item .= "<option value='{$data_item['item_pesanan']}'>".ucfirst($data_item['item_pesanan'])."</option>";
}

// Ambil semua uraian
$sql_uraian = mysqli_query($koneksi, "SELECT * FROM pesanan_uraian");
$options_uraian = '';
while ($data_uraian = mysqli_fetch_array($sql_uraian)) {
  $options_uraian .= "<option value='{$data_uraian['uraian_barang']}'>".ucfirst($data_uraian['uraian_barang'])."</option>";
}
?>

            <div class="control-group">
              <label class="control-label"> Uraian </label>
              <div class="controls">
            <input id="idf" value="" type="hidden" />
            <div id="div"></div>
            <button type="button" onclick="tambah(); " class="btn btn-success">Tambah Uraian</button>
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

<script language="javascript">
   
</script>


<!--end-Footer-part--> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/jquery.toggle.buttons.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script>
  $('.textarea_editor').wysihtml5();
</script>

<script>
const bulanList = [
  "Januari", "Februari", "Maret", "April",
  "Mei", "Juni", "Juli", "Agustus",
  "September", "Oktober", "November", "Desember"
];

// tempat penyimpanan nilai per item dan per bulan
let nilaiBulan = {};

function tambah() {
  let idf = parseInt(document.getElementById("idf").value || 0);
  const tahun = "<?= date('Y') ?>";

  // inisialisasi object untuk item baru
  nilaiBulan[idf] = {};

  const dropdownBulan = `
    <label>Bulan:</label>
    <select class='span3' id='bulanSelect${idf}' onchange='tambahInputBulan(${idf})'>
      <option value=''>-- Pilih Bulan --</option>
      ${bulanList.map((b, i) => `<option value='${i+1}'>${b}</option>`).join("")}
    </select>
    <span id='bulanInput${idf}'></span>
  `;

  const stre = `
    <p id='srow${idf}'>
      <label>Uraian:</label>
      <input type='hidden' name='tahun[]' value='${tahun}'>
      <input type='text' class='span5' name='banyak[]' value=''><br>
      <label>Anggaran Tahun Ini:</label>
      <input type='text' class='span5' name='anggaran[]' value=''><br>
      ${dropdownBulan}
      <a href='#' style='color:#3399FD;' onclick='hapusElemen("#srow${idf}"); return false;'>
        <span class='label label-important tip-bottom'><span class='icon-trash'></span></span>
      </a><br><br>
    </p>
  `;

  $("#div").append(stre);
  document.getElementById("idf").value = idf + 1;
}

function tambahInputBulan(id) {
  const select = document.getElementById(`bulanSelect${id}`);
  const value = select.value;
  const selected = select.options[select.selectedIndex].text;
  const container = document.getElementById(`bulanInput${id}`);

  if (value) {
    // ambil nilai sebelumnya kalau sudah pernah diisi
    const prev = nilaiBulan[id][value] || "";

    container.innerHTML = `
      <input 
        type='number' 
        class='span2' 
        id='inputBulan${id}_${value}' 
        name='nilai_bulan[${id}][${value}]' 
        placeholder='${selected}' 
        value='${prev}'
        oninput='simpanNilai(${id}, ${value}, this.value)'
      >
    `;
  } else {
    container.innerHTML = "";
  }
}

function simpanNilai(id, bulan, val) {
  // simpan nilai setiap kali user mengetik
  nilaiBulan[id][bulan] = val;
}

function hapusElemen(idf) {
  $(idf).remove();
}
</script>


<script type="text/javascript">
	var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value, "Rp. ");
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