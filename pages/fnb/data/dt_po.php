<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Data PO Internal
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!-- /////////////////////////////////////// Box /////////////////////////////////////// -->
    <div class="box box-primary">
      <div class="box-header">
      <h5>Data yang BELUM di konfirmasi oleh <b>Admin Stock</b></h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
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
            $record = mysql_query("SELECT a.*, b.* from po_internal a, detil_po_internal b where a.no_po_internal = b.no_po_internal and a.status='0' GROUP BY a.no_po_internal ORDER BY a.no_po_internal asc");
            $no=1;
            while ($r = mysql_fetch_array($record)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[no_po_internal]</td>
              <td>$r[tgl_po_internal]</td>
              <td>
                <button title='Lihat Detil' class='btn btn-warning' data-toggle='modal' href='#' data-target='#detilpoModal".$r['no_po_internal']."'><i class='fa fa-eye'></i></button>&nbsp;
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
      <h5>Data yang sudah di konfirmasi oleh <b>Admin Stock</b> (data yang di tampilkan adalah 20 data terbaru)</h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
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
            $record = mysql_query("SELECT a.*, b.* from po_internal a, detil_po_internal b where a.no_po_internal = b.no_po_internal and a.status='1' GROUP BY a.no_po_internal ORDER BY a.no_po_internal desc limit 20");
            $no=1;
            while ($r = mysql_fetch_array($record)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[no_po_internal]</td>
              <td>$r[tgl_po_internal]</td>
              <td>
                <button title='Lihat Detil' class='btn btn-warning' data-toggle='modal' href='#' data-target='#detilpoModal2".$r['no_po_internal']."'><i class='fa fa-eye'></i></button>&nbsp;
                <a title='Buat Retur' class='btn btn-primary' href='index.php?hal=ertr&nopo=".$r['no_po_internal']."'><i class='glyphicon glyphicon-plus'></i></a>
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
  $query = "SELECT * from po_internal a, detil_po_internal b where a.no_po_internal = b.no_po_internal and a.status='0'";
  $record = mysql_query($query);
  
  while ($row = mysql_fetch_array($record)) { 
?>

<div <?php echo 'id="detilpoModal'.$row['no_po_internal'].'"' ?> class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Detil PO</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="update/statuspo.php">
          <div class="form-group"><label>No. PO</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="po" maxlength="8" readonly value="<?php echo $row['no_po_internal']; ?>"></div>
          <div class="form-group"><label>Tanggal PO</label><input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="tglpo" value="<?php echo $row['tgl_po_internal']; ?>" readonly></div>

      <!-- table detil -->
        <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_internal a, detil_po_internal b, barang c where a.no_po_internal=b.no_po_internal and c.id_barang=b.id_barang and b.no_po_internal='".$row['no_po_internal']."' ORDER by c.nm_barang asc");

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
  $query = "SELECT * from po_internal a, detil_po_internal b where a.no_po_internal = b.no_po_internal and a.status='1'";
  $record = mysql_query($query);
  
  while ($row = mysql_fetch_array($record)) { 
?>

<div <?php echo 'id="detilpoModal2'.$row['no_po_internal'].'"' ?> class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Detil PO</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="update/statuspo.php">
          <div class="form-group"><label>No. PO</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="po" maxlength="8" readonly value="<?php echo $row['no_po_internal']; ?>"></div>
          <div class="form-group"><label>Tanggal PO</label><input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="tglpo" value="<?php echo $row['tgl_po_internal']; ?>" readonly></div>

      <!-- table detil -->
        <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_internal a, detil_po_internal b, barang c where a.no_po_internal=b.no_po_internal and c.id_barang=b.id_barang and b.no_po_internal='".$row['no_po_internal']."' ORDER by c.nm_barang asc");

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