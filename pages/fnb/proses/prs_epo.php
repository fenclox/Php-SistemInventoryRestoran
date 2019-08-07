<?php
  include "../../../Connection/config.php";
  $po   = $_POST['no'];
  $pgw  = $_POST['pegawai'];

  $jml  = $_POST['jumlah'];
  $brg  = $_POST['barang'];

  $querypo = mysql_query("INSERT into po_internal values('$po',CURDATE(),'0','$pgw')");
  $querydpo = mysql_query("INSERT into detil_po_internal values('$po','$brg','$jml')");
  
  header("Location: ../index.php?hal=epodtl&no_po=$po");
?>