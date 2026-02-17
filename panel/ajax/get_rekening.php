<?php
include "../../koneksi/koneksi.php";

$id = isset($_POST['id_kegiatan']) ? intval($_POST['id_kegiatan']) : 0;

$tampil = mysqli_query($koneksi, "SELECT * FROM rekening WHERE id_kegiatan='$id'");
$jml = mysqli_num_rows($tampil);

if ($jml > 0) {
    while ($r = mysqli_fetch_array($tampil)) {
        echo "<option value='{$r['id_rekening']}'> {$r['kode_rekening']} - {$r['nama_rekening']}</option>";
    }
} else {
    echo "<option selected >-- Tidak ada data --</option>";
}

?>

