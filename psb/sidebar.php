<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../index.php"><b>SISFO</b> AKADEMIK</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan Login Pada Form dibawah ini</p>

        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name='a' placeholder="Username" required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name='b' placeholder="Password" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button name='login' type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

<?php 
// require_once 'config/koneksi.php';

if (isset($_POST['login'])){
 $passlain=anti_injection($_POST['b']);
 $data=md5(anti_injection($_POST['b']));
 $pass=hash("sha512",$data);
 $admin = mysql_query("SELECT * FROM rb_users WHERE username='".anti_injection($_POST['a'])."' AND password='$pass'");
 $guru = mysql_query("SELECT * FROM rb_guru WHERE nip='".anti_injection($_POST['a'])."' AND password='$passlain'");
 $siswa = mysql_query("SELECT * FROM rb_siswa WHERE nisn='".anti_injection($_POST['a'])."' AND password='$passlain'");
 
 $hitungadmin = mysql_num_rows($admin);
 $hitungguru = mysql_num_rows($guru);
 $hitungsiswa = mysql_num_rows($siswa);
 if ($hitungadmin >= 1){
    $r = mysql_fetch_array($admin);
    $_SESSION['id']           = $r['id_user'];
    $_SESSION['namalengkap']  = $r['nama_lengkap'];
    $_SESSION['level']        = $r['level'];
    include "config/user_agent.php";
    mysql_query("INSERT INTO rb_users_aktivitas VALUES('','$r[id_user]','$ip','$user_browser $version','$user_os','$r[level]','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
 }elseif ($hitungguru >= 1){
    $r = mysql_fetch_array($guru);
    $_SESSION['id']           = $r['nip'];
    $_SESSION['namalengkap']  = $r['nama_guru'];
    $_SESSION['level']        = 'guru';
    include "config/user_agent.php";
    mysql_query("INSERT INTO rb_users_aktivitas VALUES('','$r[nip]','$ip','$user_browser $version','$user_os','guru','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
 }elseif ($hitungsiswa >= 1){
    $r = mysql_fetch_array($siswa);
    $_SESSION['id']           = $r['nisn'];
    $_SESSION['namalengkap']  = $r['nama'];
    $_SESSION['kode_kelas']   = $r['kode_kelas'];
    $_SESSION['angkatan']     = $r['angkatan'];
    $_SESSION['level']        = 'siswa';
    include "config/user_agent.php";
    mysql_query("INSERT INTO rb_users_aktivitas VALUES('','$r[nisn]','$ip','$user_browser $version','$user_os','siswa','".date('H:i:s')."','".date('Y-m-d')."')");
    echo "<script>document.location='index.php';</script>";
 }else{
    echo "<script>window.alert('Maaf, Anda Tidak Memiliki akses');
                                  window.location=('index.php?view=login')</script>";
 }
}
?>
                 
</br></br></br></br></br>
<form class="form-inline">              
  <div style='width:100%' class="input-group">                
  <input type="text" class="form-control" placeholder="Search for...">                
  <span class="input-group-btn">                  
    <button class="btn btn-danger" type="button">Search</button>                
  </span>              
</div>          
</form><br>          

<div class="list-group">            
  <a href="#" class="list-group-item active">Pendaftaran Santri Baru</a>            
  <a href="#" data-toggle="modal" data-target="#kode" class="list-group-item">PSB Ponpes Tingkatan Mahasiswa</a>            
  <a href="#" data-toggle="modal" data-target="#kode" class="list-group-item">PSB Ponpes Tingkatan Menengah Atas / Kejuruan</a>            
  <a href="#" data-toggle="modal" data-target="#kode" class="list-group-item">PSB Ponpes Tingkatan Menengah Pertama</a>
</div>
