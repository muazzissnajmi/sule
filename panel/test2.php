

<?php echo $nip = '1964122311994031004'; ?>

   <input id="idf<?php echo $nip; ?>" value="<?php echo $nip; ?>" type="hidden" />
   
                
    <div id="div<?php echo $nip; ?>"></div>
   	<button type="button" onclick="tambah<?php echo $nip; ?>(); return false;">Tambah Rincian Hobi</button>
   
   <button type="submit">Simpan</button>
 

<script type="text/javascript" src="../js/jquery.min.js"></script>


<script language="javascript">
   function tambah<?php echo $nip; ?>() {
     var idf<?php echo $nip; ?> = document.getElementById("idf<?php echo $nip; ?>").value;
     var stre;
     stre="<p id='srow<?php echo $nip; ?>" + idf<?php echo $nip; ?> + "'><input name='nama' type='text' id='nama' value='Penginapan' size='40'><span class='add-on'> Rp.</span><input type='number' name='penginapan<?php echo $nip; ?>[]' placeholder='' value='0'> <input type='number' name='penginapan_hari<?php echo $nip; ?>[]' placeholder='' value='0'><span class='add-on'>Hari</span><span class='add-on'>Ket.</span><input type='text' name='penginapan_ket<?php echo $nip; ?>[]' placeholder='' value=''> <a href='#' style=\"color:#3399FD;\" onclick='hapusElemen<?php echo $nip; ?>(\"#srow<?php echo $nip; ?>" + idf<?php echo $nip; ?> + "\"); return false;'>Hapus</a></p>";
     $("#div<?php echo $nip; ?>").append(stre);
     idf<?php echo $nip; ?> = (idf<?php echo $nip; ?>-1) + 2;
     document.getElementById("idf<?php echo $nip; ?>").value = idf<?php echo $nip; ?>;
   }
   function hapusElemen<?php echo $nip; ?>(idf<?php echo $nip; ?>) {
     $(idf<?php echo $nip; ?>).remove();
   }
</script>

