<?php include 'session.php' ?>
<?php $page = 'pegawai'; 

include "../koneksi/koneksi.php";

$sql = "SELECT * FROM pagu WHERE tahun = '$_GET[id]'";
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=pagu" class="tip-bottom">ASN</a>  <a href="#" class="current"> Edit Pagu Tahun <?php echo $data['tahun']; ?></a></div>
  
</div>



<div class="container-fluid">
<form class="form-horizontal" method="post" action="?page=pges" name="" enctype="multipart/form-data">
    <h3>Edit Pagu Tahun <?php echo $data['tahun']; ?></h3>
    <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pagu Berhasil Diubah!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Mengubah Data Pagu!</div>       
            <?php } ?>

  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">       

        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Pagu KDH/WKDH Tahun <?php echo $data['tahun']; ?></h5>
        </div>         
         
        <div class="widget-content nopadding form-horizontal">
            <input type="hidden" class="span11" name="tahun" id="nip" placeholder="N I P" value="<?php echo $data['tahun']; ?>" />
            <div class="control-group">
              <label class="control-label">Dalam Daerah :</label>
              <div class="controls">
                <input type="text" class="span11" name="dalam_kota_kdh" placeholder="Pagu KDH/WKDH Dalam Daerah" value="<?php echo $data['pagu_dk_kdh_awal']; ?>" required />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Luar Daerah :</label>
              <div class="controls">
                <input type="text" class="span11" name="luar_kota_kdh" placeholder="Pagu KDH/WKDH Luar Daerah" value="<?php echo $data['pagu_lk_kdh_awal']; ?>" required />
              </div>
            </div> 
            
        </div>
      </div>

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Pagu Setdakab Tahun <?php echo $data['tahun']; ?></h5>
        </div>          
        <div class="widget-content nopadding form-horizontal">            
            <div class="control-group">
              <label class="control-label">Dalam Daerah :</label>
              <div class="controls">
                <input type="text" class="span11" name="dalam_kota" placeholder="Pagu Setdakab Dalam Daerah" value="<?php echo $data['pagu_dk_awal']; ?>" required />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Luar Daerah :</label>
              <div class="controls">
                <input type="text" class="span11" name="luar_kota" placeholder="Pagu Setdakab Luar Daerah" value="<?php echo $data['pagu_lk_awal']; ?>" required />
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
                <a href="?page=pagu" class="btn btn-danger">Cancel</a>
              </center>
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