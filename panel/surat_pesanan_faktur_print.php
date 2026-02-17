<?php
include "../koneksi/koneksi.php";
error_reporting(1);
$tgl_dari = addslashes($_GET['tgl_dari']);
$tgl_sampai = addslashes($_GET['tgl_sampai']);
$rekanan = addslashes($_GET['rekanan']);
$rekening = addslashes($_GET['rekening']);

function getKodeRekening($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT kode_rekening FROM rekening WHERE id_rekening = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return $row['kode_rekening'];
  } else {
    return "-";
  }
}
function getNamaRekening($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT nama_rekening FROM rekening WHERE id_rekening = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return $row['nama_rekening'];
  } else {
    return "-";
  }
}
function getTahunRekening($id) {
  include "../koneksi/koneksi.php"; // pastikan koneksi aktif

  $id = intval($id);
  $q = mysqli_query($koneksi, "SELECT tahun FROM rekening WHERE id_rekening = '$id' LIMIT 1");

  if ($row = mysqli_fetch_assoc($q)) {
    return $row['tahun'];
  } else {
    return "-";
  }
}

function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
      $temp = " ". $huruf[$nilai];
    } else if ($nilai <20) {
      $temp = penyebut($nilai - 10). " Belas";
    } else if ($nilai < 100) {
      $temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
    } else if ($nilai < 200) {
      $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
      $temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
      $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
      $temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
      $temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
      $temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
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
function tgl_indo($tgl_spt){
  $bulan = array (
    1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
  );
  $pecahkan = explode('-', $tgl_spt);
  return $pecahkan[0] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[2];
}

function konversi_nip($nipk, $batas = " ") {
  $nipk = trim($nipk," ");
  if(strlen($nipk) == 18) {
    return substr($nipk,0,8).$batas.substr($nipk,8,6).$batas.substr($nipk,14,1).$batas.substr($nipk,15,3);
  } else {
    return $nipk;
  }
}

// Ambil semua pesanan di rentang tanggal

$sql = "
SELECT 
    a.id_amprahan,
    a.kode_amprahan,
    a.no_amprahan,
    DATE_FORMAT(a.tanggal, '%d-%m-%Y') AS tgl_indonesia,
    a.id_rekanan,
    a.id_pejabat,
    a.tahun,
    ad.uraian,
    ad.banyak,
    ad.satuan,
    ad.harga
FROM amprahan a
LEFT JOIN amprahan_detail ad 
    ON ad.id_amprahan = a.id_amprahan
WHERE a.tanggal 
    BETWEEN STR_TO_DATE('$tgl_dari', '%d-%m-%Y')
    AND STR_TO_DATE('$tgl_sampai', '%d-%m-%Y')
    AND a.id_rekanan = '$rekanan'
    AND a.id_rekening = '$rekening'
ORDER BY a.tanggal ASC, a.id_amprahan ASC
";

$q = mysqli_query($koneksi, $sql) or die(mysqli_error($koneksi));

?>

<!--<script>window.print();</script>-->

<!DOCTYPE html>
<html lang="en">
<head>
<title>Faktur Pesanan Barang</title>
<link href="../img/logo_.png" rel="shortcut icon">
<style>
.table-faktur {
  width: 100%;
  border-collapse: collapse;
  font-family: sans-serif;
    font-size: 12px;
}

/* Header tabel tetap pakai border penuh */
.table-faktur th {
  border: 1px solid #000;
  padding: 6px 8px;
  text-align: center;
  background: #ffffff;
  font-weight: bold;
}

/* Isi tabel hanya border kiri dan kanan */
.table-faktur td {
  border-left: 1px solid #000;
  border-right: 1px solid #000;
  padding: 6px 8px;
  vertical-align: top;
}


/* Tambahkan garis bawah hanya di baris terakhir agar tabel tetap tertutup */
.table-faktur tr:last-child td {
  border-bottom: 1px solid #000;
}

/* Kolom tertentu rata kanan / tengah */
.table-faktur td.price { text-align: right; }
.table-faktur td.no, .table-faktur td.tgl { text-align: center; width: 80px; }

table {
  border-collapse: collapse;
  width: 100%;
  page-break-inside: auto;
}

thead {
  display: table-row-group; /* biar header nggak muncul ulang */
}

tr {
  page-break-inside: avoid;
  page-break-after: auto;
}
.page {
        width: 210mm;
        min-height: 330mm;
        padding: 15mm;
        margin: 5mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        page-break-inside: auto;
        position: relative;
    }
@page {
        size: F4;
        margin: 0;
        size: portrait;
    }
@media print {
    
  @page {
    margin-top: 15mm;
    margin-bottom: 10mm;
    
  }

  @page:first {
    margin-top: 10mm;
  }

  html, body {
    width: 210mm;
    height: 330mm;
  }

  .page {
    margin: 0;
    border: none;
    border-radius: 0;
    box-shadow: none;
    background: none;
  }

  .page + .page {
    padding-top: 10mm; /* padding tambahan di halaman kedua dst */
  }
  
  
}



</style>
</head>
<body>


<div class="page" style="font-family: 'Arial', serif; ">
  <center>
    
    <h3>FAKTUR</h3>
    <p>NOMOR :     /<?php echo getTahunRekening($rekening);?></p>
  </center>

  <p>Kepada Yth,</p>
  <p>Kepala Bagian Umum</p>
  <p>Setdakab Bireuen</p>
  <p>di</p>
  <p>    Bireuen</p><br>

<style>


.table-faktur th.no { width: 5%; }
.table-faktur th.tgl { width: 15%; }
.table-faktur th.uraian { width: 40%; }
.table-faktur th.banyak { width: 10%; }
.table-faktur th.harga, .table-faktur th.jumlah { width: 15%; }
</style>
<table class="table-faktur">
    <thead>
        <tr>
            <th class="no" rowspan="2">No</th>
            <th class="tgl" rowspan="2">Tanggal</th>
            <th class="uraian" rowspan="2">Uraian Barang</th>
            <th class="banyak" rowspan="2">Banyaknya</th>
            <th colspan="2">Harga (Rp)</th>
        </tr>
        <tr>
            <th class="harga">Satuan</th>
            <th class="jumlah">Jumlah</th>
        </tr>
    </thead>
    <tbody>

<?php
$no = 1;
$tanggal_sebelumnya = '';
$total = 0;
while ($row = mysqli_fetch_array($q)) {
    
    $tgl_format = $row['tgl_indonesia'];
    echo "<tr>";
    echo "<td class='no'>{$no}</td>";
    // tampilkan tanggal hanya jika berbeda
      if ($tanggal_sebelumnya == $tgl_format) {
          echo "<td></td>";
      } else {
          echo "<td>$tgl_format</td>";
          $tanggal_sebelumnya = $tgl_format;
      }
    echo "<td>{$row['uraian']}</td>";
    echo "<td class='no'>{$row['banyak']} {$row['satuan']}</td>";
    echo "<td class='price'>" . number_format($row['harga'], 0, ',', '.') . "</td>";
    echo "<td class='price'>" . number_format($row['harga']*$row['banyak'], 0, ',', '.') . "</td>";
    echo "</tr>";
    $jumlah = $row['banyak'] * $row['harga']; // asumsi ini rumus total per item
    $total += $jumlah;
    $no++;
}
echo "<tr>";
echo "<td class='no'></td>";
echo "<td></td>";
echo "<td></td>";
echo "<td class='no'></td>";
echo "<td class='price'></td>";
echo "<td class='price'></td>";
echo "</tr>";

?>
<!-- TOTAL -->
    <tr>
      <th colspan="5" style="text-align: right;"><strong>Total</strong></th>
      <th style="text-align: right;"><strong><?= number_format($total,0,',','.'); ?></strong></th>
    </tr>
    
    <!-- TERBILANG -->
    <tr>
      <th colspan="6" style="text-align: left;">
        <em>Terbilang: <?= ucfirst(terbilang($total)); ?> Rupiah</em>
      </th>
    </tr>
</tbody>
</table>

  <p>Demikian Pesanan ini dibuat dan untuk dilaksanakan setelah menerima Surat Pesanan ini.</p>

  <table width="100%">
    <tr>
      <td></td>
      <td width="350" align="center">
        Bireuen, <?php echo tgl_indo($tgl_sampai); ?><br>
        <?php 
        $sql_ttd = "SELECT * FROM rekanan WHERE id_rekanan='$rekanan'";
                    $tampil_ttd = mysqli_query($koneksi, $sql_ttd);     
                    $data_ttd = mysqli_fetch_array($tampil_ttd);
        
        echo strtoupper($data_ttd['nama_rekanan']); ?><br><br><br><br>
        <?php echo ucfirst($data_ttd['nama_direktur']); ?><br>
        Direktur<br>
        
      </td>
    </tr>
  </table>
  
  
</div>
<div class="page" style="font-family: 'Arial', serif; ">
    <!-- PAGE BREAK -->
    <div style="page-break-before: always;"></div>
    
    <!-- TANDA PENERIMAAN -->
    <table class="table1" border="0">
              
              <tbody>           
                <tr>
                  <td width="200px" ></td>
                  <td width="70px" >No.</td>
                  <td width="5px">:</td>
                  <td width="150px" style="display:inline-block; border-bottom:1px solid #000; ">09</td>
                  <td width="70px"></td>
                  <td width="100px" style="display:inline-block; border-bottom:1px solid #000; ">ASLI</td>
                </tr>
                <tr>
                  <td width="200px" ></td>
                  <td width="70px" >No. Rek</td>
                  <td width="5px">:</td>
                  <td width="150px" style="display:inline-block; border-bottom:1px solid #000; "><?php echo getKodeRekening($rekening); ?></td>
                  <td width="70px"></td>
                  <td width="100px" style="display:inline-block; border-bottom:1px solid #000; ">KEDUA</td>
                </tr>
                <tr>
                  <td width="200px" ></td>
                  <td width="70px" >Tahun</td>
                  <td width="5px">:</td>
                  <td width="150px" style="display:inline-block; border-bottom:1px solid #000; "><?php echo getTahunRekening($rekening);?></td>
                  <td width="70px"></td>
                  <td width="100px" style="display:inline-block; border-bottom:1px solid #000; ">KETIGA</td>
                </tr>
                <tr>
                  <td width="200px" ></td>
                  <td width="70px" ></td>
                  <td width="5px"></td>
                  <td width="130px"></td>
                  <td width="70px"></td>
                  <td width="100px" style="display:inline-block; border-bottom:1px solid #000; ">KEEMPAT</td>
                </tr>
                
                
                </tbody>
              </table>
    <div style="font-family: 'Arial', serif; margin: 10px;">
      <h3 style="
  text-align:center;
  text-decoration:underline;
  letter-spacing:4px;
">
  TANDA PENERIMAAN
</h3>

        <p style="line-height:1.8;">
          <span style="display:inline-block;width:140px;vertical-align:top;">
            Sudah terima dari
          </span>
          <span style="display:inline-block;width:10px;vertical-align:top;">:</span>
          <span style="display:inline-block;width:calc(100% - 160px);vertical-align:top;text-align: justify;">
            Bendahara Pengeluaran Pembantu Bagian Umum Setdakab Bireuen
          </span>
        </p>
        
        <p style="line-height:1.8;">
          <span style="display:inline-block;width:140px;vertical-align:top;">
            Uang sebanyak
          </span>
          <span style="display:inline-block;width:10px;vertical-align:top;">:</span>
          <span style="display:inline-block;width:calc(100% - 160px);vertical-align:top;text-align: justify;font-style: italic;">
            <b><?= ucfirst(terbilang($total)); ?> Rupiah</b>
          </span>
        </p>
        
        <p style="line-height:1.8;">
          <span style="display:inline-block;width:140px;vertical-align:top;">
            Untuk pembayaran
          </span>
          <span style="display:inline-block;width:10px;vertical-align:top;">:</span>
          <span style="display:inline-block;width:calc(100% - 160px);vertical-align:top;text-align: justify;line-height:1.8;">
            Biaya <?= getNamaRekening($rekening); ?> pada <?= $data_ttd['nama_rekanan']; ?> Tahun <?php echo getTahunRekening($rekening);?> Bendahara Pengeluaran Pembantu Bagian Umum Setdakab Bireuen
          </span>
        </p>

      <table width="100%" style="margin-top: 20px;">
        <tr>
          <td width="50%"></td>
          <td colspan="3" style="padding-left: 80px;">Bireuen, <?php echo tgl_indo($tgl_sampai); ?></td>
        </tr>
        <tr>
          <td style="padding-left: 80px;">Setuju dibayar</td>
          <td colspan="3" style="padding-left: 80px;">Yang Menerima,</td>
        </tr>
        <tr>
          <td style="padding-left: 40px;">Kuasa Pengguna Anggaran</td>
          <td></td>
        </tr>
        
        <tr>
          <td style="padding-top: 100px;padding-left: 80px;">
            <b>Sulaiman, S.Pd</b>
          </td>
          <td style="padding-top: 100px;padding-left: 40px;">Nama
          </td>
          <td style="padding-top: 100px;">
            :
          </td>
          <td style="padding-top: 100px;">
            <?php echo ucfirst($data_ttd['nama_direktur']); ?>
          </td>
        </tr>
        <tr>
            <td style="padding-left: 40px;">
            NIP. 19670521 200801 1 096
          </td>
          <td style="width: 10%; padding-left: 40px;">
            Pekerjaan
          </td>
          <td >
            : 
          </td>
          <td >
            Direktur 
          </td>
        </tr>
        <tr>
          <td style="padding-left: 40px;">
          </td>
          <td style="padding-left: 40px;">
            Alamat: 
          </td>
          <td >
            : 
          </td>
          <td >
            Bireuen
          </td>
        </tr>
        
      </table>
    
      <p style="margin-top: 40px;padding-left: 40px;"><b>Jumlah <u>Rp. <?= number_format($total,0,',','.'); ?></u></b></p>
    
      <p style="width:50%;padding-left: 40px;">Barang/pekerjaan yang dimaksud telah diterima<br>diselenggarakan dengan sempurna pada tanggal <br><?php echo tgl_indo($tgl_sampai); ?></p>
    
      <table width="100%" style="margin-top: 20px;">
        <tr>
          <td style="padding-left: 40px;"></td>
          <td style="padding-left: 40px;">Lunas dibayar</td>
        </tr>
        <tr>
          <td style="padding-left: 40px;">Pejabat Pelaksana Teknis Kegiatan</td>
          <td style="padding-left: 40px;">Bendahara Pengeluaran Pembantu</td>
        </tr>
        <tr>
          <td style="padding-top: 100px;padding-left: 80px;">
            <b>Eff Marlina, S.Pi</b>
          </td>
          <td style="padding-top: 100px;padding-left: 80px;">
            <b>Eva Aryani, SE</b>
          </td>
        </tr>
        <tr>
          <td style="padding-left: 40px;">
            NIP. 19810520 200801 2 002
          </td>
          <td style="padding-left: 40px;">
            NIP. 19670521 200801 1 096
          </td>
        </tr>
      </table>
    </div>
</div>
<?php
$sql_foto = "
SELECT 
    d.id_detail,
    d.uraian,
    f.filename
FROM amprahan_detail d
JOIN amprahan a
    ON a.id_amprahan = d.id_amprahan
LEFT JOIN amprahan_foto f 
    ON f.id_detail = d.id_detail
WHERE a.tanggal 
    BETWEEN STR_TO_DATE('$tgl_dari', '%d-%m-%Y')
    AND STR_TO_DATE('$tgl_sampai', '%d-%m-%Y')
    AND a.id_rekanan = '$rekanan' AND a.id_rekening = '$rekening'
ORDER BY d.id_detail ASC
";


$q_foto = mysqli_query($koneksi, $sql_foto) or die(mysqli_error($koneksi));
$fotos = [];

while ($r = mysqli_fetch_assoc($q_foto)) {
    $id = $r['id_detail'];

    if (!isset($fotos[$id])) {
        $fotos[$id] = [
            'uraian' => $r['uraian'],
            'files'  => []
        ];
    }

    // ⛔ jangan push filename kosong
    if (!empty($r['filename'])) {
        $fotos[$id]['files'][] = $r['filename'];
    }
}


?>
<style>
.foto-item {
    margin-bottom: 30px;
    page-break-inside: avoid;
}

.foto-item h4 {
    margin-bottom: 10px;
    padding-bottom: 5px;
}

.foto-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

.foto-grid img {
    width: 600px;
    height: 400px;
    object-fit: contain; /* ðŸ”¥ tidak crop */
    border: 1px solid #000;
    

}
.page-footer {
    position: absolute;
    bottom: 10mm;
    left: 0;
    width: 100%;
    text-align: center;
}

.page-footer img {
    width: 60%;
    max-width: 150px;
}
</style>

<div class="page">
    <!-- PAGE BREAK -->
    <div style="page-break-before: always;"></div>
    
    <!-- FOTO PENERIMAAN-->
    <div style="font-family: 'Times New Roman', serif; margin: 40px;">
      <h3 style="text-align: center; text-decoration: underline;">DOKUMEN FOTO</h3>
    
      <?php if (empty($fotos)): ?>
          <p style="text-align:center;">Tidak ada foto penerimaan.</p>
      <?php else: ?>
    
          <?php foreach ($fotos as $item): ?>
    <div class="foto-item">
        <h4><?= htmlspecialchars($item['uraian']); ?></h4>

        <?php if (!empty($item['files'])): ?>
            <div class="foto-grid">
                <?php foreach ($item['files'] as $img): ?>
                    <img src="../uploads/amprahan/<?= htmlspecialchars($img); ?>" style="width:600px;height:400px;object-fit:contain;margin-bottom:10px;">
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p style="font-style:italic;color:#777;">
                (Belum ada foto untuk item ini)
            </p>
        <?php endif; ?>

    </div>
<?php endforeach; ?>

    
      <?php endif; ?>
     
    </div>
 <div class="page-footer">
    <img src="../img/logo_login.png" alt="Logo">
</div>
</div>


</body>
</html>
