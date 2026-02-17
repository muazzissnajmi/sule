<?php $page = 'pegawai'; 

function rupiah($angka){
  
$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
return $hasil_rupiah;
 }

//echo rupiah(1000000);

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Kwitansi</a></div>
  
</div>
  <div class="container-fluid">
    <h3>KWITANSI</h3>
    <!-- <right><a href="?page=kwe" class="btn btn-success btn-mini"><span class="icon-plus"></span> Tambah Kwitansi</a></right>-->
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Kwitansi Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data Kwitansi!</div>       
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Kwitansi</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Tahun</th>
                  <th>Dalam kota</th>
                  <th>Luar Kota</th>
                  <th>Luar Negeri</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM pagu ORDER BY tahun DESC";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 
                    $no_spt = $data['no_spt'];
                    
                ?>
                <tr>
                  <td class="span2"><center><?php echo $data['tahun']; ?></center></td>
                  <td class="span2"><center><?php echo rupiah($data['pagu_dk_awal']); ?>,-</center></td>
                  <td class="span2"><center><?php echo rupiah($data['pagu_lk_awal']); ?>,-</center></td>
                  <td class="span2"><center><?php echo rupiah($data['pagu_ln_awal']); ?>,-</center></td>
                  <td class="span2"><center>                    
                    <a href="?page=spe&id=<?php echo $data['no_spd']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
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

