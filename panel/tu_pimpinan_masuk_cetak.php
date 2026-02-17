<?php
include "../koneksi/koneksi.php";

$id = $_GET['id'];
$sql = "SELECT * FROM tupim_surat_masuk WHERE id='$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lembar Disposisi</title>
    <link href="../img/logo_.png" rel='shortcut icon'>
    <style type="text/css">
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 330mm;
            padding: 5mm;
            margin: 5mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            padding: 1cm;
            border: 1px white solid;
            height: 285mm;
        }

        @page {
            size: F4;
            margin: 0;
            size: portrait;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 330mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }

        /* Custom Table Styles for Disposisi */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11pt;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 5px;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .no-border {
            border: none;
        }

        /* Header specific */
        .header-table {
            width: 100%;
            border: none;
            margin-bottom: 2px;
        }

        .header-table td {
            border: none;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="book">
        <div class="page">
            <div class="subpage">

                <!-- Kop Surat -->
                <table class="header-table">
                    <tr>
                        <td style="width: 15%;">
                            <img src="../img/logo_bireuen.jpg" style="width: 90px; height: auto;">
                        </td>
                        <td style="width: 85%;">
                            <h3 style="margin: 0; font-size: 14pt; font-weight: bold; text-transform: uppercase;">
                                PEMERINTAH KABUPATEN BIREUEN</h3>
                            <h2 style="margin: 5px 0; font-size: 18pt; font-weight: bold; text-transform: uppercase;">
                                SEKRETARIAT DAERAH</h2>
                            <p style="margin: 0; font-size: 10pt;">Jalan Sultan Malikussaleh Cot Gapu Bireuen 24251</p>
                            <p style="margin: 0; font-size: 10pt;">Telpon (0644) 323111, 22414 Faks. (0644) 21221, 22416
                            </p>
                        </td>
                    </tr>
                </table>
                <hr style="border: 0; border-top: 4px double black; height: 4px; margin-top: 0; margin-bottom: 20px;">

                <h3 class="text-center" style="text-decoration: underline; margin-top: 0;">LEMBAR DISPOSISI</h3>
                <br>

                <!-- Table 1: Surat Info -->
                <table>
                    <tr>
                        <td width="20%">Surat Dari</td>
                        <td width="30%">
                            <?= $data['dari']; ?>
                        </td>
                        <td width="20%">Diterima Tanggal</td>
                        <td width="30%">
                            <?= date('d-m-Y', strtotime($data['tanggal_terima'])); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>No Surat</td>
                        <td>
                            <?= $data['no_surat']; ?>
                        </td>
                        <td>No Agenda</td>
                        <td>
                            <?= $data['no_agenda']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Surat</td>
                        <td>
                            <?= date('d-m-Y', strtotime($data['tanggal_surat'])); ?>
                        </td>
                        <td>Sifat</td>
                        <td>
                            <?= $data['sifat']; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td colspan="3" style="height: 60px; vertical-align: top;">
                            <?= $data['isi_ringkas']; ?>
                        </td>
                    </tr>
                </table>

                <br>

                <!-- Table 2: 5 Rows Disposition -->
                <table class="table-disposisi">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="30%">Diteruskan Kepada</th>
                            <th width="50%">Isi Disposisi / Instruksi</th>
                            <th width="15%">Paraf / Tgl</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr style="height: 120px;">
                            <td class="text-center bold" style="vertical-align: middle;">1</td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                        </tr>
                        <!-- Row 2 -->
                        <tr style="height: 120px;">
                            <td class="text-center bold" style="vertical-align: middle;">2</td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                        </tr>
                        <!-- Row 3 -->
                        <tr style="height: 120px;">
                            <td class="text-center bold" style="vertical-align: middle;">3</td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                        </tr>
                        <!-- Row 4 -->
                        <tr style="height: 120px;">
                            <td class="text-center bold" style="vertical-align: middle;">4</td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                        </tr>
                        <!-- Row 5 -->
                        <tr style="height: 120px;">
                            <td class="text-center bold" style="vertical-align: middle;">5</td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                            <td style="vertical-align: top;"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>