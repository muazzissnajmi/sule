<?php
include "../koneksi/koneksi.php";

$tampil=mysqli_query($koneksi, "SELECT * FROM sub_uraian WHERE id_uraian='$_POST[kategori_pesanan]'");
$jml=mysqli_num_rows($tampil);
if($jml > 0){
    
     while($r=mysqli_fetch_array($tampil)){
         echo "<option value=$r[id_suburaian]>$r[nama_suburaian]</option>";
		 
     }
}else{
    //echo "<option selected>-- Sub Item Barang/Jasa Tidak Ada, Pilih Yang Lain --</option>";
}
?>