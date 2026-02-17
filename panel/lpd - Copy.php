<?php $page = 'lpd'; 

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

/* konversi tanggal */
function tgl_indo($tgl_spt){
  $bulan = array (
    1 =>   'Jan',
    'Feb',
    'Mar',
    'Apr',
    'Mei',
    'Jun',
    'Jul',
    'Agus',
    'Sep',
    'Okt',
    'Nov',
    'Des'
  );
  $pecahkan = explode('-', $tgl_spt);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
}


/* TERBILANG */
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
  }
 
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">LPD</a></div>
  
</div>
  <div class="container-fluid">
    <h3>Laporan Perjalanan Dinas</h3>
    <div class="row-fluid">

      <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Pencarian Data LPD</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <form class="form-horizontal" method="post" action="?page=lpds" name="" enctype="multipart/form-data">
          <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label"> </label>
              <div class="controls">
                <div class="control-group">
                  <select name="asn"class="span3" required>   
                  <option>...</option>                
                          <?php
                  $sql = "SELECT * FROM pegawai";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['nip']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>&nbsp;&nbsp;&nbsp;
                  <input type="text" data-date="01-02-2013" name="tgl_awal" data-date-format="dd-mm-yyyy" value="<?php  date('d-m-Y'); ?>" class="datepicker span2">&nbsp;&nbsp;&nbsp;s/d&nbsp;&nbsp;&nbsp;
                  <input type="text" data-date="01-02-2013" name="tgl_akhir" data-date-format="dd-mm-yyyy" value="<?php  date('d-m-Y'); ?>" class="datepicker span2">&nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-success tip-bottom"><span class="icon-search" > Search</span></button>
                </div>
              </div>
            </div>   
          </div>
        </form>
      </div>

      <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data LPD Berhasil Dihapus!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menghapus Data LPD!</div>       
            <?php } ?>
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Table LPD</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>No SPT</th>
                  <th>Yang Ditugaskan</th>
                  <th>Tujuan</th>
                  <th>Lama Perjalanan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  //include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM lpd INNER JOIN spt ON lpd.id_spt=spt.id_spt ORDER BY id_lpd DESC";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  
                  while ($data = mysqli_fetch_array($tampil)) { 
                  $id_spt = $data['id_spt'];
                  $id_lpd = $data['id_lpd'];
                ?>
                <tr>
                  <td class="span1"><center><?php echo $no++; ?></center></td>
                  <td class="span3"><center>
                    <?php if ($data['kunci'] == 'N' ){?>
                      <a href="?page=lpdv&id=<?php echo $data['id_lpd']; ?>"><span class="badge badge-info">Peg. 800/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?></span></a><span class="badge badge-important"><span class="icon-info-sign"></span><?php } else{ ?></span>
                    <a href="?page=lpdv&id=<?php echo $data['id_lpd']; ?>"><span class="badge badge-info">Peg. 800/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?></span></a><?php } ?></center></td>
                  <td class="span4">
                    <?php 
                      $sql2 = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt'";
                      $tampil2 = mysqli_query($koneksi, $sql2);
                    
                      while ($data2 = mysqli_fetch_array($tampil2)) {
                      echo "- ".ucfirst($data2['nama'])." (NIP. ".konversi_nip($data2['nip']).")<br>";
                        }
                      ?>
                      </td>
                      <td class="span2">
                    <?php 
                      $sql_kota = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt='$id_spt'";
                      $tampil_kota = mysqli_query($koneksi, $sql_kota);     
                      $data_kota = mysqli_fetch_array($tampil_kota);
                    ?>
                    <center>
                      <?php echo $data_kota['kota']; ?></center></td>
                  <td class="span2">
                    <?php 
                      $sql_spd = "SELECT * FROM spd WHERE id_spt='$id_spt'";
                      $tampil_spd = mysqli_query($koneksi, $sql_spd);     
                      $data_spd = mysqli_fetch_array($tampil_spd);
                    ?>
                    <center>
                      <?php echo $data_spd['lama_perjalanan']; ?> (<?php echo terbilang($data_spd['lama_perjalanan']); ?>) Hari<br>
                      <?php echo tgl_indo($data_spd['tgl_berangkat']); ?> <br>s/d<br><?php echo tgl_indo($data_spd['tgl_kembali']); ?></center></td>
                  <td class="span2"><center>
                    <?php if ($data['kunci'] == 'N') {?>
                      <a href="lpd_print.php?id=<?php echo $data['id_lpd']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>
                      <a href="?page=lpde&id=<?php echo $data['id_lpd']; ?>"><span class="badge badge-info tip-bottom" data-original-title="Edit"><span class="icon-edit" ></span></span></a>
                    <?php }elseif ($data['kunci'] == 'Y') {?>
                      <a href="lpd_print.php?id=<?php echo $data['id_lpd']; ?>" target='_blank'><span class="badge badge-success tip-bottom" data-original-title="Print"><span class="icon-print" ></span></span></a>   
                      <span class="badge badge-important tip-bottom" data-original-title="SPT Terkunci"><span class="icon-lock" ></span></span>                                      
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
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/jquery.toggle.buttons.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 

