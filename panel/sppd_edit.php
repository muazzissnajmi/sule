<?php include 'session.php' ?>
<?php $page = 'sppd'; 

include "../koneksi/koneksi.php";

$id_spd =  addslashes($_GET['id']);
//$no_spt = addslashes($_POST['no_spt']);
$sql = "SELECT * FROM spd INNER JOIN spt ON spd.id_spt=spt.id_spt INNER JOIN kota on spd.id_kota_tujuan=kota.id_kota WHERE id_spd='$id_spd'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);

$berwenang = $data['berwenang'];

$id_kota_tujuan = $data['id_kota_tujuan'];
$tiba_di_1 = $data['tiba_di_1'];
$berangkat_dari_1 = $data['berangkat_dari_1'];
$ke_1 = $data['ke_1'];

$tiba_di_2 = $data['tiba_di_2'];
$berangkat_dari_2 = $data['berangkat_dari_2'];
$ke_2 = $data['ke_2'];

$tiba_di_3 = $data['tiba_di_3'];
$berangkat_dari_3 = $data['berangkat_dari_3'];
$ke_3 = $data['ke_3'];


//$tiba_di_4 = $data['tiba_di_4'];
//$berangkat_dari_4 = $data['berangkat_dari_4'];
//$ke_4 = $data['ke_4'];
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=sppd" class="tip-bottom">SPPD</a> <a href="#" class="current">Edit SPPD</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>S P P D</h3>
    <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPPD Berhasil Diedit!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data SPPD!</div>       
            <?php } ?>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input SPPD</h5>
        </div>

        <form class="form-horizontal" method="post" action="?page=spes" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">            
            <input type="hidden" class="span11" name="id_spd" placeholder="Nomor SPPD" value="<?php echo $id_spd; ?>" />
            <!--<div class="control-group">
              <label class="control-label">Nomor SPPD :</label>
              <div class="controls">
                
                094/<input type="text" class="span2" name="no_spd" placeholder="Nomor SPPD" value="<?php echo $data['no_spd']; ?>" />/<?php echo substr($data['tgl_spd'],-4);?>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal SPPD:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_spd" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_spd']; ?>" class="datepicker span4">
                </div>
              </div>
            </div>-->
            
            
            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Nomor Referensi 100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spd'],-4);?> </h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"> 

                <div class="control-group">
              <label class="control-label">Nomor Referensi :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="no_referensi" placeholder="Nomor Referensi" value="<?php echo $data['no_spt']; ?>"  />
                <input type="text" class="span11" name="" placeholder="Nomor Referensi" value="Peg. 888/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spd'],-4);?>" readonly />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Yang Memberi Perintah :</label>
              <div class="controls">                
                <input type="text" class="span11" name="" placeholder="Yang Memberi Perintah" value="<?php echo $data['memberi_perintah']; ?>" readonly/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Yang Ditugaskan :</label>
              <div class="controls">
                <select name="" multiple disabled>
                <?php

                  $sql2 = "SELECT * FROM pegawai INNER JOIN pengikut ON pegawai.nip=pengikut.pengikut WHERE no_spt='$data[id_spt]'";
                  $tampil2 = mysqli_query($koneksi, $sql2);     
                  while ($data2 = mysqli_fetch_array($tampil2)){
                      $nip2 = $data2['pengikut'];
                  ?>
                
                <option value="<?php echo $data2['nip']; ?>" <?php if ($data2['nip'] == $nip2) { echo "selected"; } ?>> <?php echo $data2['nama']; ?> 
                 <?php if ($data2['nip'] < 999999999999) { echo "<center> (".ucfirst($data2['jabatan']).")</center>"; }else{?>
                  (Nip. <?php echo $data2['nip']; ?>) <?php }?></option>
              <?php  } ?>
                </select>

                <?php
                  $sql2_ = "SELECT * FROM pegawai INNER JOIN pengikut ON pegawai.nip=pengikut.pengikut WHERE no_spt='$data[id_spt]'";
                  $tampil2_ = mysqli_query($koneksi, $sql2_);     
                  while ($data2_ = mysqli_fetch_array($tampil2_)){
                      $nip2_ = $data2_['pengikut'];
                ?>

                <input type="hidden" name="pengikut[]" value="<?php echo $data2_['nip']; ?>">

              <?php }?>
              </div>
            </div>
                
            <div class="control-group">
              <label class="control-label">Maksud Perjalanan Dinas :</label>
              <div class="controls"><textarea class="span11" name="maksud_perjalanan" rows="5" readonly ><?php echo $data['dasar_penugasan'];?></textarea></div>
            </div>
            </div>
            </div>

             <div class="control-group">
              <label class="control-label">Keterangan Lainnya :</label>
              <div class="controls"><textarea class="span11" name="keterangan"  rows="5"><?php echo $data['keterangan_spd'];?></textarea></div>
            </div>
            <div class="control-group">
              <label class="control-label">Instansi :</label>
              <div class="controls">
                <input type="text" class="span11" name="instansi" placeholder="Instansi" value="<?php echo $data['instansi'];?>" readonly />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Mata Anggaran :</label>
              <div class="controls">
                <select name="mata_anggaran" class="span3">
                  <option value="5.1.02.04.01.0001" <?php if($data['mata_anggaran'] == '5.1.02.04.01.0001') echo "selected" ?>>5.1.02.04.01.0001</option>
                  <option value="5.2.2.15.001" <?php if($data['mata_anggaran'] == '5.2.2.15.001') echo "selected" ?>>5.2.2.15.001</option>
                  <option value="5.2.2.15.002" <?php if($data['mata_anggaran'] == '5.2.2.15.002') echo "selected" ?>>5.2.2.15.002</option>
                  <option value="5.2.2.15.003" <?php if($data['mata_anggaran'] == '5.2.2.15.003') echo "selected" ?>>5.2.2.15.003</option>
                <!--<input type="text" class="span11" name="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo $data['mata_anggaran'];?>" readonly />-->
              </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tahun Anggaran :</label>
              <div class="controls">
                <select name="tahun" required>    
                  <option <?php if($data['tahun_anggaran'] == '2019') echo "selected" ?>>2019</option>
                  <option <?php if($data['tahun_anggaran'] == '2020') echo "selected" ?>>2020</option>
                  <option <?php if($data['tahun_anggaran'] == '2021') echo "selected" ?>>2021</option>
                  <option <?php if($data['tahun_anggaran'] == '2022') echo "selected" ?>>2022</option>
                  <option <?php if($data['tahun_anggaran'] == '2023') echo "selected" ?>>2023</option>
                  <option <?php if($data['tahun_anggaran'] == '2024') echo "selected" ?>>2024</option>
                </select>
              </div>
            </div>            
             <div class="control-group">
              <label class="control-label">Asal :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="asal" placeholder="Kota Asal" value="Bireuen" />
                <input type="text" class="span11" name="" placeholder="Kota Asal" value="Bireuen" readonly />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tujuan Pertama :</label>
              <div class="controls">
                <select name="tujuan" required> 
                <option value="">...</option>
                <?php

                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>" <?php if($data3['id_kota'] == $id_kota_tujuan) echo "selected" ?>><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tgl Berangkat :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_berangkat" data-date-format="dd-mm-yyyy"value="<?php echo $data['tgl_berangkat'];?>" class="datepicker span3"></div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tujuan Kedua :</label>
              <div class="controls">
                <select name="tiba_di_2" > 
                <option>...</option>
                <?php
                  $sql_2 = "SELECT * FROM kota";
                  $tampil_2 = mysqli_query($koneksi, $sql_2);     
                  while ($data_2 = mysqli_fetch_array($tampil_2)) {
                  ?>
                  <option value="<?php echo $data_2['id_kota']; ?>" <?php if($data_2['id_kota'] == $tiba_di_2) echo "selected" ?>><?php echo $data_2['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tujuan Ketiga :</label>
              <div class="controls">
                <select name="tiba_di_3" > 
                <option>...</option>
                <?php
                  $sql_3 = "SELECT * FROM kota";
                  $tampil_3 = mysqli_query($koneksi, $sql_3);     
                  while ($data_3 = mysqli_fetch_array($tampil_3)) {
                  ?>
                  <option value="<?php echo $data_3['id_kota']; ?>" <?php if($data_3['id_kota'] == $tiba_di_3) echo "selected" ?>><?php echo $data_3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tgl Kembali :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_kembali" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_kembali'];?>" class="datepicker span3">
                </div>
              </div>
            </div>
        
        <div class="control-group">
              <label class="control-label">Tgl Kembali Print:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_kembali_print" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_kembali_print'];?>" class="datepicker span3">
                </div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Lama Perjalanan :</label>
              <div class="controls">
                <div class="input-prepend">
                  <input type="text" name="lama" placeholder="" id="rupiah" class="span3" value="<?php echo $data['lama_perjalanan'];?>" readonly>                  
                   <span class="add-on">Hari</span>
                </div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Alat Transportasi :</label>
              <div class="controls">
                <select name="transportasi[]" multiple >
                  <option>Mobil Dinas</option>
                  <option>Taxi</option>
                  <option>Mini Bus</option>
                  <option>Bus Dinas</option>
                  <option>Bus</option>
                  <option>Kereta Api</option>
                  <option>Kapal Laut</option>
                  <option>Pesawat</option>
                </select>
                <br>
                Pilih ulang jika ingin merubah
                <br>
                <?php 
                $sql_trans = "SELECT * FROM spd_transportasi WHERE no_spd='$id_spd'";
                $tampil_trans = mysqli_query($koneksi, $sql_trans);     
                while ($data_trans = mysqli_fetch_array($tampil_trans)){

                echo "<span class='badge badge-info'>- ".$data_trans['transportasi']."</span>"; 
                }
                ?>
              </div>
            </div>            
            
            

            <div class="control-group">
              <label class="control-label">TTD Pejabat :</label>
              <div class="controls">
                <select name="ttd" >   
                  <option value="">...</option>                
                  <?php
                    $sql_ttdp = "SELECT * FROM spd WHERE id_spd = '$id_spd'";
                    $tampil_ttdp = mysqli_query($koneksi, $sql_ttdp);     
                    $data_ttdp = mysqli_fetch_array($tampil_ttdp);
                    $ttd_pe = $data_ttdp['ttd'];

                  
                  $sql_tt = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult='Y' ORDER BY id_ttd_pejabat ASC";
                  $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                  while ($data_tt = mysqli_fetch_array($tampil_tt)) {
                  ?>    
                <option value="<?php echo $data_tt['id_ttd_pejabat']; ?>" <?php if ($data_tt['id_ttd_pejabat'] == $ttd_pe) { echo "selected"; } ?>><?php echo ucfirst($data_tt['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            
        </div>
      </div>      
    </div>


    <div class="form-actions">
      <center>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="?page=sp" class="btn btn-primary">Back</a>
        <a href="?page=sppd" class="btn btn-danger">Cancel</a>
      </center>
    </div>
      </div>      
    </div>
    
  </div>

  
  
 </form>
</div></div>


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