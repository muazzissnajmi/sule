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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=kota" class="tip-bottom">Kota</a> <a href="#" class="current">Tambah Kab./Kota</a></div>
  
</div>
<div class="container-fluid">
  
<h3>Tambah Kabupaten / Kota / Kecamatan</h3> 
          <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Kab./Kota Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data Kab./Kota!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Kab./Kota Tersebut sudah ada di system!</div>       
            <?php } ?>   
  <div class="row-fluid">
    <div class="span12">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Kab./Kota</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=ktsim" name="" enctype="multipart/form-data">
        
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nama Kab./Kota/Kec. </label>
              <div class="controls">                
                <input type="text" class="span5" name="kota"  placeholder="Input Kabupaten / Kota / Kecamatan" />
              </div>
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
      </form>      
    </div>    
  </div> 
</div>



      </form>      
    </div>    
  </div> 
</div>

<div class="row-fluid">
    <div class="span12">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Kategori Uraian</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=supus" name="" enctype="multipart/form-data">
        
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="control-group">
              <label class="control-label">Lihat Uraian Barang/Jasa :</label>
              <div class="controls">                                  
                  <select name="" class="span5">
                    <?php
                      $sql_item = "SELECT * FROM pesanan_uraian";
                      $tampil_item = mysqli_query($koneksi, $sql_item);     
                      while ($data_item = mysqli_fetch_array($tampil_item)) {
                      ?>    
                      <option value="<?php echo $data_item['uraian_barang']; ?>"><?php echo ucfirst($data_item['uraian_barang']); ?></option>
                    <?php  } ?>
                  </select>
              </div>
            </div>
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Input Uraian Barang/Jas </label>
              <div class="controls">                
                <input type="text" class="span5" name="uraian"  placeholder="Input Satuan Pesanan" />
              </div>
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
      </form>      
    </div>    
  </div> 
</div>

</div></div>


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