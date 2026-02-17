<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";

$spt = addslashes($_GET['id']);

$sql = "SELECT * FROM spt WHERE no_spt='$spt'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);

$id_spt = $data['id_spt'];
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=upfspt" class="tip-bottom">Upload Perjalanan</a> <a href="#" class="current">View File Perjalanan</a></div>
  
</div>
<div class="container-fluid">
  <h4>File Perjalanan Dinas Peg. 800/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?></h4>
    <div class="row-fluid">
      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>File Berhasil DiHapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data ASN! Nama tersebut telah digunakan di SPT</div>       
            <?php } ?>

      <?php
                                      
        $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt'";
        $tampil_ = mysqli_query($koneksi, $sql_);            

        while($data_ = mysqli_fetch_array($tampil_)){
                              
                    
        ?>

    <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-picture"></i> </span>
            <h5><?php echo ucfirst($data_['nama']); ?> </h5>
        </div>
        <div class="widget-content nopadding">
          <form method="post" class="form-horizontal" action="?page=upfts" name="" enctype="multipart/form-data">

            <?php 
                  $sql_kgv = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='kegiatan' AND nip='$data_[nip]' ";
                  $tampil_kgv = mysqli_query($koneksi, $sql_kgv);
                  $data_kgv = mysqli_fetch_array($tampil_kgv);
                  
                  if($data_kgv['kategori'] == ''){}else{
            ?>
            <div class="control-group">
              <label class="control-label">Kegiatan </label>
              <div class="controls">
                
                <?php
                  $sql_kg = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='kegiatan' AND nip='$data_[nip]' ";
                  $tampil_kg = mysqli_query($koneksi, $sql_kg);   
                  while ($data_kg = mysqli_fetch_array($tampil_kg)) {                       
                ?>
                <table border="0" class="span2">
                <tr>
                  <td><?php $pdf = strtolower(substr($data_kg['nama_file'],-4)); 
                        if ($pdf == ".pdf") {
                           echo "<a href='../img/kegiatan/".$data_kg['nama_file']."'><img src='../img/icon_pdf.png' width='100px'?></a>";
                         }else{ ?>
                    <a href="../img/kegiatan/<?php echo $data_kg['nama_file']; ?>" onclick="basicPopup(this.href);return false"><img src="../img/kegiatan/<?php echo $data_kg['nama_file']; ?>" width="150px" height="150px" alt=""></a> <?php }?>
                  </td>
                </tr>
                <tr>
                    <td height="25px"><center><span class="badge badge-info tip-bottom" data-original-title="<?php echo $data_kg['ket_dok']; ?>"><span class="icon-info-sign" ></span> Info</span>

                  <?php $type=$_SESSION['role'] ?>
                  <?php if($type=='Administrator'){ ?>

                    <a href="?page=upfd&id=<?php echo $data_kg['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_kg['nama_file']; ?>"><span class="icon-trash" ></span></span></a>

                  <?php } if($type=='MembersFull'){ ?>

                    <a href="?page=upfd&id=<?php echo $data_kg['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_kg['nama_file']; ?>"><span class="icon-trash" ></span></span></a>

                  <?php } if($type=='MembersView1'){ ?>

                    <?php 
                    
                    $username = $_SESSION['username'];
                    $sql_user = "SELECT * FROM users INNER JOIN pegawai ON users.nip=pegawai.nip WHERE username = '$username' ORDER BY username ASC";
                    $tampil_user = mysqli_query($koneksi, $sql_user );
                    $data_user  = mysqli_fetch_array($tampil_user );
                    
                    $sql_pengikut = "SELECT * FROM pengikut WHERE pengikut = '$data_user[nip]' AND no_spt = '$id_spt'";
                    $tampil_pengikut = mysqli_query($koneksi, $sql_pengikut);     
                    $data_pengikut = mysqli_fetch_array($tampil_pengikut);
                    
                    if ($data_user['nip'] == $data_pengikut['pengikut']) {?>
                      <a href="?page=upfd&id=<?php echo $data_kg['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_kg['nama_file']; ?>"><span class="icon-trash" ></span></span></a>
                    <?php }else{}
                    ?>


                  <?php }?>
                  </center></td>
                </tr>
                </table>
              <?php }?>
              </div>
            </div>
            <?php }?>

            <?php 
                $sql_tiketv = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='tiket' AND nip='$data_[nip]' ";
                $tampil_tiketv = mysqli_query($koneksi, $sql_tiketv);
                $data_tiketv = mysqli_fetch_array($tampil_tiketv);
                  
                  if($data_tiketv['kategori'] == ''){}else{
            ?>
            <div class="control-group">
              <label class="control-label">Tiket Perjalanan</label>
              <div class="controls">

              <?php 
                $sql_tiket = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='tiket' AND nip='$data_[nip]' ";
                $tampil_tiket = mysqli_query($koneksi, $sql_tiket);
                while ($data_tiket = mysqli_fetch_array($tampil_tiket)) {                       
              ?>
               <table border="0" class="span2">
                <tr>
                  <td><?php $pdf = strtolower(substr($data_tiket['nama_file'],-4)); 
                        if ($pdf == ".pdf") {
                           echo "<a href='../img/kegiatan/".$data_tiket['nama_file']."'><img src='../img/icon_pdf.png' width='100px'?></a>";
                         }else{ ?>
                    <a href="../img/kegiatan/<?php echo $data_tiket['nama_file']; ?>" onclick="basicPopup(this.href);return false"><img src="../img/kegiatan/<?php echo $data_tiket['nama_file']; ?>" width="150px" height="150px" alt=""></a> <?php }?>
                  </td>
                </tr>
                <tr>
                    <td height="25px"><center><span class="badge badge-info tip-bottom" data-original-title="<?php echo $data_tiket['ket_dok']; ?>"><span class="icon-info-sign" ></span> Info</span>
                    <a href="?page=upfd&id=<?php echo $data_tiket['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_tiket['nama_file']; ?>"><span class="icon-trash" ></span></span></a>
                  </center></td>
                </tr>
                </table>
              <?php }?>
              </div>
            </div>
            <?php }?>

            <?php 
                $sql_boardingv = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='boarding' AND nip='$data_[nip]' ";
                $tampil_boardingv = mysqli_query($koneksi, $sql_boardingv);
                $data_boardingv = mysqli_fetch_array($tampil_boardingv);
                  
                  if($data_boardingv['kategori'] == ''){}else{
            ?>
            <div class="control-group">
              <label class="control-label">Boarding Pass</label>
              <div class="controls">

              <?php 
                $sql_boarding = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='boarding' AND nip='$data_[nip]' ";
                $tampil_boarding = mysqli_query($koneksi, $sql_boarding);
                while ($data_boarding = mysqli_fetch_array($tampil_boarding)) {                       
              ?>
               <table border="0" class="span2">
                <tr>
                  <td><?php $pdf = strtolower(substr($data_boarding['nama_file'],-4)); 
                        if ($pdf == ".pdf") {
                           echo "<a href='../img/kegiatan/".$data_boarding['nama_file']."'><img src='../img/icon_pdf.png' width='100px'?></a>";
                         }else{ ?>
                    <a href="../img/kegiatan/<?php echo $data_boarding['nama_file']; ?>" onclick="basicPopup(this.href);return false"><img src="../img/kegiatan/<?php echo $data_boarding['nama_file']; ?>" width="150px" height="150px" alt=""></a> <?php }?>
                  </td>
                </tr>
                <tr>
                    <td height="25px"><center><span class="badge badge-info tip-bottom" data-original-title="<?php echo $data_boarding['ket_dok']; ?>"><span class="icon-info-sign" ></span> Info</span>
                    <a href="?page=upfd&id=<?php echo $data_boarding['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_boarding['nama_file']; ?>"><span class="icon-trash" ></span></span></a>
                  </center></td>
                </tr>
                </table>
              <?php }?>
              </div>
            </div>
            <?php }?>

            <?php 
                
                $sql_bilv = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='bill' AND nip='$data_[nip]' ";
                $tampil_bilv = mysqli_query($koneksi, $sql_bilv);
                $data_bilv = mysqli_fetch_array($tampil_bilv);
                  
                  if($data_bilv['kategori'] == ''){}else{
            ?>
            <div class="control-group">
              <label class="control-label">Bill Hotel</label>
              <div class="controls">

              <?php 
                $sql_bil = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='bill' AND nip='$data_[nip]' ";
                $tampil_bil = mysqli_query($koneksi, $sql_bil);
                while ($data_bil = mysqli_fetch_array($tampil_bil)) {                       
              ?>
                <table border="0" class="span2">
                <tr>
                  <td><?php $pdf = strtolower(substr($data_bil['nama_file'],-4)); 
                        if ($pdf == ".pdf") {
                           echo "<a href='../img/kegiatan/".$data_bil['nama_file']."'><img src='../img/icon_pdf.png' width='100px'?></a>";
                         }else{ ?>
                    <a href="../img/kegiatan/<?php echo $data_bil['nama_file']; ?>" onclick="basicPopup(this.href);return false"><img src="../img/kegiatan/<?php echo $data_bil['nama_file']; ?>" width="150px" height="150px" alt=""></a> <?php }?>
                  </td>
                </tr>
                <tr>
                    <td height="25px"><center><span class="badge badge-info tip-bottom" data-original-title="<?php echo $data_bil['ket_dok']; ?>"><span class="icon-info-sign" ></span> Info</span>
                    <a href="?page=upfd&id=<?php echo $data_bil['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_bil['nama_file']; ?>"><span class="icon-trash" ></span></span></a>
                  </center></td>
                </tr>
                </table>
              <?php }?>
              </div>
            </div>
            <?php }?>


            <?php 

                $sql_lpdv = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='lpd' AND nip='$data_[nip]' ";
                $tampil_lpdv = mysqli_query($koneksi, $sql_lpdv);
                $data_lpdv = mysqli_fetch_array($tampil_lpdv);
                  
                  if($data_lpdv['kategori'] == ''){}else{
            ?>
            <div class="control-group">
              <label class="control-label">LPD</label>
              <div class="controls">

              <?php 
                $sql_lpd = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='lpd' AND nip='$data_[nip]' ";
                $tampil_lpd = mysqli_query($koneksi, $sql_lpd);
                while ($data_lpd = mysqli_fetch_array($tampil_lpd)) {                       
              ?>
                <table border="0" class="span2">
                <tr>
                  <td><?php $pdf = strtolower(substr($data_lpd['nama_file'],-4)); 
                        if ($pdf == ".pdf") {
                           echo "<a href='../img/kegiatan/".$data_lpd['nama_file']."'><img src='../img/icon_pdf.png' width='100px'?></a>";
                         }else{ ?>
                    <a href="../img/kegiatan/<?php echo $data_lpd['nama_file']; ?>" onclick="basicPopup(this.href);return false"><img src="../img/kegiatan/<?php echo $data_lpd['nama_file']; ?>" width="150px" height="150px" alt=""></a><?php }?>
                  </td>
                </tr>
                <tr>
                    <td height="25px"><center><span class="badge badge-info tip-bottom" data-original-title="<?php echo $data_lpd['ket_dok']; ?>"><span class="icon-info-sign" ></span> Info</span>
                    <a href="?page=upfd&id=<?php echo $data_lpd['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_lpd['nama_file']; ?>"><span class="icon-trash" ></span></span></a>
                  </center></td>
                </tr>
                </table>
              <?php }?>
              </div>
            </div>
            <?php }?>


            <?php 
                             
                $sql_lainv = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='lain' AND nip='$data_[nip]' ";
                $tampil_lainv = mysqli_query($koneksi, $sql_lainv);
                $tampil_lainv = mysqli_fetch_array($tampil_lainv);
                  
                  if($tampil_lainv['kategori'] == ''){}else{
            ?>
            <div class="control-group">
              <label class="control-label">Lain-lain</label>
              <div class="controls">

              <?php 
                $sql_lain = "SELECT * FROM dokumen WHERE id_spt='$spt' AND kategori='lain' AND nip='$data_[nip]' ";
                $tampil_lain = mysqli_query($koneksi, $sql_lain);
                while ($data_lain = mysqli_fetch_array($tampil_lain)) {                       
              ?>
                <table border="0" class="span2">
                <tr>
                  <td><?php $pdf = strtolower(substr($data_lain['nama_file'],-4)); 
                        if ($pdf == ".pdf") {
                           echo "<a href='../img/kegiatan/".$data_lain['nama_file']."'><img src='../img/icon_pdf.png' width='100px'?></a>";
                         }else{ ?>
                    <a href="../img/kegiatan/<?php echo $data_lain['nama_file']; ?>" onclick="basicPopup(this.href);return false"><img src="../img/kegiatan/<?php echo $data_lain['nama_file']; ?>" width="150px" height="150px" alt=""></a> <?php }?>
                </tr>
                <tr>
                    <td height="25px"><center><span class="badge badge-info tip-bottom" data-original-title="<?php echo $data_lain['ket_dok']; ?>"><span class="icon-info-sign" ></span> Info</span>
                    <a href="?page=upfd&id=<?php echo $data_lain['id_dokumen']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete file <?php echo $data_lain['nama_file']; ?>"><span class="icon-trash" ></span></span></a>
                  </center></td>
                </tr>
                </table>
              <?php }?>
              </div>
            </div>
            <?php }?>

            
          </form>
        </div>
      </div>
    <?php }?>
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

<script>
// JavaScript popup window function
  function basicPopup(url) {
popupWindow = window.open(url,'popUpWindow','height=300,width=700,left=50,top=50,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')
  }

</script>