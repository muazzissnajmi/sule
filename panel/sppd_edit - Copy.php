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
              Gagal Menyimpan Data SPPD!</div>       
            <?php } ?>
  <div class="row-fluid">
    <div class="span7">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input SPPD</h5>
        </div>

        <form class="form-horizontal" method="post" action="?page=spd_sim" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">            
            <div class="control-group">
              <label class="control-label">Nomor SPPD :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="no_spt" placeholder="Nomor SPPD" value="<?php echo $no_spt; ?>" />
                094/<input type="text" class="span2" name="no_spd" placeholder="Nomor SPPD" value="<?php echo $data['no_spd']; ?>" />/2019
              </div>
            </div>
            <!--<div class="control-group">
              <label class="control-label">Tanggal SPPD:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_spd" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_spd']; ?>" class="datepicker span4">
                </div>
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Nomor Referensi :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="no_referensi" placeholder="Nomor Referensi" value="<?php echo $data['no_spt']; ?>"  />
                <input type="text" class="span11" name="" placeholder="Nomor Referensi" value="Peg. 888/SPT/<?php echo $data['no_spt']; ?>/2019" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Yang Memberi Perintah :</label>
              <div class="controls">                
                <input type="text" class="span11" name="" placeholder="Yang Memberi Perintah" value="<?php echo $data['memberi_perintah']; ?>" readonly/>
              </div>
            </div>
            <!--<div class="control-group">
              <label class="control-label">Pejabat Berwenang :</label>
              <div class="controls">
                <select name="pejabat_berwenang" disabled />    
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
            </div>-->
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
                <option value="<?php echo $data2['nip']; ?>" <?php if ($data2['nip'] == $nip2) { echo "selected"; } ?>><?php echo ucfirst($data2['nama']); ?> (<?php echo ucfirst($data2['nip']); ?>)</option>
              <?php  }} ?>
                </select>
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
              <div class="controls"><textarea class="span11" name="maksud_perjalanan" rows="5" disabled ><?php echo $data['dasar_penugasan'];?></textarea></div>
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
                <input type="text" class="span11" name="mata_anggaran" placeholder="Mata Anggaran" value="<?php echo $data['mata_anggaran'];?>" readonly />
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
                <input type="text" class="span11" name="" placeholder="Kota Asal" value="Bireuen" disabled />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tujuan :</label>
              <div class="controls">
                <select name="tujuan" required> 
                <option>...</option>
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
              <label class="control-label">Alat Transportasi :</label>
              <div class="controls">
                <select name="transportasi[]" multiple >
                <option>Taxi</option>
                  <option>Mini Bus</option>
                  <option>Bus</option>
                  <option>Kereta Api</option>
                  <option>Kapal Laut</option>
                  <option>Pesawat</option>
                </select>
                <br>
                Pilih ulang jika ingin merubah
                <br>
                <?php 
                $sql_ = "SELECT * FROM spd_transportasi WHERE no_spd='$id_spd'";
                $tampil_ = mysqli_query($koneksi, $sql_);     
                while ($data_ = mysqli_fetch_array($tampil_)){

                echo "<span class='badge badge-info'>- ".$data_['transportasi']."</span>"; 
                }
                ?>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Tgl Berangkat :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_berangkat" data-date-format="dd-mm-yyyy"value="<?php echo $data['tgl_berangkat'];?>" class="datepicker span6"></div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tgl Kembali :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_kembali" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_kembali'];?>" class="datepicker span6">
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
              <label class="control-label">TTD Pejabat :</label>
              <div class="controls">
                <select name="ttd" required>   
                  <option>...</option>                
                  <?php
                    $sql_ttd = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    while ($data_ttd = mysqli_fetch_array($tampil_ttd)) {
                  ?>    
                <option value="<?php echo $data_ttd['id_ttd']; ?>" <?php if ($data_ttd['id_ttd'] == $data['ttd']) { echo "selected"; } ?>><?php echo ucfirst($data_ttd['ttd']); ?> (<?php echo ucfirst($data_ttd['nama']); ?>)</option>
              <?php  } ?>
                </select>
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
                <select name="tiba_di_1" required> 
                <option>...</option>
                <?php
                  $sql_1 = "SELECT * FROM kota";
                  $tampil_1 = mysqli_query($koneksi, $sql_1);     
                  while ($data_1 = mysqli_fetch_array($tampil_1)) {
                  ?>
                  <option value="<?php echo $data_1['id_kota']; ?>"  <?php if($data_1['id_kota'] == $tiba_di_1) echo "selected" ?>><?php echo $data_1['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_1" data-date-format="dd-mm-yyyy" value="<?php echo $data['pada_tgl_1'];?>" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangkat_dari_1" required> 
                <option>...</option>
                <?php
                  $sql_dari = "SELECT * FROM kota";
                  $tampil_dari = mysqli_query($koneksi, $sql_dari);     
                  while ($data_dari = mysqli_fetch_array($tampil_dari)) {
                  ?>
                  <option value="<?php echo $data_dari['id_kota']; ?>" <?php if($data_dari['id_kota'] == $berangkat_dari_1) echo "selected" ?>><?php echo $data_dari['kota']; ?></option>
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
                  $sql_ke_1 = "SELECT * FROM kota";
                  $tampil_ke_1 = mysqli_query($koneksi, $sql_ke_1);     
                  while ($data_ke_1 = mysqli_fetch_array($tampil_ke_1)) {
                  ?>
                  <option value="<?php echo $data_ke_1['id_kota']; ?>" <?php if($data_ke_1['id_kota'] == $ke_1) echo "selected" ?>><?php echo $data_ke_1['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_11" data-date-format="dd-mm-yyyy" value="<?php echo $data['pada_tgl_11'];?>" class="datepicker span6"></div>
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
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_2" data-date-format="dd-mm-yyyy" value="<?php echo $data['pada_tgl_2'];?>" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangkat_dari_2" required> 
                <option>...</option>
                <?php
                  $sql_dari2 = "SELECT * FROM kota";
                  $tampil_dari2 = mysqli_query($koneksi, $sql_dari2);     
                  while ($data_dari2 = mysqli_fetch_array($tampil_dari2)) {
                  ?>
                  <option value="<?php echo $data_dari2['id_kota']; ?>" <?php if($data_dari2['id_kota'] == $berangkat_dari_2) echo "selected" ?>><?php echo $data_dari2['kota']; ?></option>
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
                  $sql_ke_2 = "SELECT * FROM kota";
                  $tampil_ke_2 = mysqli_query($koneksi, $sql_ke_2);     
                  while ($data_ke_2 = mysqli_fetch_array($tampil_ke_2)) {
                  ?>
                  <option value="<?php echo $data_ke_2['id_kota']; ?>" <?php if($data_ke_2['id_kota'] == $ke_2) echo "selected" ?>><?php echo $data_ke_2['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_22" value="<?php echo $data['pada_tgl_22'];?>" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
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
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_3" data-date-format="dd-mm-yyyy" value="<?php echo $data['pada_tgl_3'];?>" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangkat_dari_3" required> 
                <option>...</option>
                <?php
                  $sql_dari3 = "SELECT * FROM kota";
                  $tampil_dari3 = mysqli_query($koneksi, $sql_dari3);     
                  while ($data_dari3 = mysqli_fetch_array($tampil_dari3)) {
                  ?>
                  <option value="<?php echo $data_dari3['id_kota']; ?>" <?php if($data_dari3['id_kota'] == $berangkat_dari_3) echo "selected" ?>><?php echo $data_dari3['kota']; ?></option>
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
                  $sql_ke_3 = "SELECT * FROM kota";
                  $tampil_ke_3 = mysqli_query($koneksi, $sql_ke_3);     
                  while ($data_ke_3 = mysqli_fetch_array($tampil_ke_3)) {
                  ?>
                  <option value="<?php echo $data_ke_3['id_kota']; ?>" <?php if($data_ke_3['id_kota'] == $ke_3) echo "selected" ?>><?php echo $data_ke_3['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_33" value="<?php echo $data['pada_tgl_33'];?>" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>
            <div class="row-fluid">
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
                <select name="tiba_di_4" required> 
                <option>...</option>
                <?php
                  $sql_4 = "SELECT * FROM kota";
                  $tampil_4 = mysqli_query($koneksi, $sql_4);     
                  while ($data_4 = mysqli_fetch_array($tampil_4)) {
                  ?>
                  <option value="<?php echo $data_4['id_kota']; ?>" <?php if($data_4['id_kota'] == $tiba_di_4) echo "selected" ?>><?php echo $data_4['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_4" data-date-format="dd-mm-yyyy" value="<?php echo $data['pada_tgl_4'];?>" class="datepicker span6"></div>
              </div>
            </div>  
            <div class="control-group">
              <label class="control-label">Berangkat dari :</label>
              <div class="controls">
                <select name="berangkat_dari_4" required> 
                <option>...</option>
                <?php
                  $sql_dari4 = "SELECT * FROM kota";
                  $tampil_dari4 = mysqli_query($koneksi, $sql_dari4);     
                  while ($data_dari4 = mysqli_fetch_array($tampil_dari4)) {
                  ?>
                  <option value="<?php echo $data_dari4['id_kota']; ?>" <?php if($data_dari4['id_kota'] == $berangkat_dari_4) echo "selected" ?>><?php echo $data_dari4['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <select name="ke_4" required> 
                <option>...</option>
                <?php
                  $sql_ke_4 = "SELECT * FROM kota";
                  $tampil_ke_4 = mysqli_query($koneksi, $sql_ke_4);     
                  while ($data_ke_4 = mysqli_fetch_array($tampil_ke_4)) {
                  ?>
                  <option value="<?php echo $data_ke_4['id_kota']; ?>" <?php if($data_ke_4['id_kota'] == $ke_4) echo "selected" ?>><?php echo $data_ke_4['kota']; ?></option>
                <?php } ?>
                </select>
              </div>
            </div> 
             <div class="control-group">
              <label class="control-label">Pada Tgl :</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="pada_tgl_44" value="<?php echo $data['pada_tgl_44'];?>" data-date-format="dd-mm-yyyy" class="datepicker span6"></div>
              </div>
            </div>
            
        </div>
      </div>
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