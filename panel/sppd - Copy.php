<?php $page = 'sppd'; ?>

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
  <div id="breadcrumb"> <a href="?page=home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">SPPD</a></div>
  
</div>
<div class="container-fluid">
  <form action="#">
    <h3>S P P D</h3>
  <div class="row-fluid">
    <div class="span7">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Input SPPD</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">           
            <div class="control-group">
              <label class="control-label">Nomor SPD :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Nomor" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pejabat Memberi Perintah :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Pejabat Memberi Perintah" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">ASN Pelaksana :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="ASN Pelaksana" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pangkat/Gol. :</label>
              <div class="controls">
                <input type="text"  class="span11" placeholder="Pangkat/Gol."  />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Jabatan/Instansi :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Jabatan/Instansi" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tingkat Pembayaran PD :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Tingkat Pembayaran PD" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Maksud Perjalanan Dinas :</label>
              <div class="controls"><textarea class="span11" ></textarea></div>
            </div>
            <div class="control-group">
              <label class="control-label">Alat Angkut :</label>
              <div class="controls">
                <select >
                  <option>Taxi</option>
                  <option>Mini Bus</option>
                  <option>Bus</option>
                  <option>Kereta Api</option>
                  <option>Kapal Laut</option>
                  <option>Pesawat</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tempat Berangkat :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Tempat Berangkat" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tempat Tujuan :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Tingkat Pembayaran PD" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Lama Perjalanan Dinas :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="" /> Hari                
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tgl Berangkat :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tgl Kembali :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
        </div>
      </div>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Pejabat Berwenang</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Dikeluarkan di :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Dikeluarkan di" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pejabat Berwenang :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Pejabat Berwenang" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Nama" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pangkat/Gol. :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Pangkat/Gol." />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">NIP :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="NIP" />
              </div>
            </div>
        </div>
      </div>
      
    </div>
    <div class="span5">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Berangkat</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
          
            <div class="control-group">
              <label class="control-label">Berangkat Dari :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tanggal :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tiba di :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tanggal :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
        </div>
      </div>

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Berangkat</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Berangkat Dari :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tanggal :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tiba di :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tanggal :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
        </div>
      </div>

      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Berangkat</h5>
        </div>
        <div class="widget-content nopadding form-horizontal">
            <div class="control-group">
              <label class="control-label">Berangkat Dari :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Ke :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tanggal :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tiba di :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Pada Tanggal :</label>
              <div class="controls">
                <div  data-date="12-02-2012" class="input-append date datepicker">
                  <input type="text" value="12-02-2012"  data-date-format="mm-dd-yyyy" class="span11" >
                  <span class="add-on"><i class="icon-th"></i></span> </div>
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
              <button type="reset" class="btn btn-primary">Reset</button>
              <button type="submit" class="btn btn-info">Edit</button>
              <button type="reset" class="btn btn-danger">Cancel</button>
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