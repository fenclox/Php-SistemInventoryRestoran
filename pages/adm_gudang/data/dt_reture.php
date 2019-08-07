<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Data Retur Eksternal
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
        <h5>Data yang di tampilkan adalah 20 data terbaru</b></h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>No. PO</th>
              <th>Tanggal PO</th>
              <th>No. Retur</th>
              <th>Tanggal Retur</th>
              <th><span class="glyphicon glyphicon-cog"></span></th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $record = mysql_query("SELECT a.no_retur_eksternal, a.tgl_retur_eksternal, b.no_po_eksternal, b.tgl_po_eksternal from retur_eksternal a, po_eksternal b where a.no_po_eksternal=b.no_po_eksternal GROUP BY a.no_retur_eksternal ORDER BY a.no_retur_eksternal desc limit 20");
            $no=1;
            while ($r = mysql_fetch_array($record)) {
            echo "
            <tr>
              <td>$no</td>
              <td>$r[no_po_eksternal]</td>
              <td>$r[tgl_po_eksternal]</td>
              <td>$r[no_retur_eksternal]</td>
              <td>$r[tgl_retur_eksternal]</td>
              <td>
                <button title='Lihat Detil' class='btn btn-warning' data-toggle='modal' href='#' data-target='#detilModal".$r['no_retur_eksternal']."'><i class='fa fa-eye'></i></button>
                
            </tr>";
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
<!-- ////////////////////////////////////////////// Detil ///////////////////////////////////////////////////// -->
<?php  
  $query = "SELECT a.no_retur_eksternal, a.tgl_retur_eksternal, b.no_po_eksternal, b.tgl_po_eksternal from retur_eksternal a, po_eksternal b where a.no_po_eksternal=b.no_po_eksternal GROUP BY a.no_retur_eksternal ORDER BY a.no_retur_eksternal asc";
  $record = mysql_query($query);
  
  while ($row = mysql_fetch_array($record)) { 
?>

<div <?php echo 'id="detilModal'.$row['no_retur_eksternal'].'"' ?> class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Detil Retur</h3>
      </div>
      <div class="modal-body">
        <form method="POST" action="update/statuspo.php">
          <div class="form-group"><label>No. Retur</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="po" maxlength="8" readonly value="<?php echo $row['no_retur_eksternal']; ?>"></div>
          <div class="form-group"><label>Tanggal Retur</label><input required class="form-control required text-capitalize" data-placement="top" data-trigger="manual" type="text" name="tglpo" value="<?php echo $row['tgl_retur_eksternal']; ?>" readonly></div>

      <!-- table detil -->
        <?php
          $query2 = mysql_query("SELECT e.id_barang as brgdetil, c.satuan, e.id_barang, c.nm_barang, jml_retur_eksternal
      FROM po_eksternal a, detil_po_eksternal b, barang c, retur_eksternal d, detil_retur_eksternal e
      WHERE a.no_po_eksternal=b.no_po_eksternal and c.id_barang=b.id_barang and a.no_po_eksternal=d.no_po_eksternal and d.no_retur_eksternal=e.no_retur_eksternal and c.id_barang=e.id_barang and e.no_retur_eksternal='".$row['no_retur_eksternal']."'
      GROUP BY e.id_barang ORDER by c.nm_barang asc");

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
                  if($row['jml_retur_eksternal']>'0'){
                      echo "<tr'>";                 
                          echo "<td style=' width:150px;  text-align:left; padding: 10px;vertical-align: middle;' class='text-uppercase'>";echo $row['id_barang'];echo"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['nm_barang'];"</td>";
                          echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['jml_retur_eksternal'].' '.$row['satuan'];"</td>";
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
