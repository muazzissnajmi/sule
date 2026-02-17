<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";

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
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=kwitansi" class="tip-bottom">Kwitansi</a> <a href="#" class="current">Edit Kwitansi</a></div>
  
</div>
<div class="container-fluid">
<h3>Kwitansi</h3> 

<?php
$msg = isset($_GET['msg']) ? $_GET['msg'] : null;            
  if ($msg == 1) { ?>
  <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">Success!</h4>Data Kwitansi Berhasil Diedit!</div>
  <?php } else if ($msg == 2) {?>
  <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">Error!</h4>
  Gagal mengubah Data Kwitansi!</div>       
<?php } ?>

<?php 
  
$id_spt = $_GET['id'];

$sql_a = "SELECT * FROM kwitansi WHERE id_spt = '$id_spt'";
$tampil_a = mysqli_query($koneksi, $sql_a);     
$data_a = mysqli_fetch_array($tampil_a);
$pengguna = $data_a['pengguna'];
$bendahara = $data_a['bendahara'];

$sql_s = "SELECT * FROM spt WHERE id_spt = '$id_spt'";
$tampil_s = mysqli_query($koneksi, $sql_s);     
$data_s = mysqli_fetch_array($tampil_s);

?>
<form class="form-horizontal" method="post" action="?page=kwes" name="" enctype="multipart/form-data">

<div class="row-fluid">
<div class="widget-box collapsible">
          <div class="widget-title"> <a href="#collapseOne" data-toggle="collapse"> <span class="icon"><i class="icon-align-justify"></i></span>
            <h5>Kwitansi</h5>
            </a> </div>
          <div class="collapse in" id="collapseOne">
            <div class="widget-content">
          <input type="hidden" class="span11" name="id_kw" id="id_kw" value="<?php echo $data_a['id_kw']; ?>" required />          
            <!--<div class="control-group">
              <label class="control-label">No. Kwitansi</label>
              <div class="controls">
                
                <input type="text" class="span11" name="no_kw" id="no_kw" placeholder="Nomor Kwitansi" value="<?php echo $data['no_kw']; ?>" required /><br>
                <span id="pesan"></span>
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Lampiran SPT Nomor</label>
              <div class="controls">
                <input type="hidden" class="span11" name="id_spt" placeholder="Nomor SPT" value="<?php echo $id_spt; ?>" />                
                <input type="text" class="span11" name="no_spt" placeholder="Nomor SPD" value="100.3.5/SPT/<?php echo $data_s['no_spt']; ?>/<?php echo substr($data_s['tgl_spt'],-4);?>" disabled /><br>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Tgl Kwitansi</label>
              <div class="controls">
                <div class="control-group">                  
                    <input type="text" data-date="01-02-2013" name="tgl_kw" data-date-format="dd-mm-yyyy" value="<?php echo $data_a['tgl_kw']; ?>" class="datepicker span3" required>
                </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kode Rekening</label>
              <div class="controls">
                <select name="kode_rek" class="span2">
                  <option <?php if($data_a['kode_rek'] == '5.2.2.15.001') echo "selected" ?> value="5.2.2.15.001">5.2.2.15.001</option>
                  <option <?php if($data_a['kode_rek'] == '5.2.2.15.002') echo "selected" ?> value="5.2.2.15.002">5.2.2.15.002</option>
                  <option <?php if($data_a['kode_rek'] == '5.2.2.15.003') echo "selected" ?> value="5.2.2.15.003">5.2.2.15.003</option>
				  <option <?php if($data_a['kode_rek'] == '5.1.02.04.01.0001') echo "selected" ?> value="5.1.02.04.01.0001">5.1.02.04.01.0001</option>
				  <option <?php if($data_a['kode_rek'] == '5.1.02.04.01.0002') echo "selected" ?> value="5.1.02.04.01.0002">5.1.02.04.01.0002</option>
				  <option <?php if($data_a['kode_rek'] == '5.1.02.04.01.0003') echo "selected" ?> value="5.1.02.04.01.0003">5.1.02.04.01.0003</option>
				  <option <?php if($data_a['kode_rek'] == '5.1.02.04.01.0004') echo "selected" ?> value="5.1.02.04.01.0004">5.1.02.04.01.0004</option>
				  <option <?php if($data_a['kode_rek'] == '5.1.02.04.01.0005') echo "selected" ?> value="5.1.02.04.01.0005">5.1.02.04.01.0005</option>
				  <option <?php if($data_a['kode_rek'] == '5.1.02.04.02.0001') echo "selected" ?> value="5.1.02.04.02.0001">5.1.02.04.02.0001</option>
                </select>
                <!--<input type="text" class="span3" name="kode_rek" placeholder="Kode Rekening" />-->
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Tahun</label>
              <div class="controls">
                <!--<input type="text" name="tahun" class="span1" value="<?php echo date('Y') ?>" >-->
                <select name="tahun" class=" span3" required>    
                  <option <?php if($data['tahun'] == '2019') echo "selected" ?> value="2019" >2019</option>
                  <option <?php if($data['tahun'] == '2020') echo "selected" ?> value="2020" >2020</option>
                  <option <?php if($data['tahun'] == '2021') echo "selected" ?> value="2021" >2021</option>
                  <option <?php if($data['tahun'] == '2022') echo "selected" ?> value="2022" >2022</option>
                  <option <?php if($data['tahun'] == '2023') echo "selected" ?> value="2023" >2023</option>
                  <option <?php if($data['tahun'] == '2024') echo "selected" ?> value="2024" >2024</option>
                </select>
              </div>
            </div>   
                        
            <div class="control-group">
              <label class="control-label">Pengguna Anggaran</label>
              <div class="controls">
                <select name="pengguna_anggaran" required>    
                  <?php
                  $sql = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult = 'Y'";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_ttd_pejabat']; ?>" <?php if($data['id_ttd_pejabat'] == $pengguna) echo "selected" ?>><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Bendahara</label>
              <div class="controls">
                <select name="bendahara" required>    
                  <?php
                  $sql = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult = 'T'";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_ttd_pejabat']; ?>" <?php if($data['id_ttd_pejabat'] == $bendahara) echo "selected" ?>><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Pagu</label>
              <div class="controls" >
                <select name="" disabled>                   
                <option <?php if($data_a['pagu'] == 'luar_kota') echo "selected"; ?> value="luar_kota" >Setdakab Luar Daerah</option>
                <option <?php if($data_a['pagu'] == 'dalam_kota') echo "selected"; ?> value="dalam_kota" >Setdakab Dalam Daerah</option>
                <option <?php if($data_a['pagu'] == 'kdh_dalam_kota') echo "selected"; ?> value="kdh_dalam_kota" >KDH/WKDH Dalam Daerah</option>
                <option <?php if($data_a['pagu'] == 'kdh_luar_kota') echo "selected"; ?> value="kdh_luar_kota" >KDH/WKDH Luar Daerah</option>
              
                </select>
              </div>
            </div>
            <input type="hidden" name="pagu" value="<?php echo $data_a['pagu']; ?>">

            <div class="control-group">              
              <div class="controls" >
               <?php
                $sql_kw2 = "SELECT * FROM kwitansi_nilai WHERE id_spt = '$id_spt' ";
                $tampil_kw2 = mysqli_query($koneksi, $sql_kw2);
                $total_kw= 0;
                while($data_kw2 = mysqli_fetch_array($tampil_kw2)){
                $hari = $data_kw2['hari'];
                  
                if ($data_kw2['hari'] == '0') {
                $hari_kw = $data_kw2['hari']+1;
                }else{
                $hari_kw = $data_kw2['hari'];
                }

                $nilai_kw = $data_kw2['nominal'] * $hari_kw;

                $total_kw+=$nilai_kw;
                  
                }

              if ($total_kw == '') {                    
                      //echo '0'; 
                  echo "<input type='hidden' name='total_kw' class='span3' value='0'>";
                  } else {
                      //echo $total_kw; 
                  echo "<input type='hidden' name='total_kw' class='span3' value='$total_kw'>";
                  };
              ?>
              </div>
            </div>

          </div>
        </div>
      </div>       
      


<?php

$sql = "SELECT * FROM kwitansi INNER JOIN pegawai ON kwitansi.nip=pegawai.nip WHERE id_spt = '$id_spt'";
$tampil = mysqli_query($koneksi, $sql); 
$no=1;   
while ($data = mysqli_fetch_array($tampil)){
$nip = $data['nip'];

$sql_spd = "SELECT * FROM spd WHERE id_spt = '$id_spt'";                    
$tampil_spd = mysqli_query($koneksi, $sql_spd);                         
$data_spd = mysqli_fetch_array($tampil_spd);

$sql_kwn = "SELECT * FROM kwitansi_nilai WHERE nip = '$nip'";                    
$tampil_kwn = mysqli_query($koneksi, $sql_kwn);                         
$data_kwn = mysqli_fetch_array($tampil_kwn);

$tujuan1 = $data_spd['id_kota_tujuan'];
$tujuan2 = $data_spd['tiba_di_2'];
$tujuan3 = $data_spd['tiba_di_3'];

$sql3 = "SELECT * FROM kota WHERE id_kota = '$tujuan1'";                    
$tampil3 = mysqli_query($koneksi, $sql3);                         
$data3 = mysqli_fetch_array($tampil3); 

$sql4 = "SELECT * FROM kota WHERE id_kota = '$tujuan2'";
$tampil4 = mysqli_query($koneksi, $sql4);                         
$data4 = mysqli_fetch_array($tampil4);

$sql5 = "SELECT * FROM kota WHERE id_kota = '$tujuan3'";                    
$tampil5 = mysqli_query($koneksi, $sql5);                         
$data5 = mysqli_fetch_array($tampil5); 
//echo $data5['tiba_di_3'];                   

?>



<div class="widget-box collapsible">
  <div class="widget-title">
    <a href="#<?php echo $nip ?>" data-toggle="collapse">
      <span class="icon"><b><?php echo $no++; ?></b></span>
      <h5>
        <?php echo $data['nama']; ?>
        <?php if ($nip >= 999999999999) { echo "( Nip. ".konversi_nip($nip)." )"; } ?>
        &nbsp;&nbsp;&nbsp;<b><i class="icon-sort-down"></i></b>
      </h5>
    </a>
  </div>

  <div class="collapse" id="<?php echo $nip ?>">
    <div class="widget-content">
      <input id="idf_<?php echo $nip ?>" value="1" type="hidden" />

      <div class="control-group">
        <label class="control-label">Lampiran SPD Nomor</label>
        <div class="controls">
          <input type="hidden" name="penerima1[]" value="<?php echo $nip ?>" />
          <input type="number" class="span4" name="no_spd[]" 
                 value="<?php echo $data['no_spd']; ?>" placeholder="Nomor SPD" />
        </div>
      </div>

      <?php 
      $sql_kwe = "SELECT * FROM kwitansi_nilai 
                  INNER JOIN kwitansi_kategori 
                  ON kwitansi_nilai.kategori = kwitansi_kategori.id_kategori_kw 
                  WHERE id_spt = '$id_spt' AND nip = '$nip'";
      $tampil_kwe = mysqli_query($koneksi, $sql_kwe);  
      while ($data_kwe = mysqli_fetch_array($tampil_kwe)) { ?>
        <input type="hidden" name="kategori2[]" value="<?php echo $data_kwe['id_kategori_kw']; ?>" />
        <input type="hidden" name="id_nilai[]" value="<?php echo $data_kwe['id_nilai']; ?>" />
        <input type="hidden" name="spt2[]" value="<?php echo $id_spt ?>" />
        <input type="hidden" name="penerima2[]" value="<?php echo $nip ?>" />

        <label class="control-label"><?php echo ucfirst($data_kwe["kategori"]); ?></label>
        <div class="control-group">           
          <div class="controls">
            <div class="input-prepend"> 
              <span class="add-on">Rp.</span>
              <input type="hidden" name="nominal_lama[]" value="<?php echo $data_kwe['nominal'] ?>">
              <input type="number" name="nominal2[]" value="<?php echo $data_kwe['nominal'] ?>" class="span11">
            </div>
            &nbsp;
            <div class="input-prepend">                     
              <input type="number" name="hari2[]" value="<?php echo $data_kwe['hari'] ?>" class="span3"> 
              <span class="add-on"><?php echo $data_kwe['k_hari'] ?></span>
            </div>
            <div class="input-prepend"> 
              <span class="add-on">Ket.</span>
              <input type="text" name="ket2[]" value="<?php echo $data_kwe['ket'] ?>">
            </div>
          </div>
          <div class="controls">
            <select name="k_hari2[]" class="span2">
              <option value="hari" <?php if($data_kwe['k_hari'] == 'hari') echo "selected"; ?>>Hari</option>
              <option value="liter" <?php if($data_kwe['k_hari'] == 'liter') echo "selected"; ?>>Liter</option>
            </select>
          </div>
        </div>
      <?php } ?>

      <div id="div_<?php echo $nip ?>"></div>

      <div class="control-group">
        <div class="controls">
          <button type="button" class="btn btn-info"
            onclick="tambahRincian('<?php echo $nip ?>','<?php echo $id_spt ?>')">
            <span class="icon-plus"></span> Rincian Kwitansi
          </button>
        </div>
      </div>
    </div>
  </div>
</div>


<?php } ?>

  <div class="row-fluid">
   <div class="form-actions">
    <center>
              <button type="submit" class="btn btn-success" onclick="return confirm('Harap cek kembali sebelum disimpan!!')">Save</button>
              <!--<button type="reset" class="btn btn-primary">Reset</button>
              <button type="submit" class="btn btn-info">Edit</button>-->
              <a href="?page=kwitansi" class="btn btn-danger">Cancel</a></form>                            
              <a href="#myAlert" data-toggle="modal" class="btn btn-inverse">Final</a>
              <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Peringatan!!</h3>
              </div>
              <div class="modal-body">
                <p><b>Harap tekan tombol Save jika ada perubahan dan cek kembali sebelum di Finalkan!!</b><br>Kwitansi yang sudah final tidak bisa diubah kembali.</p>
              </div>
              <div class="modal-footer"> <a class="btn btn-danger" href="?page=kwf&id=<?php echo $id_spt; ?>">Confirm</a> <a data-dismiss="modal" class="btn" href="#">Cancel</a> </div>
            </div>
            </center>

    </div>
  </div>
 
</div></div></div>


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
  
  function tambahRincian(nip, id_spt) {
  var counterInput = document.getElementById("idf_" + nip);
  var counter = parseInt(counterInput.value);
  var target = $("#div_" + nip);

  var html = `
    <div id="srow_${nip}_${counter}">
      <input type="hidden" name="spt[]" value="${id_spt}">
      <input type="hidden" name="penerima[]" value="${nip}">
      <label class="control-label">Rincian</label>
      <div class="control-group">
        <div class="controls">
          <select name="kategori[]" required>
            <?php 
              $sql_rinci = 'SELECT * FROM kwitansi_kategori ORDER BY id_kategori_kw ASC';
              $tampil_rinci = mysqli_query($koneksi, $sql_rinci);
              while ($data_rinci = mysqli_fetch_array($tampil_rinci)) {
                echo "<option value='{$data_rinci['id_kategori_kw']}'>".ucfirst($data_rinci['kategori'])."</option>";
              }
            ?>
          </select>
        </div>
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on">Rp.</span>
            <input type="number" name="nominal[]" value="0" class="span11">
          </div>
          &nbsp;
          <div class="input-prepend">
            <input type="number" name="hari[]" value="0" class="span3">
            <select name="k_hari[]" class="span4">
              <option value="hari">Hari</option>
              <option value="liter">Liter</option>
            </select>
          </div>
          <div class="input-prepend">
            <span class="add-on">Ket.</span>
            <input type="text" name="ket[]" value="">
          </div>
          &nbsp;
          <a href="#" style="color:#3399FD;"
             onclick="hapusRincian('srow_${nip}_${counter}'); return false;">
            <span class="label label-important tip-bottom" data-original-title="Delete">
              <span class="icon-trash"></span>
            </span>
          </a>
        </div>
      </div>
    </div>`;

  target.append(html);
  counterInput.value = counter + 1;
}

function hapusRincian(id) {
  $("#" + id).remove();
}

</script>


<script type ="text/javascript">
    $(".perhitungan").keyup(function(){
      var penginapan = parseInt($("#penginapan").val())
      var saku = parseInt($("#saku").val())
      var makan = parseInt($("#makan").val())
      var transport_lokal = parseInt($("#transport_lokal").val())
      var transport_pp = parseInt($("#transport_pp").val())
      var bbm = parseInt($("#bbm").val())
      var bbm_pp = parseInt($("#bbm_pp").val())
      
      var jumlah = penginapan + saku + makan + transport_lokal + transport_pp + bbm + bbm_pp;
      $("#jumlah").attr("value",jumlah)
      $("#jumlah2").attr("value",jumlah)
      
      });
  </script>

<script type="text/javascript">
  var rupiah = document.getElementById("rupiah");
rupiah.addEventListener("keyup", function(e) {
  // Add 'Rp.' as the prefix while the user types
  // Use the formatRupiah() function to convert the typed number into formatted currency
  this.value = formatRupiah(this.value, "Rp. ");
});

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
  var number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/g);

  // tambahkan titik jika yang di input sudah menjadi angka ribuan
  if (ribuan) {
    separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
  return prefix == undefined ? rupiah : (rupiah ? "" + rupiah : "");
}

</script>
