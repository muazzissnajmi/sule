
<!--sidebar-menu-->
<?php
$page = $_GET['page'];
?>

<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li <?php if($page == 'home') {echo "class='active'";}  elseif ($page == '') {
      echo "class='active'";} ?>><a href="?page=home"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>


<?php $type=$_SESSION['role'] ?>
  <?php if($type=='Administrator'){ ?>

    <li class="submenu"> 
      <a href="#">
        <i class="icon-plane"></i> 
        <span>Perjalanan Dinas</span>
        <font color="#ffffff"><i class="icon icon-sort-down"></i></font>
      </a>
    
      <ul <?php if(
            $page == 'spt' || $page == 'st' ||
            $page == 'sppd' || $page == 'sp' || $page == 'spd' || $page == 'spv' || $page == 'spe' ||
            $page == 'kwitansi' || $page == 'kwv' || $page == 'kwe' ||
            $page == 'kwitansi_pinjaman' || $page == 'kwp_pinjaman' ||
            $page == 'lpd' || $page == 'rpdr' || $page == 'upfspt'
          ) echo 'style="display:block;"'; ?>>
    
        <li <?php if($page == 'spt' || $page == 'st') echo "class='active'"; ?>>
          <a href="?page=spt"><i class="icon icon-th-list"></i> <span>SPT</span></a>
        </li>
    
        <li <?php if($page == 'sppd' || $page == 'sp' || $page == 'spd' || $page == 'spv' || $page == 'spe') echo "class='active'"; ?>>
          <a href="?page=sppd"><i class="icon icon-briefcase"></i> <span>SPPD</span></a>
        </li>
    
        <li <?php if($page == 'kwitansi' || $page == 'kwv' || $page == 'kwe') echo "class='active'"; ?>>
          <a href="?page=kwitansi"><i class="icon icon-list-alt"></i> <span>Kwitansi</span></a>
        </li>
    
        <li <?php if($page == 'kwitansi_pinjaman' || $page == 'kwp_pinjaman') echo "class='active'"; ?>>
          <a href="?page=kwitansi_pinjaman"><i class="icon icon-money"></i> <span>Pinjaman</span></a>
        </li>
    
        <li <?php if($page == 'lpd') echo "class='active'"; ?>>
          <a href="?page=lpd"><i class="icon-columns"></i> <span>Laporan </span></a>
        </li>
        
        <li <?php if($page == 'rpdr') echo "class='active'"; ?>>
          <a href="?page=rpdr"><i class="icon-copy"></i> <span>Rekap </span></a>
        </li>
        
        <li <?php if($page == 'upfspt') echo "class='active'"; ?>>
          <a href="?page=upfspt"><i class="icon-download-alt"></i> <span>Upload </span></a>
        </li>
    
      </ul>
    </li>

    
    
    <li class="submenu"> 
      <a href="#">
        <i class="icon-money"></i> 
        <span>Amprahan</span>
        <font color="#ffffff"><i class="icon icon-sort-down"></i></font>
      </a>
    
      <ul <?php if($page == 'sups' || $page == 'supca' || $page == 'supsbk' || $page == 'supe' || $page == 'supst' || $page == 'supsg') echo 'style="display:block;"'; ?>>
        <li <?php if($page == 'sups') echo "class='active'"; ?>>
          <a href="?page=sups"><i class="icon-list-alt"></i> <span>Daftar Amprahan</span></a>
        </li>
        
        <li <?php if( $page == 'supsg') echo "class='active'"; ?>>
          <a href="?page=supsg"><i class="icon-list-alt"></i> <span>Daftar Amprahan Gaji</span></a>
        </li>
    
        <li <?php if($page == 'supca') echo "class='active'"; ?>>
          <a href="?page=supca"><i class="icon-columns"></i> <span>Rekap Amprahan</span></a>
        </li>
        
        <li <?php if($page == 'supsbk') echo "class='active'"; ?>>
          <a href="?page=supsbk"><i class="icon-book"></i> <span>Buku Kontrol</span></a>
        </li>
      </ul>
    </li>
    
    <li class="submenu"> 
      <a href="#">
        <i class="icon-book"></i> 
        <span>TU Pimpinan</span>
        <font color="#ffffff"><i class="icon icon-sort-down"></i></font>
      </a>
    
      <ul <?php if($page == 'tupimsm' || $page == 'tupimsk' || $page == 'tupimst') echo 'style="display:block;"'; ?>>
        
        <li <?php if( $page == 'tupimsm') echo "class='active'"; ?>>
          <a href="?page=tupimsm"><i class="icon-inbox"></i> <span>Surat Masuk</span></a>
        </li>
        
        <li <?php if($page == 'tupimsk') echo "class='active'"; ?>>
          <a href="?page=tupimsk"><i class="icon-inbox"></i> <span>Surat Keluar</span></a>
        </li>
    
        <li <?php if($page == 'tupimst') echo "class='active'"; ?>>
          <a href="?page=tupimst"><i class="icon-inbox"></i> <span>Surat Tugas</span></a>
        </li>
      </ul>
    </li>

    
    <li class="submenu"> 
      <a href="#">
        <i class="icon icon-cogs"></i> 
        <span>Setting</span>
        <font color="#ffffff"><i class="icon icon-sort-down"></i></font>
      </a>
    
      <ul <?php if(
            $page == 'pegawai' || $page == 'nonpegawai' || $page == 'npt' || 
            $page == 'kota' || $page == 'rekanan' || 
            $page == 'pagu' || $page == 'pge' || $page == 'rekening' || 
            $page == 'rakas_tambah' || $page == 'uraian' || $page == 'suburaian' || 
            $page == 'supkat' || $page == 'kegiatan' || $page == 'subkegiatan' || 
            $page == 'ttd_pejabat' || $page == 'ttdpt' || $page == 'program' || 
            $page == 'ttd' || $page == 'ttdt' || $page == 'ttde' || 
            $page == 'user'
          ) echo 'style="display:block;"'; ?>>
    
        <li <?php if($page == 'pegawai' ) echo "class='active'"; ?>>
          <a href="?page=pegawai"><i class="icon-columns"></i> ASN</a>
        </li>
        
        <li <?php if($page == 'nonpegawai' || $page == 'npt' ) echo "class='active'"; ?>>
          <a href="?page=nonpegawai"><i class="icon-columns"></i> Pegawai</a>
        </li>
    
        <li <?php if($page == 'kota') echo "class='active'"; ?>>
          <a href="?page=kota"><i class="icon-columns"></i> Kota</a>
        </li>
        
        <li <?php if($page == 'rekanan') echo "class='active'"; ?>>
          <a href="?page=rekanan"><i class="icon-user"></i> Rekanan/Penyedia</a>
        </li>
        
        <li <?php if($page == 'program') echo "class='active'"; ?>>
          <a href="?page=program"><i class="icon-money"></i> Program</a>
        </li>
        
        <li <?php if($page == 'kegiatan') echo "class='active'"; ?>>
          <a href="?page=kegiatan"><i class="icon-money"></i> Kegiatan</a>
        </li>
        
        <li <?php if($page == 'subkegiatan') echo "class='active'"; ?>>
          <a href="?page=subkegiatan"><i class="icon-money"></i> Sub Kegiatan</a>
        </li>
        
        <li <?php if($page == 'rekening') echo "class='active'"; ?>>
          <a href="?page=rekening"><i class="icon-money"></i> Rekening Belanja</a>
        </li>
        
        <li <?php if($page == 'uraian') echo "class='active'"; ?>>
          <a href="?page=uraian"><i class="icon-money"></i> Uraian Belanja</a>
        </li>
        
        
        <!--<li <?php if($page == 'suburaian') echo "class='active'"; ?>>-->
        <!--  <a href="?page=suburaian"><i class="icon-money"></i> Sub-Uraian</a>-->
        <!--</li>-->
    
        <li <?php if($page == 'pagu' || $page == 'pge') echo "class='active'"; ?>>
          <a href="?page=pagu"><i class="icon-columns"></i> Pagu</a>
        </li>
    
        <li <?php if($page == 'rakas_tambah') echo "class='active'"; ?>>
          <a href="?page=rakas_tambah"><i class="icon-columns"></i> Rencana Anggaran KAS</a>
        </li>
    
    
        <li <?php if($page == 'ttd_pejabat' || $page == 'ttdpt') echo "class='active'"; ?>>
          <a href="?page=ttd_pejabat"><i class="icon-columns"></i> TTD Pejabat</a>
        </li>
    
        <li <?php if($page == 'ttd' || $page == 'ttdt' || $page == 'ttde') echo "class='active'"; ?>>
          <a href="?page=ttd"><i class="icon-columns"></i> TTD U.B</a>
        </li>
    
        <li <?php if($page == 'user') echo "class='active'"; ?>>
          <a href="?page=user"><i class="icon-columns"></i> Pengguna</a>
        </li>
    
      </ul>
    </li>
    
    
    






<?php } if($type=='MembersFull'){ ?>
<li class="submenu"> <a href="#"><i class="icon-plane"></i> <span>Perjalanan</span><font color="#ffffff"><i class="icon icon-sort-down"></i></font></a>
  <ul>

    <li <?php if($page == 'spt') {echo "class='active'";} elseif ($page == 'st') {
      echo "class='active'";}?>><a href="?page=spt"><i class="icon icon-th-list"></i> <span>SPT</span></a> </li>

    <li <?php if($page == 'sppd') {echo "class='active'";} elseif ($page == 'sp') {echo "class='active'";} elseif ($page == 'spd') {echo "class='active'";} elseif ($page == 'spv') {echo "class='active'";}elseif ($page == 'spe') {echo "class='active'";}?>><a href="?page=sppd"><i class="icon icon-briefcase"></i> <span>SPPD</span></a> </li>

    <li <?php if($page == 'kwitansi') {echo "class='active'";} elseif ($page == 'kwv') {echo "class='active'";} elseif ($page == 'kwe') {echo "class='active'";}?>><a href="?page=kwitansi"><i class="icon icon-list-alt"></i> <span>Kwitansi</span></a></li>
    
    
    <li <?php if($page == 'lpd') echo "class='active'";?>><a href="?page=lpd"><i class="icon-columns"></i> <span>LPD</span></a> </li>

   
        <li <?php if($page == 'rpdr') {echo "class='active'";} elseif ($page == 'lpds') {echo "class='active'";}?>><a href="?page=rpdr"><i class="icon-copy"></i> <span>Report RPD</span></a> </li>
      </ul>
      <ul>
        <li <?php if($page == 'upfspt') {echo "class='active'";} elseif ($page == 'upfp') {echo "class='active'";} elseif ($page == 'upft') {echo "class='active'";}?>><a href="?page=upfspt"><i class="icon-download-alt"></i> <span>Upload Perjalanan</span></a> </li>

     
  
    

    

    <li <?php if($page == 'pegawai') {echo "class='active'";} elseif ($page == 'pt') {echo "class='active'";} elseif ($page == 'pv') {echo "class='active'";} elseif ($page == 'pe') {echo "class='active'";}?>><a href="?page=pegawai"><i class="icon-user"></i> <span>ASN</span></a> </li>


    
        <li <?php if($page == 'pagu') {echo "class='active'";} elseif ($page == 'pge') {echo "class='active'";}?>><a href="?page=pagu"><i class="icon-money"></i> <span>Pagu</span></a></li>
        <li <?php if($page == 'ttd_pejabat') {echo "class='active'";} elseif($page == 'ttdpt') {echo "class='active'";} ?>><a href="?page=ttd_pejabat"><i class="icon-ok-sign"></i> <span>TTD Pejabat</span></a></li>
        <li <?php if($page == 'ttd') {echo "class='active'";} elseif($page == 'ttdt') {echo "class='active'";} ?>><a href="?page=ttd"><i class="icon-ok-sign"></i> <span>TTD U.B</span></a></li>        
    
        <li <?php if($page == 'kota') {echo "class='active'";} ?>><a href="?page=kota"><i class="icon-cogs"></i> Kota</a></li>
  
    <li <?php if($page == 'user') echo "class='active'";?>><a href="?page=user"><i class="icon-user"></i> <span>Pengguna</span></a> </li>

</ul>
</li> 
<li <?php if($page == 'sups') echo "class='active'";?>><a href="?page=sups"><i class="icon-th"></i> <span>Amprahan</span></a> </li>
<li <?php if($page == 'supca') echo "class='active'";?>><a href="?page=supca"><i class="icon-th"></i> <span>Rekap Amprahan</span></a> </li>

<li <?php if($page == 'rakas_tambah') echo "class='active'";?>><a href="?page=rakas_tambah"><i class="icon-th"></i> <span>Rencana Anggaran KAS</span></a> </li>

<?php } if($type=='Members1'){ ?>      
<li class="submenu"> <a href="#"><i class="icon-plane"></i> <span>Perjalanan</span><font color="#ffffff"><i class="icon icon-sort-down"></i></font></a>
  <ul>
    <li <?php if($page == 'spt') {echo "class='active'";} elseif ($page == 'st') {
      echo "class='active'";}?>><a href="?page=spt"><i class="icon icon-th-list"></i> <span>SPT</span></a> </li>

    <li <?php if($page == 'sppd') {echo "class='active'";} elseif ($page == 'sp') {echo "class='active'";} elseif ($page == 'spd') {echo "class='active'";} elseif ($page == 'spv') {echo "class='active'";}elseif ($page == 'spe') {echo "class='active'";}?>><a href="?page=sppd"><i class="icon icon-briefcase"></i> <span>SPPD</span></a> </li>

    <li <?php if($page == 'kwitansi') {echo "class='active'";} elseif ($page == 'kwv') {echo "class='active'";} elseif ($page == 'kwe') {echo "class='active'";}?>><a href="?page=kwitansi"><i class="icon icon-list-alt"></i> <span>Kwitansi</span></a></li>

    <li <?php if($page == 'kwitansi_pesanan') {echo "class='active'";} elseif ($page == 'kwv') {echo "class='active'";} elseif ($page == 'kwe') {echo "class='active'";}?>><a href="?page=kwitansi_pinjaman"><i class="icon icon-list-alt"></i> <span>Pinjaman</span></a></li>

    <li <?php if($page == 'lpd') echo "class='active'";?>><a href="?page=lpd"><i class="icon-columns"></i> <span>LPD</span></a> </li>

    
    <li <?php if($page == 'upfspt') {echo "class='active'";} elseif ($page == 'upfp') {echo "class='active'";} elseif ($page == 'upft') {echo "class='active'";}?>><a href="?page=upfspt"><i class="icon-download-alt"></i> <span>Upload Perjalanan</span></a> </li>
  </ul>
</li>  
    <!--<li <?php if($page == 'kontrak') echo "class='active'";?>><a href="?page=kontrak"><i class="icon-pencil"></i> <span>Kontrak</span></a> </li>-->

    <li <?php if($page == 'pegawai') {echo "class='active'";} elseif ($page == 'pt') {echo "class='active'";} elseif ($page == 'pv') {echo "class='active'";} elseif ($page == 'pe') {echo "class='active'";}?>><a href="?page=pegawai"><i class="icon-user"></i> <span>ASN</span></a> </li>   

    <li class="submenu <?php if($page == 'kota') {echo "active";} elseif ($page == 'pagu') {echo "active";} elseif ($page == 'pge') {echo "active";} elseif ($page == 'ttd') {echo "active";} elseif ($page == 'ttdt') {echo "active";} elseif ($page == 'ttde') {echo "active";} elseif ($page == 'ttd_pejabat') {echo "active";} elseif ($page == 'ttdpt') {echo "active";} ?>"> <a href="#"><i class="icon icon-cogs"></i> <span>Setting</span><font color="#ffffff"><i class="icon icon-sort-down"></i></font></a>
      <ul> 
        <li <?php if($page == 'ttd_pejabat') {echo "class='active'";} elseif($page == 'ttdpt') {echo "class='active'";} ?>><a href="?page=ttd_pejabat">TTD Pejabat</a></li>
        <li <?php if($page == 'ttd') {echo "class='active'";} elseif($page == 'ttdt') {echo "class='active'";} ?>><a href="?page=ttd">TTD U.B</a></li>        
      </ul>
    </li>




    <?php } if($type=='Members2'){ ?>      
      
      <li <?php if($page == 'rpdr') {echo "class='active'";} elseif ($page == 'lpds') {echo "class='active'";}?>><a href="?page=rpdr"><i class="icon-copy"></i> <span>Report RPD</span></a> </li> 
      <li <?php if($page == 'pagu') {echo "class='active'";} elseif ($page == 'pge') {echo "class='active'";}?>><a href="?page=pagu"><i class="icon-money"></i> Pagu</a></li>




    <?php } if($type=='Members3'){ ?>

      <li <?php if($page == 'sups') echo "class='active'";?>><a href="?page=sups"><i class="icon-th"></i> <span>Surat Pesanan</span></a> </li>
      <li <?php if($page == 'supca') echo "class='active'";?>><a href="?page=supca"><i class="icon-th"></i> <span>Rekap Surat Pesanan</span></a> </li>




    <?php } if($type=='MembersView1'){ ?>

      <li <?php if($page == 'rpdr') {echo "class='active'";} elseif ($page == 'lpds') {echo "class='active'";}?>><a href="?page=rpdr"><i class="icon-copy"></i> <span>Report RPD</span></a> </li> 
      <li <?php if($page == 'upfspt') {echo "class='active'";} elseif ($page == 'upfp') {echo "class='active'";} elseif ($page == 'upft') {echo "class='active'";}?>><a href="?page=upfspt"><i class="icon-download-alt"></i> <span>Upload Perjalanan</span></a> </li>
      <li <?php if($page == 'pagu') {echo "class='active'";} elseif ($page == 'pge') {echo "class='active'";}?>><a href="?page=pagu"><i class="icon-money"></i> Pagu</a></li>

    <?php } ?>

    <li <?php if($page == 'prohu') echo "class='active'";?>><a href="?page=prohu"><i class="icon-file"></i> <span>Produk Hukum</span></a> </li>
    <li <?php if($page == 'help') echo "class='active'";?>><a href="?page=help"><i class="icon-question-sign"></i> <span>Bantuan</span></a> </li>
    
    <li><a href="logout.php"><i class="icon-key"></i> <span>Logout</span></a> </li>

    <?php 
    include "../koneksi/koneksi.php";

    function rupiah_($angka_){
  
    $hasil_rupiah = "Rp " . number_format($angka_,0,',','.');
    return $hasil_rupiah;
     }

    //echo rupiah(1000000);

    $tahun =  date('Y');

    $sql = "SELECT * FROM pagu WHERE tahun = '$tahun'";
    $tampil = mysqli_query($koneksi, $sql);     
    $data = mysqli_fetch_array($tampil);

    $persen_dk_kdh = 0;
    $persen_lk_kdh = 0;
    $persen_dk = 0;
    $persen_lk = 0;

    if ($data) {
      $persen_dk_kdh = ($data['pagu_dk_kdh_awal'] != 0) ? (100 - $data['pagu_dk_kdh_akhir'] / $data['pagu_dk_kdh_awal'] * 100) : 0;
      $persen_lk_kdh = ($data['pagu_lk_kdh_awal'] != 0) ? (100 - $data['pagu_lk_kdh_akhir'] / $data['pagu_lk_kdh_awal'] * 100) : 0;

      $persen_dk = ($data['pagu_dk_awal'] != 0) ? (100 - $data['pagu_dk_akhir'] / $data['pagu_dk_awal'] * 100) : 0;
      $persen_lk = ($data['pagu_lk_awal'] != 0) ? (100 - $data['pagu_lk_akhir'] / $data['pagu_lk_awal'] * 100) : 0;
      //$persen_ln = ($data['pagu_ln_awal'] != 0) ? (100 - $data['pagu_ln_akhir'] / $data['pagu_ln_awal'] * 100) : 0;
    }





    ?>
   
     <!-- kdh/wkdh dalamKota -->

    <!--<?php if ($data['pagu_dk_kdh_awal'] == '0') { ?>
      <li class="content"> <span>
      <b>Pagu KDH/WKDH</b><br>
      Pagu Dalam Daerah</span>
      <div class="progress progress-mini progress-info active progress-striped">
        <div style="width: 0%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_dk_kdh); ?>%</span>
      <div class="stat"><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,-</div>
    </li>

    <?php }else { ?>

            
    <li class="content"> <span>
      <b>Pagu KDH/WKDH</b><br>
      Pagu Dalam Daerah</span>
      <div class="progress progress-mini progress-info active progress-striped">
        <div style="width: <?php echo $persen_dk_kdh ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_dk_kdh); ?>%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_dk_kdh_akhir']); ?>,- / <?php echo rupiah_($data['pagu_dk_kdh_awal']); ?>,-</div>
    </li>

    <?php } ?>-->

    <!-- Luar Kota -->

    <!--<?php if ($data['pagu_lk_kdh_awal'] == '0') { ?>
    <li class="content"> <span>Pagu Luar Daerah</span>
      <div class="progress progress-mini progress-warning active progress-striped">
        <div style="width: <?php echo $persen_lk_kdh; ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_lk_kdh); ?>%</span>
      <div class="stat"><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,-</div>
    </li>

    <?php }else { ?>

      <li class="content"> <span>Pagu Luar Daerah</span>
      <div class="progress progress-mini progress-warning active progress-striped">
        <div style="width: <?php echo $persen_lk_kdh; ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_lk_kdh); ?>%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_lk_kdh_akhir']); ?>,- / <?php echo rupiah_($data['pagu_lk_kdh_awal']); ?>,-</div>
    </li>

    <?php } ?>-->

    <!-- Setdakab dalam Kota
<a href="?page=pagu" style="color: #939da8;">
    <?php if ($data['pagu_dk_awal'] == '0') { ?>
      <li class="content"> <span>
      <b>Pagu Setdakab</b><br>
      Pagu Dalam Daerah</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 0%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_dk); ?>%</span>
      <div class="stat"><?php echo rupiah_('0'); ?>,- / <?php echo rupiah_('0'); ?>,-</div>
    </li>

    <?php }else { ?>

            
    <li class="content"> <span>
      <b>Pagu Setdakab</b><br>
      Pagu Dalam Daerah</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: <?php echo $persen_dk ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_dk); ?>%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_dk_akhir']); ?>,- / <?php echo rupiah_($data['pagu_dk_awal']); ?>,-</div>
    </li>

    <?php } ?> -->

    <!-- Luar Kota 

    <?php if ($data['pagu_lk_awal'] == '0') { ?>
    <li class="content"> <span>Pagu Luar Daerah</span>
      <div class="progress progress-mini progress-success active progress-striped">
        <div style="width: <?php echo $persen_lk; ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_lk); ?>%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_lk_akhir']); ?>,- / <?php echo rupiah_($data['pagu_lk_awal']); ?>,-</div>
    </li>

    <?php }else { ?>

      <li class="content"> <span>Pagu Luar Daerah</span>
      <div class="progress progress-mini progress-success active progress-striped">
        <div style="width: <?php echo $persen_lk; ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_lk); ?>%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_lk_akhir']); ?>,- / <?php echo rupiah_($data['pagu_lk_awal']); ?>,-</div>
    </li>

    <?php } ?></a>-->

    <!-- Luar Negeri 

    <?php if ($data['pagu_ln_awal'] == '0') { ?>     

      <li class="content"> <span>Pagu Luar Negeri</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: <?php echo $persen_ln; ?>%;" class="bar"></div>
      </div>
      <span class="percent">0%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_ln_akhir']); ?>,- / <?php echo rupiah_($data['pagu_ln_awal']); ?>,-</div>
    </li>
    
    <?php }else { ?>
      
      <li class="content"> <span>Pagu Luar Negeri</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: <?php echo $persen_ln; ?>%;" class="bar"></div>
      </div>
      <span class="percent"><?php echo round($persen_ln); ?>%</span>
      <div class="stat"><?php echo rupiah_($data['pagu_ln_akhir']); ?>,- / <?php echo rupiah_($data['pagu_ln_awal']); ?>,-</div>
    </li>
    
    <?php } ?>-->

  </ul>
</div>
<!--sidebar-menu-->

