<?php
require '../koneksi/koneksi.php';
include 'session.php';

$where = [];

if (!empty($_GET['rekanan'])) {
    $rekanan = mysqli_real_escape_string($koneksi, $_GET['rekanan']);
    $where[] = "a.id_rekanan = '$rekanan'";
}

if (!empty($_GET['rekening'])) {
    $rekening = mysqli_real_escape_string($koneksi, $_GET['rekening']);
    $where[] = "a.id_rekening = '$rekening'";
}

$sql = "
SELECT 
    p.no_bukti,
    r.nama_rekanan,
    CONCAT(
        rek.kode_rekening, ' - ',
        rek.nama_rekening,
        ' (Rp. ', FORMAT(p.nilai, 0), ')'
    ) AS rekening
FROM pesanan p
JOIN rekanan r ON r.id_rekanan = p.id_rekanan
JOIN rekening rek ON rek.id_rekening = p.id_rekening
";

if ($where) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}

$query = mysqli_query($koneksi, $sql);

$data = [];
while ($row = mysqli_fetch_row($query)) {
    $data[] = $row;
}

echo json_encode([
    'aaData' => $data
]);