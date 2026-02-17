<?php include 'session.php' ?>
<?php $page = 'lpd'; 

?>

<script src="../js/jquery.js"></script>

<script>
$(document).ready(function() {
  $('#kategori').change(function() { // Jika Select Box id kategori dipilih
    var kategori = $(this).val(); // Ciptakan variabel kategori
    $.ajax({
      type: 'POST', // Metode pengiriman data menggunakan POST
      url: 'katergori_subpesanan.php', // File yang akan memproses data
      data: 'kategori_pesanan=' + kategori, // Data yang akan dikirim ke file pemroses
      success: function(response) { // Jika berhasil
        $('#subkatergori').html(response); // Berikan hasil ke id subkatergori
      }
    });
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Rekap Surat Pesanan</a></div>
  
</div>
  <div class="container-fluid">
    <h3>REKAP SURAT PESANAN</h3>
    <div class="row-fluid">

      <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-search"></i></span>
            <h5>Pencarian Data Surat Pesanan</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <form class="form-horizontal" method="post" action="?page=supct" name="" enctype="multipart/form-data">
          <div class="widget-content nopadding form-horizontal">
            <table align="center" width="80%" border="0">
              <tr>
                <td><br></td>
              </tr>
              <tr>
                <td>
                <div class="control-group">
                <select name="tahun" class="span2" required>    
                  <option <?php if(date('Y') == '2019') echo "selected" ?>>2019</option>
                  <option <?php if(date('Y') == '2020') echo "selected" ?>>2020</option>
                  <option <?php if(date('Y') == '2021') echo "selected" ?>>2021</option>
                  <option <?php if(date('Y') == '2022') echo "selected" ?>>2022</option>
                  <option <?php if(date('Y') == '2023') echo "selected" ?>>2023</option>
                  <option <?php if(date('Y') == '2024') echo "selected" ?>>2024</option>
                  <option <?php if(date('Y') == '2025') echo "selected" ?>>2025</option>
                  <option <?php if(date('Y') == '2026') echo "selected" ?>>2026</option>
                  <option <?php if(date('Y') == '2027') echo "selected" ?>>2027</option>
                  <option <?php if(date('Y') == '2028') echo "selected" ?>>2028</option>
                  <option <?php if(date('Y') == '2029') echo "selected" ?>>2029</option>
                  <option <?php if(date('Y') == '2030') echo "selected" ?>>2030</option>
                </select>
                 
                <select name="tgl_awal"class="span2" required>   
                  <option <?php if(date('m') == '01'){ echo "selected";} ?> value="I">Januari</option>
                  <option <?php if(date('m') == '02'){ echo "selected";} ?> value="II">Februari</option>
                  <option <?php if(date('m') == '03'){ echo "selected";} ?> value="III">Maret</option>
                  <option <?php if(date('m') == '04'){ echo "selected";} ?> value="IV">April</option>
                  <option <?php if(date('m') == '05'){ echo "selected";} ?> value="V">Mei</option>
                  <option <?php if(date('m') == '06'){ echo "selected";} ?> value="VI">Juni</option>
                  <option <?php if(date('m') == '07'){ echo "selected";} ?> value="VII">Juli</option>
                  <option <?php if(date('m') == '08'){ echo "selected";} ?> value="VIII">Agustus</option>
                  <option <?php if(date('m') == '09'){ echo "selected";} ?> value="IX">September</option>
                  <option <?php if(date('m') == '10'){ echo "selected";} ?> value="X">Oktober</option>
                  <option <?php if(date('m') == '11'){ echo "selected";} ?> value="XI">November</option>
                  <option <?php if(date('m') == '12'){ echo "selected";} ?> value="XII">Desember</option>
                </select>

                <select name="tgl_akhir"class="span2" required>   
                  <option <?php if(date('m') == '01'){ echo "selected";} ?> value="I">Januari</option>
                  <option <?php if(date('m') == '02'){ echo "selected";} ?> value="II">Februari</option>
                  <option <?php if(date('m') == '03'){ echo "selected";} ?> value="III">Maret</option>
                  <option <?php if(date('m') == '04'){ echo "selected";} ?> value="IV">April</option>
                  <option <?php if(date('m') == '05'){ echo "selected";} ?> value="V">Mei</option>
                  <option <?php if(date('m') == '06'){ echo "selected";} ?> value="VI">Juni</option>
                  <option <?php if(date('m') == '07'){ echo "selected";} ?> value="VII">Juli</option>
                  <option <?php if(date('m') == '08'){ echo "selected";} ?> value="VIII">Agustus</option>
                  <option <?php if(date('m') == '09'){ echo "selected";} ?> value="IX">September</option>
                  <option <?php if(date('m') == '10'){ echo "selected";} ?> value="X">Oktober</option>
                  <option <?php if(date('m') == '11'){ echo "selected";} ?> value="XI">November</option>
                  <option <?php if(date('m') == '12'){ echo "selected";} ?> value="XII">Desember</option>
                </select>

                <select name="kategori" id="kategori" class="span3" required>                  
                  <?php $tampil=mysqli_query($koneksi, "SELECT * FROM kategori_pesanan");
                    while($t=mysqli_fetch_array($tampil)){
                       echo "<option value='$t[id_pesanan]'>$t[pesanan]</option>";
                  }?>
                </select>

                <select name="subkatergori" class="span3">
                    <option>-- Pilih Subkategori --</option>
                    <?php $tampil_sub=mysqli_query($koneksi, "SELECT * FROM kategori_subpesanan");
                    while($f=mysqli_fetch_array($tampil_sub)){?>
                      
                      <option value="<?php echo $f['id_sub_pesanan']?>" <?php if ($f[id_sub_pesanan] == $subkatergori) {echo 'selected';} ?>><?php echo $f['sub_pesanan'];?></option>";
                  <?php }?>
                </select>
                </select>
                
                  </td>
                </tr><tr>
                <td><br><center><button type="submit" class="btn btn-success tip-bottom"><span class="icon-search" > </span> Search</button></center><br></td>
              </tr> 
              </table>
            </div>   
          </div>
        </form>
      </div>
     
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
<script src="../js/bootstrap-colorpicker.js"></script> 
<script src="../js/bootstrap-datepicker.js"></script> 
<script src="../js/jquery.toggle.buttons.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 

