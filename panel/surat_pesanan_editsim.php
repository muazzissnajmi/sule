<?php include 'session.php'; ?>
<?php
include "../koneksi/koneksi.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ===============================
// Ambil ID Amprahan yang diupdate
// ===============================
$id_amprahan = intval($_POST['id_amprahan']);

$kode_amprahan      = addslashes($_POST['kode_amprahan']);
$kode_item          = addslashes($_POST['kode_item']);
$no_amprahan        = addslashes($_POST['no_amprahan']);
$tgl_pesanan        = addslashes($_POST['tgl_pesanan']);
$tahun              = addslashes($_POST['tahun_']);

$tujuan             = addslashes($_POST['tujuan']);
$pejabat            = addslashes($_POST['pejabat_berwenang']);

$id_program         = addslashes($_POST['program']);
$id_kegiatan        = addslashes($_POST['kegiatan']);
$id_sub_kegiatan    = addslashes($_POST['sub_kegiatan']);
$id_rekening        = addslashes($_POST['rekening']);
$id_uraian          = intval($_POST['uraian']);

// ============ DATE FORMAT ============
$bln = substr($tgl_pesanan, 3, 2);
$romawi = [
    '01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI',
    '07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'
];
$bulan_romawi = $romawi[$bln];
$tgl_sql = date('Y-m-d', strtotime($tgl_pesanan));


// ===============================
// 1. UPDATE HEADER AMPRAHAN
// ===============================
$sql_header = "
    UPDATE amprahan SET
        kode_amprahan   = '$kode_amprahan',
        kode_item       = '$kode_item',
        no_amprahan     = '$no_amprahan',
        bulan_romawi    = '$bulan_romawi',
        tahun           = '$tahun',
        tanggal         = '$tgl_sql',
        id_rekanan      = '$tujuan',
        id_pejabat      = '$pejabat',
        id_program      = '$id_program',
        id_kegiatan     = '$id_kegiatan',
        id_sub_kegiatan = '$id_sub_kegiatan',
        id_rekening     = '$id_rekening',
        id_uraian       = '$id_uraian'
    WHERE id_amprahan = '$id_amprahan'
";

$update_header = mysqli_query($koneksi, $sql_header);
if (!$update_header) {
    die("Gagal update amprahan: " . mysqli_error($koneksi));
}


// 2. UPDATE DETAIL LAMA
if (!empty($_POST['banyak_edit'])) {

    foreach ($_POST['banyak_edit'] as $id_detail => $banyak) {

        $banyak     = addslashes($banyak);
        $satuan     = addslashes($_POST['satuan_edit'][$id_detail]);
        $uraian     = addslashes($_POST['uraian_edit'][$id_detail]);
        $ket        = addslashes($_POST['ket_edit'][$id_detail]);

        mysqli_query($koneksi, "
            UPDATE amprahan_detail
            SET banyak='$banyak',
                satuan='$satuan',
                uraian='$uraian',
                keterangan='$ket'
            WHERE id_detail='$id_detail'
              AND id_amprahan='$id_amprahan'
        ");
    }
}



// ===============================
// 3. HAPUS DETAIL YANG DIHAPUS USER
// ===============================
$qExist = mysqli_query($koneksi, "SELECT id_detail FROM amprahan_detail WHERE id_amprahan='$id_amprahan'");
$existing = [];

while ($d = mysqli_fetch_assoc($qExist)) {
    $existing[] = $d['id_detail'];
}

$posted = !empty($_POST['banyak_edit'])
    ? array_keys($_POST['banyak_edit'])
    : [];

foreach ($existing as $id_detail) {
    if (!in_array($id_detail, $posted)) {
        mysqli_query($koneksi, "DELETE FROM amprahan_detail WHERE id_detail='$id_detail' AND id_amprahan='$id_amprahan'");
    }
}
// ===============================
// 4. INSERT DETAIL BARU
// ===============================
if (!empty($_POST['banyak_new'])) {
    foreach ($_POST['banyak_new'] as $i => $banyak) {

        $banyak  = trim($_POST['banyak_new'][$i]);
        $satuan  = trim($_POST['satuan_new'][$i]);
        $uraian  = trim($_POST['uraian_new'][$i]);
        $ket     = trim($_POST['ket_new'][$i]);

        // Skip row kosong
        if ($banyak === "" && $uraian === "" && $satuan === "") continue;

        mysqli_query($koneksi, "
            INSERT INTO amprahan_detail
                (id_amprahan, banyak, satuan, uraian, keterangan)
            VALUES
                ('$id_amprahan', '$banyak', '$satuan', '$uraian', '$ket')
        ");
    }
}





// ===============================
// 5. NOTIFIKASI SUKSES
// ===============================
echo "<script>
        document.location='?page=sups&msg=5';
      </script>";
exit;
?>
