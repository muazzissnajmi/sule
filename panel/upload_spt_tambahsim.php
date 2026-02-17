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
  
  <center><br><br><br><img src="../img/loading_upload.gif" width="20%"></center>

  <?php
include "../koneksi/koneksi.php";
//session_start();

//ini_set('upload_max_filesize', '10M');
//ini_set('post_max_size', '10M');
//ini_set('max_input_time', 600);
//ini_set('max_execution_time', 600);

$no_spt = addslashes($_POST['no_spt']);
$nip = addslashes($_POST['nip']);
foreach ($_POST['kategori'] as $i => $kategori) {

    //echo $nip =$_POST['nip'][$i];
    $kegiatan_ket =$_POST['kegiatan_ket'][$i];
    //echo $no_spt = $_POST['no_spt'][$i];
    //$tgl = date('d-m-Y h:i');

    
    $img      = $_FILES['kegiatan']['tmp_name'][$i];
    $imgType  = $_FILES['kegiatan']['type'][$i];
    $imgName  = rand(1,99) . $_FILES['kegiatan']['name'][$i];

    $namafolder="../img/kegiatan/";   
    $newName  = $namafolder . $imgName;
        

        
        if (!$img==""){
        $buat_foto = $imgName;
        $d = 'img/';
        @unlink ("$d");
        copy ($img,$newName);
        }else{
           $buat_foto;
        }
        

        mysqli_query($koneksi, "INSERT INTO dokumen VALUES (NULL,'$no_spt','$nip','$buat_foto','$kegiatan_ket','$kategori')");
        //echo "<script type='text/javascript'> document.location = '?page=upfspt&msg=1'; </script>";    
    
    }

?>
<meta http-equiv="refresh" content="10;url=?page=upfspt&msg=1">

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