<?php
  //Include file header.php
  include 'header.php';
  //cek session, kalo ga ada, lempar ke login.
  if(isset($_GET['hal'])){
      switch($_GET['hal']){
          case 'beranda' : include 'beranda.php'; break;
          case 'brg'     : include 'data/dt_barang.php'; break;
          case 'poi'     : include 'data/dt_po_internal.php'; break;
          case 'poe'     : include 'data/dt_po_eksternal.php'; break;
          case 'epoe'    : include 'data/dt_epo.php'; break;
          case 'epodtl'  : include 'data/dt_epodtl.php'; break;
          case 'ettb'    : include 'data/dt_ettb.php'; break;
          case 'ettbdtl' : include 'data/dt_ettbdtl.php'; break;
          case 'rtr'     : include 'data/dt_retur.php'; break;
          case 'rtre'     : include 'data/dt_reture.php'; break;
          case 'ertre'    : include 'data/dt_ereture.php'; break;
          case 'ertredtl' : include 'data/dt_ertredtl.php'; break;

          default : include '404.php';
      }
  }else{
      include 'beranda.php';
  }
  //Include file footer.php
  include 'footer.php';

?>