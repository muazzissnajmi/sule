<?php include 'session.php' ?>
<?php
/* konversi tanggal */
function tgl_indo($tgl_spt){
  $bulan = array (
    1 =>   'Jan',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
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

include "../koneksi/koneksi.php";

$id_spt =  addslashes($_GET['id']);
$sql = "SELECT * FROM spt WHERE id_spt = '$id_spt'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
$no_spt = $data['no_spt'];
$berwenang = $data['berwenang'];
//$id_spt2 = $data['id_spt'];

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=spt" class="tip-bottom">SPT</a> <a href="#" class="current">Data SPT</a></div>
  
</div>
<div class="container-fluid">
  
  <h3>S P T</h3>
  <right><a href="spt_print.php?id=<?php echo $data['id_spt']; ?>" target="_blank" class="btn btn-success btn-mini"><span class="icon-print"></span> Cetak</a></right>
    <div class="row-fluid">
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Data SPT</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nomor SPT :</label>
              <div class="controls">
                <input type="text" class="span11" name="no_spt" placeholder="Nomor SPT" value="100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo date('Y', strtotime($data['tgl_spt'])); ?>" disabled />
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Tanggal SPT:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_spt" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_spt']; ?>" class="datepicker span4" disabled />
                </div>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Yang Memberi Perintah :</label>
              <div class="controls">
                <input type="text" class="span11" name="memberi_perintah" placeholder="Yang Memberi Perintah" value="<?php echo ucfirst($data['memberi_perintah']); ?>" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pejabat Berwenang :</label>
              <div class="controls">
                <select name="pejabat_berwenang" disabled>    
                  <option value="...">...</option>                
                  <?php
                    $sql1 = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip";
                    $tampil1 = mysqli_query($koneksi, $sql1);     
                    while ($data1 = mysqli_fetch_array($tampil1)) {
                  ?>    
                
                <option value="<?php echo $data1['id_ttd_pejabat']; ?>" <?php if ($data1['id_ttd_pejabat'] == $berwenang) { echo "selected"; } ?>><?php echo ucfirst($data1['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Yang Ditugaskan :</label>
              <div class="controls">
                <select name="pengikut[]" multiple disabled>
                <?php

                  $sql2 = "SELECT * FROM pegawai";
                  $tampil2 = mysqli_query($koneksi, $sql2);     
                  while ($data2 = mysqli_fetch_array($tampil2)) {


                $sql_ = "SELECT * FROM pengikut WHERE no_spt= '$data[id_spt]'";
                $tampil_ = mysqli_query($koneksi, $sql_);     
                while ($data_ = mysqli_fetch_array($tampil_)){

                $nip2 = $data_['pengikut']; 
                ?>
                <option value="<?php echo $data2['nip']; ?>" <?php if ($data2['nip'] == $nip2) { echo "selected"; } ?>><?php echo ucfirst($data2['nama']); ?> 
                <?php if ($data2['nip'] < 999999999999) { echo "<center> (".ucfirst($data2['jabatan']).")</center>"; }else{?>
                (<?php echo ucfirst($data2['nip']); ?>)</option>
              <?php  }}} ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Dasar Penugasan :</label>
              <div class="controls"><textarea class="span11" name="dasar_penugasan" disabled /><?php echo ucfirst($data['dasar_penugasan']); ?></textarea></div>
            </div>
            <?php
                $sql_ket = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                $tampil_ket = mysqli_query($koneksi, $sql_ket);     
                $data_ket = mysqli_fetch_array($tampil_ket);
              ?>
             <div class="control-group">
              <label class="control-label">Untuk :</label>
              <div class="controls"><?php echo ucfirst($data['keterangan']); ?>, Selama <?php echo $data_ket['lama_perjalanan']; ?> (<?php echo terbilang($data_ket['lama_perjalanan']); ?>) Hari terhitung mulai tanggal <?php echo tgl_indo($data_ket['tgl_berangkat']); ?> sampai dengan <?php echo tgl_indo($data_ket['tgl_kembali']); ?> di <?php echo $data_ket['kota'];?><?php if ($data_ket['tiba_di_2'] == '...') {
                  }elseif ($data_ket['tiba_di_3'] == '...'){  
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo "Dan". $data_tu2['kota']; 
                  }else{
                    $sql_tu2 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_2=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu2 = mysqli_query($koneksi, $sql_tu2);     
                    $data_tu2 = mysqli_fetch_array($tampil_tu2);
                    echo ",". $data_tu2['kota']; }?>
                  <?php if ($data_ket['tiba_di_3'] == '...') {
                  }else{ $sql_tu3 = "SELECT * FROM spd INNER JOIN kota ON spd.tiba_di_3=kota.id_kota WHERE id_spt = '$data[id_spt]'";
                    $tampil_tu3 = mysqli_query($koneksi, $sql_tu3);     
                    $data_tu3 = mysqli_fetch_array($tampil_tu3);
                    echo "Dan ". $data_tu3['kota']; } ?>
              
              </div>
            </div>
        </div>
      </div>      
    </div>    
  </div>
  <div class="row-fluid">
   
  </div>
 </form>

</div></div>
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

<script type="text/javascript">
  var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // tambahkan 'Rp.' pada saat form di ketik
  // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
  rupiah.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
}
</script>