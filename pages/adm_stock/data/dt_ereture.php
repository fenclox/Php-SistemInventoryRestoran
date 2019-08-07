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
      <h5>Data di bawah ini adalah data PO Eksternal</h5>
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <?php
          $query2 = mysql_query("SELECT b.id_barang as brgdetil, satuan, c.id_barang, nm_barang, qty, satuan from po_eksternal a, detil_po_eksternal b, barang c where a.no_po_eksternal=b.no_po_eksternal and c.id_barang=b.id_barang and b.no_po_eksternal='".$_GET['nopo']."' group by c.id_barang ORDER by c.nm_barang asc");

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
            <form method="POST" action="proses/prs_ereture.php">
              <div class="form-group"><label>No. Retur</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="retur" readonly
              value="<?php
              $dym    =  date('dym');
              //menjadikan 6 digit pertama kode -> dym (tahun,bulan,tanggal) dan mereset kode setelah dym berganti
              $query = "select MAX(RIGHT(no_po_eksternal,2)) as max_id from po_eksternal where LEFT(no_po_eksternal, 6)='$dym' ORDER BY no_po_eksternal";
              $sql   = mysql_query($query);
              $hasil = mysql_fetch_array($sql);
              $maxid = 0;
              $maxid = $hasil['max_id'];
              $maxid++;
              switch (strlen($maxid)) {
              case 1 :
              $idfix = "0" . $maxid;
              break;
              default :
              $idfix = $maxid;
              break;
              };
              $no_po = $dym.$idfix;
              echo $no_po;
              ?>">
            </div>
            <input name="no" type="hidden" value="<?php echo $_GET['nopo'];?>">
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control select2" style="width: 100%;" name="barang" required="">
                <?php
                $nopo = $_GET['nopo'];
                $query = mysql_query("select a.* from barang a, detil_po_eksternal b where a.id_barang=b.id_barang and b.no_po_eksternal='$nopo'");
                while ($row = mysql_fetch_array($query)){
                echo "<option value=$row[id_barang]>$row[nm_barang] $row[model]</option>";
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
      <!-- END FORM ENTRY PO -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
</div>