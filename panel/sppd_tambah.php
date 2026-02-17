<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";

$id_spt = addslashes($_POST['id_spt']);

$sql = "SELECT * FROM spt WHERE id_spt='$id_spt'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);

$nip = $data['berwenang'];
?>

<script src="../js/jquery.js"></script>
<script>

    $(document).ready(function(){
        $('#no_spd').blur(function(){
            $('#pesan').html('<img style="margin-left:10px; width:10px" src="loading.gif">');
            var no_spd = $(this).val();

            $.ajax({
                type    : 'POST',
                url     : 'sppd_cek.php',
                data    : 'no_spd='+no_spd,
                success : function(data){
                    $('#pesan').html(data);
                }
            })

        });
    });
    </script>

    <script>
      var tgl1 = 10
      var tgl2 = 15;
      var text = "";
      var i;
      for (i = tgl1; i <= tgl2; i++) {
          text += i + "<br>";
      }
      document.getElementById("coba").innerHTML = text;
    </script>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=sppd" class="tip-bottom">SPPD</a> <a href="#" class="current">Tambah SPPD</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>S P P D</h3>
    <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPPD Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data SPPD!
              <meta http-equiv="refresh" content="5;url=?page=sp">
            </div>       
            <?php } ?>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input SPPD</h5>
        </div>

        <form class="form-horizontal" method="post" action="?page=spd_sim" name="" enctype="multipart/form-data">
          <!-- <input type="text" class="span2" name="id_spd" id="no_spd" value="<?php echo $newID; ?>" readonly />-->
        <div class="widget-content nopadding form-horizontal">            
          <!--<div class="control-group">
              <label class="control-label">Nomor SPPD :</label>
              <div class="controls">                
                094/<input type="text" class="span2" name="no_spd" id="no_spd" placeholder="Nomor SPPD" />/<?php echo date('Y');?>
                <span id="pesan"></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal SPPD:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_spd" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_spt']; ?>" class="datepicker span4">
              	</div>
              </div>
            </div>-->

            <div class="accordion-heading">
              <div class="widget-title"> <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse"> <span class="icon"><i class="icon-ok"></i></span>
                <h5>Nomor Referensi 100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?> </h5>
                </a> </div>
            </div>
            <div class="collapse in accordion-body" id="collapseGOne">
              <div class="widget-content"> 
            <input type="hidden" data-date="01-02-2013" name="tgl_spd" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_spt']; ?>" class="datepicker span4">
            <div class="control-group">
              <label class="control-label">Nomor Referensi :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="id_spt" placeholder="Nomor Referensi" value="<?php echo $data['id_spt']; ?>"  />
                <input type="hidden" class="span11" name="no_spt" placeholder="Nomor Referensi" value="<?php echo $data['no_spt']; ?>"  />
                <input type="text" class="span11" name="" placeholder="Nomor Referensi" value="100.3.5/SPT/<?php echo $data['no_spt']; ?>/<?php echo substr($data['tgl_spt'],-4);?>" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Yang Memberi Perintah :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="memberi_perintah" placeholder="Yang Memberi Perintah" value="<?php echo $data['memberi_perintah']; ?>" />
                <input type="text" class="span11" name="" placeholder="Yang Memberi Perintah" value="<?php echo $data['memberi_perintah']; ?>" disabled/>
              </div>
            </div>
            <!--<div class="control-group">
              <label class="control-label">Pejabat Berwenang :</label>
              <div class="controls">
                <select name="pejabat_berwenang" disabled>		
        				<option>...</option>                
                        <?php
        				$sql1 = "SELECT * FROM pegawai";
        				$tampil1 = mysqli_query($koneksi, $sql1);     
        				while ($data1 = mysqli_fetch_array($tampil1)) {
        				?>		
                
                <option value="<?php echo $data1['nip']; ?>" <?php if ($data1['nip'] == $nip) { echo "selected"; } ?>><?php echo $data1['nama']; ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>-->
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
            <!--<div class="control-group">
              <label class="control-label">Perkiraan Biaya Dinas :</label>
              <div class="controls">
                <div class="input-prepend"> <span class="add-on">Rp.</span>
                  <input type="text" name="biaya" placeholder="" id="rupiah" class="span11">                  
                </div>
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Maksud Perjalanan Dinas :</label>
              <div class="controls"><textarea class="span11" name="maksud_perjalanan" rows="7" disabled ><?php echo $data['keterangan'];?></textarea></div>
            </div>
          </div>
        </div>

             <div class="control-group">
              <label class="control-label">Keterangan Lainnya :</label>
              <div class="controls"><textarea class="span11" rows="7" name="keterangan"></textarea></div>
            </div>
            <div class="control-group">
              <label class="control-label">Instansi :</label>
              <div class="controls">
                <input type="text" class="span11" name="instansi" placeholder="Instansi" value="Setdakab. Bireuen" readonly />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Mata Anggaran :</label>
              <div class="controls">
                <select name="mata_anggaran" class="span2">
                  <option value="5.1.02.04.01.0001" selected>5.1.02.04.01.0001</option>
                <option value="5.1.02.04.01.0002">5.1.02.04.01.0002</option>
                <option value="5.1.02.04.01.0003">5.1.02.04.01.0003</option>
                  <option value="5.2.2.15.001">5.2.2.15.001</option>
                  <option value="5.2.2.15.002">5.2.2.15.002</option>                  
                  <option value="5.2.2.15.003">5.2.2.15.003</option>
                </select>
                <!--<input type="text" class="span11" name="mata_anggaran" placeholder="Mata Anggaran" value="5.2.2.15.002" readonly />-->
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tahun Anggaran :</label>
              <div class="controls">
                <select name="tahun" required>    
                  <option <?php if(date('Y') == '2019') echo "selected" ?>>2019</option>
                  <option <?php if(date('Y') == '2020') echo "selected" ?>>2020</option>
                  <option <?php if(date('Y') == '2021') echo "selected" ?>>2021</option>
                  <option <?php if(date('Y') == '2022') echo "selected" ?>>2022</option>
                  <option <?php if(date('Y') == '2023') echo "selected" ?>>2023</option>
                  <option <?php if(date('Y') == '2024') echo "selected" ?>>2024</option>
                </select>
              </div>
            </div>

                                           
          <div class="control-group">
              <label class="control-label">Asal :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="asal" placeholder="Kota Asal" value="Bireuen" />
                <input type="text" class="span11" name="" placeholder="Kota Asal" value="Bireuen" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tujuan Pertama :</label>
              <div class="controls">
                <select name="tujuan" required>
                <?php

                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tgl Berangkat :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" id='datetimepicker1' name="tgl_berangkat" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', strtotime('+1 days')); ?>" class="datepicker span3"></div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tujuan Kedua :</label>
              <div class="controls">
                <select name="tiba_di_2" > 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
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
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tgl Kembali :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" id='datetimepicker2' name="tgl_kembali" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', strtotime('+4 days')); ?>" class="datepicker span3">
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
              </div>
            </div>            
            
            <!--<div class="control-group">
              <label class="control-label">Lama Perjalanan :</label>
              <div class="controls">
                <div class="input-prepend">
                  <input type="text" name="lama" placeholder="" id='hasil' class="span3">                  
                   <span class="add-on">Hari</span>
                </div>
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">TTD Pejabat :</label>
              <div class="controls">
                <select name="ttd" required>   
                  <option>...</option>                
                  <?php
                  $sql = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult='Y' ORDER BY id_ttd_pejabat DESC";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_ttd_pejabat']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
        </div>
      </div>      
    </div>
    

    <!--<div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Tiba</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Tiba di :</label>
              <div class="controls">
                <select name="tiba_di_1" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_1" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangakat_dari_1" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <select name="ke_1" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_11" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>            
        </div>
      </div>
    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Tiba</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Tiba di :</label>
              <div class="controls">
                <select name="tiba_di_2" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_2" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangakat_dari_2" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <select name="ke_2" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_22" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>            
        </div>
      </div>

    </div>

    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Tiba</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Tiba di :</label>
              <div class="controls">
                <select name="tiba_di_3" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_3" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangakat_dari_3" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <select name="ke_3" required> 
                <option>...</option>
                <?php
                  $sql3 = "SELECT * FROM kota";
                  $tampil3 = mysqli_query($koneksi, $sql3);     
                  while ($data3 = mysqli_fetch_array($tampil3)) {
                  ?>
                  <option value="<?php echo $data3['id_kota']; ?>"><?php echo $data3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_33" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>
            
        </div>
      </div>
    </div>

    
  </div>-->
  <div class="form-actions">
            <center>
              <button type="submit" class="btn btn-success">Save</button>
              <a href="?page=sp" class="btn btn-primary">Back</a>
              <a href="?page=sppd" class="btn btn-danger">Cancel</a>
            </center>
          </div>

 <!--<div class="row-fluid">
   <div class="form-actions">
    <center>
              <button type="submit" class="btn btn-success">Save</button>
              <a href="?page=sp" class="btn btn-primary">Back</a>
              <a href="?page=sppd" class="btn btn-danger">Cancel</a>
              </center>
    </div>-->
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

