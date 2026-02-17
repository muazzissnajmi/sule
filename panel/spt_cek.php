<?php

include "../koneksi/koneksi2.php";

// Sanitize the input
$no_spt = mysqli_real_escape_string($connect, $_POST['no_spt']);

// Prepare the SQL statement
$sql = "SELECT * FROM spt WHERE no_spt = ? AND cek_spt = 'Y'";

// Initialize a prepared statement
$stmt = mysqli_prepare($connect, $sql);

if ($stmt) {
    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "s", $no_spt);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Store the result
    mysqli_stmt_store_result($stmt);

    // Get the number of rows returned
    $num = mysqli_stmt_num_rows($stmt);

    // Check if the number of rows is zero
    if ($num == 0) {
        echo " ";
    } else {
        echo "<span class='label label-important'><span class='icon-exclamation-sign'></span> No. SPT ini sudah ada di database!! Harap gunakan No. SPT yang lain!!</span>";
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Handle the error if the statement preparation fails
    echo "Error: " . mysqli_error($connect);
}

?>
