<?php

include "../koneksi/koneksi2.php";

$no_spd = mysqli_real_escape_string($connect, $_POST['no_spd']);
$sql = "select * from spd where no_spd = '$no_spd'";
$process = mysqli_query($connect, $sql);
$num = mysqli_num_rows($process);
if($num == 0){
	echo " ";
}else{
	echo "<span class='label label-important'><span class='icon-exclamation-sign'></span> No. SPD ini sudah ada di database!! Harap gunakan No. SPD &nbsp;<br> &nbsp;&nbsp;&nbsp;&nbsp;yang lain!!</span>";
}
?>