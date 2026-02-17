<?php include 'session.php' ?>
<script type = "text/javascript" >
function preventBack(){window.history.forward();}
setTimeout("preventBack()", 0);
window.onunload=function(){null};
</script>
<?php
include "../koneksi/koneksi.php";

$sql = "SELECT * FROM users INNER JOIN pegawai ON users.nip=pegawai.nip ORDER BY id_pegawai DESC";
$tampil = mysqli_query($koneksi, $sql);

$data = mysqli_fetch_array($tampil);
echo $nip = $_GET[id];

$chars = "123456789AbCdEfGhiJkLMnPQrstUVWxYz";
  $res1 = '';
  for ($i = 0; $i < 6; $i++) { //jumlah kode voucher
  $res1 .= $chars[mt_rand(0, strlen($chars) - 1)];
  }

$pengacak  = "PG09381IJSLLE8302EDG";

$passwordbaruenkrip = md5($pengacak . md5($res1) . $pengacak . md5($res1) .$pengacak . md5($res1) . $pengacak);
              
$query = mysqli_query($koneksi, "UPDATE users SET password = '$passwordbaruenkrip' WHERE nip = '$nip'") or die(mysqli_error($koneksi));

?>

<script type='text/javascript' src='http://code.jquery.com/jquery-1.10.2.min.js'></script>

<script>
$(document).ready(function() {
var detik = 15;
var menit = 0;
function hitung() {
setTimeout(hitung,1000);
$('#tampilkan').html( detik );
detik --;
if(detik < 0) {
detik = 59;
menit --;
if(menit < 0) {
menit = 0;
detik = 0;
}
}
}
hitung();
});
</script>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=user" class="tip-bottom"> Pengguna</a> <a href="#" class="current"> Reset Password</a></div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">         
          <div class="widget-content">
            <div class="error_ex">              
              <h4>Password Baru Pengguna <?php echo $data['nama']; ?></h4>
              <h1><?php echo $res1; ?></h1>              
              <p>Silahkan gunakan password diatas</p>
              <p><strong>Setelah login harap segera ganti dengan password baru</strong></p>
              <br>
              <h3>Halaman akan dialihkan dalam </h3>
              <h2><font color="red"><div id='tampilkan'></div></font></h2>
              
              
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<meta http-equiv="refresh" content="16;url=?page=redir">


<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>
