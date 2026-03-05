<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

if ($id != '') {
    // Ambil no_spt dari SPT
    $sql_ = "SELECT * FROM spt WHERE id_spt = '$id'";
    $tampil_ = mysqli_query($koneksi, $sql_);     
    $data_ = mysqli_fetch_array($tampil_);
    $no_spt_ = $data_['no_spt'] ?? '';

    // Hapus data terkait
    $sql3 = mysqli_query($koneksi, "DELETE FROM spt WHERE id_spt = '$id'");
    $sql4 = mysqli_query($koneksi, "DELETE FROM pengikut WHERE no_spt = '$no_spt_'");
}

echo "<script type='text/javascript'> document.location = '?page=spt&msg=1'; </script>";
?>
