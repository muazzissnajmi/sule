<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";?>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=sppd" class="tip-bottom">SPPD</a> <a href="#" class="current">Template SPPD</a></div>
  
</div>
<div class="container-fluid">
  
<h3>Template SPPD</h3> 
  <a href="?page=sppdttn" class="btn btn-success btn-mini"><span class="icon-plus"></span> Tambah Nama TTD Template</a>
  <div class="row-fluid">
    <div class="span12">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Nama TTD SPPD</h5>
        </div>
        <form class="form-horizontal" method="post" action="sppd_print_template2.php" target="_blank" name="" enctype="multipart/form-data">
        
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nama Pejabat Kota 1</label>
              <div class="controls">
                <select name="nama1"class="span11"> 
                  <option>...</option>
                  <?php
                  $sql = "SELECT * FROM sppd_template";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_nama_pejabat']; ?>"><?php echo ucfirst($data['nama_pejabat'])." (Nip. ".$data['nip']." - ".$data['jabatan']." - ".$data['pangkat']." ".$data['gol']." )"; ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Pejabat Kota 2</label>
              <div class="controls">
                <select name="nama2"class="span11"> 
                  <option>...</option>
                  <?php
                  $sql = "SELECT * FROM sppd_template";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_nama_pejabat']; ?>"><?php echo ucfirst($data['nama_pejabat'])." (Nip. ".$data['nip']." - ".$data['jabatan']." - ".$data['pangkat']." ".$data['gol']." )"; ?></option>
              <?php  } ?>
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Nama Pejabat Kota 3</label>
              <div class="controls">
                <select name="nama3"class="span11"> 
                  <option>...</option>
                  <?php
                  $sql = "SELECT * FROM sppd_template";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
               <option value="<?php echo $data['id_nama_pejabat']; ?>"><?php echo ucfirst($data['nama_pejabat'])." (Nip. ".$data['nip']." - ".$data['jabatan']." - ".$data['pangkat']." ".$data['gol']." )"; ?></option>
              <?php  } ?>
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Nama Pejabat Kota 4</label>
              <div class="controls">
                <select name="nama4"class="span11"> 
                  <option>...</option>
                  <?php
                  $sql = "SELECT * FROM sppd_template";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_nama_pejabat']; ?>"><?php echo ucfirst($data['nama_pejabat'])." (Nip. ".$data['nip']." - ".$data['jabatan']." - ".$data['pangkat']." ".$data['gol']." )"; ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">TTD Pejabat Berwenang :</label>
              <div class="controls">
                <select name="ttd_pejabat_berwenang"class="span11" required> 
                <option>...</option>
                  <?php
                  $sql = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult='Y' ORDER BY id_ttd_pejabat ASC";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_ttd_pejabat']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">TTD U.B :</label>
              <div class="controls">
                <select name="ttd_ub"class="span11">   
                  <option value="">...</option>                
                  <?php
                    $sql_ttd = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    while ($data_ttd = mysqli_fetch_array($tampil_ttd)) {
                  ?>    
                <option value="<?php echo $data_ttd['id_ttd']; ?>"><?php echo ucfirst($data_ttd['nama']); ?> (<?php echo ucfirst($data_ttd['jabatan']); ?>)</option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="row-fluid">
             <div class="form-actions">
              <center>
                        <button type="submit" class="btn btn-success">Print</button>
                        <!--<button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-info">Edit</button>-->
                        <a href="?page=sppd" class="btn btn-danger">Cancel</a>
                        </center>
              </div>
            </div>        
      </div>
      </form>      
    </div>    
  </div> 
</div>

</div>
</div>


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