<?php
include "../../../Connection/config.php";

//Proses Tambah
if(isset($_POST['tambah'])){
  $id   = $_POST['id'];
  $nm   = $_POST['nama'];
  $alm  = $_POST['alamat'];
  $tlp  = $_POST['no_telp'];
  $bg   = $_POST['bagian'];
  $pass = 'testing';
  if ($bg=='Admin Gudang'){
    $lvl=0;
  } else if($bg=='Admin Stock'){
    $lvl=1;
  } else if ($bg=='F&B'){
    $lvl=2;
  }
  //INSERT QUERY START
  $sql = mysql_query("insert into pegawai values('$id','$nm','$alm','$tlp','$bg','$lvl','$pass')");
  if ($sql) {
      header("Location: ../index.php?hal=pgw");
    } else {
      header("Location: ../index.php?hal=pgw");
    }
}
//Proses Ubah
else if(isset($_POST['ubah'])) {
  $id   = $_POST['id'];
  $nm   = $_POST['nama'];
  $alm  = $_POST['alamat'];
  $tlp  = $_POST['no_telp'];
  $bg   = $_POST['bagian'];
  $pass = 'testing';
  
  if ($bg=='Admin Gudang'){
    $lvl=0;
  } else if($bg=='Admin Stock'){
    $lvl=1;
  } else if ($bg=='F&B'){
    $lvl=2;
  }
  //UPDATE QUERY START
  $sql = mysql_query("update pegawai set nm_pegawai='$nm',alamat='$alm',no_telp='$tlp',bagian='$bg',level='$lvl' where id_pegawai='$id'");
  if ($sql) {
    header("Location: ../index.php?hal=pgw");
  } else {
    header("Location: ../index.php?hal=pgw");
  }
//UPDATE QUERY END
}
//Proses Hapus
else if(isset($_POST['hapus'])) {
  $id = $_POST['id'];
  //DELETE QUERY START
  $sql = mysql_query("delete from pegawai where id_pegawai='$id'");
  if ($sql) {
    header("Location: ../index.php?hal=pgw");
  } else {
    header("Location: ../index.php?hal=pgw");
  }
  exit;
}
?>