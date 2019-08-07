  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pegawai
      </h1>
      <ol class="breadcrumb">
        <b><p style="font-size:15px; margin-top:-5px"><?php echo tglIndonesia(date('D, d F Y')); ?></p></b>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title"><button type="button" class="btn btn-primary" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#tambah"><i class="glyphicon glyphicon-plus"></i></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>ID Pegawai</th>
                <th>Nama Pegawai</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Bagian</th>
                <th><span class="glyphicon glyphicon-cog"></span></th>
              </tr>
            </thead>
            <tbody>
              <!-- Data barang -->
              <?php
              $query="SELECT * from pegawai where not level='3'";
              $tampil = mysql_query($query);
              $no = 1; // nomor baris
              while ($r = mysql_fetch_array($tampil)) {
                echo "
                    <tr>
                        <td>$no</td>
                        <td>$r[id_pegawai]</td>
                        <td style='text-transform: capitalize;'>$r[nm_pegawai]</td>
                        <td style='text-transform: capitalize;'>$r[alamat]</td>
                        <td style='text-transform: capitalize;'>$r[no_telp]</td>
                        <td style='text-transform: capitalize;'>$r[bagian]</td>
                        <td> "; ?>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning" value='<?php echo $r['id_pegawai'];?>' onclick="ubahdata(this.value)" data-toggle="modal" data-target="#ubah"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp;
                        <button type="button" class="btn btn-danger" value='<?php echo $r['id_pegawai'];?>' onclick="hapusdata(this.value)" data-toggle="modal" data-target="#hapus"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                    </tr>
                  <?php
                  $no++;}
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
  <!--**************************************** Modals ****************************************-->
  <!--****************** Tambah ******************-->
  <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah Pegawai</h4>
        </div>
        <div class="modal-body">
          <!-- general form elements -->
            <!-- form start -->
            <form role="form" method="POST" action="proses/prs_pegawai.php">
              <div class="box-body">
                <div class="form-group">
                  <?php
                    $query = mysql_query("SELECT max(id_pegawai) as maxNO FROM pegawai");
                    $row = mysql_fetch_array($query);
                    $idMax = $row['maxNO'];

                   //setelah membaca id terbesar, buat no urut dari karakter ke 2, 4 digit ke kanan
                    $NoUrut = (int) substr($idMax, 1, 2);
                    $NoUrut++;
                    $id = sprintf('%02s', $NoUrut);
                  ?>
                  <label>Id Pegawai</label>
                  <input name="id" type="text" class="form-control" value="<?php echo 'P'.$id ?>" readonly="">
                </div>
                <div class="form-group">
                  <label>Nama Pegawai</label>
                  <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Pegawai" maxlength="30" onkeypress="return isAlphabetKey(event)" required="" style='text-transform: capitalize;'>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" type="text" class="form-control" placeholder="Masukkan Alamat"></textarea>
                </div>
                <div class="form-group">
                  <label>No. Telepon</label>
                  <input name="no_telp" type="text" class="form-control" placeholder="Masukkan Nomor Telepon" maxlength="15" onkeypress="return isNumberKey(event)" required="" style='text-transform: capitalize;'>
                </div>
                <div class="form-group">
                  <label>Select</label>
                  <select name="bagian" class="form-control">
                    <option value="Admin Gudang">Admin Gudang</option>
                    <option value="Admin Stock">Admin Stock</option>
                    <option value="F&B">F&B</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="tambah" type="submit" class="btn btn-primary">Tambah</button>
              </div>
            </form>
          <!-- /.box -->
        </div>
      </div>
    </div>
  </div>
  <!--****************** Ubah ******************-->
  <div class="modal fade" id="ubah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Ubah Pegawai</h4>
        </div>
        <div class="modal-body">
          <!-- general form elements -->
            <!-- form start -->
            <form role="form" method="POST" action="proses/prs_pegawai.php">
              <div class="box-body">
                <!-- Ubah Data -->
                <span id="dub"></span>
                <!-- End Ubah Data -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button name="ubah" type="submit" class="btn btn-primary">Ubah</button>
              </div>
            </form>
          <!-- /.box -->
        </div>
      </div>
    </div>
  </div>
  <!--****************** Hapus ******************-->
  <div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Pegawai</h4>
        </div>
        <div class="modal-body">
          <!-- general form elements -->
            <!-- form start -->
            <form role="form" method="POST" action="proses/prs_Pegawai.php">
              <div class="box-body">
                Yakin ingin menghapus data?
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" id="id" name="id" value="">
                <button name="hapus" type="submit" class="btn btn-primary">Hapus</button>
              </div>
            </form>
          <!-- /.box -->
        </div>
      </div>
    </div>
  </div>
  <!--**************************************** /Modals ****************************************-->
  <!-- Ubah & hapus data -->
  <script>
  function ubahdata(id_pegawai){
      var ajaxbos = new XMLHttpRequest();
          ajaxbos.onreadystatechange= function(){
              if(ajaxbos.readyState==4 && ajaxbos.status==200){
                  document.getElementById("dub").innerHTML= ajaxbos.responseText;
              }
          };
          ajaxbos.open("GET","ubah/ubh_pegawai.php?q="+id_pegawai+"&s=#",true);
          ajaxbos.send();
      }
  function hapusdata(id_pegawai){
      document.getElementById('id').value=id_pegawai;
  }
</script>
