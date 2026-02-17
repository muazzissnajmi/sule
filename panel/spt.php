<?php include 'session.php' ?>
<?php $page = 'pegawai'; ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/select2.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">SPT</a></div>
  
</div>
  <div class="container-fluid">
    <h3>DATA SPT</h3>
    <right><a href="?page=st" class="btn btn-success btn-mini"><span class="icon-plus"></span> Tambah SPT</a></right>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPT Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data SPT!</div>       
            <?php }  else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Data SPT tidak bisa dihapus! Harap hapus SPD yang menggunakan nomor SPT tersebut</div>       
            <?php }else if ($msg == 4) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPT Berhasil Disimpan!</div>  
            <?php } else if ($msg == 5) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>Terjadi Kesalahan!</div>  
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table SPT</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <!--<th>No.</th>-->
                  <th>No SPT</th>
                  <th>Yang Ditugaskan</th>
                  <th>Tgl Spt</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM spt where tgl_spt like '%2025%' OR tgl_spt like '%2026%' ORDER BY id_spt DESC";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  
                  while ($data = mysqli_fetch_array($tampil)) { 
                  $id_spt = $data['id_spt'];
                ?>
                <tr>
                  <!--<td class="span1"><center><?php echo $no++; ?></center></td>-->
                  <td class="span3"><center>
                    <?php if ($data['no_spt'] == '' ){?><span class="badge badge-important">Baru Kode <?php echo $data['id_spt']; } else{ ?></span>
                    <a href="?page=sv&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info">100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?></span></a><?php } ?></center></td>
                  <td class="span4">
                    <?php 
                      $sql2 = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY id_pengikut ";
                      $tampil2 = mysqli_query($koneksi, $sql2);
                    
                      while ($data2 = mysqli_fetch_array($tampil2)) {?>

                      <?php echo ucfirst($data2['nama']);?> 
                      <?php if ($data2['nip'] < 999999999999) { echo "<br>"; }else{?>
                      (<?php echo$data2['nip'];?>)<br>
                      
                      <?php }} ?>
                      </td>
                  <td class="span2"><center><?php echo $data['tgl_spt']; ?></center></td>
                  <td class="span2"><center>
                    <?php if ($data['cek_spt'] == 'O') {?>
                      <a href="spt_print.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="spt_print_nk.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-warning tip-bottom" data-original-title="Print Tanpa Kops"><span class="icon-print" ></span></span></a>
                      <a href="spt_print_emas.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-dark tip-bottom" data-original-title="Print Garuda Emas"><span class="icon-print" ></span></span></a>
                      <a href="?page=se&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <?php }elseif ($data['cek_spt'] == 'F') {?>
                      <a href="spt_print.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>  
                      <a href="spt_print_nk.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-warning tip-bottom" data-original-title="Print Tanpa Kops"><span class="icon-print" ></span></span></a>                      
                      <a href="spt_print_emas.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-dark tip-bottom" data-original-title="Print Garuda Emas"><span class="icon-print" ></span></span></a>
                      <span class="badge badge-inverse tip-bottom" data-original-title="SPT Selesai"><span class="icon-lock" ></span></span>
                    <?php }elseif ($data['cek_spt'] == 'K') {?>
                      <a href="spt_print.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="spt_print_nk.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-warning tip-bottom" data-original-title="Print Tanpa Kops"><span class="icon-print" ></span></span></a>
                      <a href="spt_print_emas.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-dark tip-bottom" data-original-title="PPrint Garuda Emas"><span class="icon-print" ></span></span></a>
                      <a href="?page=se&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <?php }else{ ?>
                      <a href="spt_print.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="spt_print_nk.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-warning tip-bottom" data-original-title="Print Tanpa Kops"><span class="icon-print" ></span></span></a>
                      <a href="spt_print_emas.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-dark tip-bottom" data-original-title="PPrint Garuda Emas"><span class="icon-print" ></span></span></a>
                      <a href="?page=se&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                      <a href="?page=spth&id=<?php echo $data['id_spt']; ?>" onclick="return confirm('Yakin Ingin Menghapus SPT No. <?php echo $data['no_spt']; ?> ?')"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a>
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

