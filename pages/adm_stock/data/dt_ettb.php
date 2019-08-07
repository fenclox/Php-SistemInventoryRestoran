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
              <div class="form-group"><label>No. TTB</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="ttb" readonly value="<?php 
              //Kode
              $time   = date('mydHis');
              $id     = rand(0,9);
              $no     = $time.$id;
              echo $no;
              ?>">
            </div>
              <div class="form-group"><label>No. PO</label><input required class="form-control required text-uppercase" data-placement="top" data-trigger="manual" type="text" name="po" readonly value="<?php echo $_GET['nopo'];?>">
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
            <button name="ettb" type="submit" class="btn btn-primary">Proses</button>
            <input type="hidden" value="<?php echo $_SESSION['id_stk']; ?>" name="pegawai">
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