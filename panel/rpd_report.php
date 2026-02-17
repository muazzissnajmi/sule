<?php include 'session.php' ?>
<?php $page = 'lpd'; 

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

/* konversi tanggal */
function tgl_indo($tgl_spt){
  $bulan = array (
    1 =>   'Jan',
    'Feb',
    'Mar',
    'Apr',
    'Mei',
    'Jun',
    'Jul',
    'Agus',
    'Sep',
    'Okt',
    'Nov',
    'Des'
  );
  $pecahkan = explode('-', $tgl_spt);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
 
  return $pecahkan[0] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[2];
}


/* TERBILANG */
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
    } else if ($nilai < 1000000000000000) {
      $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
    }     
    return $temp;
  }

  function terbilang($nilai) {
    if($nilai<0) {
      $hasil = "minus ". trim(penyebut($nilai));
    } else {
      $hasil = trim(penyebut($nilai));
    }         
    return $hasil;
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">RPD</a></div>
  
</div>
  <div class="container-fluid">
    <h3>REKAP PERJALANAN DINASs</h3>
    <div class="row-fluid">

      <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-search"></i></span>
            <h5>Pencarian Data RPD ASN</h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <form class="form-horizontal" method="post" action="?page=rpds" name="" enctype="multipart/form-data">
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

                  <select name="asn" class="span3" required>   
                  <option>...</option>                
                  <?php
                  $sql = "SELECT * FROM pegawai";
                  $tampil = mysqli_query($koneksi, $sql);     
                  while ($data = mysqli_fetch_array($tampil)) {
                  ?>    
                <option value="<?php echo $data['nip']; ?>"><?php echo ucfirst($data['nama']); ?></option>
                <?php  } ?>
                </select> 
                <select name="tgl_awal"class="span2" required>   
                  <option <?php if(date('m') == '01'){ echo "selected";} ?> value="01">Januari</option>
                  <option <?php if(date('m') == '02'){ echo "selected";} ?> value="02">Februari</option>
                  <option <?php if(date('m') == '03'){ echo "selected";} ?> value="03">Maret</option>
                  <option <?php if(date('m') == '04'){ echo "selected";} ?> value="04">April</option>
                  <option <?php if(date('m') == '05'){ echo "selected";} ?> value="05">Mei</option>
                  <option <?php if(date('m') == '06'){ echo "selected";} ?> value="06">Juni</option>
                  <option <?php if(date('m') == '07'){ echo "selected";} ?> value="07">Juli</option>
                  <option <?php if(date('m') == '08'){ echo "selected";} ?> value="08">Agustus</option>
                  <option <?php if(date('m') == '09'){ echo "selected";} ?> value="09">September</option>
                  <option <?php if(date('m') == '10'){ echo "selected";} ?> value="10">Oktober</option>
                  <option <?php if(date('m') == '11'){ echo "selected";} ?> value="11">November</option>
                  <option <?php if(date('m') == '12'){ echo "selected";} ?> value="12">Desember</option>
                </select>
                <select name="tgl_akhir"class="span2" required>   
                  <option <?php if(date('m') == '01'){ echo "selected";} ?> value="01">Januari</option>
                  <option <?php if(date('m') == '02'){ echo "selected";} ?> value="02">Februari</option>
                  <option <?php if(date('m') == '03'){ echo "selected";} ?> value="03">Maret</option>
                  <option <?php if(date('m') == '04'){ echo "selected";} ?> value="04">April</option>
                  <option <?php if(date('m') == '05'){ echo "selected";} ?> value="05">Mei</option>
                  <option <?php if(date('m') == '06'){ echo "selected";} ?> value="06">Juni</option>
                  <option <?php if(date('m') == '07'){ echo "selected";} ?> value="07">Juli</option>
                  <option <?php if(date('m') == '08'){ echo "selected";} ?> value="08">Agustus</option>
                  <option <?php if(date('m') == '09'){ echo "selected";} ?> value="09">September</option>
                  <option <?php if(date('m') == '10'){ echo "selected";} ?> value="10">Oktober</option>
                  <option <?php if(date('m') == '11'){ echo "selected";} ?> value="11">November</option>
                  <option <?php if(date('m') == '12'){ echo "selected";} ?> value="12">Desember</option>
                </select>
                <select name="pagu"class="span3" required>
                <option value="semua">Semua Tujuan</option>
                  <option value="luar_kota">Setdakab Luar Daerah</option>
                  <option value="dalam_kota">Setdakab Dalam Daerah</option>
                  <option value="kdh_luar_kota">KDH/WKDH Luar Daerah</option>
                  <option value="kdh_dalam_kota">KDH/WKDH Dalam Daerah</option>
                </select>
                  </td>
                </tr><tr>
                <td><center><button type="submit" class="btn btn-success tip-bottom"><span class="icon-search" > Search</span></button></center><br></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toggles/2.0.4/toggles.min.js"></script> 
<script src="../js/masked.js"></script> 
<script src="../js/matrix.form_common.js"></script> 
<script src="../js/wysihtml5-0.3.0.js"></script> 
<script src="../js/jquery.peity.min.js"></script> 
<script src="../js/bootstrap-wysihtml5.js"></script> 

