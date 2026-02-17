<?php include 'session.php'; ?>
<?php
include "../koneksi/koneksi.php";
ini_set('display_errors', 1);
error_reporting(E_ALL);

function resizeImage($src, $dest, $maxW = 600, $maxH = 400, $quality = 80)
{
    list($w, $h, $type) = getimagesize($src);

    $ratio = min($maxW / $w, $maxH / $h, 1); // ⬅️ 1 = jangan diperbesar
    $newW = floor($w * $ratio);
    $newH = floor($h * $ratio);

    $dst = imagecreatetruecolor($newW, $newH);

    switch ($type) {
        case IMAGETYPE_JPEG:
            $srcImg = imagecreatefromjpeg($src);
            break;
        case IMAGETYPE_PNG:
            $srcImg = imagecreatefrompng($src);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
            break;
        default:
            return false;
    }

    imagecopyresampled($dst, $srcImg, 0, 0, 0, 0, $newW, $newH, $w, $h);

    if ($type == IMAGETYPE_JPEG) {
        imagejpeg($dst, $dest, $quality);
    } else {
        imagepng($dst, $dest);
    }

    imagedestroy($srcImg);
    imagedestroy($dst);

    return true;
}


// ===============================
// Ambil ID Amprahan yang diupdate
// ===============================
$id_amprahan = intval($_POST['id_amprahan']);
$no_faktur = addslashes($_POST['no_faktur']);

$sql_header = "
    UPDATE amprahan SET no_faktur = '$no_faktur' WHERE id_amprahan = '$id_amprahan'
";

$update_header = mysqli_query($koneksi, $sql_header);
if (!$update_header) {
    die("Gagal update amprahan: " . mysqli_error($koneksi));
}



// 2. UPDATE DETAIL LAMA
if (!empty($_POST['harga_edit'])) {

    foreach ($_POST['harga_edit'] as $id_detail => $harga) {

        $harga = preg_replace('/[^0-9]/', '', $harga);
        $harga = (int) $harga;
    
        mysqli_query($koneksi, "
            UPDATE amprahan_detail
            SET harga='$harga'
            WHERE id_detail='$id_detail'
              AND id_amprahan='$id_amprahan'
        ");
    }

}

$path = __DIR__ . '/../uploads/amprahan/';

foreach ($_FILES['foto_edit']['name'] as $id_detail => $files) {

    $id_detail = intval($id_detail);

    // cek ada upload baru
    $adaUpload = false;
    foreach ($files as $f) {
        if ($f != '') {
            $adaUpload = true;
            break;
        }
    }

    if (!$adaUpload) continue;

    // ambil & hapus foto lama
    $q = mysqli_query($koneksi, "
        SELECT filename 
        FROM amprahan_foto 
        WHERE id_detail = '$id_detail'
    ");

    while ($r = mysqli_fetch_assoc($q)) {
        $file = $path . $r['filename'];
        if (file_exists($file)) {
            unlink($file);
        }
    }

    mysqli_query($koneksi, "
        DELETE FROM amprahan_foto 
        WHERE id_detail = '$id_detail'
    ");

    // upload foto baru
    foreach ($files as $i => $filename) {

        if ($filename == '') continue;

        $tmp = $_FILES['foto_edit']['tmp_name'][$id_detail][$i];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $newName = $id_detail . '_' . time() . '_' . $i . '.' . $ext;
        $newName = mysqli_real_escape_string($koneksi, $newName);
        
        $dest = $path . $newName;


        if (resizeImage($tmp, $dest)) {
            mysqli_query($koneksi, "
                INSERT INTO amprahan_foto (id_detail, filename)
                VALUES ('$id_detail', '$newName')
            ");
        }
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
