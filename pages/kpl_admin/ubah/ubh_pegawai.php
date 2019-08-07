<?php
  include "../../../Connection/config.php";
  
  $tampil = mysql_query("SELECT * FROM pegawai where id_pegawai='".$_GET['q']."'");
  $r = mysql_fetch_array($tampil);
  //Fungsi Cek\
  class selected{
    function cek($val,$sel,$tipe){
      if($val==$sel){
          switch($tipe){
            case 'select' :echo "selected"; break;
            case 'radio' :echo "checked"; break;
          }
      } else {
        echo "";
      }
    }
  }
  $ob = new selected();
?>
<div class="form-group">
  <label>ID Pegawai</label>
  <input name="id" type="text" class="form-control" placeholder="Masukkan Nama Pegawai" maxlength="30" onkeypress="return isAlphabetKey(event)" required="" style='text-transform: capitalize;' value="<?php echo $r['id_pegawai']?>" readonly>
</div>
<div class="form-group">
  <label>Nama Pegawai</label>
  <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Pegawai" maxlength="30" onkeypress="return isAlphabetKey(event)" required="" style='text-transform: capitalize;' value="<?php echo $r['nm_pegawai']?>">
</div>
<div class="form-group">
  <label>Alamat</label>
  <textarea name="alamat" type="text" class="form-control" placeholder="Masukkan Alamat"><?php echo $r['alamat']?></textarea>
</div>
<div class="form-group">
  <label>No. Telepon</label>
  <input name="no_telp" type="text" class="form-control" placeholder="Masukkan Nomor Telepon" maxlength="15" onkeypress="return isNumberKey(event)" required="" style='text-transform: capitalize;' value="<?php echo $r['no_telp']?>">
</div>
<div class="form-group">
  <label>Select</label>
  <select name="bagian" class="form-control">
    <option <?php $ob->cek("Admin Gudang",$r['bagian'],"select") ?> value="Admin Gudang">Admin Gudang</option>
    <option <?php $ob->cek("Admin Stock",$r['bagian'],"select") ?> value="Admin Stock">Admin Stock</option>
    <option <?php $ob->cek("F&B",$r['bagian'],"select") ?> value="F&B">F&B</option>
  </select>
</div>
</div>