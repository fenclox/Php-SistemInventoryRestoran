<?php
  include('../../../connection/config.php');
  session_start(); //Mendapatkan Session

  date_default_timezone_set('Asia/Jakarta');
  function tglIndonesia($str){
        $tr   = trim($str);
        $str    = str_replace(array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'), array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'), $tr);
        return $str;
    }

  $thn = $_POST['tahun'];
  $bln = $_POST['bulan'];

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
    <td width='230'><h4 align='center'>PT. Nuansa Timur Lestari (Eastern Group)</h4></td>
    <td width='500'><h4 align='center'>Laporan</h4></td>
  </tr>
  </table> <br>
  <br>
  <hr>
  <h4 align='center'>PO Eksternal</h4>
  <hr>
   <table>
  <tr>
    <td width='365'><h5 align='left'> Bulan : &nbsp; $bln</h5></td>
    <td width='370'><h5 align='right'>Tahun : &nbsp; $thn</h5></td>
  </tr>
  </table>
  <p align='center'>
    <table cellpadding='0' cellspacing='1' style='width: 210mm;' border=0.5>
      <tr bgcolor='#CCCCCC'>
        <th style='width:30px; height: 20px'>#</th>
        <th style='width:350px;'>No.PO Eksternal</th>
        <th style='width:360px;'>Tgl.PO Eksternal</th>
      </tr>";
      // Menampilkan data
      $query = mysql_query("
         SELECT * from po_eksternal
        WHERE YEAR(tgl_po_eksternal)='$thn' AND MONTH(tgl_po_eksternal)='$bln' AND status='3'
        GROUP BY no_po_eksternal");
      $no = 1; // nomor baris
      while ($r = mysql_fetch_array($query)) {
      $content.="<tr bgcolor='#FFFFFF'>
        <td>$no</td>
        <td>$r[no_po_eksternal]</td>
        <td>$r[tgl_po_eksternal]</td>
      </tr>";
      $no++;
      }
    $content.="</table></p><br><br>";

  $filename="Laporan PO Eksternal ".$bln."_".$thn.".pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya

  ob_end_clean();
  // conversion HTML => PDF
  try
  {
    $html2pdf = new HTML2PDF('P', 'A4','en', false, 'ISO-8859-15');
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->pdf->IncludeJS('print(TRUE)');
    $html2pdf->Output($filename);
  }
  catch(HTML2PDF_exception $e) { echo $e; }
?>

