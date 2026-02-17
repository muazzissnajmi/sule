<?php

include "../koneksi/koneksi2.php";

$username = mysqli_real_escape_string($connect, $_POST['username']);
$sql = "SELECT * FROM users WHERE username = '$username'";
$process = mysqli_query($connect, $sql);
$num = mysqli_num_rows($process);
$data = mysqli_fetch_array($process);
if($num == 0){
	echo " ";
}else{ ?>
	<div class="alert alert-error span11">
        <button class="close" data-dismiss="alert">×</button>
        <strong>Warning!</strong> username diatas sudah terdaftar disystem atas nama <strong><?php echo $data['nama']; ?></strong>!</div>
    </div>
<?php }
?>
