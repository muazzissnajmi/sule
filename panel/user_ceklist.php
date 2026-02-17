<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
error_reporting(0);

$username = addslashes($_POST['username']);
$ceklist  = addslashes($_POST['ceklist']);

if ($ceklist == '') {
	echo $ceklist_ = 'N';
}else{
	echo $ceklist_= 'Y';
}


    $sql=mysqli_query($koneksi, "UPDATE users SET aktif = '$ceklist_' WHERE username = '$username'");
    
    if ($ceklist_ == 'Y') {
    	echo "<script type='text/javascript'> document.location = '?page=user&msg=4'; </script>";
    }else{
    	echo "<script type='text/javascript'> document.location = '?page=user&msg=5'; </script>";
    }
              
    
?>