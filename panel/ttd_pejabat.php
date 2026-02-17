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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tanda Tangan Pejabat Berwenang</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Tanda Tangan Pejabat Berwenang</h3>
    <right><a href="?page=ttdpt" class="btn btn-success btn-mini"><span class="icon-plus"></span> Tambah TTD</a></right>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Tanda Tangan Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data Tanda Tangan!</div> 
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Tanda Tangan Berhasil Ditambah!</div>              
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Daftar Tanda Tangan Pejabat Berwenang</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th width="150px">Tanda Tangan</th>
                  <th>Nama</th>
                  <th>Golongan</th>
                  <th>Pangkat</th>
                  <th>Ttd Utama</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip ORDER BY id_ttd_pejabat ASC";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 

                ?>
                <tr>
                  <td class="span1"><center><?php echo $no++; ?></center></td>
                  <td class="span3"><center><?php echo $data['jabatan']; ?></center></td>
                  <td class="span4"><?php echo ucfirst($data['nama']); ?><br>NIP. <?php echo konversi_nip($data['nip_pejabat']); ?></td>
                  <td class="span2"><center><?php echo $data['golongan']; ?></center></td>
                  <td class="span2"><center><?php echo $data['pangkat']; ?></center></td>
                  <td class="span2" valign="top"><center>
                      <form role="form" method="post" action="?page=ttdd" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $data['nip']; ?>">
                        <select name="defult" onchange='this.form.submit()' onclick="return  confirm('Yakin ingin mengubah?')">
                          <option value="">...</option>
                          <option value="Y" <?php if ($data['defult'] == 'Y') { echo "selected"; } ?>>Berwenang</option>
                          <option value="T" <?php if ($data['defult'] == 'T') { echo "selected"; } ?>>Bendahara</option>
                          <option value="umum" <?php if ($data['defult'] == 'umum') { echo "selected"; } ?>>Bagian Umum</option>
                        </select>
                        <!--<input type="checkbox" name="defult" value="Y"<?php if ('Y' == $data['defult']) { echo "checked"; } ?> onchange='this.form.submit()' onclick="return  confirm('Yakin ingin mengubah?')">-->
                      </form></center>
                  </td>
                  <td class="span2"><center>
                    <!--<a href="?page=pe&id=<?php echo $data['nip']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>-->
                    <a href="?page=ph&id=<?php echo $data['nip']; ?>" onclick="return confirm('Yakin Ingin Menghapus NIP <?php echo $data['nip']; ?> atas nama <?php echo $data['nama']; ?>?')"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a>
                    </center>
                  </td>
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

