<?php
include "../../../Connection/config.php";
//Proses ACC
if(isset($_POST['acc'])){
  $po  = $_POST['po'];
  $pgw  = $_POST['pegawai'];
  $sts  = '1';
  
  $query1 = "update po_eksternal set status='$sts', id_pegawai='$pgw' where no_po_eksternal='$po'";
  $sql1 = mysql_query($query1);
  if ($sql1) {
    header("Location: ../index.php?hal=poe");
  } else {
     echo mysql_error();
  }
} else if(isset($_POST['sj'])){
  //Kode
  $time   = date('ymdHis');
  $id     = rand(0,9);
  $no     = $time.$id;

  $po  = $_POST['po'];
  $pgw  = $_POST['pegawai'];
  $sts = '2';
  
  $query = "INSERT into surat_jalan values ('$no',CURDATE(),'$po')";
  $query1 = "update po_eksternal set status='$sts', id_pegawai='$pgw' where no_po_eksternal='$po'";

  $sql = mysql_query($query);
  $sql1 = mysql_query($query1);

  if ($sql && $sql1) {
    header("Location: ../index.php?hal=sj");
  } else {
     echo mysql_error();
  }
}
?>
