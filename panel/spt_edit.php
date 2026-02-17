<?php include 'session.php' ?> 
<?php

include "../koneksi/koneksi.php";

$id_spt =  addslashes($_GET['id']);
$sql = "SELECT * FROM spt WHERE id_spt = '$id_spt'";
$tampil = mysqli_query($koneksi, $sql);     
$data = mysqli_fetch_array($tampil);
$no_spt = $data['no_spt'];
$berwenang = $data['berwenang'];

?>

<script src="../js/jquery.js"></script>
<script>

    $(document).ready(function(){
        $('#no_spt').blur(function(){
            $('#pesan').html('<img style="margin-left:10px; width:10px" src="../img/loading.gif">');
            var no_spt = $(this).val();

            $.ajax({
                type    : 'POST',
                url     : 'spt_cek.php',
                data    : 'no_spt='+no_spt,
                success : function(data){
                    $('#pesan').html(data);
                }
            })

        });
    });
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=spt" class="tip-bottom">SPT</a> <a href="#" class="current">Edit Data SPT</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>EDIT DATA SPT</h3>    
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Data SPT</h5>           
        </div>
        <form class="form-horizontal" method="post" action="?page=ses" name="" enctype="multipart/form-data">
          <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPT Berhasil Diubah!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Ubah Data SPT!</div>       
            <?php } ?>
        <div class="widget-content nopadding form-horizontal">           
            <!--<div class="control-group">
              <label class="control-label">Nomor SPT :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="id_spt" placeholder="Nomor SPT" value="<?php echo $data['id_spt']; ?>" required />
                <input type="hidden" class="span11" name="no_spt" placeholder="Nomor SPT" value="<?php echo $data['no_spt']; ?>" required />
                <input type="text" class="span11" name="" placeholder="Nomor SPT" value="<?php echo $data['no_spt']; ?>" disabled />
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Nomor SPT :</label>
              <div class="controls">
                <input type="hidden" class="span11" name="id_spt" placeholder="Nomor SPT" value="<?php echo $id_spt ?>" required />
                <strong>Peg. 800/SPT/ <input type="text" class="span1" name="no_spt" id="no_spt" value="<?php echo $data['no_spt']; ?>" placeholder="" /> /<?php echo substr($data['tgl_spt'],-4);?></strong><br>
                <span id="pesan"></span>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Tanggal SPT:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_spt" data-date-format="dd-mm-yyyy" value="<?php echo $data['tgl_spt']; ?>" class="datepicker span4">
                </div>
              </div>
            </div>            
            <!--<div class="control-group">
              <label class="control-label">Yang Memberi Perintah :</label>
              <div class="controls">
                <input type="text" class="span11" name="memberi_perintah" value="<?php echo $data['memberi_perintah']; ?>" placeholder="Yang Memberi Perintah" />
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Pejabat Berwenang :</label>
              <div class="controls">
                <select name="pejabat_berwenang" required>    
                  <option value="...">...</option>                
                  <?php
                    $sql1 = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE defult='Y' ORDER BY id_ttd_pejabat ASC";
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
                <?php if ($data['cek_spt'] == 'KK') {
                 
                $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY golongan DESC";
                $tampil_ = mysqli_query($koneksi, $sql_);     
                while ($data_ = mysqli_fetch_array($tampil_)){

                echo "<span class='badge badge-info'>- ".$data_['nama']."</span><br>"; 
                }
                
                }else{ ?>
                <?php 
                $sql_pengikut = "SELECT * FROM pengikut WHERE no_spt='$id_spt'";
                  $tampil_pengikut = mysqli_query($koneksi, $sql_pengikut); 
                  while($data_pengikut = mysqli_fetch_array($tampil_pengikut)){
                ?>
                <input type="hidden" name="id_pengikut" value="<?php echo $data_pengikut['id_pengikut']; ?>">
                <p><select name="pengikut[]" class="span6">
                <?php

                  $sql2 = "SELECT * FROM pegawai";
                  $tampil2 = mysqli_query($koneksi, $sql2);     
                  while ($data2 = mysqli_fetch_array($tampil2)) {
                                
                ?>
                
                <option value="<?php echo $data2['nip']; ?>" <?php if ($data2['nip'] == $data_pengikut['pengikut'])  echo "selected" ?>><?php echo ucfirst($data2['nama']); ?>
                <?php if ($data2['nip'] < 999999999999) { echo "<center> (".ucfirst($data2['jabatan']).")</center>"; }else{?>
                (<?php echo $data2['nip']; ?>) <?php }?></option>
              <?php  } ?>
                </select>
                <a href="?page=spthn&id=<?php echo $data_pengikut['id_pengikut']; ?>"><span class='label label-important tip-bottom' data-original-title='Delete'><span class='icon-trash'></span><span></a></p>
                <?php }}?>

                <input id="idf" value="" type="hidden" />
                  <div id="div"></div>
                  <button type="button" onclick="tambah(); return false;" class="btn btn-success"><span class="icon-plus"></span> Yang Ditugaskan</button>
              </div>
            </div>

            
            <div class="control-group">
              <label class="control-label">Dasar Penugasan :</label>
              <div class="controls">
              <textarea class="textarea_editor span11" rows="6" name="dasar_penugasan" placeholder="Enter text ..."><?php echo ucfirst($data['dasar_penugasan']); ?></textarea>
            </div>
            </div>
            <div class="control-group">
              <label class="control-label">Untuk :</label>
              <div class="controls"><textarea class="span11" name="keterangan" ><?php echo ucfirst($data['keterangan']); ?></textarea><br>
                Ket : untuk tulisan miring masukkan kode <?php echo htmlspecialchars("<i>"); ?> di depan dan <?php echo htmlspecialchars("</i>"); ?> untuk penutup. contoh : <i><?php echo htmlspecialchars("<i>huruf miring</i>"); ?></i></div>
            </div>
            <div class="control-group">
              <label class="control-label">TTD U.B :</label>
              <div class="controls">
                <select name="ttd"class="span11">   
                  <option value="">...</option>                
                  <?php
                    $sql_ttd = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    while ($data_ttd = mysqli_fetch_array($tampil_ttd)) {
                  ?>    
                <option value="<?php echo $data_ttd['id_ttd']; ?>" <?php if ($data_ttd['id_ttd'] == $data['ttd_ub']) { echo "selected"; } ?>><?php echo ucfirst($data_ttd['nama']); ?> (<?php echo ucfirst($data_ttd['jabatan']); ?>)</option>
              <?php  } ?>
                </select>
              </div>
            </div>
            <?php if ($data['cek_spt'] == 'F') {
            }elseif ($data['cek_spt'] == 'O') {              
            }elseif ($data['cek_spt'] == 'K') {              
            }else{ ?>
            <div class="control-group">
              <label class="control-label">Gunakan SPD :</label>
              <div class="controls">
                <select name="spd"class="span2" required>   
                  <option <?php if($data['cek_spt'] == 'N') echo "selected" ?> value='N'>Tidak</option>
                  <option <?php if($data['cek_spt'] == 'Y') echo "selected" ?> value='Y'>Ya</option>
                </select>
              </div>
            </div>
          <?php  }?>
            <div class="row-fluid">
             <div class="form-actions">
              <center>
                        <button type="submit" class="btn btn-success">Save</button>
                        <!--<button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-info">Edit</button>-->
                        <a href="?page=spt" class="btn btn-danger">Cancel</a>
                        </center>
              </div>
            </div>  
             <!--<div class="control-group">
              <label class="control-label">Keterangan Lainnya :</label>
              <div class="controls"><textarea class="span11" name="keterangan" ><?php echo ucfirst($data['keterangan']); ?></textarea></div>
            </div>-->
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


<script type="text/javascript" src="../js/jquery.min.js"></script>
<script language="javascript">
   function tambah() {
     var idf = document.getElementById("idf").value;
     var stre;
     stre="<p id='srow" + idf + "'><select name='pengikut_[]'  class='span6'><?php $sql2 = 'SELECT * FROM pegawai ORDER BY nama ASC';$tampil2 = mysqli_query($koneksi, $sql2); while ($data2 = mysqli_fetch_array($tampil2)) {?><option value='<?php echo $data2['nip']; ?>'><?php echo ucfirst($data2['nama']); ?><?php if ($data2['nip'] < 999999999999) { echo '<center> ('.ucfirst($data2['jabatan']).')</center>'; }else{?>(<?php echo ucfirst($data2['nip']); ?>) <?php }?></option><?php  } ?></select> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen(\"#srow" + idf + "\"); return false;'><span class='label label-important tip-bottom' data-original-title='Delete'><span class='icon-trash'></span><span></a></p>";
     $("#div").append(stre);
     idf = (idf-1) + 2;
     document.getElementById("idf").value = idf;
   }
   function hapusElemen(idf) {
     $(idf).remove();
   }
</script>