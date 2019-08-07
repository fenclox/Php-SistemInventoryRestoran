<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Data Surat Jalan
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- /////////////////////////////////////// Box 1 /////////////////////////////////////// -->
    <div class="box box-primary">
      <div class="box-header">
      <h5>Klik tombol <i>checklist</i> untuk membuat <b>Surat Jalan</b> pada PO Eksternal yang sudah di konfirmasi</h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <table id="hidesrc" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>No. PO</th>
              <th>Tanggal PO</th>
              <th><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $record = mysql_query("SELECT a.*, b.* from po_eksternal a, detil_po_eksternal b where a.no_po_eksternal = b.no_po_eksternal and a.status='1' GROUP BY a.no_po_eksternal ORDER BY a.no_po_eksternal asc");
            $no=1;
            while ($r = mysql_fetch_array($record)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[no_po_eksternal]</td>
              <td>$r[tgl_po_eksternal]</td>
              <td>
                <button title='Lihat Detil' class='btn btn-warning' data-toggle='modal' href='#' data-target='#detilpoModal".$r['no_po_eksternal']."'><i class='fa fa-eye'></i></button>&nbsp;
              </td>
            </tr>
            ";
            $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->

    <!-- /////////////////////////////////////// Box 2 /////////////////////////////////////// -->
    <div class="box box-primary">
      <div class="box-header">
      <h5>Data yang SUDAH di buat <b>Surat Jalan</b></h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <table id="hidesrc" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>No. SJ</th>
              <th>No. PO</th>
              <th>Tanggal PO</th>
              <th>Tanggal SJ</th>
              <th><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $record = mysql_query("SELECT a.*, b.*, c.* from po_eksternal a, detil_po_eksternal b, surat_jalan c where a.no_po_eksternal = b.no_po_eksternal and a.no_po_eksternal = c.no_po_eksternal and a.status='2' GROUP BY a.no_po_eksternal ORDER BY a.tgl_po_eksternal desc");
            $no=1;
            while ($r = mysql_fetch_array($record)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[no_sj]</td>
              <td>$r[no_po_eksternal]</td>
              <td>$r[tgl_po_eksternal]</td>
              <td>$r[tgl_sj]</td>
              <td>
                <button title='Lihat Detil' class='btn btn-warning' data-toggle='modal' href='#' data-target='#detilpoModal".$r['no_po_eksternal']."'><i class='fa fa-eye'></i></button> &nbsp;
                <a title='Cetak Surat Jalan' class='btn btn-primary' target='_blank' href='proses/prs_ctk_sj.php?nopoe=".$r['no_po_eksternal']."&nosj=".$r['no_sj']."'><i class='glyphicon glyphicon-print'></i></a>
              </td>
            </tr>
            ";
            $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->

    <!-- /////////////////////////////////////// Box 3 /////////////////////////////////////// -->
    <div class="box box-primary">
      <div class="box-header">
      <h5>Data <b>TTB</b> yang sudah diterima oleh <b>Admin Stock</b> (data yang di tampilkan adalah 20 data terbaru)</h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <table id="hidesrc" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>No. TTB</th>
              <th>No. PO</th>
              <th>Tanggal PO</th>
              <th>Tanggal TTB</th>
              <th><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $record = mysql_query("SELECT a.*, b.* from po_eksternal a, ttb b where a.no_po_eksternal = b.no_po_eksternal and a.status='3' GROUP BY a.no_po_eksternal ORDER BY a.tgl_po_eksternal desc limit 20");
            $no=1;
            while ($r = mysql_fetch_array($record)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[no_ttb]</td>
              <td>$r[no_po_eksternal]</td>
              <td>$r[tgl_po_eksternal]</td>
              <td>$r[tgl_ttb]</td>
              <td>
                <button title='Lihat Detil' class='btn btn-warning' data-toggle='modal' href='#' data-target='#detilpoModal".$r['no_po_eksternal']."'><i class='fa fa-eye'></i></button>&nbsp;
              </td>
            </tr>
            ";
            $no++;
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
    <!-- /////////////////////////////////////// =============== /////////////////////////////////////// -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- ////////////////////////////////////////////// Detil 1 ///////////////////////////////////////////////////// -->
<?php  
  $query = "SELECT * from po_eksternal a, detil_po_eksternal b where a.no_po_eksternal = b.no_po_eksternal and a.status='1'";
  $record = mysql_query($query);
  
  while ($row = mysql_fetch_array($record)) { 
?>

<div <?php echo 'id="detilpoModal'.$row['no_po_eksternal'].'"' ?> class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Detil PO</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="proses/prs_acc.php">
          <div class="row">
          <div class="col-xs-10">
            <div class="form-group"><label>No.PO</label><input class="form-control" data-placement="top" data-trigger="manual" type="text" name="po" maxlength="8" readonly value="<?php echo $row['no_po_eksternal']; ?>">
          </div>
          </div>
          <div class="col-md-offset-10 col-xs-2" style="margin: 23px 0 0 0">
            <button type="submit" name="sj" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i></button>
          </div>
          </div>
          <div class="form-group"><label>Tanggal PO</label><input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="tglpo" value="<?php echo $row['tgl_po_eksternal']; ?>" readonly></div>
          <input type="hidden" value="<?php echo $_SESSION['id_gdg']; ?>" name="pegawai">
      <!-- table detil -->
        <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_eksternal a, detil_po_eksternal b, barang c where a.no_po_eksternal=b.no_po_eksternal and c.id_barang=b.id_barang and b.no_po_eksternal='".$row['no_po_eksternal']."' ORDER by c.nm_barang asc");

          echo'<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
              echo '<thead>';
                  echo '<tr>';
                      echo '<th>ID Barang</th>';
                      echo '<th>Nama Barang</th>';
                      echo '<th>Jumlah</th>';
                  echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
              while ($row = mysql_fetch_array($query2)) {
                  if($row['qty']>'0'){
                      echo "<tr'>";                 
                          echo "<td style=' width:150px;  text-align:left; padding: 10px;vertical-align: middle;' class='text-uppercase'>";echo $row['id_barang'];echo"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['nm_barang'];"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['qty'].' '.$row['satuan'];"</td>";
                      echo '</tr>';
                  }
              }
              echo '</tbody>';
          echo '</table>';
        ?>
        <!-- end table detil -->
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  }
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////// Detil 2 ///////////////////////////////////////////////////// -->
<?php  
  $query = "SELECT * from po_eksternal a, detil_po_eksternal b, surat_jalan c where a.no_po_eksternal = b.no_po_eksternal and a.no_po_eksternal=c.no_po_eksternal and a.status='2'";
  $record = mysql_query($query);
  
  while ($row = mysql_fetch_array($record)) { 
?>

<div <?php echo 'id="detilpoModal'.$row['no_po_eksternal'].'"' ?> class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Detil Surat Jalan</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="proses/prs_sj.php">
          <div class="form-group"><label>No. SJ</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="po" maxlength="8" readonly value="<?php echo $row['no_sj']; ?>"></div>
          <div class="form-group"><label>Tanggal SJ</label><input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="tglpo" value="<?php echo $row['tgl_sj']; ?>" readonly></div>

      <!-- table detil -->
        <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_eksternal a, detil_po_eksternal b, barang c where a.no_po_eksternal=b.no_po_eksternal and c.id_barang=b.id_barang and b.no_po_eksternal='".$row['no_po_eksternal']."' ORDER by c.nm_barang asc");

          echo'<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
              echo '<thead>';
                  echo '<tr>';
                      echo '<th>ID Barang</th>';
                      echo '<th>Nama Barang</th>';
                      echo '<th>Jumlah</th>';
                  echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
              while ($row = mysql_fetch_array($query2)) {
                  if($row['qty']>'0'){
                      echo "<tr'>";                 
                          echo "<td style=' width:150px;  text-align:left; padding: 10px;vertical-align: middle;' class='text-uppercase'>";echo $row['id_barang'];echo"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['nm_barang'];"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['qty'].' '.$row['satuan'];"</td>";
                      echo '</tr>';
                  }
              }
              echo '</tbody>';
          echo '</table>';
        ?>
        <!-- end table detil -->
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  }
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////// Detil 3 ///////////////////////////////////////////////////// -->
<?php  
  $query = "SELECT * from po_eksternal a, detil_po_eksternal b where a.no_po_eksternal = b.no_po_eksternal and a.status='3'";
  $record = mysql_query($query);
  
  while ($row = mysql_fetch_array($record)) { 
?>

<div <?php echo 'id="detilpoModal'.$row['no_po_eksternal'].'"' ?> class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Detil PO</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="proses/prs_acc.php">
            <div class="form-group"><label>No.PO</label><input class="form-control" data-placement="top" data-trigger="manual" type="text" name="po" maxlength="8" readonly value="<?php echo $row['no_po_eksternal']; ?>">
          </div>
          <div class="form-group"><label>Tanggal PO</label><input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="tglpo" value="<?php echo $row['tgl_po_eksternal']; ?>" readonly></div>
          <input type="hidden" value="<?php echo $_SESSION['id_stk']; ?>" name="pegawai">
      <!-- table detil -->
        <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_eksternal a, detil_po_eksternal b, barang c where a.no_po_eksternal=b.no_po_eksternal and c.id_barang=b.id_barang and b.no_po_eksternal='".$row['no_po_eksternal']."' ORDER by c.nm_barang asc");

          echo'<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
              echo '<thead>';
                  echo '<tr>';
                      echo '<th>ID Barang</th>';
                      echo '<th>Nama Barang</th>';
                      echo '<th>Jumlah</th>';
                  echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
              while ($row = mysql_fetch_array($query2)) {
                  if($row['qty']>'0'){
                      echo "<tr'>";                 
                          echo "<td style=' width:150px;  text-align:left; padding: 10px;vertical-align: middle;' class='text-uppercase'>";echo $row['id_barang'];echo"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['nm_barang'];"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['qty'].' '.$row['satuan'];"</td>";
                      echo '</tr>';
                  }
              }
              echo '</tbody>';
          echo '</table>';
        ?>
        <!-- end table detil -->
        </form>
      </div>
    </div>
  </div>
</div>

<?php
  }
?>
<!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->