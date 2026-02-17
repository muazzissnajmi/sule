<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";

$spt = addslashes($_POST['id_spt']);

$sql = "SELECT * FROM spt WHERE id_spt='$spt'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);

$nip = $data['berwenang'];
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=upfspt" class="tip-bottom">Upload Perjalanan</a> <a href="?page=upfp" class="tip-bottom">Pilih SPT</a> <a href="#" class="current">Upload File Perjalanan</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>Upload File Perjalanan</h3>
  <div class="row-fluid">
    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Upload File Perjalanan</h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal" action="?page=upfts" name="" enctype="multipart/form-data">

          	<div class="control-group">
              <label class="control-label">No SPT </label>
              <div class="controls">
                <input type="hidden" class="span5" name="no_spt" placeholder="No SPT" value="<?php echo $data['no_spt'];?>" readonly />
                <input type="text" class="span5" placeholder="No SPT" value="Peg. 888/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?>" readonly />
              </div>
            </div>

          	<div class="control-group">
              <label class="control-label">Nama </label>
              <div class="controls">
                <select name="nip"class="span5" required>		
          				<option value="">...</option>                
                <?php
          				$sql = "SELECT * FROM pegawai INNER JOIN pengikut ON pegawai.nip=pengikut.pengikut WHERE no_spt='$spt'";
          				$tampil = mysqli_query($koneksi, $sql);     
          				while ($data = mysqli_fetch_array($tampil)) {
          				?>		
                <option value="<?php echo $data['nip']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>

            <div class='control-group'><label class='control-label'>Upload </label><div class='controls'>
              <input id="idf<?php echo $spt; ?>" value="<?php echo $spt; ?>" type="hidden" />
              <div id="div<?php echo $spt; ?>"></div>
              <button type="button" class="btn btn-info" onclick="tambah<?php echo $spt; ?>(); return false;"><span class="icon-plus"></span> File Perjalanan</button>
              </div>
            </div>

          	<script language="javascript">
             function tambah<?php echo $spt; ?>() {
               var idf<?php echo $spt; ?> = document.getElementById("idf<?php echo $spt; ?>").value;
               var stre;
               stre="<p id='srow<?php echo $spt; ?>" + idf<?php echo $spt; ?> + "'><select name='kategori[]' class='span4'><option value='kegiatan'>Kegiatan</option><option value='bill'>Bill Hotel</option><option value='tiket'>Tiket Perjalanan</option><option value='boarding'>Boarding Pass</option><option value='lpd'>LPD</option><option value='lain'>Lain-lain</option></select> &nbsp;<a href='#' class='btn btn-mini btn-danger' onclick='hapusElemen<?php echo $spt; ?>(\"#srow<?php echo $spt; ?>" + idf<?php echo $spt; ?> + "\"); return false;'><span class='icon-trash'></span> Hapus</a><br><br><input type='file' name='kegiatan[]' accept='.pdf,.jpeg,.jpg' required/><br><textarea name='kegiatan_ket[]' class='span5' placeholder='Keterangan Kegiatan' rows='5'></textarea> <br></p>";
               $("#div<?php echo $spt; ?>").append(stre);
               idf<?php echo $spt; ?> = (idf<?php echo $spt; ?>-1) + 2;
               document.getElementById("idf<?php echo $spt; ?>").value = idf<?php echo $spt; ?>;
             }
             function hapusElemen<?php echo $spt; ?>(idf<?php echo $spt; ?>) {
               $(idf<?php echo $spt; ?>).remove();
             }
          </script>


            <div class="row-fluid">
              <div class="form-actions">
              <center>
                <button type="submit" name="kirim" class="btn btn-success">Save</button>
                <a href="?page=upfspt" type="reset" class="btn btn-danger">Cancel</a>
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
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script>
  $('.textarea_editor').wysihtml5();
</script>