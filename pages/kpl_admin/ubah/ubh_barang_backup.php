<?php
  include "../../../Connection/config.php";
  
  $tampil = mysql_query("SELECT * FROM barang where id_barang='".$_GET['q']."'");
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
  <label>ID Barang</label>
  <input name="id" type="text" class="form-control" value="<?php echo $r['id_barang'];?>" readonly="">
</div>
<div class="form-group">
  <label>Nama Barang</label>
  <input name="nama" type="text" class="form-control" value="<?php echo $r['nm_barang'];?>" placeholder="Masukkan Nama Barang" maxlength="50" required="" style="text-transform: capitalize;">
</div>
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Stok</label>
        <div class="input-group">
          <input name="stok" type="text" class="form-control" placeholder="Masukkan Stok Barang" maxlength="4" onkeypress="return isNumberKey(event)" required="" value="<?php echo $r['stok'];?>">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label>Satuan</label>
        <select class="form-control" style="width: 100%;" name="satuan" required="">
          <option <?php $ob->cek("Batang",$r['satuan'],"select") ?> value="Batang">Batang</option>
          <option <?php $ob->cek("Botol",$r['satuan'],"select") ?> value="Botol">Botol</option>
          <option <?php $ob->cek("Box",$r['satuan'],"select") ?> value="Box">Box</option>
          <option <?php $ob->cek("Buku",$r['satuan'],"select") ?> value="Buku">Buku</option>
          <option <?php $ob->cek("Bungkus",$r['satuan'],"select") ?> value="Bungkus">Bungkus</option>
          <option <?php $ob->cek("Butir",$r['satuan'],"select") ?> value="Butir">Butir</option>
          <option <?php $ob->cek("Can",$r['satuan'],"select") ?> value="Can">Can</option>
          <option <?php $ob->cek("Derigen",$r['satuan'],"select") ?> value="Derigen">Derigen</option>
          <option <?php $ob->cek("Ekor",$r['satuan'],"select") ?> value="Ekor">Ekor</option>
          <option <?php $ob->cek("Gabung",$r['satuan'],"select") ?> value="Gabung">Gabung</option>
          <option <?php $ob->cek("Galon",$r['satuan'],"select") ?> value="Galon">Galon</option>
          <option <?php $ob->cek("Gr",$r['satuan'],"select") ?> value="Gr">Gr</option>
          <option <?php $ob->cek("Ikat",$r['satuan'],"select") ?> value="Ikat">Ikat</option>
          <option <?php $ob->cek("Kaleng",$r['satuan'],"select") ?> value="Kaleng">Kaleng</option>
          <option <?php $ob->cek("Kemasan 225gr",$r['satuan'],"select") ?> value="Kemasan 225gr">Kemasan 225gr</option>
          <option <?php $ob->cek("Kg",$r['satuan'],"select") ?> value="Kg">Kg</option>
          <option <?php $ob->cek("Pack 100gr",$r['satuan'],"select") ?> value="Pack 100gr">Pack 100gr</option>
          <option <?php $ob->cek("Pack Isi 100",$r['satuan'],"select") ?> value="Pack Isi 100">Pack Isi 100</option>
          <option <?php $ob->cek("Pcs",$r['satuan'],"select") ?> value="Pcs">Pcs</option>
          <option <?php $ob->cek("Porsi",$r['satuan'],"select") ?> value="Porsi">Porsi</option>
          <option <?php $ob->cek("Rim",$r['satuan'],"select") ?> value="Rim">Rim</option>
          <option <?php $ob->cek("Roll",$r['satuan'],"select") ?> value="Roll">Roll</option>
          <option <?php $ob->cek("Sachet",$r['satuan'],"select") ?> value="Sachet">Sachet</option>
          <option <?php $ob->cek("Slice",$r['satuan'],"select") ?> value="Slice">Slice</option>
          <option <?php $ob->cek("Toples",$r['satuan'],"select") ?> value="Toples">Toples</option>
          <option <?php $ob->cek("Unit",$r['satuan'],"select") ?> value="Unit">Unit</option>
        </select>
      </div>
    </div>
  </div>
</div> 