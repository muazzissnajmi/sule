<?php include 'session.php'; ?>
<?php
include "../koneksi/koneksi.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ambil data utama
$kode_amprahan      = addslashes($_POST['kode_pesanan']);       // PB00123
$kode_item          = addslashes($_POST['kode_item']);
$no_amprahan        = addslashes($_POST['no_pesanan']);
$tgl_pesanan        = addslashes($_POST['tgl_pesanan']);
$tahun              = addslashes($_POST['tahun_']);

$tujuan             = addslashes($_POST['tujuan']);             // id_rekanan
$pejabat            = addslashes($_POST['pejabat_berwenang']);  // id_ttd_pejabat

$id_program         = addslashes($_POST['program']);
$id_kegiatan        = addslashes($_POST['kegiatan']);
$id_sub_kegiatan    = addslashes($_POST['sub_kegiatan']);
$id_rekening        = addslashes($_POST['rekening']);
$id_uraian          = intval($_POST['uraian']);

// Konversi bulan ke romawi
$bln = substr($tgl_pesanan, 3, 2);
$romawi = [
    '01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI',
    '07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'
];
$bulan_romawi = $romawi[$bln];

// Format tanggal SQL
$tgl_sql = date('Y-m-d', strtotime($tgl_pesanan));


// ===========================
// 1. SIMPAN HEADER AMPRAHAN
// ===========================
$sql_header = "
    INSERT INTO amprahan (
        kode_amprahan, kode_item, no_amprahan, 
        bulan_romawi, tahun, tanggal,
        id_rekanan, id_pejabat,
        id_program, id_kegiatan, id_sub_kegiatan, id_rekening, id_uraian
    ) VALUES (
        '$kode_amprahan', '$kode_item', '$no_amprahan',
        '$bulan_romawi', '$tahun', '$tgl_sql',
        '$tujuan', '$pejabat',
        '$id_program', '$id_kegiatan', '$id_sub_kegiatan', '$id_rekening', '$id_uraian'
    )
";

$insert_header = mysqli_query($koneksi, $sql_header);

if (!$insert_header) {
    die("Gagal menyimpan amprahan: " . mysqli_error($koneksi));
}

// Ambil id_amprahan baru
$id_amprahan = mysqli_insert_id($koneksi);


// ===========================
// 2. SIMPAN DETAIL AMPRAHAN
// ===========================
if (!empty($_POST['banyak'])) {

    foreach ($_POST['banyak'] as $i => $banyak) {

        $banyak     = addslashes($_POST['banyak'][$i]);
        $harga      = 0;
        $satuan     = addslashes($_POST['satuan'][$i]);
        $uraianItem = addslashes($_POST['uraian_detail'][$i]);
        $ket        = addslashes($_POST['ket'][$i]);

        // Insert detail
        $sql_detail = "
            INSERT INTO amprahan_detail (
                id_amprahan, banyak, satuan, uraian, keterangan
            ) VALUES (
                '$id_amprahan', '$banyak', '$satuan', '$uraianItem', '$ket'
            )
        ";

        $insert_detail = mysqli_query($koneksi, $sql_detail);

        if (!$insert_detail) {
            die("Gagal menyimpan detail: " . mysqli_error($koneksi));
        }
    }
}


// ===========================
// 3. KIRIM NOTIF BERHASIL
// ===========================
echo "<script type='text/javascript'>
        document.location = '?page=sups&msg=4';
      </script>";
exit;

?>
