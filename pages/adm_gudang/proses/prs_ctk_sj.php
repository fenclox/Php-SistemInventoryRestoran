<?php
  include('../../../connection/config.php');
  session_start(); //Mendapatkan Session

  date_default_timezone_set('Asia/Jakarta');
  function tglIndonesia($str){
        $tr   = trim($str);
        $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
        return $str;
    }
  ////////////////////////////////////////////////////////////////////////////////////////
  $nopoe = $_GET['nopoe'];
  $nosj = $_GET['nosj'];
  // query sj
  $query1 = mysql_query("SELECT no_sj, tgl_sj from surat_jalan where no_sj='$nosj'");
  $sql1   = mysql_fetch_array($query1);
  $tglsjG  = $sql1['tgl_sj'];
  $tglsj = tglIndonesia(date(" d F Y", strtotime($tglsjG)));
  ////////////////////////////////////////////////////////////////////////////////////////
  ob_start();
  //Report
  require ("../../../html2pdf/html2pdf.class.php");
  $content = ob_get_clean();

  $content.= "
  <style>
  p.kop{
    margin: 5px 0 0 45px;
  }
  </style>
  <table border='1'>
  <tr>
    <td width='365'><h4 align='center'>PT. Nuansa Timur Lestari (Eastern Group)</h4></td>
    <td width='365'><h4 align='center'>Surat Jalan</h4></td>
  </tr>
  </table>
  <br>
   <table>
  <tr>
    <td width='365'><h5 align='left'> No.SJ : &nbsp; $nosj <br><br>  No.PO Eksternal : &nbsp; $nopoe</h5></td>
    <td width='365'><h5 align='right'> Tanggal SJ : &nbsp; $tglsj</h5></td>
  </tr>
  </table>
  <p align='center'>
    <table cellpadding='0' cellspacing='1' style='width: 210mm;' border=0.5>
      <tr bgcolor='#CCCCCC'>
        <th style='width:30px; height: 20px'>#</th>
        <th style='width:350px;'>Barang</th>
        <th style='width:360px;'>Jumlah</th>
      </tr>";
      // Menampilkan data
      $query = mysql_query("
          SELECT a.id_barang as id, a.nm_barang as nm, a.satuan as satuan, b.qty as jumlah
          FROM barang a
          JOIN detil_po_eksternal b ON a.id_barang=b.id_barang
          JOIN po_eksternal c ON b.no_po_eksternal=c.no_po_eksternal
          WHERE c.no_po_eksternal='$nopoe' order by a.id_barang");
      $no = 1; // nomor baris
      while ($r = mysql_fetch_array($query)) {
      $content.="<tr bgcolor='#FFFFFF'>
        <td>$no</td>
        <td style='text-transform: capitalize;'>$r[nm]</td>
        <td>$r[jumlah] $r[satuan]</td>
      </tr>";
      $no++;
      }
    $content.="</table></p><br><br>";

  $filename="Cetak SJ ".$bln."_".$thn.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya

  ob_end_clean();
  // conversion HTML => PDF
  try
  {
    $html2pdf = new HTML2PDF('L', 'A5','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->pdf->IncludeJS('print(TRUE)');
    $html2pdf->Output($filename);
  }
  catch(HTML2PDF_exception $e) { echo $e; }
?>

