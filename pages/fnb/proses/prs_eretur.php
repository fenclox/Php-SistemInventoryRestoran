<?php
  include "../../../Connection/config.php";
  $rtr   = $_POST['retur'];
  $po   = $_POST['no'];

  $jml  = $_POST['jumlah'];
  $brg  = $_POST['barang'];

  $querypo = mysql_query("INSERT into retur values('$rtr',CURDATE(),'$po')");
  $querydpo = mysql_query("INSERT into detil_retur values('$rtr','$brg','$jml')");
  
  header("Location: ../index.php?hal=ertrdtl&nortr=$rtr");
?>