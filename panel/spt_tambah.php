<?php include 'session.php' ?>
<?php $page = 'sppd'; 
include "../koneksi/koneksi.php";
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
<script>

$(document).ready(function(){

    $('#pengikut').on('change', function(){

        $('#pesannama').html(
            '<img style="margin-left:10px; width:10px" src="../img/loading.gif">'
        );

        var nip = $(this).val(); // ARRAY

        if (!nip || nip.length === 0) {
            $('#pesannama').html('');
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'spt_ceknama.php',
            data: { nip: nip.join(',') }, // jadi "123,456"
            success: function(data){
                $('#pesannama').html(data);
            }
        });

    });

});
</script>
<script>
$(function(){

    $('#pengikut option').on('mousedown', function(e){
        e.preventDefault(); // hentikan default ctrl behavior

        const select = $(this).parent();
        const option = this;

        // toggle selected
        option.selected = !option.selected;

        // force refresh select value
        select.trigger('change');

        return false;
    });

});
</script>




<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="../css/colorpicker.css" />
<link rel="stylesheet" href="../css/datepicker.css" />
<link rel="stylesheet" href="../css/uniform.css" />
<link rel="stylesheet" href="../css/matrix-style.css" />
<link rel="stylesheet" href="../css/matrix-media.css" />
<link rel="stylesheet" href="../css/bootstrap-wysihtml5.css" />
<link href="../font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="../css/select2.min.css">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=spt" class="tip-bottom">SPT</a> <a href="#" class="current">Tambah SPT</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>S P T</h3>    
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input SPT</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
        <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data SPT Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data SPT!</div>       
            <?php } ?>
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nomor SPT :</label>
              <div class="controls">
                <strong>Peg. 800/SPT/ <input type="text" class="span2" name="no_spt" id="no_spt" placeholder="" /> /<?php echo date('Y');?></strong><br>
                <span id="pesan"></span>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Tanggal SPT:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_spt" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" class="datepicker span4">
              	</div>
              </div>
            </div>            
            <!--<div class="control-group">
              <label class="control-label">Yang Memberi Perintah :</label>
              <div class="controls">
                <select name="memberi_perintah" class="span3" required>    
                  <option value="bupati">Bupati</option>
                  <option value="wakil_bupati">Wakil Bupati</option>
                  <option value="sekda">Sekda</option>
                </select>                
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Pejabat Berwenang :</label>
              <div class="controls">
                <select name="pejabat_berwenang"class="span4" required>	
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
            <div class="control-group">
              <label class="control-label">Yang Ditugaskan :</label>
              <div class="controls">
                  <input type="text" id="cariPengikut"
                   class="span8"
                   placeholder="Cari pegawai..."
                   autocomplete="off"
                   style="margin-bottom:5px;">

                <select name="pengikut[]" id="pengikut" class="span8" multiple size="10">
                <?php

                  $sql2 = "SELECT * FROM pegawai ORDER BY nama ASC";
                  $tampil2 = mysqli_query($koneksi, $sql2);     
                  while ($data2 = mysqli_fetch_array($tampil2)) {
                
                 
                ?>
                <option value="<?php echo $data2['nip']; ?>"><?php echo ucfirst($data2['nama']); ?> 
                <?php if ($data2['nip'] < 999999999999) { echo "<center> (".ucfirst($data2['jabatan']).")</center>"; }else{?>
                  (<?php echo ucfirst($data2['nip']); ?>) <?php }?></option>
                
              <?php  } ?>
                </select><br>
              <span id="pesannama"></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Dasar Penugasan :</label>
              <div class="controls">
                <textarea class="textarea_editor span11" rows="6" name="dasar_penugasan" placeholder="Dasar Penugasan"></textarea>
              </div>
            </div>              
             <div class="control-group">
              <label class="control-label">Untuk :</label>
              <div class="controls"><textarea class="span11" name="keterangan" ></textarea><br>
                Ket : untuk tulisan miring masukkan kode <?php echo htmlspecialchars("<i>"); ?> di depan dan <?php echo htmlspecialchars("</i>"); ?> untuk penutup. contoh : <i><?php echo htmlspecialchars("<i>huruf miring</i>"); ?></i></div>
            </div>
            <!--<div class="control-group">
              <label class="control-label">TTD Pejabat :</label>
              <div class="controls">
                <select name="ttd"class="span4" required>   
                  <option>...</option>                
                  <?php
                    $sql = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip";
                    $tampil = mysqli_query($koneksi, $sql);     
                    while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['id_ttd']; ?>"><?php echo ucfirst($data['ttd']); ?> (<?php echo ucfirst($data['nama']); ?>)</option>
              <?php  } ?>
                </select>
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Gunakan SPD :</label>
              <div class="controls">
                <select name="spd"class="span2" required>   
                  <option value="N">Tidak</option>
                  <option value="Y" selected>Ya</option>
                </select>
              </div>
            </div>
        	<div class="control-group">
              <label class="control-label">Nomor ND:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" name="nd_spt">
              	</div>
              </div>
            </div>
        	<div class="control-group">
              <label class="control-label">Tanggal ND:</label>
              <div class="controls">
                <div class="control-group">
                  <input type="text" data-date="01-02-2013" name="tgl_nd" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" class="datepicker span4">
              	</div>
              </div>
            </div> 
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
        </div>
      </div>      
    </div>    
  </div>
  
 </form>
</div></div>


<!--end-Footer-part--> 

<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/jquery.toggle.buttons.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 
<script src="../js/select2.min.js"></script>

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
<script>
$(function(){

    $('#cariPengikut').on('keyup', function(){
        var keyword = $(this).val().toLowerCase();

        $('#pengikut option').each(function(){
            var text = $(this).text().toLowerCase();

            // tampilkan yang cocok ATAU yang sudah selected
            if (text.indexOf(keyword) > -1 || this.selected) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

});
</script>
