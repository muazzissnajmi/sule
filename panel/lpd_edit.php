<?php include 'session.php' ?>

<?php

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

/* konversi tanggal */
function tgl_indo($tgl_spt){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
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


$id_lpd =  addslashes($_GET['id']);
$sql_lpd = "SELECT * FROM lpd WHERE id_lpd = '$id_lpd'";
$tampil_lpd = mysqli_query($koneksi, $sql_lpd);     
$data_lpd = mysqli_fetch_array($tampil_lpd);

$id_spt = $data_lpd['id_spt'];
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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="?page=lpd" class="tip-bottom">LPD</a> <a href="#" class="current">Input Data LPD</a></div>
  
</div>
<div class="container-fluid">
  
    <h3>INPUT DATA LPD</h3>    
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input Data LPD</h5>           
        </div>
        <form class="form-horizontal" method="post" action="?page=lpdes" name="" enctype="multipart/form-data">
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
            
            <div class="control-group">
              <label class="control-label">Dasar Penugasan :</label>
              <input type="hidden" class="span11" name="id_lpd" id="no_spt" value="<?php echo $id_lpd ; ?>" placeholder="" readonly />
              <div class="controls"><textarea class="span11" name="dasar_penugasan" rows="5" disabled><?php echo ucfirst($data['dasar_penugasan']); ?></textarea></div>
            </div>

            <div class="control-group">
              <label class="control-label">Yang Ditugaskan :</label>
              <div class="controls">
                
                <?php 
                $sql_ = "SELECT * FROM pengikut INNER JOIN pegawai ON pengikut.pengikut=pegawai.nip WHERE no_spt='$id_spt' ORDER BY golongan DESC";
                $tampil_ = mysqli_query($koneksi, $sql_);     
                $no=1;
                while ($data_ = mysqli_fetch_array($tampil_)){

                echo "<span class='badge badge-info'>".$no++.". ".ucfirst($data_['nama'])." (NIP. ".konversi_nip($data_['nip']).")</span><br>"; 
                }
                ?>
              </div>
            </div>

            <?php 
              $sql_kota = "SELECT * FROM spd INNER JOIN kota ON spd.id_kota_tujuan=kota.id_kota WHERE id_spt='$id_spt'";
              $tampil_kota = mysqli_query($koneksi, $sql_kota);     
              $data_kota = mysqli_fetch_array($tampil_kota);
            ?>

            <div class="control-group">
              <label class="control-label">Tujuan :</label>
              <div class="controls">                
                <!--<input type="text" class="span11" name="no_spt" id="no_spt" value="<?php echo $data_kota['kota']; ?>" placeholder="" readonly />--><strong>
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
                    echo $data_3['kota']."<br>"; }?></strong>
              </div>
            </div>  

            <div class="control-group">
              <label class="control-label">Dalam Rangka :</label>
              <div class="controls"><textarea class="span11" name="keterangan" rows="5" disabled><?php echo ucfirst($data['keterangan']); ?></textarea></div>
            </div>

            <?php 
              $sql_spd = "SELECT * FROM spd WHERE id_spt='$id_spt'";
              $tampil_spd = mysqli_query($koneksi, $sql_spd);     
              $data_spd = mysqli_fetch_array($tampil_spd);
            ?>

            <div class="control-group">
              <label class="control-label">Lamanya Perjalanan :</label>
              <div class="controls">                
                <input type="text" class="span11" name="no_spt" id="no_spt" value="<?php echo $data_spd['lama_perjalanan']; ?> (<?php echo terbilang($data_spd['lama_perjalanan']); ?>) Hari, Mulai Tanggal <?php echo substr($data_spd['tgl_berangkat'],-10,2); ?> s/d <?php echo tgl_indo($data_spd['tgl_kembali']); ?>" placeholder="" disabled />
                
              </div>
            </div>  

            <div class="control-group">
            <label class="control-label">Hasil Yang Dicapai :</label>
              <div class="controls"><textarea class="span11" name="hasil" rows="5" ><?php echo ucfirst($data_lpd['hasil_dicapai']); ?></textarea></div>
            </div>

             
            <div class="row-fluid">
             <div class="form-actions">
              <center>
                        <button type="submit" class="btn btn-success">Save</button>
                        <!--<button type="reset" class="btn btn-primary">Reset</button>
                        <button type="submit" class="btn btn-info">Edit</button>-->
                        <a href="?page=lpd" class="btn btn-danger">Cancel</a>
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