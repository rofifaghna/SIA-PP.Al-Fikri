<?php if ($_GET['act']==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Pertanyan Penilaian Diri </h3>
                  <?php if($_SESSION['level']!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=penilaiandiri&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Pertanyaan</th>
                        <?php if($_SESSION['level']!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT * FROM rb_pertanyaan_penilaian where status='diri' ORDER BY id_pertanyaan_penilaian DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[pertanyaan]</td>";
                              if($_SESSION['level']!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='index.php?view=penilaiandiri&act=edit&id=$r[id_pertanyaan_penilaian]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=penilaiandiri&hapus=$r[id_pertanyaan_penilaian]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }

                      if (isset($_GET['hapus'])){
                          mysql_query("DELETE FROM rb_pertanyaan_penilaian where id_pertanyaan_penilaian='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=penilaiandiri';</script>";
                      }
                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
<?php 
}elseif($_GET['act']=='edit'){
    if (isset($_POST['update'])){
        mysql_query("UPDATE rb_pertanyaan_penilaian SET pertanyaan = '$_POST[a]' where id_pertanyaan_penilaian='$_POST[id]'");
      echo "<script>document.location='index.php?view=penilaiandiri';</script>";
    }
    $edit = mysql_query("SELECT * FROM rb_pertanyaan_penilaian where id_pertanyaan_penilaian='$_GET[id]'");
    $s = mysql_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Pertanyaan Penilaian Diri</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[id_pertanyaan_penilaian]'>
                    <tr><th width='120px' scope='row'>Pertanyaan</th> <td><textarea style='height:100px' class='form-control' name='a'>$s[pertanyaan]</textarea> </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=penilaiandiri'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET['act']=='tambah'){
    if (isset($_POST['tambah'])){
        mysql_query("INSERT INTO rb_pertanyaan_penilaian VALUES('','$_POST[a]','diri','".date('Y-m-d H:i:s')."')");
        echo "<script>document.location='index.php?view=penilaiandiri';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Pertanyaan Penilaian Diri</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='120px' scope='row'>Pertanyaan</th> <td><textarea style='height:100px' class='form-control' name='a'></textarea> </td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=penilaiandiri'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>