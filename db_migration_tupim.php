<?php
include 'koneksi/koneksi.php';

$sql1 = "CREATE TABLE IF NOT EXISTS tupim_surat_masuk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    no_indeks VARCHAR(50),
    no_agenda VARCHAR(50),
    tanggal_terima DATE,
    sifat VARCHAR(50),
    isi_ringkas TEXT,
    lampiran VARCHAR(100),
    dari VARCHAR(100),
    tanggal_surat DATE,
    no_surat VARCHAR(100),
    no_hp VARCHAR(50),
    pengolah VARCHAR(100),
    kepada VARCHAR(100),
    hubungan_no VARCHAR(100),
    arsip_di VARCHAR(100),
    file_surat VARCHAR(255), 
    status_posisi VARCHAR(100) DEFAULT 'Bagian Umum', 
    status_selesai INT DEFAULT 0, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$sql2 = "CREATE TABLE IF NOT EXISTS tupim_surat_masuk_disposisi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_surat INT,
    tahap_ke INT, 
    dari_posisi VARCHAR(100),
    tujuan_disposisi VARCHAR(100),
    catatan VARCHAR(255),
    file_nota VARCHAR(255), 
    tgl_proses TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_surat) REFERENCES tupim_surat_masuk(id) ON DELETE CASCADE
)";

if (mysqli_query($koneksi, $sql1)) {
    echo "Table tupim_surat_masuk created successfully.<br>";
}
else {
    echo "Error creating table tupim_surat_masuk: " . mysqli_error($koneksi) . "<br>";
}

if (mysqli_query($koneksi, $sql2)) {
    echo "Table tupim_surat_masuk_disposisi created successfully.<br>";
}
else {
    echo "Error creating table tupim_surat_masuk_disposisi: " . mysqli_error($koneksi) . "<br>";
}
?>