<?php
if (isset($_GET['page'])) {
	$page = $_GET['page'];

	switch ($page) {
		case 'home':
			include "home.php";
			break;
		case 'spt':
			include "spt.php";
			break;
		case 'st':
			include "spt_tambah.php";
			break;
		case 'se':
			include "spt_edit.php";
			break;
		case 'ses':
			include "spt_editsim.php";
			break;
		case 'sv':
			include "spt_view.php";
			break;
		case 'spt_sim':
			include "spt_sim.php";
			break;
		case 'spt_print':
			include "spt_print.php";
			break;
		case 'spth':
			include "spt_hapus.php";
			break;
		case 'spthn':
			include "spt_hapus_nama.php";
			break;

		case 'sppd':
			include "sppd.php";
			break;
		case 'sp':
			include "sppd_pilih.php";
			break;
		case 'spd':
			include "sppd_tambah.php";
			break;
		case 'spd_sim':
			include "sppd_sim.php";
			break;
		case 'spe':
			include "sppd_edit.php";
			break;
		case 'spes':
			include "sppd_editsim.php";
			break;
		case 'spdh':
			include "sppd_hapus.php";
			break;
		case 'spv':
			include "sppd_view.php";
			break;
		case 'sppd_print':
			include "sppd_print.php";
			break;
		case 'sppd_template':
			include "sppd_template.php";
			break;
		case 'sppdttn':
			include "sppd_template_nama.php";
			break;
		case 'sppdttns':
			include "sppd_template_nama_sim.php";
			break;
		case 'sppdttnh':
			include "sppd_template_nama_hapus.php";
			break;


		case 'kwitansi':
			include "kwitansi.php";
			break;
		case 'kwitansi_pinjaman':
			include "kwitansi_pinjaman.php";
			break;
		case 'kwp':
			include "kwitansi_pilih.php";
			break;
		case 'kwp_pinjaman':
			include "kwitansi_pinjaman_pilih.php";
			break;
		case 'kwpr':
			include "kwitansi_proses.php";
			break;
		case 'kwpr_pinjaman':
			include "kwitansi_pinjaman_proses.php";
			break;
		case 'kwt':
			include "kwitansi_tambah.php";
			break;
		case 'kwt_pinjaman':
			include "kwitansi_pinjaman_tambah.php";
			break;
		case 'kwtc':
			include "kwitansi_cancel.php";
			break;
		case 'kws':
			include "kwitansi_simpan.php";
			break;
		case 'kwe':
			include "kwitansi_edit.php";
			break;
		case 'kwes':
			include "kwitansi_editsim.php";
			break;
		case 'kwv':
			include "kwitansi_view.php";
			break;
		case 'kwh':
			include "kwitansi_hapus.php";
			break;
		case 'kwf':
			include "kwitansi_final.php";
			break;

		case 'lpd':
			include "lpd.php";
			break;
		case 'lpde':
			include "lpd_edit.php";
			break;
		case 'lpdes':
			include "lpd_editsim.php";
			break;
		case 'lpdv':
			include "lpd_view.php";
			break;

		case 'rpds':
			include "rpd_cari.php";
			break;
		case 'rpdr':
			include "rpd_report.php";
			break;

		case 'pegawai':
			include "pegawai.php";
			break;
		case 'nonpegawai':
			include "nonpegawai.php";
			break;
		case 'pt':
			include "pegawai_tambah.php";
			break;
		case 'npt':
			include "nonpegawai_tambah.php";
			break;
		case 'pe':
			include "pegawai_edit.php";
			break;
		case 'pegawai_sim':
			include "pegawai_sim.php";
			break;
		case 'nonpegawai_sim':
			include "nonpegawai_sim.php";
			break;
		case 'pegawai_edsim':
			include "pegawai_editsim.php";
			break;
		case 'ph':
			include "pegawai_hapus.php";
			break;
		case 'pv':
			include "pegawai_view.php";
			break;

		case 'user':
			include "user.php";
			break;
		case 'usern':
			include "user_tambah.php";
			break;
		case 'userns':
			include "user_tambah_sim.php";
			break;
		case 'userc':
			include "user_ceklist.php";
			break;
		case 'rpas':
			include "rpas.php";
			break;
		case 'redir':
			include "redir.php";
			break;
		case 'program':
			include "program.php";
			break;
		case 'kegiatan':
			include "kegiatan.php";
			break;
		case 'subkegiatan':
			include "subkegiatan.php";
			break;
		case 'rekening':
			include "rekening.php";
			break;

		case 'rekanan':
			include "rekanan.php";
			break;

		case 'uraian':
			include "uraian.php";
			break;

		case 'suburaian':
			include "suburaian.php";
			break;
		case 'kota':
			include "kota.php";
			break;
		case 'kt':
			include "kota_tambah.php";
			break;
		case 'ktsim':
			include "kota_sim.php";
			break;

		case 'pagu':
			include "pagu.php";
			break;
		case 'pge':
			include "pagu_edit.php";
			break;
		case 'pges':
			include "pagu_editsim.php";
			break;
		case 'ttd':
			include "ttd.php";
			break;
		case 'ttdt':
			include "ttd_tambah.php";
			break;
		case 'ttds':
			include "ttd_sim.php";
			break;
		case 'ttde':
			include "ttd_edit.php";
			break;
		case 'ttdes':
			include "ttd_editsim.php";
			break;
		case 'ttd_pejabat':
			include "ttd_pejabat.php";
			break;
		case 'ttdpt':
			include "ttd_pejabat_tambah.php";
			break;
		case 'ttdps':
			include "ttd_pejabat_simpan.php";
			break;
		case 'ttdd':
			include "ttd_pejabat_defult.php";
			break;
		case 'ttdph':
			include "ttd_pejabathapus.php";
			break;

		case 'upfspt':
			include "upload_spt.php";
			break;
		case 'upfp':
			include "upload_spt_pilih.php";
			break;
		case 'upft':
			include "upload_spt_tambah.php";
			break;
		case 'upfts':
			include "upload_spt_tambahsim.php";
			break;
		case 'upfv':
			include "upload_spt_view.php";
			break;
		case 'upfd':
			include "upload_spt_delete.php";
			break;

		case 'del_all':
			include "delete_view.php";
			break;

		case 'pfl':
			include "profile.php";
			break;
		case 'pse':
			include "password_edit.php";
			break;
		case 'pses':
			include "password_editsim.php";
			break;

		case 'sups':
			include "surat_pesanan.php";
			break;
		case 'supsg':
			include "surat_pesanan_gaji.php";
			break;
		case 'supsbk':
			include "surat_pesanan_bk.php";
			break;
		case 'supst':
			include "surat_pesanantambah.php";
			break;
		case 'supsgt':
			include "surat_pesanantambah_gaji.php";
			break;
		case 'rakas_tambah':
			include "rakas_pesanantambah.php";
			break;
		case 'supsi':
			include "surat_pesanansim.php";
			break;
		case 'supkat':
			include "surat_pesanan_kategori.php";
			break;
		case 'supkats':
			include "surat_pesanan_kategorisim.php";
			break;
		case 'supskats':
			include "surat_pesanan_subkategorisim.php";
			break;
		case 'supssts':
			include "surat_pesanan_satuansim.php";
			break;
		case 'supe':
			include "surat_pesanan_edit.php";
			break;
		case 'super':
			include "surat_pesanan_edit_rupiah.php";
			break;
		case 'supesr':
			include "surat_pesanan_editsim_rupiah.php";
			break;
		case 'supes':
			include "surat_pesanan_editsim.php";
			break;
		case 'suph':
			include "surat_pesanan_hapus.php";
			break;
		case 'suphi':
			include "surat_pesanan_hapus_item.php";
			break;
		case 'supus':
			include "surat_pesanan_uraiansim.php";
			break;
		case 'supca':
			include "surat_pesanan_cari.php";
			break;
		case 'supct':
			include "surat_pesanan_caritampil.php";
			break;

		case 'prohu':
			include "produk_hukum.php";
			break;

		case 'tum':
			include "tu_pimpinan_masuk.php";
			break;
		case 'tupimsm':
			include "tu_pimpinan_masuk.php";
			break;
		case 'tupimsk':
			include "tu_pimpinan_keluar.php";
			break;
		case 'tupimst':
			include "tu_pimpinan_tugas.php";
			break;

		case 'help':
			include "bantuan.php";
			break;



		default:
			include "not_found.php";
			break;
	}
}
else {
	include 'home.php';
}

?>