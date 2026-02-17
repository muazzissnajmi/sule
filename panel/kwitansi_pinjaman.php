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
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
  <div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Pinjaman</a></div>
  
</div>
  <div class="container-fluid">
    <h3>PINJAMAN</h3>
    <right><a href="?page=kwp_pinjaman" class="btn btn-danger btn-mini"><span class="icon-plus"></span> Tambah Pinjaman</a></right>
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
            <?php } else if ($msg == 3) {?>
             <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Kwitansi Berhasil Disimpan!</div>      
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table Kwitansi</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table table-responsive">
              <thead>
                <tr>
                  <!--<th>No.</th>-->
                  <th>No. SPT</th>
                  <!--<th>No. Kwitansi</th>-->
                  <th>Penerima</th>
                  <th>Jumlah</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";

                  //$sql_kw = "SELECT * FROM kwitansi where tgl_kw like '%2024%' or tgl_kw like '%2025%'GROUP BY id_spt";
                  $sql_kw = "SELECT * FROM kwitansi where tgl_kw like '%2025%' GROUP BY id_spt";
                  $tampil_kw = mysqli_query($koneksi, $sql_kw);
                  $no=1;
                  while($data_kw = mysqli_fetch_array($tampil_kw)){
                  $id_spt = $data_kw['id_spt'];
                  
                  $sql = "SELECT * FROM spt WHERE id_spt = '$id_spt' ";
                  $tampil = mysqli_query($koneksi, $sql);

                  

                  $data = mysqli_fetch_array($tampil);
                  
                  
                  
                  $sql_kw2 = "SELECT * FROM kwitansi_nilai WHERE id_spt = '$id_spt' ";
                  $tampil_kw2 = mysqli_query($koneksi, $sql_kw2);
                  $total= 0;
                  while($data_kw2 = mysqli_fetch_array($tampil_kw2)){
                  $hari = $data_kw2['hari'];
                  
                  if ($data_kw2['hari'] == '0') {
                    $hari2 = $data_kw2['hari']+1;
                  }else{
                    $hari2 = $data_kw2['hari'];
                  }

                  $nilai = $data_kw2['nominal'] * $hari2;

                  $total+=$nilai;
                  
                  }
                  
                  
                ?>
                <tr>
                  <!--<td class="span1"><center><?php echo $no++; ?></center></td>-->
                  <td class="span2"><center>
                    <span class="badge badge-info">100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?></span></center></td>
                  <td class="span2"><?php 
                    $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY golongan DESC";
                    $tampil_ = mysqli_query($koneksi, $sql_);
                    while ($data_ = mysqli_fetch_array($tampil_)) {
                      echo "- ".$data_['nama']."<br>"; 
                    }?></td>                  
                  <td class="span2"><center>
                    <?php if ($total == '') {                    
                      echo rupiah('0'); 
                    } else {
                      echo rupiah($total); 
                    };
                    ?>,-</center></td>
                  <td class="span2"><center>
                    <?php 
                    if ($data_kw['kunci'] == 'Y') {?>
                       <a href="kwitansi_print.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                       <a href="kwitansi_print_sptjm.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-warning tip-bottom" data-original-title="Print SPTJM"><span class="icon-print" ></span></span></a>
                       <a href="kwitansi_print_ril.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-info tip-bottom" data-original-title="Print RIL"><span class="icon-print" ></span></span></a>
                       <!--<a href="?page=kwe&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>-->
                       <span class="badge badge-inverse tip-bottom" data-original-title="Kunci"><span class="icon-lock" ></span></span>
                       <?php if($type=='Administrator'){ ?>
                       <a href="?page=kwe&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                       <?php } if($type=='MembersFull'){ ?>
                        <a href="?page=kwe&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                       <?php }?>

                    <?php }else {
                    ?>
                    <a href="kwitansi_print.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                    <a href="kwitansi_print_sptjm.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-warning tip-bottom" data-original-title="Print SPTJM"><span class="icon-print" ></span></span></a>
                    <a href="kwitansi_print_ril.php?id=<?php echo $data['id_spt']; ?>" target='_blank'><span class="badge badge-default tip-bottom" data-original-title="Print RIL"><span class="icon-print" ></span></span></a>
                    <a href="?page=kwe&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <a href="?page=kwh&id=<?php echo $data['id_spt']; ?>" onclick="return confirm('Yakin Ingin Menghapus Kwitansi No. 100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spd'],-4);?>?')"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a>
                    
                    <!--<a href="?page=kwf&id=<?php echo $data['id_spt']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Final"><span class="icon-unlock" ></span></span></a>-->
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

