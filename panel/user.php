<?php include 'session.php' ?>
<?php $page = 'pegawai'; 

/* konversi NIP */
function konversi_nip($nipk, $batas = " ") {
    $nipk = trim($nipk," ");
    $panjang = strlen($nipk);
     
    if($panjang == 18) {
        $sub[] = substr($nipk, 0, 8); // tanggal lahir
        $sub[] = substr($nipk, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nipk, 14, 1); // jenis kelamin
        $sub[] = substr($nipk, 15, 3); // nomor urut
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2].$batas.$sub[3];
    
    } else {
        return $nipk;
    }
}
?>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pengguna</a></div>
  
</div>
  <div class="container-fluid">
    <h3>DATA PENGGUNA</h3>
    <right><a href="?page=usern" class="btn btn-success btn-mini"><span class="icon-plus"></span> Tambah Pengguna</a></right>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pengguna Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data ASN!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data ASN! Nama tersebut telah digunakan di SPT</div>       
            <?php } else if ($msg == 4) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pengguna Berhasil Di Aktifkan!</div>    
            <?php } else if ($msg == 5) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pengguna Berhasil Di Nonaktifkan!</div>    
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Pengguna</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Nama</th>
                  <th>Pangkat/Gol.</th>
                  <th>Jabatan</th>
                  <th>Hak Akses</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM users INNER JOIN pegawai ON users.nip=pegawai.nip ORDER BY id_pegawai DESC";
                  $tampil = mysqli_query($koneksi, $sql);
                  $username = $_SESSION['username'];
                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 

                ?>
                <tr>
                  <td class="span2"><center><strong><a href="?page=pv&id=<?php echo $data['nip']; ?>"><span class="badge badge-info"><?php echo $data['username']; ?></span></a></strong></center></td>
                  <td class="span2"><strong><?php echo ucfirst($data['nama']); ?></strong></td>
                  <td class="span2"><center>
                    <?php if ($data['pangkat'] == '') { echo "<center>-</center>"; }else{?>
                    <?php echo $data['pangkat']; ?><br><?php echo $data['golongan']; }?></center></td>
                  <td class="span3"><center><?php echo ucfirst($data['jabatan']); ?></center></td>
                  <td class="span2"><center>
                    <?php if ($data['role'] == 'MembersFull') {
                        echo 'Admin';
                      }elseif ($data['role'] == 'Members1') {
                        echo 'User 1';
                      }elseif ($data['role'] == 'Members2') {
                        echo 'User 2';
                      }elseif ($data['role'] == 'Members3') {
                        echo 'User 3';
                      }elseif ($data['role'] == 'MembersView1') {
                        echo 'User View 1';
                      } ?></center></td>
                  <td class="span2"><center>
                    <form role="form" method="post" action="?page=userc" enctype="multipart/form-data">
                      <input type="hidden" name="username" value="<?php echo $data['username']; ?>">
                    <label><?php if ($username == $data['username']) { ?>
                      <span class="badge" data-original-title="Pengguna Aktif, Klik untuk Non Aktifkan"><input type="checkbox" name="ceklist" value="N" onchange='this.form.submit()' onclick="return" checked disabled /> <font color="cccccc"> Aktif</font></span>
                    <?php }elseif ($data['aktif'] == 'Y') { ?>
                      <span class="badge badge-success tip-bottom" data-original-title="Pengguna Aktif, Klik untuk Non Aktifkan"><input type="checkbox" name="ceklist" value="N" onchange='this.form.submit()' onclick="return" checked /> Aktif</span>
                    <?php } elseif ($data['aktif'] == 'N') {?>
                      <span class="badge badge-important tip-bottom" data-original-title="Pengguna Non Aktif, Klik untuk Mengaktifkan"><input type="checkbox" name="ceklist" value="Y" onchange='this.form.submit()' onclick="return"/> Non Aktif</span>
                    <?php } ?>                    
                  </form>
                  <?php if ($username == $data['username']) { ?>
                    <span class="badge tip-bottom" data-original-title="Reset Password"><span class="icon-magic"></span><span>
                  <?php }else{?>
                  <a href="?page=rpas&id=<?php echo $data['nip']; ?>" onclick="return confirm('Tekan Oke untuk mereset password pengguna atas nama <?php echo $data['nama']; ?>?')"><span class="badge badge-info tip-bottom" data-original-title="Reset Password"><span class="icon-magic"></span><span></a>
                  <?php } ?>
                  <?php $type=$_SESSION['role'] ?>
                  <?php if($type=='Administrator'){ ?>
                    <a href="?page=ph&id=<?php echo $data['nip']; ?>" onclick="return confirm('Yakin Ingin Menghapus NIP <?php echo $data['nip']; ?> atas nama <?php echo $data['nama']; ?>?')"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a>
                  <?php } ?>
                  </td></center>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>

