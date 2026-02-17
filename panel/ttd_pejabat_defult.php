<?php include 'session.php' ?>
<?php
include "../koneksi/koneksi.php";
error_reporting(0);

$id  = addslashes($_POST['id']);
$defult  = addslashes($_POST['defult']);

    $sql=mysqli_query($koneksi, "UPDATE ttd_pejabat SET defult = '$defult' WHERE nip_pejabat = '$id'");
    
    echo "<script type='text/javascript'> document.location = '?page=ttd_pejabat&msg=3'; </script>";          
    
?>