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

<link rel="stylesheet" href="js/jquery-ui.css" />
<script src="js/jquery-1.8.3.js"></script>
<script src="js/jquery-ui.js"></script>
  
    <script>
/*autocomplete muncul setelah user mengetikan minimal2 karakter */
    $(function() { 
        $( "#nama" ).autocomplete({
         source: "sppd_template_data.php", 
           minLength:1,
        });
    });

    /*$(function() { 
        $( "#nama2" ).autocomplete({
         source: "sppd_template_data.php", 
           minLength:1,
        });
    });

    $(function() { 
        $( "#nama3" ).autocomplete({
         source: "sppd_template_data.php", 
           minLength:1,
        });
    });

    $(function() { 
        $( "#nama4" ).autocomplete({
         source: "sppd_template_data.php", 
           minLength:1,
        });
    });*/
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=sppd" class="tip-bottom">SPPD</a> <a href="?page=sppd_template" class="tip-bottom">Template SPPD</a> <a href="#" class="current">Template SPPD</a></div>
  
</div>
<div class="container-fluid">
  
<h3>Template SPPD</h3> 
<?php
            $msg = isset($_GET['msg']) ? $_GET['msg'] : null;
            
            if ($msg == 1) { ?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>Data Berhasil Disimpan!</div>
            <?php } else if ($msg == 2) {?>
              <div class="alert alert-error alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Error!</h4>
              Nama tesebut sudah ada di database!</div>
            <?php } else if ($msg == 3) {?>
              <div class="alert alert-success alert-block"> <a class="close" data-dismiss="alert" href="#">×</a>
              <h4 class="alert-heading">Success!</h4>
              Data SPPD Berhasil Disimpan!</div>       
            <?php } ?>
  
  <div class="row-fluid">
    <div class="span12">

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Nama TTD SPPD</h5>
        </div>
        <form class="form-horizontal" method="post" action="?page=sppdttns" name="" enctype="multipart/form-data">
        
        <!--<input type="text" class="span2" name="id_spt" id="no_spt" value="<?php echo $newID; ?>" placeholder="" />-->
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nama Pejabat</label>
              <div class="controls">                
                <input type="text" class="span5" name="nama_pejabat" id="nama" placeholder="Input Nama Pejabat" required />
                <!--<input type="text" class="span5" name="kategori"  placeholder="Input Nip" />-->
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nip</label>
              <div class="controls">                
                <input type="number" class="span5" name="nip" id="nama2" placeholder="Input Nip Pejabat" />
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Pangkat/Gol</label>
              <div class="controls">                
                <select name="pangkat" class="span5">
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
                </select>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Jabatan</label>
              <div class="controls">                
                <input type="text" class="span5" name="jabatan" id="nama4" placeholder="Input Jabatan" />
              </div>
            </div>   
            <div class="row-fluid">
             <div class="form-actions">
              <center>
                        <button type="submit" class="btn btn-success">Save</button>
                        <!--<button type="reset" class="btn btn-primary">Reset</button>-->
                        <!--<button type="submit" class="btn btn-info">Edit</button>-->
                        <a href="?page=sppd_template" class="btn btn-danger">Cancel</a>
                        </center>
              </div>
            </div>        
      </div>
      </form>      
    </div>    
  </div> 
</div>


<div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data Nama Pejabat</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <!--<th>No.</th>-->
                  <!--<th>No. SPPD</th>-->
                  <th>Nip</th>
                  <th>Nama</th>
                  <th>Pangkat/Gol</th>
                  <th>Jabatan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  
                  $sql = "SELECT * FROM sppd_template";
                  $tampil = mysqli_query($koneksi, $sql);

                  $no=1;
                  while ($data = mysqli_fetch_array($tampil)) { 
                                      
                ?>
                <tr>                  
                  <td class="span2"><center><?php echo konversi_nip($data['nip']); ?></center></td>
                  <td class="span2"><center><?php echo $data['nama_pejabat']; ?></center></td>
                  <td class="span3"><center><?php echo $data['pangkat']; ?><?php echo " ( ".$data['gol']." )"; ?></center></td>
                  <td class="span2"><center><?php echo $data['jabatan']; ?></center></td>
                  <td class="span2"><center><a href="?page=sppdttnh&id=<?php echo $data['id_nama_pejabat']; ?>"><span class="badge badge-important tip-bottom" data-original-title="Delete"><span class="icon-trash"></span><span></a></center></td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>

</div>
</div>


<script src="../js/jquery.min.js"></script> 
<script src="../js/jquery.ui.custom.js"></script> 
<script src="../js/bootstrap.min.js"></script> 
<script src="../js/jquery.uniform.js"></script> 
<script src="../js/select2.min.js"></script> 
<script src="../js/jquery.dataTables.min.js"></script> 
<script src="../js/matrix.js"></script> 
<script src="../js/matrix.tables.js"></script>

