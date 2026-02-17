<?php
include "../koneksi/koneksi2.php";

if (empty($_POST['nip']))
  exit;

$nip = mysqli_real_escape_string($connect, $_POST['nip']);

// -----------------------------
// 1. Pegawai yang bentrok
// -----------------------------
$sqlBentrok = "
    SELECT DISTINCT p.nama
    FROM lpd a
    INNER JOIN kwitansi b ON a.id_spt = b.id_spt
    INNER JOIN pegawai p ON p.nip = b.nip
    WHERE b.nip IN ($nip)
      AND a.kunci = 'Y'
";

$qBentrok = mysqli_query($connect, $sqlBentrok);
$bentrokCount = mysqli_num_rows($qBentrok);

$bentrokNama = [];
while ($row = mysqli_fetch_assoc($qBentrok)) {
  $bentrokNama[] = $row['nama'];
}

// -----------------------------
// 2. Pegawai yang aman
// -----------------------------
$sqlAman = "
    SELECT nama
    FROM pegawai
    WHERE nip IN ($nip)
      AND nip NOT IN (
          SELECT b.nip
          FROM lpd a
          INNER JOIN kwitansi b ON a.id_spt = b.id_spt
          WHERE a.kunci = 'Y'
      )
";

$qAman = mysqli_query($connect, $sqlAman);

// -----------------------------
// OUTPUT
// -----------------------------

// Warning jika ada bentrok
// OUTPUT PERINGATAN
if ($bentrokCount > 0) {

  $namaBentrok = implode(', ', $bentrokNama);

  echo "<span class='label label-important'>
            <span class='icon-exclamation-sign'></span>
            Pegawai yang anda pilih <strong>$namaBentrok</strong>
            sedang ditugaskan di SPPD lain!
          </span><br>";
}


// Pegawai aman
while ($row = mysqli_fetch_assoc($qAman)) {
  echo "<span class='label label-success' >
            <span class='icon-ok'></span> {$row['nama']}
          </span><br>";
}
?>