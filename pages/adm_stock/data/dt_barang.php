  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Barang
      </h1>
      <ol class="breadcrumb">
        <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
          <h5>Data yang berwarna <b>merah</b> adalah barang yang stok-nya kurang dari 4</h5>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
              </tr>
            </thead>
            <tbody>
              <!-- Data barang -->                 
              <?php
              $query="SELECT * from barang order by stok asc";
              $tampil = mysql_query($query);
              $no = 1; // nomor baris
              while ($r = mysql_fetch_array($tampil)) {
                if($r['stok']<=3){
                  echo "
                  <tr style='color:red'>
                      <td>$no</td>
                      <td>$r[id_barang]</td>
                      <td style='text-transform: capitalize;'>$r[nm_barang]</td>
                      <td style='text-transform: capitalize;'>$r[stok]</td>
                      <td style='text-transform: capitalize;'>$r[satuan]</td>
                  </tr>";
                } else {
                  echo "
                  <tr>
                      <td>$no</td>
                      <td>$r[id_barang]</td>
                      <td style='text-transform: capitalize;'>$r[nm_barang]</td>
                      <td style='text-transform: capitalize;'>$r[stok]</td>
                      <td style='text-transform: capitalize;'>$r[satuan]</td>
                  </tr>";
                }
                $no++;
              }
              ?>
              <!-- End Data Barang -->
            </table>
          </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
