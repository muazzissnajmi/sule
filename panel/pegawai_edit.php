<?php include 'session.php' ?>
<?php $page = 'pegawai'; ?>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=pegawai" class="tip-bottom">ASN</a>  <a href="#" class="current"> Edit Data ASN</a></div>
  
</div>

<?php

include "../koneksi/koneksi.php";

$sql = "SELECT * FROM pegawai WHERE nip = '$_GET[id]'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
?>

<div class="container-fluid">
<form class="form-horizontal" method="post" action="?page=pegawai_edsim" name="" enctype="multipart/form-data">
    <h3>Edit Data ASN</h3>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Data ASN</h5>
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
                <input type="number" class="span11" name="" placeholder="N I P" value="<?php echo $data['nip']; ?>" disabled/>                
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama :</label>
              <div class="controls">
                <input type="text" class="span11" name="nama" placeholder="Nama" value="<?php echo $data['nama']; ?>" required />
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Pangkat/Gol. :</label>
              <div class="controls">
                <select name="pangkat">
                  <option <?php if ($data['golongan'] == '') { echo "selected"; } ?> value="">...</option>
                  <option <?php if ($data['golongan'] == 'I/a') { echo "selected"; } ?> value="Juru Muda">Juru Muda (I/a)</option>
                  <option <?php if ($data['golongan'] == 'I/b') { echo "selected"; } ?> value="Juru Muda Tk. I">Juru Muda Tk. I (I/b)</option>
                  <option <?php if ($data['golongan'] == 'I/c') { echo "selected"; } ?> value="Juru">Juru (I/c)</option>
                  <option <?php if ($data['golongan'] == 'I/d') { echo "selected"; } ?> value="Juru Tk. I">Juru Tk. I (I/d)</option>
                  <option <?php if ($data['golongan'] == 'II/a') { echo "selected"; } ?> value="Pengatur Muda">Pengatur Muda (II/a)</option>
                  <option <?php if ($data['golongan'] == 'II/b') { echo "selected"; } ?> value="Pengatur Muda Tk. I">Pengatur Muda Tk. I (II/b)</option>
                  <option <?php if ($data['golongan'] == 'II/c') { echo "selected"; } ?> value="Pengatur">Pengatur (II/c)</option>
                  <option <?php if ($data['golongan'] == 'II/d') { echo "selected"; } ?> value="Pengatur TK.I">Pengatur TK.I (II/d)</option>
                  <option <?php if ($data['golongan'] == 'III/a') { echo "selected"; } ?> value="Penata Muda">Penata Muda (III/a)</option>
                  <option <?php if ($data['golongan'] == 'III/b') { echo "selected"; } ?> value="Penata Muda Tk. I">Penata Muda Tk. I (III/b)</option>
                  <option <?php if ($data['golongan'] == 'III/c') { echo "selected"; } ?> value="Penata">Penata (III/c)</option>
                  <option <?php if ($data['golongan'] == 'III/d') { echo "selected"; } ?> value="Penata Tk.I">Penata Tk.I (III/d)</option>
                  <option <?php if ($data['golongan'] == 'IV/a') { echo "selected"; } ?> value="Pembina">Pembina (IV/a)</option>
                  <option <?php if ($data['golongan'] == 'IV/b') { echo "selected"; } ?> value="Pembina Tk. I">Pembina Tk. I (IV/b)</option>
                  <option <?php if ($data['golongan'] == 'IV/c') { echo "selected"; } ?> value="Pembina Utama Muda">Pembina Utama Muda (IV/c)</option>
                  <option <?php if ($data['golongan'] == 'IV/d') { echo "selected"; } ?> value="Pembina Utama Madya">Pembina Utama Madya (IV/d)</option>
                </select>
              </div>
            </div>
            <!--<div class="control-group">
              <label class="control-label">Pangkat :</label>
              <div class="controls">
                <input type="text" class="span11" name="pangkat" value="<?php echo $data['pangkat']; ?>" placeholder="Pangkat" />
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Jabatan :</label>
              <div class="controls">
                <input type="text" class="span11" name="jabatan" value="<?php echo $data['jabatan']; ?>" placeholder="Jabatan" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No SK :</label>
              <div class="controls">
                <input type="text" class="span11" name="no_sk" value="<?php echo $data['no_sk']; ?>" placeholder="No SK" />
              </div>
            </div>           
            <div class="control-group">
              <label class="control-label">Tgl SK :</label>
              <div class="controls">
                <div class="control-group span3">
                  <input type="text" data-date="01-02-2013" name="tgl_sk" value="<?php echo $data['tgl_sk']; ?>" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" class="datepicker span11">
                <span class="help-block">Format Tanggal (Hari-Bulan-Tahun)</span> </div>
              </div>
            </div>
        </div>
      </div>
      
    </div>
    
  </div>
  <div class="row-fluid">
   <div class="form-actions">
    <center>
              <button type="submit" class="btn btn-success">Update</button>
              <!--<button type="reset" class="btn btn-primary">Reset</button>
              <button type="submit" class="btn btn-info">Edit</button>-->
              <a href="?page=pegawai" class="btn btn-danger">Cancel</a>
              </center>
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