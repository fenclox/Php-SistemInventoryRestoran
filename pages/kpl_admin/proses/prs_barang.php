<?php
include "../../../Connection/config.php";

//Proses Tambah
if(isset($_POST['tambah'])){
  $id   = $_POST['id'];
  $nm   = $_POST['nama'];
  $st   = $_POST['satuan'];
  //INSERT QUERY START
  $sql = mysql_query("insert into barang values('$id','$nm',0,'$st')");
  if ($sql) {
      header("Location: ../index.php?hal=brg");
    } else {
      header("Location: ../index.php?hal=brg");
    }
}
//Proses Ubah
else if(isset($_POST['ubah'])) {
  $id   = $_POST['id'];
  $nm   = $_POST['nama'];
  $st   = $_POST['satuan'];
  //UPDATE QUERY START
  $sql = mysql_query("update barang set nm_barang='$nm', satuan='$st' where id_barang='$id'");
  if ($sql) {
    header("Location: ../index.php?hal=brg");
  } else {
    header("Location: ../index.php?hal=brg");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapus'])) {
  $id = $_POST['id'];
  //DELETE QUERY START
  $sql = mysql_query("delete from barang where id_barang='$id'");
  if ($sql) {
    header("Location: ../index.php?hal=brg");
  } else {
    header("Location: ../index.php?hal=brg");
  }
  exit;
}
?>