<?php
include "../koneksi/koneksi.php";

error_reporting(0);

$nama1 = addslashes($_POST['nama1']);
$nama2 = addslashes($_POST['nama2']);
$nama3 = addslashes($_POST['nama3']);
$nama4 = addslashes($_POST['nama4']);
$ttd_pejabat_berwenang = addslashes($_POST['ttd_pejabat_berwenang']);
$ttd_ub = addslashes($_POST['ttd_ub']);


$sql_ttd = "SELECT * FROM ttd_pejabat INNER JOIN pegawai ON ttd_pejabat.nip_pejabat=pegawai.nip WHERE id_ttd_pejabat='$ttd_pejabat_berwenang'";
$tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
$data_ttd = mysqli_fetch_array($tampil_ttd);

//$sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$ttd_ub'";
//$tampil_tt = mysqli_query($koneksi, $sql_tt);     
//$data_tt = mysqli_fetch_array($tampil_tt);




  $sql_cek1 = "SELECT * FROM sppd_template WHERE id_nama_pejabat = '$nama1'";
	$tampil_cek1 = mysqli_query($koneksi, $sql_cek1);
	$data_cek1 = mysqli_fetch_array($tampil_cek1);


	$sql_cek2 = "SELECT * FROM sppd_template WHERE id_nama_pejabat = '$nama2'";
	$tampil_cek2 = mysqli_query($koneksi, $sql_cek2);
	$data_cek2 = mysqli_fetch_array($tampil_cek2);


	$sql_cek3 = "SELECT * FROM sppd_template WHERE id_nama_pejabat = '$nama3'";
	$tampil_cek3 = mysqli_query($koneksi, $sql_cek3);
	$data_cek3 = mysqli_fetch_array($tampil_cek3);


	$sql_cek4 = "SELECT * FROM sppd_template WHERE id_nama_pejabat = '$nama4'";
	$tampil_cek4 = mysqli_query($koneksi, $sql_cek4);
	$data_cek4 = mysqli_fetch_array($tampil_cek4);


?>


<?php //include 'session.php' ?>
<style type="text/css">
  @page {
        /*size: landscape;*/
    }
  .tr, td {
    font-family: sans-serif;
    font-size: 11px;
    color: #000;
  }
    .border1 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .border2 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
     .border3 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
     .border4 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
     .border5 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .border6 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .table2 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
    .table2 {
        border-width: 1px;
        border-style: solid;
        border-top-color: transparent;
        border-bottom-color: transparent;
        border-left-color: transparent;
        border-right-color: transparent;
    }
 </style>
 <style type="text/css">
/* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        /*background-color: #FAFAFA;
        font: 12pt "Tahoma";*/
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 330mm;
        min-height: 210mm;
        padding: 5mm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 1px white solid;
        height: 220mm;
        /*outline: 2cm #FFEAEA solid;*/
    }
    
    @page {
        size: A4;
        margin: 0;
        size: landscape;
    }
    @media print {
        html, body {
            width: 330mm;
            height: 210mm;
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
</style>

<script>
    window.print();
</script>

<?php 

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

<!DOCTYPE html>
<html lang="en">
<head>
<title>SULE REPORT SPD</title>
<link href="../img/logo_.png" rel='shortcut icon'>
<link rel="stylesheet" href="../css/report.css" />
</head>
<body>

<!--<link rel="stylesheet" href="../css/bootstrap.min.css" />-->


<div id="content">

<div class="container-fluid">
  
 
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        
        <form class="form-horizontal" method="post" action="?page=spt_sim" name="" enctype="multipart/form-data">
        <div class="widget-content nopadding form-horizontal">
                        
            <div class="widget-content nopadding">
              <center>
       
  <div class="book">
    <div class="page">
        <div class="subpage">

        <table class="table2">
          <tr>
            <td valign="top">
            <table class="table1" border="0" rules="all"  style="width: 580px;">
              
            </table>
            </td>
            <td width="30px"></td>

            <td>
            <table class="table1" border="1" rules="all">
              <!--<thead>
                <tr class="border3">
                  <td colspan="9"><center><img src="../img/kops_surat.jpg" width="800px"></center></td>
                  <tr class="border3">
                  <td colspan="9"><hr style="border:0; border-top: 3px double transparent;"></td>
                </tr>
                </tr>
              </thead>-->
              <tbody>
                <tr>
                  <td class="border5" colspan="9"></td>
                </tr>
                <tr>
                  <td class="border5" width="25px" align="right" valign="top">&nbsp;</td>
                  <td class="border5" width="100px"></td>
                  <td class="border5" width="10px"></td>
                  <td class="border6" width="170px"></td>
                  <td class="border5"></td>
                  <td class="border5" width="120px" valign="top">&nbsp;</td>
                  <td class="border5" width="10px" valign="top">&nbsp;</td>
                  <td class="border5" width="150px" valign="top"> </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border4"></td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border3" colspan="3"></td>
                  <td class="border4"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border2" colspan="4" height="75px" valign="bottom"><!--<center><?php if ($data_cek1['nama_pejabat'] == '') {}else{ ?><?php echo $data_cek1['jabatan']."<br><br><br>".$data_cek1['nama_pejabat']."<br>".$data_cek1['pangkat']."<br>Nip. ".$data_cek1['nip']; }?></center>--></td>
                  <td class="border2" colspan="5" valign="bottom"><center><?php if ($data_cek1['nama_pejabat'] == '') {}else{ ?><?php echo $data_cek1['jabatan']."<br><br><br>".$data_cek1['nama_pejabat']."<br>Nip. ".$data_cek1['nip']; }?></center></td>
                </tr>
                <tr>
                  <td class="border5" align="right" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border4" valign="top"> </td>
                  <td class="border5"></td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top"> </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border4" valign="top"> </td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td>
                  <td class="border3"></td>
                </tr>
                <tr>                  
                  <td class="border1" colspan="9" height="75px" valign="bottom"><center><?php if ($data_cek2['nama_pejabat'] == '') {}else{ ?><?php echo $data_cek2['jabatan']."<br><br><br>".$data_cek2['nama_pejabat']."<br>Nip. ".$data_cek2['nip']; }?></center></td>
                </tr>
                <tr>
                  <td class="border5" align="right" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border4" valign="top"> </td>
                  <td class="border5"></td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top"> </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border4" valign="top"> </td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="9" height="75px" valign="bottom"><center><?php if ($data_cek3['nama_pejabat'] == '') {}else{ ?><?php echo $data_cek3['jabatan']."<br><br><br>".$data_cek3['nama_pejabat']."<br>Nip. ".$data_cek3['nip']; }?></center></td>
                </tr>
                <tr>
                  <td class="border5" align="right" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border4" valign="top"> </td>
                  <td class="border5"></td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top"> </td>
                  <td class="border5"></td>
                </tr>
                <tr>
                  <td class="border5"></td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border5" valign="top">&nbsp;</td>
                  <td class="border4" valign="top"> </td>
                  <td class="border3"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border5" colspan="3"></td>
                  <td class="border6"></td>
                  <td class="border5"></td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top">&nbsp;</td>
                  <td class="border3" valign="top"> </td></td>
                  <td class="border3"></td>
                </tr>
                <tr>
                  <td class="border1" colspan="9" height="75px" valign="bottom"><center><?php if ($data_cek4['nama_pejabat'] == '') {}else{ ?><?php echo $data_cek4['jabatan']."<br><br><br>".$data_cek4['nama_pejabat']."<br>Nip. ".$data_cek4['nip']; }?></center></td>
                </tr>
                
                <?php if ($ttd_ub == '') { ?>
                <tr>
                  <td class="border3" align="right" valign="top"></td>                 
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top"></td>                  
                  <td class="border3" colspan="4"><center><b><!--a.n BUPATI BIREUEN--></b></center></td>                
                </tr>
                <tr> 
                  <td class="border3"></td>                   
                  <td class="border3"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3"></td>
                  <td class="border3" colspan="5"><center><b><?php echo ucfirst($data_ttd['jabatan']); ?><br><br><br></b></center></td>               
                </tr>
                <tr>
                  <td class="border3"></td>  
                  <td class="border3" colspan="4" align="justify">
                    
                  </td>  
                   <td class="border3" colspan="5" height="30px" valign="bottom">
                    <center>
                      <b><?php echo ucfirst($data_ttd['nama']); ?></b><br>
                      <?php echo ucfirst($data_ttd['pangkat']); ?><br>
                       <?php echo konversi_nip($data_ttd['nip']); ?>
                    </center>
                   </td>        
                </tr>
              <?php }else{ ?>
                 <tr>
                  <td class="border3" align="right" valign="top"></td>                 
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top">:</td>
                  <td class="border3" valign="top"></td>
                  <td class="border3" colspan="4"><center><b><!--a.n BUPATI BIREUEN--></b></td>                
                </tr>
                <tr> 
                  <td class="border3"></td>                   
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3"></td>
                  <td class="border3" colspan="5"><center>
                  <b><?php echo ucfirst($data_ttd['jabatan']); ?></b><br>u.b<br>
                    <?php 
                  $sql_tt = "SELECT * FROM ttd INNER JOIN pegawai ON ttd.nip=pegawai.nip WHERE id_ttd='$ttd_ub'";
                    $tampil_tt = mysqli_query($koneksi, $sql_tt);     
                    $data_tt = mysqli_fetch_array($tampil_tt);
                  ?>
                  <b><?php echo ucfirst($data_tt['jabatan']); ?><br><br></b>
                  </center></td>               
                </tr>
                <tr>
                  <td class="border3"></td>  
                  <td class="border3" colspan="4" align="justify" valign="top">
                   
                  </td>  
                   <td class="border3" colspan="5" valign="bottom">
                    <center>
                      <b><?php echo ucfirst($data_tt['nama']); ?></b><br>
                      <?php echo ucfirst($data_tt['pangkat']); ?><br>
                       <?php echo konversi_nip($data_tt['nip']); ?>
                    </center>
                   </td>        
                </tr>
                <?php } ?>
                <tr>
                  <td class="border3"></td>
                  <td class="border3"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3" valign="top"></td>
                  <td class="border3"></td>
                  <td class="border3" colspan="5"> </td>
                </tr>
                <tr>
                  <td class="border3"></td>
                  <td class="border3" colspan="4" align="justify">
                    
                  </td>
                   <td class="border3" colspan="5" height="30px" valign="bottom"> </td>
                </tr>
             
                <tr>
                  <td class="border2" colspan="9" align="right"></td>
                </tr>
                <tr>
                  <td class="border1" align="right"></td>
                  <td class="border1" colspan="8"></td>
                </tr>
                <tr>
                  <td class="border3" align="right" valign="top"></td>
                  <td class="border3" colspan="8" align="justify">
                    
                  </td>
                </tr>
              </tbody>
            </table>
            
            </td>
          </tr>

        </table>
      </div>
    </div>
  </div>

    
            </center>
          </div>

        </div>
      </div>
    </div>
  </div>
 </form>
</div></div>


</body>
</html>