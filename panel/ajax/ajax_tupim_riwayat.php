<?php
include '../../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id_surat = intval($_GET['id']);

    // Get Surat Info
    $sql_surat = "SELECT * FROM tupim_surat_masuk WHERE id='$id_surat'";
    $q_surat = mysqli_query($koneksi, $sql_surat);
    $d_surat = mysqli_fetch_array($q_surat);

    // Get Disposisi History
    $sql_disp = "SELECT * FROM tupim_surat_masuk_disposisi WHERE id_surat='$id_surat' ORDER BY id ASC";
    $q_disp = mysqli_query($koneksi, $sql_disp);

?>
<style>
    .timeline {
        list-style: none;
        padding: 20px 0 20px;
        position: relative;
    }

    .timeline:before {
        top: 0;
        bottom: 0;
        position: absolute;
        content: " ";
        width: 3px;
        background-color: #eeeeee;
        left: 50%;
        margin-left: -1.5px;
    }

    .timeline>li {
        margin-bottom: 20px;
        position: relative;
    }

    .timeline>li:before,
    .timeline>li:after {
        content: " ";
        display: table;
    }

    .timeline>li:after {
        clear: both;
    }

    .timeline>li>.timeline-panel {
        width: 46%;
        float: left;
        border: 1px solid #d4d4d4;
        border-radius: 2px;
        padding: 20px;
        position: relative;
        -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }

    .timeline>li>.timeline-badge {
        color: #fff;
        width: 50px;
        height: 50px;
        line-height: 50px;
        font-size: 1.4em;
        text-align: center;
        position: absolute;
        top: 16px;
        left: 50%;
        margin-left: -25px;
        background-color: #999999;
        z-index: 100;
        border-top-right-radius: 50%;
        border-top-left-radius: 50%;
        border-bottom-right-radius: 50%;
        border-bottom-left-radius: 50%;
    }

    .timeline>li.timeline-inverted>.timeline-panel {
        float: right;
    }

    .timeline>li.timeline-inverted>.timeline-badge {
        background-color: #2e6da4;
    }
</style>

<h4>Detail Surat</h4>
<table class="table table-bordered">
    <tr>
        <td width="20%">No Surat</td>
        <td>
            <?= $d_surat['no_surat']; ?>
        </td>
        <td width="20%">Dari</td>
        <td>
            <?= $d_surat['dari']; ?>
        </td>
    </tr>
    <tr>
        <td>Perihal</td>
        <td colspan="3">
            <?= $d_surat['isi_ringkas']; ?>
        </td>
    </tr>
</table>

<h4>Riwayat Disposisi</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Dari</th>
            <th>Ke</th>
            <th>Catatan</th>
            <th>Waktu</th>
            <th>Bukti Nota</th>
        </tr>
    </thead>
    <tbody>
        <!-- Initial State -->
        <tr>
            <td>1</td>
            <td>Bagian Umum</td>
            <td>Bupati (Awal)</td>
            <td>Surat Masuk</td>
            <td>
                <?= $d_surat['created_at']; ?>
            </td>
            <td>
                <?php if (!empty($d_surat['file_surat'])): ?>
                <a href="../uploads/surat_masuk/<?= $d_surat['file_surat']; ?>" target="_blank"
                    class="btn btn-mini btn-success">Surat Asli</a>
                <?php
    endif; ?>
            </td>
        </tr>
        <?php
    $no = 2;
    while ($d = mysqli_fetch_array($q_disp)) { ?>
        <tr>
            <td>
                <?= $no++; ?>
            </td>
            <td>
                <?= $d['dari_posisi']; ?>
            </td>
            <td>
                <?= $d['tujuan_disposisi']; ?>
            </td>
            <td>
                <?= $d['catatan']; ?>
            </td>
            <td>
                <?= $d['tgl_proses']; ?>
            </td>
            <td>
                <?php if (!empty($d['file_nota'])): ?>
                <a href="../uploads/surat_masuk/<?= $d['file_nota']; ?>" target="_blank"
                    class="btn btn-mini btn-info">Nota Scan</a>
                <?php
        endif; ?>
            </td>
        </tr>
        <?php
    }?>
    </tbody>
</table>

<?php
}
?>