<?php include 'session.php' ?>
<?php $page = 'lpd'; 

$tahun = addslashes($_POST['tahun']);
$tgl_awal = addslashes($_POST['tgl_awal']);
$tgl_akhir = addslashes($_POST['tgl_akhir']);
$kategori = addslashes($_POST['kategori']);
$subkatergori = addslashes($_POST['subkatergori']);

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
                  <option <?php if($tahun == '2019') echo "selected" ?>>2019</option>
                  <option <?php if($tahun == '2020') echo "selected" ?>>2020</option>
                  <option <?php if($tahun == '2021') echo "selected" ?>>2021</option>
                  <option <?php if($tahun == '2022') echo "selected" ?>>2022</option>
                  <option <?php if($tahun == '2023') echo "selected" ?>>2023</option>
                  <option <?php if($tahun == '2024') echo "selected" ?>>2024</option>
                  <option <?php if($tahun == '2025') echo "selected" ?>>2025</option>
                  <option <?php if($tahun == '2026') echo "selected" ?>>2026</option>
                  <option <?php if($tahun == '2027') echo "selected" ?>>2027</option>
                  <option <?php if($tahun == '2028') echo "selected" ?>>2028</option>
                  <option <?php if($tahun == '2029') echo "selected" ?>>2029</option>
                  <option <?php if($tahun == '2030') echo "selected" ?>>2030</option>
                </select>
                 
                <select name="tgl_awal"class="span2" required>   
                  <option <?php if($tgl_awal == 'I'){ echo "selected";} ?> value="I">Januari</option>
                  <option <?php if($tgl_awal == 'II'){ echo "selected";} ?> value="II">Februari</option>
                  <option <?php if($tgl_awal == 'III'){ echo "selected";} ?> value="III">Maret</option>
                  <option <?php if($tgl_awal == 'IV'){ echo "selected";} ?> value="IV">April</option>
                  <option <?php if($tgl_awal == 'V'){ echo "selected";} ?> value="V">Mei</option>
                  <option <?php if($tgl_awal == 'VI'){ echo "selected";} ?> value="VI">Juni</option>
                  <option <?php if($tgl_awal == 'VII'){ echo "selected";} ?> value="VII">Juli</option>
                  <option <?php if($tgl_awal == 'VIII'){ echo "selected";} ?> value="VIII">Agustus</option>
                  <option <?php if($tgl_awal == 'IX'){ echo "selected";} ?> value="IX">September</option>
                  <option <?php if($tgl_awal == 'X'){ echo "selected";} ?> value="X">Oktober</option>
                  <option <?php if($tgl_awal == 'XI'){ echo "selected";} ?> value="XI">November</option>
                  <option <?php if($tgl_awal == 'XII'){ echo "selected";} ?> value="XII">Desember</option>
                </select>

                <select name="tgl_akhir"class="span2" required>   
                  <option <?php if($tgl_akhir == 'I'){ echo "selected";} ?> value="I">Januari</option>
                  <option <?php if($tgl_akhir == 'II'){ echo "selected";} ?> value="II">Februari</option>
                  <option <?php if($tgl_akhir == 'III'){ echo "selected";} ?> value="III">Maret</option>
                  <option <?php if($tgl_akhir == 'IV'){ echo "selected";} ?> value="IV">April</option>
                  <option <?php if($tgl_akhir == 'V'){ echo "selected";} ?> value="V">Mei</option>
                  <option <?php if($tgl_akhir == 'VI'){ echo "selected";} ?> value="VI">Juni</option>
                  <option <?php if($tgl_akhir == 'VII'){ echo "selected";} ?> value="VII">Juli</option>
                  <option <?php if($tgl_akhir == 'VIII'){ echo "selected";} ?> value="VIII">Agustus</option>
                  <option <?php if($tgl_akhir == 'IX'){ echo "selected";} ?> value="IX">September</option>
                  <option <?php if($tgl_akhir == 'X'){ echo "selected";} ?> value="X">Oktober</option>
                  <option <?php if($tgl_akhir == 'XI'){ echo "selected";} ?> value="XI">November</option>
                  <option <?php if($tgl_akhir == 'XII'){ echo "selected";} ?> value="XII">Desember</option>
                </select>

                <select name="kategori" id="kategori" class="span3" required>                  
                  <?php $tampil_kat=mysqli_query($koneksi, "SELECT * FROM kategori_pesanan");
                    while($t=mysqli_fetch_array($tampil_kat)){?>
                       <option value="<?php echo $t['id_pesanan']?>" <?php if ($t[id_pesanan] == $kategori) {echo 'selected';} ?>><?php echo $t['pesanan'];?></option>";
                  <?php }?>
                </select>

                <select name="subkatergori" class="span3">
                  <option>-- Pilih Subkategori -- </option>
                    <?php $tampil_sub=mysqli_query($koneksi, "SELECT * FROM kategori_subpesanan");
                    while($f=mysqli_fetch_array($tampil_sub)){?>
                      
                      <option value="<?php echo $f['id_sub_pesanan']?>" <?php if ($f[id_sub_pesanan] == $subkatergori) {echo 'selected';} ?>><?php echo $f['sub_pesanan'];?></option>";
                  <?php }?>
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


      <form method="post" action="surat_pesanan_print_report.php" target="_blank">
        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
        <input type="hidden" name="tgl_awal" value="<?php echo $tgl_awal; ?>">
        <input type="hidden" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
        <input type="hidden" name="kategori" value="<?php echo $kategori; ?>">
        <input type="hidden" name="subkatergori" value="<?php echo $subkatergori; ?>">
        <button type="submit" class="btn btn-info"><span class="icon-print"></span> Print</button>
      </form>

      <?php
        include "../koneksi/koneksi.php";
        
        if ($subkatergori == '-- Pilih Subkategori --') {          
        $sql = "SELECT * FROM pesanan_barang_kode WHERE bulan_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tahun_pesanan = '$tahun' AND id_kategori = '$kategori'";        
        }else{
        $sql = "SELECT * FROM pesanan_barang_kode WHERE bulan_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tahun_pesanan = '$tahun' AND id_kategori = '$kategori' AND id_subkategori = '$subkatergori'";
        }

        $tampil = mysqli_query($koneksi, $sql);

        $total = 0;
        echo $data['id_kategori'];

        $tampil_c=mysqli_query($koneksi, "SELECT * FROM kategori_pesanan WHERE id_pesanan = '$kategori'");
        $cek=mysqli_fetch_array($tampil_c);

        $tampil_d=mysqli_query($koneksi, "SELECT * FROM kategori_subpesanan WHERE id_sub_pesanan = '$subkatergori'");
        $cek_d=mysqli_fetch_array($tampil_d);
        
      ?>
      <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>LAPORAN SURAT PESANAN BARANG/JASA [Rincian :  <?php echo $cek['pesanan']; ?> <?php echo $cek_d['sub_pesanan']; ?>]</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>No Pesanan</th>
                <th>Tanggal</th>
                <th>Uraian</th>
                <th>Volume</th>
                <th>Satuan</th>
                <th>Yang dituju</th>
                <th>Keterangan</th>
              </tr>
              </thead>
              <?php 
                while ($data = mysqli_fetch_array($tampil)) { 

                $sql_sub = "SELECT * FROM pesanan_barang WHERE kode_pesanan_barang = '$data[kode_pesanan_barang]'";
                $tampil_sub = mysqli_query($koneksi, $sql_sub);
                $rowspan = mysqli_num_rows($tampil_sub);
                while ($data_sub = mysqli_fetch_array($tampil_sub)) { 
              ?>
              
                <tr>
                  <?php if($jum <= 1) { ?>
                  <td rowspan="<?php echo $rowspan; ?>" style="vertical-align: middle;"><center><?php echo $data['kode_item']."/".$data['no_pesanan']."/".$data['bulan_pesanan']."/".$data['tahun_pesanan']; ?></td>                  
                  <td rowspan="<?php echo $rowspan; ?>" style="vertical-align: middle;"><center><?php echo $data['tgl']; ?></center></td>
                  <?php 
                    $jum = $rowspan;      
                    } else {
                      $jum = $jum - 1;
                    }?>
                  <td><center><?php echo $data_sub['uraian']; ?></center></td>
                  <td><center><?php echo $data_sub['banyaknya']; ?></center></td>
                  <td><center><?php echo $data_sub['satuan']; ?></center></td>
                  <td><center><?php echo $data['tujuan']; ?></center></td>
                  <td><center><?php echo $data_sub['keterangan']; ?></center></td>
                </tr>
              
            <?php }}?>
            </table>
          </div>
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

