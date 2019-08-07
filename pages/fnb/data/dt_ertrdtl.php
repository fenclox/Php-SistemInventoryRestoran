<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Retur Barang
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <div class="box-header">
      <h5>Data di bawah ini adalah data PO</h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
       <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_internal a, detil_po_internal b, barang c, retur d where a.no_po_internal=b.no_po_internal and c.id_barang=b.id_barang and d.no_po_internal=a.no_po_internal and d.no_retur='".$_GET['nortr']."' group by c.id_barang ORDER by c.nm_barang asc");

          echo'<table class="table table-striped table-bordered table-hover" id="dataTables-example" style="width:48.5%">';
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
          echo '</br>';
        ?>

        <!-- FORM ENTRY Retur -->
        <div class="row">
          <div class="col-md-6">
            <form method="POST" action="proses/prs_eretur.php">
              <div class="form-group"><label>No. Retur</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="retur" readonly
              value="<?php echo $_GET['nortr'];?>">
            </div>
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control select2" style="width: 100%;" name="barang" required="">
                <?php
                $nortr = $_GET['nortr'];
                $query = mysql_query("select a.* from barang a, detil_po_internal b, po_internal c, retur d where a.id_barang=b.id_barang and b.no_po_internal=c.no_po_internal and c.no_po_internal=d.no_po_internal and d.no_retur='$nortr' group by a.id_barang");
                while ($row = mysql_fetch_array($query)){
                echo "<option value=$row[id_barang]>$row[nm_barang]</option>";
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Jumlah Barang</label>
              <input name="jumlah" type="text" maxlength="4" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Jumlah Barang" data-trigger="manual" required="">
            </div>
            <button name="proses" type="submit" class="btn btn-primary">Proses</button>
          </form>
        </div>
      </div>
      <!-- END FORM ENTRY Retur -->
      <hr>
      <!-- DETIL Retur -->
      <i class="fa fa-list fa-fw"></i> Detil Retur<hr>
      <?php
      $record = mysql_query("SELECT e.id_barang as brgdetil, c.satuan, e.id_barang, nm_barang, jml_retur
      FROM po_internal a, detil_po_internal b, barang c, retur d, detil_retur e
      WHERE a.no_po_internal=b.no_po_internal and c.id_barang=b.id_barang and a.no_po_internal=d.no_po_internal and d.no_retur=e.no_retur and c.id_barang=e.id_barang and e.no_retur='$_GET[nortr]' 
      ");
      echo'<table class="table table-striped table-bordered table-hover" id="dataTables-example">';
        echo '<thead>';
          echo '<tr>';
            echo '<th>ID Barang</th>';
            echo '<th>Barang</th>';
            echo '<th>Jumlah Barang</th>';
            echo '<th>Aksi</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          while ($row = mysql_fetch_array($record)) {
          if($row['jml_retur']>'0'){
          echo "<tr'>";
            echo "<td style=' width:150px;  text-align:left; padding: 10px;vertical-align: middle;' class='text-uppercase'>";echo $row['id_barang'];echo"</td>";
            echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['nm_barang'];"</td>";
            echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['jml_retur'].' '.$row['satuan'];"</td>";
            echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'><a class='btn btn-danger' aria-label='Delete' href='proses/hps_retur.php?brgdetil=$row[brgdetil]'></span>Hapus</a></td>";
          echo '</tr>';
          }
          }
        echo '</tbody>';
      echo '</table><br>';
      echo"<div class='box-footer'>
        <a class='btn btn-success' href='index.php?hal=rtr'>Selesai</a>
      </div>";
      ?>
      <!-- END DETIL PO -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
</div>