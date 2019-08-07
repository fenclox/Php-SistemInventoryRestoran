<?php
  //Include file header.php
  include 'header.php';
  //cek session, kalo ga ada, lempar ke login.
  if(isset($_GET['hal'])){
      switch($_GET['hal']){
          case 'beranda' : include 'beranda.php'; break;
          case 'poe'     : include 'data/dt_po_eksternal.php'; break;
          case 'sj'      : include 'data/dt_surat_jalan.php'; break;
          case 'rtre'    : include 'data/dt_reture.php'; break;

          default : include '404.php';
      }
  }else{
      include 'beranda.php';
  }
  //Include file footer.php
  include 'footer.php';

?>