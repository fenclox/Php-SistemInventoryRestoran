<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Buat TTB
    </h1>
    <ol class="breadcrumb">
      <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary">
      <div class="box-header">
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- FORM ENTRY PO -->
        <div class="row">
          <div class="col-md-6">
            <form method="POST" action="proses/prs_acc.php">
            <div class="form-group"><label>No. TTB</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="ttb" readonly
              value='<?php echo $_GET['nottb'];?>'>
            </div>
            <div class="form-group"><label>No. PO</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="po" readonly
              value='<?php echo $_GET['nopo'];?>'>
            </div>
            <div class="form-group">
              <label>Barang</label>
              <select class="form-control select2" style="width: 100%;" name="barang" required="">
                <?php
                $query = mysql_query("select * from barang ORDER by id_barang asc");
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
            <input type="hidden" value="<?php echo $_SESSION['id_stk']; ?>" name="pegawai">
            <button name="ettb" type="submit" class="btn btn-primary">Proses</button>
          </form>
        </div>
      </div>
      <!-- END FORM ENTRY TTB -->
      <hr>
      <!-- DETIL TTB -->
      <i class="fa fa-list fa-fw"></i> Detil TTB<hr>
      <?php
      $record = mysql_query("SELECT b.id_barang as brgdetil, c.satuan, c.id_barang, nm_barang, jml_terima
      FROM ttb a, detil_ttb b, barang c
      WHERE a.no_ttb=b.no_ttb and c.id_barang=b.id_barang and a.no_ttb = '$_GET[nottb]'
      GROUP BY c.id_barang ORDER by c.nm_barang asc");
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
          if($row['jml_terima']>'0'){
          echo "<tr'>";
            echo "<td style=' width:150px;  text-align:left; padding: 10px;vertical-align: middle;' class='text-uppercase'>";echo $row['id_barang'];echo"</td>";
            echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['nm_barang'];"</td>";
            echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'>";echo $row['jml_terima'].' '.$row['satuan'];"</td>";
            echo "<td style='width:110px;  text-align:left; vertical-align: middle;' class='text-capitalize'><a class='btn btn-danger' aria-label='Delete' href='proses/hps_ttbdtl.php?brgdetil=$row[brgdetil]'></span>Hapus</a></td>";
          echo '</tr>';
          }
          }
        echo '</tbody>';
      echo '</table><br>';
      echo"<div class='box-footer'>
        <a class='btn btn-success' href='index.php?hal=poe'>Selesai</a>
      </div>";
      ?>
      <!-- END DETIL TTB -->
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
</div>