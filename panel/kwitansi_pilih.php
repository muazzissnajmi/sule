<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";

$sql_cek = "SELECT * FROM spt WHERE cek_spt='Y'";
$tampil_cek = mysqli_query($koneksi, $sql_cek);     
$data_cek = mysqli_fetch_array($tampil_cek);

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
<link rel="stylesheet" href="../css/bootstrap-wysihtml5.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=kwitansi" class="tip-bottom">Kwitansi</a> <a href="#" class="current">Tambah Kwitansi</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>Tambah Kwitansi</h3>
  <div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Pilih Nomor SPT</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal" action="?page=kwpr" name="" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Pilih No SPT</label>
              <div class="controls">
                
                

                 
               <select name="id_spt" class="select2-ignore " style="width:300px" required>    
                  <option value="">...</option>                
                  <?php
                    $sql = "SELECT * FROM spt WHERE cek_spt='O' ORDER BY id_spt ASC";
                    $tampil = mysqli_query($koneksi, $sql);     
                    while ($data = mysqli_fetch_array($tampil)) {
                      
                  ?> 
                    <option value="<?php echo $data['id_spt']; ?>"><?php echo ucfirst($data['id_spt']); ?> (100.3.5/SPT/<?php echo ucfirst($data['no_spt']); ?>/<?php echo date('Y', strtotime($data['tgl_spt'])); ?>)</option>
                  <?php  } ?>
                </select>

              </div>
            </div>            
            <div class="row-fluid">
              <div class="form-actions">
              <center>
                <button type="submit" class="btn btn-success">Next</button>
                <a href="?page=kwitansi" type="reset" class="btn btn-danger">Cancel</a>
              </center>
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
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 

<script src="../js/matrix.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script>
  $('.textarea_editor').wysihtml5();
</script>
<script>
$('.select2-ignore').select2({
  placeholder: "Cari Nomor SPT",
  width: '40%'
});

$(document).ready(function () {
  $('.select2').select2({
    placeholder: "Cari Nomor SPT...",
    allowClear: true,
    width: 'resolve'
  });
});
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