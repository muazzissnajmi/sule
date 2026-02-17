<?php include 'session.php' ?>
<?php $page = 'lpd'; 

$asn = addslashes($_POST['asn']);
$tgl_awal = addslashes($_POST['tgl_awal']);
$tgl_akhir = addslashes($_POST['tgl_akhir']);
$pagu = addslashes($_POST['pagu']);
$tahun = addslashes($_POST['tahun']);

if ($pagu == 'luar_kota') {
  $tmp_pagu = 'Setdakab Luar Daerah';
}elseif ($pagu == 'dalam_kota') {
  $tmp_pagu = 'Setdakab Dalam Daerah';
}elseif ($pagu == 'kdh_luar_kota') {
  $tmp_pagu = 'KDH/WKDH Luar Daerah';
}elseif ($pagu == 'kdh_dalam_kota') {
  $tmp_pagu = 'KDH/WKDH Dalam Daerah';
}



//$tgl_awal = '11-2019';
//$tgl_akhir = '11-2019';
//echo $bulan = month('10-12-2019');

//$tgl_awal1 = $tgl_awal ."-". date('Y');
//$tgl_akhir2 = $tgl_akhir ."-". date('Y');


function rupiah($angka){
  
$hasil_rupiah = "Rp " . number_format($angka,0,',','.');
return $hasil_rupiah;
 }

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
    <h3>REKAP PERJALANAN DINAS</h3>
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
                  
                  <select name="asn"class="span3" required>   
                  <option>...</option>                
                  <?php
                  $sql_cek = "SELECT * FROM pegawai";
                  $tampil_cek = mysqli_query($koneksi, $sql_cek);     
                  while ($data_cek = mysqli_fetch_array($tampil_cek)) {
                  ?>    
                <option value="<?php echo $data_cek['nip']; ?>" <?php if ($data_cek['nip'] == $asn) { echo "selected"; } ?>><?php echo ucfirst($data_cek['nama']); ?></option>
              <?php  } ?>
                </select> 
                <select name="tgl_awal"class="span2" required>   
                  <option <?php if($tgl_awal == '01'){ echo "selected";} ?> value="01">Januari</option>
                  <option <?php if($tgl_awal == '02'){ echo "selected";} ?> value="02">Februari</option>
                  <option <?php if($tgl_awal == '03'){ echo "selected";} ?> value="03">Maret</option>
                  <option <?php if($tgl_awal == '04'){ echo "selected";} ?> value="04">April</option>
                  <option <?php if($tgl_awal == '05'){ echo "selected";} ?> value="05">Mei</option>
                  <option <?php if($tgl_awal == '06'){ echo "selected";} ?> value="06">Juni</option>
                  <option <?php if($tgl_awal == '07'){ echo "selected";} ?> value="07">Juli</option>
                  <option <?php if($tgl_awal == '08'){ echo "selected";} ?> value="08">Agustus</option>
                  <option <?php if($tgl_awal == '09'){ echo "selected";} ?> value="09">September</option>
                  <option <?php if($tgl_awal == '10'){ echo "selected";} ?> value="10">Oktober</option>
                  <option <?php if($tgl_awal == '11'){ echo "selected";} ?> value="11">November</option>
                  <option <?php if($tgl_awal == '12'){ echo "selected";} ?> value="12">Desember</option>
                </select>
                <select name="tgl_akhir"class="span2" required>   
                  <option <?php if($tgl_akhir == '01'){ echo "selected";} ?> value="01">Januari</option>
                  <option <?php if($tgl_akhir == '02'){ echo "selected";} ?> value="02">Februari</option>
                  <option <?php if($tgl_akhir == '03'){ echo "selected";} ?> value="03">Maret</option>
                  <option <?php if($tgl_akhir == '04'){ echo "selected";} ?> value="04">April</option>
                  <option <?php if($tgl_akhir == '05'){ echo "selected";} ?> value="05">Mei</option>
                  <option <?php if($tgl_akhir == '06'){ echo "selected";} ?> value="06">Juni</option>
                  <option <?php if($tgl_akhir == '07'){ echo "selected";} ?> value="07">Juli</option>
                  <option <?php if($tgl_akhir == '08'){ echo "selected";} ?> value="08">Agustus</option>
                  <option <?php if($tgl_akhir == '09'){ echo "selected";} ?> value="09">September</option>
                  <option <?php if($tgl_akhir == '10'){ echo "selected";} ?> value="10">Oktober</option>
                  <option <?php if($tgl_akhir == '11'){ echo "selected";} ?> value="11">November</option>
                  <option <?php if($tgl_akhir == '12'){ echo "selected";} ?> value="12">Desember</option>
                </select>
                <select name="pagu"class="span3" required>
                 <option <?php if($_POST['pagu'] == 'semua') { echo "selected"; }?> value="semua" >Semua Tujuan</option>
                  <option <?php if($_POST['pagu'] == 'luar_kota') { echo "selected"; }?> value="luar_kota" >Setdakab Luar Daerah</option>
                  <option <?php if($_POST['pagu'] == 'dalam_kota') { echo "selected"; }?> value="dalam_kota" >Setdakab Dalam Daerah</option>
                  <option <?php if($_POST['pagu'] == 'kdh_dalam_kota') { echo "selected"; }?> value="kdh_dalam_kota" >KDH/WKDH Dalam Daerah</option>
                  <option <?php if($_POST['pagu'] == 'kdh_luar_kota') { echo "selected"; }?> value="kdh_luar_kota" >KDH/WKDH Luar Daerah</option>
                </select></td>
                </tr><tr>
                <td><center><button type="submit" class="btn btn-success tip-bottom"><span class="icon-search" > Search</span></button></center><br></td>
              </tr> 
              </table>
            </div>   
          </div>
        </form>
      </div>

     
      <form method="post" action="rpd_printreport.php" target="_blank">
        <input type="hidden" name="asn" value="<?php echo $asn; ?>">
        <input type="hidden" name="tgl_awal" value="<?php echo $tgl_awal; ?>">
        <input type="hidden" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
        <input type="hidden" name="pagu" value="<?php echo $pagu; ?>">
      </form>
      
      
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>DATA RPD <?php echo strtoupper($tmp_pagu); ?><?php if ($asn == '...') { ?>
            KESELURUHAN ASN DI LINGKUNGAN SETDAKAB BIREUEN
          <?php }else{ ?>
            ASN PERORANGAN DI LINGKUNGAN SETDAKAB BIREUEN
          <?php } ?></h5>
            <!--<a href="?page=pt" class="label label-success btn btn-success btn-mini">+ Tambah ASN</a>-->            

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered">
              
                <tr>
                  <th rowspan="2" style="vertical-align: middle;">Nama</th>
                  <th rowspan="2" style="vertical-align: middle;">Jabatan</th>
                  <th rowspan="2" style="vertical-align: middle;">Tujuan</th>
                  <th rowspan="2" style="vertical-align: middle;">No SPT</th>
                  <th colspan="2">Tanggal</th>
                  <th rowspan="2" style="vertical-align: middle;">Jumlah Hari</th>
                  <th rowspan="2" style="vertical-align: middle;">Anggaran</th>
                  <th rowspan="2" style="vertical-align: middle;">Keterangan</th>
                </tr>
                <tr>
                  <th style="vertical-align: middle;">Dari</th>
                  <th style="vertical-align: middle;">Pulang</th>
                </tr>
              
              <tbody>
                <?php
                  include "../koneksi/koneksi.php";
                  //$tahun = date('Y');
                  $sql = "SELECT * FROM spd WHERE bulan BETWEEN '$tgl_awal' AND '$tgl_akhir' AND tahun = '$tahun'";
                  $tampil = mysqli_query($koneksi, $sql);

                  $total = 0;
                  while ($data = mysqli_fetch_array($tampil)) { 
                  $id_spt = $data['id_spt'];
                   
                  if ($asn == '...') {
                  	if($pagu == 'semua'){
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE id_spt='$id_spt'";
                    }else{
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE pagu = '$_POST[pagu]' AND id_spt='$id_spt'";
                    }
                  }else{
                  	if($pagu == 'semua'){
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE nip = '$asn' AND id_spt='$id_spt' ";
                    }else{
                    	$sql_pagu = "SELECT * FROM kwitansi WHERE nip = '$asn' AND pagu = '$_POST[pagu]' AND id_spt='$id_spt' ";
                    }
                  }
                  $tampil_pagu = mysqli_query($koneksi, $sql_pagu); 
                  while($data_pagu = mysqli_fetch_array($tampil_pagu)){
                  $nip = $data_pagu['nip'];

                ?>
                <tr>                                  
                  <td class="span3">
                    <?php 
                    $sql_pegawai = "SELECT * FROM pegawai WHERE nip='$nip'";
                      $tampil_pegawai = mysqli_query($koneksi, $sql_pegawai);     
                      $data_pegawai = mysqli_fetch_array($tampil_pegawai);
                      echo ucfirst($data_pegawai['nama']);
                      echo "<br>";
                      //echo "Nip. ".konversi_nip($data_pagu['nip']);

                      if ($data_pagu['nip'] < 999999999999) { 
                        echo ""; 
                      }else{
                        echo "Nip. ".konversi_nip($data_pagu['nip']); }
                    ?>
                  </td>
                  <td><?php echo ucfirst($data_pegawai['jabatan']); ?></td>
                    
                  <td class="span2">
                    <?php 
                      $sql_kota = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt='$id_spt'";
                      $tampil_kota = mysqli_query($koneksi, $sql_kota);     
                      $data_kota = mysqli_fetch_array($tampil_kota);
                    ?>
                    <center>
                      <?php echo $data_kota['kota']; ?><br>
                      <?php
                    $sql_2 = "SELECT * FROM kota WHERE id_kota = '$data_kota[tiba_di_2]'";
                    $tampil_2 = mysqli_query($koneksi, $sql_2);     
                    $data_2 = mysqli_fetch_array($tampil_2)
                  ?>
                    <?php 
                    if ($data_2['kota'] == '') {
                      
                    }else{
                    echo $data_2['kota']."<br>"; }?>

                  <?php
                    $sql_3 = "SELECT * FROM kota WHERE id_kota = '$data_kota[tiba_di_3]'";
                    $tampil_3 = mysqli_query($koneksi, $sql_3);     
                    $data_3 = mysqli_fetch_array($tampil_3)
                  ?>
                    <?php 
                    if ($data_3['kota'] == '') {
                      
                    }else{
                    echo $data_3['kota']."<br>"; }?>
                    </center></td>

                  <td><center><?php 
                      $sql_spt = "SELECT * FROM spt WHERE id_spt='$id_spt'";
                      $sql_spt = mysqli_query($koneksi, $sql_spt);     
                      $sql_spt = mysqli_fetch_array($sql_spt);
                    ?>
                    <?php echo $sql_spt['no_spt']; ?></center></td>

                  <td class="span2">
                    <?php 
                      $sql_spd = "SELECT * FROM spd WHERE id_spt='$id_spt'";
                      $tampil_spd = mysqli_query($koneksi, $sql_spd);     
                      $data_spd = mysqli_fetch_array($tampil_spd);
                    ?>
                    <center>
                      
                      <?php echo tgl_indo($data_spd['tgl_berangkat']); ?></center></td>

                  <td class="span2"><center><?php echo tgl_indo($data_spd['tgl_kembali']); ?></center></td>
                  <td><center><?php echo $data_spd['lama_perjalanan']; ?> Hari</center></td>

                  <td class="span2" style="text-align: right;">
                    <?php
                      $jumlah = 0;
                      $sql_kw = "SELECT * FROM kwitansi_nilai WHERE nip = '$nip' AND id_spt='$id_spt'";
                      $tampil_kw = mysqli_query($koneksi, $sql_kw);     
                      while($data_kw = mysqli_fetch_array($tampil_kw)){

                        $hari = $data_kw['hari'];
                  
                        if ($data_kw['hari'] == '0') {
                          $hari2 = $data_kw['hari']+1;
                        }else{
                          $hari2 = $data_kw['hari'];
                        }

                        $nominal = $hari2*$data_kw['nominal'];
                        $jumlah+=$nominal;

                      }
                    ?>

                    <?php echo rupiah($jumlah); ?>
                  </td>
                  <td><?php 
                      $sql_spt = "SELECT * FROM spt WHERE id_spt='$id_spt'";
                      $sql_spt = mysqli_query($koneksi, $sql_spt);     
                      $sql_spt = mysqli_fetch_array($sql_spt);
                    ?>
                    
                    <?php
                    // Get the content from $data['dasar_penugasan']
                    $content = $sql_spt['keterangan'];
                    
                    // Check if the content contains "#"
                    if (strpos($content, '#') !== false) {
                        // Split the content into an array using "#" as the delimiter
                        $listItems = explode('#', $content);
                    
                        // Remove any empty elements from the array
                        $listItems = array_filter($listItems);
                    
                        // Output the numbered list
                        echo '<ol style="padding-left:16px">';
                        foreach ($listItems as $item) {
                            echo '<li>' . trim($item) . '</li>';
                        }
                        echo '</ol>';
                    } else {
                        // If there is no "#" symbol, just output the content as is
                        echo $content;
                    }
                    ?>
                    </td>

                  <?php $total+=$jumlah; ?>
                </tr>
                <?php
                  }}
                ?>
                <tr>
                  <td colspan="7" style="text-align: right;"><strong>JUMLAH</strong></td>
                  <td  style="text-align: right;"><strong><?php echo rupiah($total); ?></strong></td>
              </tbody>
            </table>
          </div>
        </div>
        <form method="post" action="rpd_export.php" style="text-align: right;">
          <input type="hidden" name="asn" value="<?php echo $asn; ?>">
          <input type="hidden" name="tgl_awal" value="<?php echo $tgl_awal; ?>">
          <input type="hidden" name="tgl_akhir" value="<?php echo $tgl_akhir; ?>">
        <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
          <input type="hidden" name="pagu" value="<?php echo $pagu; ?>">
          <button type="submit" class="btn btn-success"><span class="icon-save"></span> Export To Excel</button>
        </form>
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

