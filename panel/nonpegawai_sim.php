<?php include 'session.php'; ?>
<?php
include "../koneksi/koneksi.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ambil data utama
$nama_nonpegawai    = addslashes($_POST['nama_nonpegawai']);       // PB00123
$nip_nonpegawai     = addslashes($_POST['nip_nonpegawai']);
$jenis_nonpegawai   = addslashes($_POST['jenis_nonpegawai']);
$gaji_nonpegawai    = preg_replace('/[^0-9]/', '', $_POST['gaji_nonpegawai']);

$id_program         = addslashes($_POST['program']);
$id_kegiatan        = addslashes($_POST['kegiatan']);
$id_sub_kegiatan    = addslashes($_POST['sub_kegiatan']);
$id_rekening        = addslashes($_POST['rekening']);
$id_uraian          = intval($_POST['uraian']);

// ===========================
// 1. SIMPAN PEGAWAI
// ===========================
$sql_header = "
    INSERT INTO non_pegawai (
        nama_nonpegawai, nip_nonpegawai, jenis_nonpegawai, gaji_nonpegawai, id_program, id_kegiatan, id_sub_kegiatan, id_rekening, id_uraian
    ) VALUES (
        '$nama_nonpegawai', '$nip_nonpegawai', '$jenis_nonpegawai', '$gaji_nonpegawai', '$id_program', '$id_kegiatan', '$id_sub_kegiatan', '$id_rekening', '$id_uraian'
    )
";

$insert_header = mysqli_query($koneksi, $sql_header);

if (!$insert_header) {
    die("Gagal menyimpan pegawai: " . mysqli_error($koneksi));
}


// ===========================
// 2. KIRIM NOTIF BERHASIL
// ===========================
echo "<script type='text/javascript'>
        document.location = '?page=nonpegawai&msg=4';
      </script>";
exit;

?>
