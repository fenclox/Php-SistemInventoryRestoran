<?php
  //Include file header.php
  include 'header.php';
  //cek session, kalo ga ada, lempar ke login.
  if(isset($_GET['hal'])){
      switch($_GET['hal']){
          case 'beranda' : include 'beranda.php'; break;
          case 'po'      : include 'data/dt_po.php'; break;
          case 'epo'     : include 'data/dt_epo.php'; break;
          case 'epodtl'  : include 'data/dt_epodtl.php'; break;
          case 'rtr'     : include 'data/dt_retur.php'; break;
          case 'ertr'    : include 'data/dt_eretur.php'; break;
          case 'ertrdtl' : include 'data/dt_ertrdtl.php'; break;

          default : include '404.php';
      }
  }else{
      include 'beranda.php';
  }
  //Include file footer.php
  include 'footer.php';

?>