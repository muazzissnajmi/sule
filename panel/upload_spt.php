<?php include 'session.php' ?>
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Upload Perjalanan</a></div>
  
</div>
  <div class="container-fluid">
    <h3>DATA PERJALANAN</h3>
    <right><a href="?page=upfp" class="btn btn-success btn-mini"><span class="icon-plus"></span> Upload Perjalanan</a></right>
    <div class="row-fluid">

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>File Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data ASN!</div>       
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data ASN! Nama tersebut telah digunakan di SPT</div>       
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Perjalanan</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th width="250px">No SPT</th>
                  <th width="900px">Nama</th>

                  <!--<th>Kegiatan</th>
                  <th>Bill Hotel</th>
                  <th>Tiket Pesawat</th>
                  <th>Boarding Pass</th>-->
                  
                  <th>Action</th>
                </tr>                
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM dokumen GROUP BY id_spt ORDER BY id_spt DESC";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  
                  while ($data = mysqli_fetch_array($tampil)) { 
                  $no_spt = $data['id_spt'];
                ?>      
                <tr>
                  <td class="span3"><center>
                  <?php
                                      
                    $sql_ = "SELECT * FROM spt WHERE no_spt='$no_spt'";
                    $tampil_ = mysqli_query($koneksi, $sql_);

                    $data_ = mysqli_fetch_array($tampil_);
                    ;
                    
                ?><strong>Peg. 800/SPT/<?php echo $data_['no_spt']; ?>/<?php echo substr($data_['tgl_spt'],-4);?></strong></center>
                  </td>
                  <td class="span5">
                    <?php 
                      $sql2 = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$data_[id_spt]'";
                      $tampil2 = mysqli_query($koneksi, $sql2);
                    
                      while ($data2 = mysqli_fetch_array($tampil2)) {?>
                      <?php echo "- ".ucfirst($data2['nama'])."<br>"; }?> 
                  </td>
                  <!--<td class="span2"><center>
                    <?php                  
                      $sql_kg = "SELECT * FROM dokumen WHERE id_spt='$no_spt' and kategori='kegiatan'";
                      $tampil_kg = mysqli_query($koneksi, $sql_kg);
                      
                      while ($data_kg = mysqli_fetch_array($tampil_kg)) { 
                      if ($data_kg['kategori'] == '') {?>

                      <span class="icon-check-empty" >
                      <?php }else{?>
                        <span class="icon-check" ></span>
                      <?php }?>
                  <?php }?>
                    </center>
                  </td>
                  <td class="span2"><center>
                    <?php                  
                      $sql_bill = "SELECT * FROM dokumen WHERE id_spt='$no_spt' and kategori='bill'";
                      $tampil_bill = mysqli_query($koneksi, $sql_bill);
                      
                      while ($data_bill = mysqli_fetch_array($tampil_bill)) { 
                      if ($data_bill['kategori'] == '') {?>

                      <span class="icon-check-empty" >
                      <?php }else{?>
                        <span class="icon-check" ></span>
                      <?php }?>
                  <?php }?>
                    </center></span>
                    </center></td>
                  <td class="span2"><center>
                    <span class="icon-check-empty" ></span>
                    </center></td></td>
                  <td class="span2"><center>
                    <span class="icon-check" ></span>
                    </center></td></td>-->
                  <td class="span2"><center>
                    <a href="?page=upfv&id=<?php echo $data_['no_spt']; ?>"><span class="badge badge-success tip-bottom" data-original-title="View"><span class="icon-eye-open" ></span> View</span></a>
                    </center>
                  </td>
                </tr>
              <?php }?>
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

