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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">SPPD</a></div>
  
</div>
  <div class="container-fluid">
    <h3>DATA SPPD</h3>
    <right><a href="?page=sp" class="btn btn-success btn-mini"><span class="icon-plus"></span> Tambah SPPD</a>
    <a href="?page=sppd_template" class="btn btn-info btn-mini"><span class="icon-print" ></span> Print Template</a>
    </right>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPPD Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data SPPD!</div>
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>
              Data SPPD Berhasil Disimpan!</div>       
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table SPPD</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <!--<th>No.</th>-->
                  <!--<th>No. SPPD</th>-->
                  <th>NO. SPT</th>
                  <th>Tgl SPPD</th>
                  <th>Yang Ditugaskan</th>
                  <th>Tujuan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM spd INNER JOIN spt ON spd.id_spt=spt.id_spt INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota where tgl_spd like '%2024%' or tgl_spd like '%2025%' or tgl_spd like '%2026%' ORDER BY id_spd DESC ";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 
                    $id_spt = $data['id_spt'];

                  $sql_kw = "SELECT * FROM kwitansi WHERE id_spt = '$id_spt' ";
                  $tampil_kw = mysqli_query($koneksi, $sql_kw);
                  $data_kw = mysqli_fetch_array($tampil_kw);
                ?>
                <tr>
                  <!--<td class="span1"><center><?php echo $no++; ?></center></td>-->
                  <!--<td class="span2"><center>
                    <?php if ($data['no_spd'] == '' ){?><span class="badge badge-important">Baru Kode <?php echo $data['id_spd']; } else{ ?></span>
                    <a href="?page=spv&id=<?php echo $data['id_spd']; ?>"><span class="badge badge-info">094/<?php echo $data['no_spd']; ?>/<?php echo substr($data['tgl_spd'],-4);?></span></a><?php } ?></center></td>-->
                  <td class="span2"><center><a href="?page=spv&id=<?php echo $data['id_spd']; ?>"><span class="badge badge-info">100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spd'],-4);?></span></a></center></td>
                  <td class="span2"><center><?php echo $data['tgl_spd']; ?></center></td>
                  <td class="span3"><?php 
                    $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY golongan DESC";
                    $tampil_ = mysqli_query($koneksi, $sql_);
                    while ($data_ = mysqli_fetch_array($tampil_)) {
                      echo "- ".$data_['nama']."<br>"; 
                    }?></td>
                  <td class="span2"><center><?php echo $data['kota']; ?><br>
                    <?php
                    $sql_2 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_2]'";
                    $tampil_2 = mysqli_query($koneksi, $sql_2);     
                    $data_2 = mysqli_fetch_array($tampil_2)
                  ?>
                    <?php 
                    if ($data_2['kota'] == '') {
                      
                    }else{
                    echo $data_2['kota']."<br>"; }?>

                  <?php
                    $sql_3 = "SELECT * FROM kota WHERE id_kota = '$data[tiba_di_3]'";
                    $tampil_3 = mysqli_query($koneksi, $sql_3);     
                    $data_3 = mysqli_fetch_array($tampil_3)
                  ?>
                    <?php 
                    if ($data_3['kota'] == '') {
                      
                    }else{
                    echo $data_3['kota']."<br>"; }?>
                  </center></td>
                  <td class="span2"><center>
                    <?php if ($data_kw['kunci'] == 'Y') {?>
                     <a href="sppd_print.php?id=<?php echo $data['id_spd']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <!--<a href="?page=spe&id=<?php echo $data['id_spd']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>-->                       
                      <span class="badge badge-inverse tip-bottom" data-original-title="SPD Selesai"><span class="icon-lock" ></span></span>
                      
                    <?php }elseif($data_kw['kunci'] == 'N'){ ?>
                      <a href="sppd_print.php?id=<?php echo $data['id_spd']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="?page=spe&id=<?php echo $data['id_spd']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>                     
                    <?php }else{ ?>
                      <a href="sppd_print.php?id=<?php echo $data['id_spd']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="?page=spe&id=<?php echo $data['id_spd']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>                     
                      <a href="?page=spdh&id=<?php echo $data['id_spd']; ?>" onclick="return confirm('Yakin Ingin Menghapus SPD <?php echo $data['no_spd']; ?> ?')"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a>
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

