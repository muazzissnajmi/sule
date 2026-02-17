<?php include 'session.php' ?>
<?php $page = 'pegawai'; ?>

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
<script src="../../js/jquery.js"></script>

<script>
    $(document).ready(function(){
        $('#nip').blur(function(){
            $('#pesan').html('<img style="margin-left:10px; width:10px" src="../img/loading.gif">');
            var nip = $(this).val();

            $.ajax({
                type    : 'POST',
                url     : 'pegawai_ceknip.php',
                data    : 'nip='+nip,
                success : function(data){
                    $('#pesan').html(data);
                }
            })

        });
    });
    </script>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=pegawai" class="tip-bottom"> ASN</a> <a href="#" class="current"> Tambah ASN</a></div>
  
</div>

<div class="container-fluid">
<form class="form-horizontal" method="post" action="?page=pegawai_sim" name="" enctype="multipart/form-data">
    <h3>Tambah ASN</h3>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Data ASN</h5>
        </div>
          <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data Pegawai!</div>       
            <?php } ?>
         
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">N I P :</label>
              <div class="controls">
                <input type="number" class="span11" name="nip" id="nip" placeholder="N I P" />                
                <span class="help-block">Masukkan NIP tanpa spasi<br>NIP adalah id permanent ASN tidak bisa dirubah jika salah, harap diisi dengan benar.</span>
                <span id="pesan"></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama :</label>
              <div class="controls">
                <input type="text" class="span11" name="nama" placeholder="Nama" required />
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Pangkat/Gol. :</label>
              <div class="controls">
                <select name="pangkat">
                  <option value="">...</option>
                  <option value="Juru Muda">Juru Muda (I/a)</option>
                  <option value="Juru Muda Tk. I">Juru Muda Tk. I (I/b)</option>
                  <option value="Juru">Juru (I/c)</option>
                  <option value="Juru Tk. I">Juru Tk. I (I/d)</option>
                  <option value="Pengatur Muda">Pengatur Muda (II/a)</option>
                  <option value="Pengatur Muda Tk. I">Pengatur Muda Tk. I (II/b)</option>
                  <option value="Pengatur">Pengatur (II/c)</option>
                  <option value="Pengatur TK.I">Pengatur TK.I (II/d)</option>
                  <option value="Penata Muda">Penata Muda (III/a)</option>
                  <option value="Penata Muda Tk. I">Penata Muda Tk. I (III/b)</option>
                  <option value="Penata">Penata (III/c)</option>
                  <option value="Penata Tk.I">Penata Tk.I (III/d)</option>
                  <option value="Pembina">Pembina (IV/a)</option>
                  <option value="Pembina Tk. I">Pembina Tk. I (IV/b)</option>
                  <option value="Pembina Utama Muda">Pembina Utama Muda (IV/c)</option>
                  <option value="Pembina Utama Madya">Pembina Utama Madya (IV/d)</option>
                  <option value="V">V</option>
                  <option value="VI">VI</option>
                  <option value="VII">VII</option>
                  <option value="VIII">VIII</option>
                  <option value="IX">IX</option>
                </select>
              </div>
            </div>
            <!--<div class="control-group">
              <label class="control-label">Pangkat :</label>
              <div class="controls">
                <input type="text" class="span11" name="pangkat" placeholder="Pangkat" />
              </div>
            </div>-->
            <div class="control-group">
              <label class="control-label">Jabatan :</label>
              <div class="controls">
                <input type="text" class="span11" name="jabatan" placeholder="Jabatan" />
                <span class="help-block">Untuk jabatan Bupati ketik <strong>Bupati</strong> dan Wakil Bupati ketik <strong>Wakil Bupati</strong> agar terbaca disistem</span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">No SK :</label>
              <div class="controls">
                <input type="text" class="span11" name="no_sk" placeholder="No SK" />
              </div>
            </div>           
            <div class="control-group">
              <label class="control-label">Tgl SK :</label>
              <div class="controls">
                <div class="control-group span3">
                  <input type="text" data-date="01-02-2013" name="tgl_sk" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y'); ?>" class="datepicker span11">
                <span class="help-block">Format Tanggal (Hari-Bulan-Tahun)</span> </div>
              </div>
            </div>
        </div>
      </div>
      
    </div>
    
  </div>
  <div class="row-fluid">
   <div class="form-actions">
    <center>
              <button type="submit" class="btn btn-success">Save</button>
              <!--<button type="reset" class="btn btn-primary">Reset</button>
              <button type="submit" class="btn btn-info">Edit</button>-->
              <a href="?page=pegawai" class="btn btn-danger">Cancel</a>
              </center>
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