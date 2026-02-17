<?php 
include 'session.php' ;
include "../koneksi/koneksi.php";

$id_spt = addslashes($_POST['id_spt']);
$tahun = date('Y');
$pengikut = $_POST['pengikut'];

$sql = "SELECT * FROM kwitansi WHERE id_spt = '$id_spt'";
$tampil = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($tampil);
$id_sptkw = $data['id_spt'];

// ambil halaman sebelumnya
$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$isPinjaman = (strpos($referer, 'page=kwp_pinjaman') !== false || strpos($referer, 'page=kwt_pinjaman') !== false);

if ($id_spt == $id_sptkw) {
    // redirect tergantung halaman sebelumnya
    if ($isPinjaman) {
        echo '<meta http-equiv="refresh" content="1;url=?page=kwt_pinjaman&id='.$id_spt.'">';
    } else {
        echo '<meta http-equiv="refresh" content="1;url=?page=kwt&id='.$id_spt.'">';
    }
} else {
    $sql2_ = "SELECT * FROM pegawai INNER JOIN pengikut ON pegawai.nip=pengikut.pengikut WHERE no_spt='$id_spt'";
    $tampil2_ = mysqli_query($koneksi, $sql2_);     
    while ($data2_ = mysqli_fetch_array($tampil2_)){
        $pengikut[] = $data2_['pengikut'];                   
    }

    foreach ($pengikut as $ikut) {
        $sql_kw = mysqli_query($koneksi, "INSERT INTO kwitansi VALUES (NULL,NULL,'$id_spt',NULL,'$ikut',NULL,NULL,NULL,'$tahun',NULL,NULL,NULL,NULL,'0','N')");
    }

    // redirect tergantung halaman sebelumnya
    if ($isPinjaman) {
        echo '<meta http-equiv="refresh" content="1;url=?page=kwt_pinjaman&id='.$id_spt.'">';
    } else {
        echo '<meta http-equiv="refresh" content="1;url=?page=kwt&id='.$id_spt.'">';
    }
}
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=kwitansi" class="tip-bottom">Kwitansi</a> <a href="#" class="current">Tambah Kwitansi</a></div>
  
</div>
<div class="container-fluid">
  
  <center><br><br><br><img src="../img/loading.gif" width="20%"></center>



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