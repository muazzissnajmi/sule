<?php

include "../koneksi/koneksi2.php";

$nip = mysqli_real_escape_string($connect, $_POST['nip']);
$sql = "select * from pegawai where nip = '$nip'";
$process = mysqli_query($connect, $sql);
$num = mysqli_num_rows($process);
$data = mysqli_fetch_array($process);
if($num == 0){
	echo " ";
}else{ ?>
	<div class="alert alert-error span11">
        <button class="close" data-dismiss="alert">×</button>
        <strong>Warning!</strong> NIP diatas sudah terdaftar disystem atas nama <strong><?php echo $data['nama']; ?></strong>!</div>
    </div>
<?php }
?>
