<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Beranda
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="callout callout-info">
      <!--h4>Tip!</h4-->
      <?php
      $kd = $_SESSION['id_gdg'];
      include "../../connection/config.php";
      $sql = "select nm_pegawai, bagian from pegawai where id_pegawai='".$kd."'";
      $query = mysql_query($sql);
      while($data = mysql_fetch_array($query)){
      echo "<p>Selamat datang, ".$data['nm_pegawai']." <b>[".$data['bagian']."]</b></p>";
      }
      ?>
    </div>
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->