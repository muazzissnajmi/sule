<?php include 'session.php' ?>
<?php

include "../koneksi/koneksi.php";


/* TERBILANG 
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
  }*/


  //$angka = 1530093;
  //echo terbilang($angka);

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=kwitansi" class="tip-bottom">Kwitansi</a> <a href="#" class="current">Data Kwitansi</a></div>
  
</div>

<div class="container-fluid"><hr>
  <!--<a href="kwitansi_print.php?id=<?php echo $data['id_kw']; ?>" target="_blank" class="btn btn-success btn-mini"><span class="icon-print"></span> Cetak</a>-->


<?php
$id =  addslashes($_GET['id']);
$sql_ = "SELECT * FROM kwitansi WHERE id_spt = '$id'";
//$sql = "SELECT * FROM kwitansi INNER JOIN spd on kwitansi.id_spd=spd.id_spd INNER JOIN spt ON spd.id_spt=spt.id_spt WHERE id_spt = $id_spt";
$tampil_ = mysqli_query($koneksi, $sql_);     
while ($data_ = mysqli_fetch_array($tampil_)) {
echo $id_spt = $data_['id_spt'];
//echo $no_spt = $data['no_spt'];

    $sql = "SELECT * FROM spt INNER JOIN kwitansi ON spt.id_spt=kwitansi.id_spt WHERE id_spt = '$id_spt'";
    //$sql = "SELECT * FROM kwitansi INNER JOIN spd on kwitansi.id_spd=spd.id_spd INNER JOIN spt ON spd.id_spt=spt.id_spt WHERE id_spt = $id_spt";
    $tampil = mysqli_query($koneksi, $sql);    
    $data = mysqli_fetch_array($tampil);
?>

    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5>Rincian Biaya Perjalanan Dinas No <?php echo $data['no_spt']; ?></h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td width="120px"><img src="../img/logo_bireuen.jpg" width="90px"></td>
                      <td>
                        <strong>Pemerintah Kabupaten Bireuen<br>
                        <font size="5px"> SEKRETARIAT DAERAH</font></strong><br>
                        Jalan Sultan Malikussaleh Cot Gapu Bireuen 24251<br>
                        Telpon (0644) 323111, 22414 Faks. (0644) 21221, 22416<br>
                        B I R E U E N
                      </td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">Lampiran SPT</td>
                      <td class="width70">100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?></strong></td>
                    </tr>
                    <!--<tr>
                      <td>Nomor Kwitansi</td>
                      <td><strong><?php echo $data['no_kw']; ?></strong></td>
                    </tr>-->
                    <tr>
                      <td>Tanggal</td>
                      <td><strong><?php echo $data['tgl_kw']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Kode Rek</td>
                      <td><strong><?php echo $data['kode_rek']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>Tahun</td>
                      <td><strong><?php echo $data['tahun']; ?></strong></td>
                    </tr>                  
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-invoice-full">
                  <thead>
                    <tr>
                      <th class="head0">No</th>
                      <th class="head1" colspan="3">Rincian Biaya</th>
                      <th class="head0 right">Jumlah</th>
                      <th class="head1 right">Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td width="10px"><center>1.</center></td>
                      <td>Penginapan</td>
                      <td width="60px"><center><?php echo $data['penginapan_hari']; ?> Hari @</center></td>
                      <td width="80px"><?php echo rupiah_($data['penginapan']/$data['penginapan_hari']); ?>,-</td>
                      <td class="right" width="120px"><strong><?php echo rupiah_($data['penginapan']); ?>,-</strong></td>
                      <td class="right" width="300px" rowspan="8"><?php echo $data['keterangan']; ?></td>
                    </tr>
                    <tr>
                      <td><center>2.</center></td>
                      <td>Uang Saku</td>
                      <td><center><?php echo $data['saku_hari']; ?> Hari @</center></td>
                      <td><?php echo rupiah_($data['saku']/$data['saku_hari']); ?>,-</td>
                      <td><strong><?php echo rupiah_($data['saku']); ?>,-</strong></td>
                    </tr>
                    <tr>
                      <td><center>3.</center></td>
                      <td>Biaya Makan</td>
                      <td><center><?php echo $data['makan_hari']; ?> Hari @</center></td>
                      <td><?php echo rupiah_($data['makan']/$data['makan_hari']); ?>,-</td>
                      <td><strong><?php echo rupiah_($data['makan']); ?>,-</strong></td>
                    </tr>
                    <tr>
                      <td><center>4.</center></td>
                      <td>Transportasi Lokal</td>
                      <td><center><?php echo $data['transport_lokal_hari']; ?> Hari @</center></td>
                      <td><?php echo rupiah_($data['transport_lokal']/$data['transport_lokal_hari']); ?>,-</td>
                      <td><strong><?php echo rupiah_($data['transport_lokal']); ?>,-</strong></td>
                    </tr>
                    <tr>
                      <td><center>5.</center></td>
                      <td>Transportasi PP</td>
                      <td><center><?php echo $data['transport_pp_hari']; ?> Hari @</center></td>
                      <td><?php echo rupiah_($data['transport_pp']/$data['transport_pp_hari']); ?>,-</td>
                      <td><strong><?php echo rupiah_($data['transport_pp']); ?>,-</strong></td>
                    </tr>
                    <tr>
                      <td><center>6.</center></td>
                      <td>BBM Harian</td>
                      <td><center><?php echo $data['bbm_hari']; ?> Liter @</center></td>
                      <td><?php echo rupiah_($data['bbm']/$data['bbm_hari']); ?>,-</td>
                      <td><strong><?php echo rupiah_($data['bbm']); ?>,-</strong></td>
                    </tr>
                    <tr>
                      <td><center>6.</center></td>
                      <td>BBM PP</td>
                      <td><center><?php echo $data['bbm_pp_hari']; ?> Liter @</center></td>
                      <td><?php echo rupiah_($data['bbm_pp']/$data['bbm_pp_hari']); ?>,-</td>
                      <td><strong><?php echo rupiah_($data['bbm_pp']); ?>,-</strong></td>
                    </tr>
                    <!--<tr>
                      <td><center>7.</center></td>
                      <td> </td>
                      <td><center> &nbsp;&nbsp; Hari @</center></td>
                      <td>Rp </td>
                      <td><strong>Rp</strong></td>
                    </tr>
                    <tr>
                      <td><center>8.</center></td>
                      <td> </td>
                      <td><center> &nbsp;&nbsp; Hari @</center></td>
                      <td>Rp </td>
                      <td><strong>Rp</strong></td>
                    </tr>-->
                  </tbody>
                </table>
                <table class="table table-bordered table-invoice-full">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="80%"><h4>J U M L A H : </h4>
                        <strong>Terbilang : <i><?php echo ucwords(terbilang($data['jumlah'])); ?> Rupiah</i></strong>
                      </td>                      
                      <td valign="bottom"><center><h4><?php echo rupiah_($data['jumlah']); ?>,-</h4></center></td>
                    </tr>
                  </tbody>
                </table>                
              </div>
            </div>
          </div>
        </div><?php } ?>
      </div>
    </div>
  </div>
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