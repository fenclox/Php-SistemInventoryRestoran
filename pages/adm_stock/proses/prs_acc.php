<?php
include "../../../Connection/config.php";
//Proses ACC
if(isset($_POST['acc'])){
  $po  = $_POST['po'];
  $pgw  = $_POST['pegawai'];
  $sts  = '1';
  
  $query1 = "update po_internal set status='$sts', id_pegawai='$pgw' where no_po_internal='$po'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../index.php?hal=poi");
  } else {
     echo mysql_error();
  }
} else if(isset($_POST['ettb'])){
  $po   = $_POST['po'];
  $pgw  = $_POST['pegawai'];
  $sts  = '3';

  $ttb  = $_POST['ttb'];
  $brg  = $_POST['barang'];
  $jml  = $_POST['jumlah'];
  
  $queryttb = "INSERT into ttb values ('$ttb', CURDATE(), '$pgw', '$po')";
  $querydtlttb = "INSERT into detil_ttb (no_ttb, id_barang, jml_terima) values('$ttb', '$brg', '$jml')";
  $querypoe = "UPDATE po_eksternal set status='$sts', id_pegawai='$pgw' where no_po_eksternal='$po'";

  mysql_query($queryttb);
  mysql_query($querydtlttb);
  mysql_query($querypoe);
  
  header('location:../index.php?hal=ettbdtl&nottb='.$ttb.'&nopo='.$po);
}
?>
