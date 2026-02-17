<?php
include "../koneksi/koneksi.php";

$idRekening = mysqli_real_escape_string($koneksi, $_GET['rekening']);
$idRekanan  = mysqli_real_escape_string($koneksi, $_GET['rekanan']);

$where = [];
if ($idRekening != '') $where[] = "a.id_rekening = '$idRekening'";
if ($idRekanan  != '') $where[] = "a.id_rekanan  = '$idRekanan'";

$sql = "
SELECT a.*
FROM amprahan a
" . (!empty($where) ? "WHERE ".implode(" AND ", $where) : "") . "
ORDER BY a.id_amprahan DESC
";

$q = mysqli_query($koneksi, $sql);
$data = [];

while ($a = mysqli_fetch_assoc($q)) {

    // ================= NO SURAT =================
    $noSurat = ($a['no_amprahan'] == '')
        ? "<span class='badge badge-important'>New</span>"
        : $a['kode_item']."/".$a['no_amprahan']."/".$a['tahun'];

    // ================= REKANAN =================
    $qr = mysqli_query($koneksi, "SELECT nama_rekanan FROM rekanan WHERE id_rekanan='{$a['id_rekanan']}' LIMIT 1");
    $rekanan = mysqli_fetch_assoc($qr)['nama_rekanan'];

    // ================= SUB KEGIATAN =================
    $qs = mysqli_query($koneksi, "SELECT kode_sub_kegiatan,nama_sub_kegiatan 
                       FROM sub_kegiatan 
                       WHERE id_sub_kegiatan='{$a['id_sub_kegiatan']}' LIMIT 1");
    $s = mysqli_fetch_assoc($qs);
    $sub = "<strong>{$s['kode_sub_kegiatan']}</strong> - {$s['nama_sub_kegiatan']}";

    // ================= REKENING =================
    $qrek = mysqli_query($koneksi, "SELECT kode_rekening,nama_rekening,jumlah 
                         FROM rekening 
                         WHERE id_rekening='{$a['id_rekening']}' LIMIT 1");
    $r = mysqli_fetch_assoc($qrek);
    $rekening = "<strong>{$r['kode_rekening']}</strong> - {$r['nama_rekening']} (Rp. ".number_format($r['jumlah'],0,',','.').")";

    // ================= DETAIL =================
    $qd = mysqli_query($koneksi, "SELECT * FROM amprahan_detail WHERE id_amprahan='{$a['id_amprahan']}'");

    $item = $harga = $ket = "";
    $total = $belum = 0;

    while ($d = mysqli_fetch_assoc($qd)) {
        $item  .= "<li>{$d['uraian']} {$d['banyak']} {$d['satuan']}</li>";
        $harga .= "<li>".number_format($d['harga'],0,',','.')."</li>";
        $ket   .= "<li>{$d['keterangan']}</li>";

        $total++;
        if ($d['harga'] == '' || $d['harga'] == 0) $belum++;
    }

    $item  = "<ul style='margin:0;padding-left:18px'>{$item}</ul>";
    $harga = "<ul style='margin:0;padding-left:18px'>{$harga}</ul>";
    $ket   = "<ul style='margin:0;padding-left:18px'>{$ket}</ul>";

    // ================= STATUS =================
    $status = ($total > 0 && $belum == 0)
        ? "<span style='color:green;font-weight:bold'><span class='icon-check'></span></span>"
        : "<span style='color:red;font-weight:bold'><span class='icon-remove-sign'></span></span>";

    // ================= ACTION =================
    $action = "
    <center>
      <a href='surat_pesanan_print.php?id={$a['id_amprahan']}' target='_blank'>
        <span class='badge badge-success'><span class='icon-print'></span></span>
      </a>
      <a href='?page=supe&id={$a['id_amprahan']}'>
        <span class='badge badge-info'><span class='icon-edit'></span></span>
      </a>
      <a href='?page=super&id={$a['id_amprahan']}'>
        <span class='badge badge-warning'><span class='icon-edit'></span></span>
      </a>
      <a href='?page=suph&id={$a['id_amprahan']}' 
         onclick=\"return confirm('Yakin?')\">
        <span class='badge badge-important'><span class='icon-trash'></span></span>
      </a>
    </center>";

    // ================= PUSH ROW =================
    $data[] = [
        $noSurat,
        $a['tanggal'],
        $rekanan,
        $sub,
        $rekening,
        $item,
        $harga,
        $ket,
        $status,
        $action
    ];
}

echo json_encode($data);
