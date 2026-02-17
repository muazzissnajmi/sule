<?php
//connect ke database
  include "../koneksi/koneksi.php";
//harus selalu gunakan variabel term saat memakai autocomplete,
//jika variable term tidak bisa, gunakan variabel q
$term = trim(strip_tags($_GET['term']));
  
$qstring = "SELECT * FROM sppd_template WHERE nama_pejabat LIKE '".$term."%'";
//query database untuk mengecek tabel
$result = mysqli_query($koneksi, $qstring);
  
while ($row = mysqli_fetch_array($result))
{
    $row['value']=htmlentities(stripslashes($row['nama_pejabat']));
    //$row['id']=(int)$row['id'];
//buat array yang nantinya akan di konversi ke json
    $row_set[] = $row;
}
//data hasil query yang dikirim kembali dalam format json
echo json_encode($row_set);
?>