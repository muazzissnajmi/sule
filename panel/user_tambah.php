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
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script src="../../../js/jquery.js"></script>

<script>
    $(document).ready(function(){
        $('#username').blur(function(){
            $('#pesan').html('<img style="margin-left:10px; width:10px" src="../img/loading.gif">');
            var username = $(this).val();

            $.ajax({
                type    : 'POST',
                url     : 'user_cek.php',
                data    : 'username='+username,
                success : function(data){
                    $('#pesan').html(data);
                }
            })

        });
    });
    </script>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a> <a href="?page=user" class="tip-bottom"> Pengguna</a> <a href="#" class="current"> Tambah Pengguna</a></div>
  
</div>

<div class="container-fluid">
<form class="form-horizontal" method="post" action="?page=userns" name="password_validate" id="password_validate" novalidate="novalidate">
    <h3>Tambah Pengguna</h3>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Data Pengguna</h5>
        </div>
          <?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Pegawai Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Gagal Menyimpan Data User!</div>       
            <?php }  else if ($msg == 3) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Password tidak sama!</div>       
            <?php } else if ($msg == 4) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Username tersebut sudah terdaftar!</div>       
            <?php } ?>
         
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Username :</label>
              <div class="controls">
                <input type="text" class="span6" name="username" placeholder="Username" minlength="4" required />
                <span class="help-block">Username adalah id permanent pengguna tidak bisa dirubah jika salah, harap diisi dengan benar.</span>
                <span id="pesan"></span>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama ASN :</label>
              <div class="controls">
                <select name="nip"class="span6" required> 
                  <?php
                  $sql = "SELECT * FROM pegawai";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['nip']; ?>"><?php echo ucfirst($data['nama']); ?></option>
              <?php  } ?>
                </select>
              </div>
            </div>            
            <div class="control-group">
              <label class="control-label">Sebutan :</label>
              <div class="controls">
                <select name="jk" class="span2">
                  <option value="Bpk">Bapak</option>
                  <option value="Ibu">Ibu</option>
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
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="email" class="span4" name="email" placeholder="noname@yourmail.com"/>                
              </div>
            </div>
            <div class="control-group">
                  <label class="control-label">Password</label>
                  <div class="controls">
                    <input type="password" name="pwd" id="pwd" required />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm password</label>
                  <div class="controls">
                    <input type="password" name="pwd2" id="pwd2" required />
                  </div>
                </div>
            <div class="control-group">
              <label class="control-label">Hak Akses :</label>
              <div class="controls">
                <select name="rule"class="span2" required>                  
                  <option value="MembersFull">Admin</option>
                  <option value="Members1">User 1</option>
                  <option value="Members2">User 2</option>
                  <option value="Members3">User 3</option>
                  <option value="MembersView1" selected>User View 1</option>
                </select>
              </div>
            </div>
            <br><br>

              <div class="row-fluid">
                <div class="span12 btn-icon-pg">&nbsp;<b> Ket. Hak Akses:</b>
                  <ul>
                    <li><font color="be0707"><i class="icon-bookmark"></i></font> Admin : Full Akses</li>
                    <li><font color="076fbe"><i class="icon-bookmark"></i></font> User 1 : SPT, SPPD, Kwitansi, lpd, upload Perjalanan, ASN, TTD Pejabat, TTD U.B</li>
                    <li><font color="07be3b"><i class="icon-bookmark"></i></font> User 2 : Pagu, Report RPD</li>
                    <li><font color="bcbe07"><i class="icon-bookmark"></i></font> User 3 : Surat Pesanan</li>
                    <li><font color="be6607"><i class="icon-bookmark"></i></font> User View 1 : Report RPD, Upload Perjalanan, Pagu</li>                                    
                  </ul>
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
              <a href="?page=user" class="btn btn-danger">Cancel</a>
              </center>
    </div>
  </div>
 </form>
</div></div>

<!--end-Footer-part--> 
<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.validate.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.form_validation.js"></script>