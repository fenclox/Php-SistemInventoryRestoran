<?php
session_start();
require_once("../../Connection/config.php");
$id     = $_POST['id'];
$pass   = $_POST['password'];

$query = mysql_query("SELECT id_pegawai,password,level FROM pegawai WHERE id_pegawai='$id' AND password='$pass'"); // Membandingkan kode & password
    if(mysql_num_rows($query) == 0){
      ?>
      <script type="text/javascript">
          alert("Login Gagal");
          document.location="index.php";
      </script>
      <?php
    } else{
      $row = mysql_fetch_array($query);
      if ($row['level'] == 0 ){ // Membandingkan level
        $_SESSION['id_gdg']=$id;
        header("Location:../adm_gudang/index.php"); // Mengalihkan file setelah berhasil login
      } else if ($row['level'] == 1){
        $_SESSION['id_stk']=$id;
        header("Location:../adm_stock/index.php");
      } else if ($row['level'] == 2){
        $_SESSION['id_fnb']=$id;
        header("Location:../fnb/index.php");
      } else if ($row['level'] == 3){
        $_SESSION['id_kpl']=$id;
        header("Location:../kpl_admin/index.php");
      }else if ($row['level'] == 4){
        $_SESSION['id_spr']=$id;
        header("Location:../spr_admin/index.php");
      } else {
        ?>
        <script type="text/javascript">
            alert("Login Gagal");
            document.location="index.php";
        </script>
        <?php
      }
    }
?>
