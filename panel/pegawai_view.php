<?php include 'session.php' ?>
<?php $page = 'pegawai'; ?>

<?php

include "../koneksi/koneksi.php";

$sql = "SELECT * FROM pegawai WHERE nip = '$_GET[id]'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=pegawai" class="tip-bottom">ASN</a>  <a href="#" class="current"> Data ASN <?php echo ucfirst($data['nama']); ?></a></div>
  
</div>

<div class="container-fluid">
<form class="form-horizontal" method="post" action="?page=pegawai_edsim" name="" enctype="multipart/form-data">
    <h3>Data ASN</h3>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Data ASN <?php echo ucfirst($data['nama']); ?></h5>
        </div>
          <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil DiUbah!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Mengubah Data Pegawai!</div>       
            <?php } ?>
         
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">N I P :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="nip" id="nip" placeholder="N I P" value="<?php echo $data['nip']; ?>" />
                <input type="text" class="span11" placeholder="N I P" min="99999999999999999" value="<?php echo $data['nip']; ?>" disabled />
                <span class="help-block">NIP adalah id permanent ASN tidak bisa dirubah jika salah</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama :</label>
              <div class="controls">
                <input type="text" class="span11" name="nama" placeholder="Nama" value="<?php echo ucfirst($data['nama']); ?>" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pangkat :</label>
              <div class="controls">
                <input type="text" class="span11" name="nama" placeholder="Nama" value="<?php echo $data['golongan']; ?>" disabled />
              </div>
            </div>             
            <div class="control-group">
              <label class="control-label">Pangkat :</label>
              <div class="controls">
                <input type="text" class="span11" name="pangkat" value="<?php echo $data['pangkat']; ?>" placeholder="Pangkat" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Jabatan :</label>
              <div class="controls">
                <input type="text" class="span11" name="jabatan" value="<?php echo $data['jabatan']; ?>" placeholder="Jabatan" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No SK :</label>
              <div class="controls">
                <input type="text" class="span11" name="no_sk" value="<?php echo $data['no_sk']; ?>" placeholder="No SK" disabled />
              </div>
            </div>           
            <div class="control-group">
              <label class="control-label">Tgl SK :</label>
              <div class="controls">
                <div class="control-group span3">
                  <input type="text" data-date="01-02-2013" name="tgl_sk" value="<?php echo $data['tgl_sk']; ?>" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" class="datepicker span11" disabled>
                <span class="help-block">Format Tanggal (Hari-Bulan-Tahun)</span> </div>
              </div>
            </div>
        </div>
      </div>
      
    </div>
    
  </div>
  
 </form>
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