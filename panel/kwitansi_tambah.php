<?php //include 'session.php' ?>
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
  <h4 class="alert-heading">Success!</h4>Data Kwitansi Berhasil Disimpan!</div>
  <?php } else if ($msg == 2) {?>
  <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
  <h4 class="alert-heading">Error!</h4>
  Gagal Menyimpan Data Kwitansi!</div>       
<?php } ?>

<?php 
  
$id_spt = $_GET['id'];

$sql_a = "SELECT * FROM spt WHERE id_spt = '$id_spt' ";
$tampil_a = mysqli_query($koneksi, $sql_a);     
$data_a = mysqli_fetch_array($tampil_a);

?>
<form class="form-horizontal" method="post" action="?page=kws" name="" enctype="multipart/form-data">

<div class="row-fluid">
<div class="widget-box collapsible">
          <div class="widget-title"> <a href="#collapseOne" data-toggle="collapse"> <span class="icon"><i class="icon-align-justify"></i></span>
            <h5>Kwitansi</h5>
            </a> </div>
          <div class="collapse in" id="collapseOne">
            <div class="widget-content">
          <input type="hidden" class="span11" name="id_kw" id="id_kw" value="<?php echo $data['id_kw']; ?>" required />          
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
                <input type="text" class="span11" name="no_spt" placeholder="Nomor SPD" value="100.3.5/SPT/<?php echo $data_a['no_spt']; ?>/<?php echo substr($data_a['tgl_spt'],-4);?>" disabled /><br>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Tgl Kwitansi</label>
              <div class="controls">
                <div class="control-group">                  
                    <input type="text" data-date="01-02-2013" name="tgl_kw" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y') ?>" class="datepicker span3" required>
                </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Kode Rekening</label>
              <div class="controls">
                <select name="kode_rek" class="span2">
                  <option value="5.2.2.15.001">5.2.2.15.001</option>
                  <option value="5.2.2.15.002" selected>5.2.2.15.002</option>
                  <option value="5.2.2.15.003">5.2.2.15.003</option>
				  <option value="5.1.02.04.01.0001">5.1.02.04.01.0001</option>
				  <option value="5.1.02.04.01.0002">5.1.02.04.01.0002</option>
				  <option value="5.1.02.04.01.0003">5.1.02.04.01.0003</option>
				  <option value="5.1.02.04.01.0004">5.1.02.04.01.0004</option>
				  <option value="5.1.02.04.01.0005">5.1.02.04.01.0005</option>
				  <option value="5.1.02.04.02.0001">5.1.02.04.02.0001</option>
                </select>
                <!--<input type="text" class="span3" name="kode_rek" placeholder="Kode Rekening" />-->
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Tahun</label>
              <div class="controls">
                <input type="text" name="tahun" class="span1" value="<?php echo date('Y') ?>" readonly>
                <!--<select name="tahun" class=" span3" required>    
                  <option <?php if($data['tahun'] == '2019') echo "selected" ?> value="2019" >2019</option>
                  <option <?php if($data['tahun'] == '2020') echo "selected" ?> value="2020" >2020</option>
                  <option <?php if($data['tahun'] == '2021') echo "selected" ?> value="2021" >2021</option>
                  <option <?php if($data['tahun'] == '2022') echo "selected" ?> value="2022" >2022</option>
                  <option <?php if($data['tahun'] == '2023') echo "selected" ?> value="2023" >2023</option>
                  <option <?php if($data['tahun'] == '2024') echo "selected" ?> value="2024" >2024</option>
                </select>-->
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
                <option value="<?php echo $data['id_ttd_pejabat']; ?>"><?php echo ucfirst($data['nama']); ?></option>
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
                <option value="<?php echo $data['id_ttd_pejabat']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Pilih Pagu</label>
              <div class="controls">
                <select name="pagu" required>             
                <option value="" ></option>  
                <option <?php if($data['pagu'] == 'luar_kota') echo "selected" ?> value="luar_kota" >Setdakab Luar Daerah</option>
                <option <?php if($data['pagu'] == 'dalam_kota') echo "selected" ?> value="dalam_kota" >Setdakab Dalam Daerah</option>
                <option <?php if($data['pagu'] == 'kdh_dalam_kota') echo "selected" ?> value="kdh_dalam_kota" >KDH/WKDH Dalam Daerah</option>
                <option <?php if($data['pagu'] == 'kdh_luar_kota') echo "selected" ?> value="kdh_luar_kota" >KDH/WKDH Luar Daerah</option>
              
                </select>
                <br><strong><i>Ket : Pagu harus dipilih dengan benar. Pagu yang salah tidak dapat diubah kembali</i></strong>
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
        <?php if ($nip >= 999999999999) { echo "( Nip. ".konversi_nip($nip)." )";} ?>
        &nbsp;&nbsp;&nbsp;<b><i class="icon-sort-down"></i></b>
      </h5>
    </a>
  </div>

  <div class="collapse" id="<?php echo $nip ?>">
    <div class="widget-content">
      <input type="hidden" id="idf_<?php echo $nip ?>" value="1" />

      <div class="control-group">
        <label class="control-label">Lampiran SPD Nomor</label>
        <div class="controls">
          <input type="hidden" name="penerima1[]" value="<?php echo $nip ?>" />
          <input type="number" name="no_spd[]" class="span4" placeholder="Nomor SPD" />
        </div>
      </div>

      <div id="div_<?php echo $nip ?>"></div>

      <div class="control-group">
        <div class="controls">
          <button type="button" class="btn btn-info"
            onclick="tambahRincian('<?php echo $nip ?>', '<?php echo $id_spt ?>')">
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
              <a href="?page=kwtc&id=<?php echo $id_spt; ?>" class="btn btn-danger">Cancel</a>
              </center>
    </div>
  </div>
 </form>
</div></div></div>


<!--end-Footer-part--> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script>
  $('.textarea_editor').wysihtml5();
  function tambahRincian(nip, id_spt) {
  var counter = document.getElementById("idf_" + nip).value;
  var target = $("#div_" + nip);

  var html = `
    <div id="srow_${nip}_${counter}">
      <input type="hidden" name="spt[]" value="${id_spt}" />
      <input type="hidden" name="penerima[]" value="${nip}" />

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
  document.getElementById("idf_" + nip).value = parseInt(counter) + 1;
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


