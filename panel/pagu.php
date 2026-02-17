<?php include 'session.php' ?>
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pagu</a></div>
  
</div>
  <div class="container-fluid">
    <h3>P A G U</h3>
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

        <div class="row-fluid">
  <div class="span6">
  <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
            <h5>PAGU KDH/WKDH TAHUN <?php echo $tahun ?></h5>
          </div>
          <div class="widget-content">
            <ul class="unstyled">

              <?php if ($data['pagu_dk_kdh_awal'] == '0') { ?>
              <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,- </strong><span class="pull-right strong"><strong><?php echo round($persen_dk_kdh); ?>%</strong></span>
                <div class="progress progress-info active progress-striped ">
                  <div style="width: 0%;" class="bar">Dalam Daerah</div>
                </div>
              </li>
              <?php }else { ?>

                <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_($data['pagu_dk_kdh_akhir']); ?>,- / <?php echo rupiah_($data['pagu_dk_kdh_awal']); ?>,- </strong><span class="pull-right strong"><strong><?php echo round($persen_dk_kdh); ?>%</strong></span>
                <div class="progress progress-info active progress-striped ">
                  <div style="width: <?php echo $persen_dk_kdh ?>%;" class="bar">Dalam Daerah</div>
                </div>
              </li>

              <?php } ?>

              
              <?php if ($data['pagu_lk_kdh_awal'] == '0') { ?>
              <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,-</strong> <span class="pull-right strong"><strong><?php echo round($persen_lk_kdh); ?>%</strong></span>
                <div class="progress progress-warning active progress-striped ">
                  <div style="width: 0%;" class="bar">Luar Daerah</div>
                </div>
              </li>
              <?php }else { ?>

                <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_($data['pagu_lk_kdh_akhir']); ?>,- / <?php echo rupiah_($data['pagu_lk_kdh_awal']); ?>,-</strong> <span class="pull-right strong"><strong><?php echo round($persen_lk_kdh); ?>%</strong></span>
                <div class="progress progress-warning active progress-striped ">
                  <div style="width: <?php echo $persen_lk_kdh; ?>%;" class="bar">Luar Daerah</div>
                </div>
              </li>
              <?php } ?>

            </ul>
          </div>
        </div>
      </div>
    
  
    
    <div class="span6">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
            <h5>PAGU SETDAKAB TAHUN <?php echo $tahun ?></h5>
          </div>
          <div class="widget-content">
            <ul class="unstyled">

              <?php if ($data['pagu_dk_awal'] == '0') { ?>
              <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,- </strong><span class="pull-right strong"><strong><?php echo round($persen_dk); ?>%</strong></span>
                <div class="progress progress-danger active progress-striped ">
                  <div style="width: 0%;" class="bar">Dalam Daerah</div>
                </div>
              </li>
              <?php }else { ?>

                <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_($data['pagu_dk_akhir']); ?>,- / <?php echo rupiah_($data['pagu_dk_awal']); ?>,- </strong><span class="pull-right strong"><strong><?php echo round($persen_dk); ?>%</strong></span>
                <div class="progress progress-danger active progress-striped ">
                  <div style="width: <?php echo $persen_dk ?>%;" class="bar">Dalam Daerah</div>
                </div>
              </li>

              <?php } ?>

              
              <?php if ($data['pagu_lk_awal'] == '0') { ?>
              <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,-</strong> <span class="pull-right strong"><strong><?php echo round($persen_lk); ?>%</strong></span>
                <div class="progress progress-success active progress-striped ">
                  <div style="width: 0%;" class="bar">Luar Daerah</div>
                </div>
              </li>
              <?php }else { ?>

                <li> <span class="icon24 icomoon-icon-arrow-up-2 green"></span> <strong><?php echo rupiah_($data['pagu_lk_akhir']); ?>,- / <?php echo rupiah_($data['pagu_lk_awal']); ?>,-</strong> <span class="pull-right strong"><strong><?php echo round($persen_lk); ?>%</strong></span>
                <div class="progress progress-success active progress-striped ">
                  <div style="width: <?php echo $persen_lk; ?>%;" class="bar">Luar Daerah</div>
                </div>
              </li>
              <?php } ?>

            </ul>
          </div>
        </div>
      </div>
    </div>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>P A G U</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th rowspan="2" style="vertical-align: middle;">Tahun</th>
                  <th colspan="2">KDH/WKDH</th>
                  <th colspan="2">Setdakab</th>                  
                  <th rowspan="2" style="vertical-align: middle;">Action</th>
                </tr>
                <tr>                  
                  <th>Dalam Daerah</th>
                  <th>Luar Daerah</th>
                  <th>Dalam Daerah</th>
                  <th>Luar Daerah</th>
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
                  <td width="50px"><center><?php echo $data['tahun']; ?></center></td>
                  <td width="500px"><center><?php echo rupiah($data['pagu_dk_kdh_awal']); ?>,-</center></td>
                  <td width="500px"><center><?php echo rupiah($data['pagu_lk_kdh_awal']); ?>,-</center></td>
                  <td width="500px"><center><?php echo rupiah($data['pagu_dk_awal']); ?>,-</center></td>
                  <td width="500px"><center><?php echo rupiah($data['pagu_lk_awal']); ?>,-</center></td>
                  <td width="50px"><center>
                  <?php $type=$_SESSION['role'] ?>
                    <?php if($type=='Administrator'){ ?>                    
                      <a href="?page=pge&id=<?php echo $data['tahun']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <?php } if($type=='MembersFull'){ ?>
                      <a href="?page=pge&id=<?php echo $data['tahun']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <?php } if($type=='Members2'){ ?>
                      <a href="?page=pge&id=<?php echo $data['tahun']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <?php } if($type=='MembersView1'){ ?>
                      <span class="badge badge-inverse tip-bottom" data-original-title="Kunci"><span class="icon-lock" ></span></span>
                    <?php } ?>
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

