<?php if ($_GET['act']==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Mata Pelajaran </h3>
                  <?php if($_SESSION['level']!='kepala'){ ?>
                  <a class='pull-right btn btn-primary btn-sm' href='index.php?view=matapelajaran&act=tambah'>Tambahkan Data</a>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:30px'>No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Jurusan</th>
                        <th>Tingkat</th>
                        <th>Guru Pengampu</th>
                        <th>Kelompok</th>
                        <?php if($_SESSION['level']!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT * FROM rb_mata_pelajaran a 
                                              LEFT JOIN rb_kelompok_mata_pelajaran b ON a.id_kelompok_mata_pelajaran=b.id_kelompok_mata_pelajaran
                                                LEFT JOIN rb_guru c ON a.nip=c.nip 
                                                  LEFT JOIN rb_jurusan d ON a.kode_jurusan=d.kode_jurusan
                                                    LEFT JOIN rb_kurikulum e ON a.kode_kurikulum=e.kode_kurikulum
                                                      ORDER BY a.urutan ASC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[kode_pelajaran]</td>
                              <td>$r[namamatapelajaran]</td>
                              <td>$r[nama_jurusan]</td>
                              <td>$r[tingkat]</td>
                              <td>$r[nama_guru]</td>
                              <td>$r[nama_kelompok_mata_pelajaran]</td>";
                              if($_SESSION['level']!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-primary btn-xs' title='Detail Data' href='?view=matapelajaran&act=detail&id=$r[kode_pelajaran]'><span class='glyphicon glyphicon-search'></span></a>
                                <a class='btn btn-success btn-xs' title='Edit Data' href='?view=matapelajaran&act=edit&id=$r[kode_pelajaran]'><span class='glyphicon glyphicon-edit'></span></a>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='?view=matapelajaran&hapus=$r[kode_pelajaran]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET['hapus'])){
                          mysql_query("DELETE FROM rb_mata_pelajaran where kode_pelajaran='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=matapelajaran';</script>";
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
        mysql_query("UPDATE rb_mata_pelajaran SET kode_pelajaran = '$_POST[a]',
                                         id_kelompok_mata_pelajaran = '$_POST[b]',
                                         kode_jurusan = '$_POST[c]',
                                         nip = '$_POST[d]',
                                         kode_kurikulum = '$_POST[e]',
                                         namamatapelajaran = '$_POST[f]',
                                         tingkat = '$_POST[h]',
                                         jumlah_jam = '$_POST[k]',
                                         sesi = '$_POST[n]',
                                         urutan = '$_POST[l]',
                                         aktif = '$_POST[m]' where kode_pelajaran='$_POST[id]'");
      echo "<script>document.location='index.php?view=matapelajaran';</script>";
    }
    $edit = mysql_query("SELECT * FROM rb_mata_pelajaran where kode_pelajaran='$_GET[id]'");
    $s = mysql_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Mata Pelajaran</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <input type='hidden' name='id' value='$s[kode_pelajaran]'>
                    <tr><th width='140px' scope='row'>Kurikulum</th> <td><select class='form-control' name='e'> 
                             <option value='0' selected>- Pilih Kurikulum -</option>"; 
                              $kurikulum = mysql_query("SELECT * FROM rb_kurikulum");
                                  while($a = mysql_fetch_array($kurikulum)){
                                    if ($s['kode_kurikulum']==$a['kode_kurikulum']){
                                       echo "<option value='$a[kode_kurikulum]' selected>$a[nama_kurikulum]</option>";
                                    }else{
                                       echo "<option value='$a[kode_kurikulum]'>$a[nama_kurikulum]</option>";
                                    }
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Kode Pelajaran</th>       <td><input type='text' class='form-control' name='a' value='$s[kode_pelajaran]'> </td></tr>
                    <tr><th scope='row'>Nama Mapel</th>           <td><input type='text' class='form-control' name='f' value='$s[namamatapelajaran]'></td></tr>
                    <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='c'> 
                             <option value='0' selected>- Pilih Jurusan -</option>"; 
                              $jurusan = mysql_query("SELECT * FROM rb_jurusan");
                                  while($a = mysql_fetch_array($jurusan)){
                                    if ($s['kode_jurusan']==$a['kode_jurusan']){
                                       echo "<option value='$a[kode_jurusan]' selected>$a[nama_jurusan]</option>";
                                    }else{
                                       echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
                                    }
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Guru Pengampu</th> <td><select class='form-control' name='d'> 
                             <option value='0' selected>- Pilih Guru Pengampu -</option>"; 
                              $guru = mysql_query("SELECT * FROM rb_guru");
                                  while($a = mysql_fetch_array($guru)){
                                    if ($s['nip']==$a['nip']){
                                       echo "<option value='$a[nip]' selected>$a[nama_guru]</option>";
                                    }else{
                                       echo "<option value='$a[nip]'>$a[nama_guru]</option>";
                                    }
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Tingkat</th>              <td><input type='text' class='form-control' name='h' value='$s[tingkat]'></td></tr>
                    <tr><th scope='row'>Jumlah Jam</th>           <td><input type='text' class='form-control' name='k' value='$s[jumlah_jam]'></td></tr>
                    <tr><th scope='row'>Urutan</th>           <td><input type='text' class='form-control' name='l' value='$s[urutan]'></td></tr>
                    <tr><th scope='row'>Sesi</th>           <td><input type='text' class='form-control' name='n' value='$s[sesi]'></td></tr>
                    <tr><th scope='row'>Kelompok</th> <td><select class='form-control' name='b'> 
                             <option value='0' selected>- Pilih Kelompok Mata Pelajaran -</option>"; 
                              $kelompok = mysql_query("SELECT * FROM rb_kelompok_mata_pelajaran");
                                  while($a = mysql_fetch_array($kelompok)){
                                    if ($s['id_kelompok_mata_pelajaran']==$a['id_kelompok_mata_pelajaran']){
                                       echo "<option value='$a[id_kelompok_mata_pelajaran]' selected>$a[nama_kelompok_mata_pelajaran]</option>";
                                    }else{
                                       echo "<option value='$a[id_kelompok_mata_pelajaran]'>$a[nama_kelompok_mata_pelajaran]</option>";
                                    }
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>";
                                                                  if ($s['aktif']=='Ya'){
                                                                      echo "<input type='radio' name='m' value='Ya' checked> Ya
                                                                             <input type='radio' name='m' value='Tidak'> Tidak";
                                                                  }else{
                                                                      echo "<input type='radio' name='m' value='Ya'> Ya
                                                                             <input type='radio' name='m' value='Tidak' checked> Tidak";
                                                                  }
                  echo "</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='update' class='btn btn-info'>Update</button>
                    <a href='index.php?view=matapelajaran'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET['act']=='tambah'){
    if (isset($_POST['tambah'])){
        mysql_query("INSERT INTO rb_mata_pelajaran VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]',
                                                          '$_POST[h]','$_POST[i]','$_POST[k]','$_POST[n]','$_POST[l]','$_POST[m]')");
        echo "<script>document.location='index.php?view=matapelajaran';</script>";
    }

    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Tambah Data Mata Pelajaran</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kurikulum</th> <td><select class='form-control' name='e'> 
                             <option value='0' selected>- Pilih Kurikulum -</option>"; 
                              $kurikulum = mysql_query("SELECT * FROM rb_kurikulum");
                                  while($a = mysql_fetch_array($kurikulum)){
                                    echo "<option value='$a[kode_kurikulum]'>$a[nama_kurikulum]</option>";
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Kode Pelajaran</th>       <td><input type='text' class='form-control' name='a' value='$s[kode_pelajaran]'> </td></tr>
                    <tr><th scope='row'>Nama Mapel</th>           <td><input type='text' class='form-control' name='f' value='$s[namamatapelajaran]'></td></tr>
                    <tr><th scope='row'>Jurusan</th> <td><select class='form-control' name='c'> 
                             <option value='0' selected>- Pilih Jurusan -</option>"; 
                              $jurusan = mysql_query("SELECT * FROM rb_jurusan");
                                  while($a = mysql_fetch_array($jurusan)){
                                       echo "<option value='$a[kode_jurusan]'>$a[nama_jurusan]</option>";
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Guru Pengampu</th> <td><select class='form-control' name='d'> 
                             <option value='0' selected>- Pilih Guru Pengampu -</option>"; 
                              $guru = mysql_query("SELECT * FROM rb_guru");
                                  while($a = mysql_fetch_array($guru)){
                                       echo "<option value='$a[nip]'>$a[nama_guru]</option>";
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Tingkat</th>              <td><input type='text' class='form-control' name='h' value='$s[tingkat]'></td></tr>
                    <tr><th scope='row'>Jumlah Jam</th>           <td><input type='text' class='form-control' name='k' value='$s[jumlah_jam]'></td></tr>
                    <tr><th scope='row'>Urutan</th>           <td><input type='text' class='form-control' name='l' value='$s[urutan]'></td></tr>
                    <tr><th scope='row'>Sesi</th>           <td><input type='text' class='form-control' name='n'></td></tr>
                    <tr><th scope='row'>Kelompok</th> <td><select class='form-control' name='b'> 
                             <option value='0' selected>- Pilih Kelompok Mata Pelajaran -</option>"; 
                              $kelompok = mysql_query("SELECT * FROM rb_kelompok_mata_pelajaran");
                                  while($a = mysql_fetch_array($kelompok)){
                                       echo "<option value='$a[id_kelompok_mata_pelajaran]'>$a[nama_kelompok_mata_pelajaran]</option>";
                                  }
                             echo "</select>
                    </td></tr>
                    <tr><th scope='row'>Aktif</th>                <td><input type='radio' name='m' value='Ya' checked> Ya
                                                                             <input type='radio' name='m' value='Tidak'> Tidak</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <button type='submit' name='tambah' class='btn btn-info'>Tambahkan</button>
                    <a href='index.php?view=matapelajaran'><button type='button' class='btn btn-default pull-right'>Cancel</button></a>
                    
                  </div>
              </form>
            </div>";
}elseif($_GET['act']=='detail'){
    $edit = mysql_query("SELECT a.*, b.nama_kelompok_mata_pelajaran, c.nama_guru, d.nama_kurikulum, e.nama_jurusan FROM rb_mata_pelajaran a 
                                              JOIN rb_kelompok_mata_pelajaran b ON a.id_kelompok_mata_pelajaran=b.id_kelompok_mata_pelajaran
                                                JOIN rb_guru c ON a.nip=c.nip
                                                  JOIN rb_kurikulum d ON a.kode_kurikulum=d.kode_kurikulum
                                                    JOIN rb_jurusan e ON a.kode_jurusan=e.kode_jurusan
                                                      where a.kode_pelajaran='$_GET[id]'");
    $s = mysql_fetch_array($edit);
    echo "<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Detail Data Mata Pelajaran</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='' enctype='multipart/form-data'>
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>
                    <tr><th width='140px' scope='row'>Kurikulum</th> <td>$s[nama_kurikulum]</td></tr>
                    <tr><th scope='row'>Kode Pelajaran</th>       <td>$s[kode_pelajaran] </td></tr>
                    <tr><th scope='row'>Nama Mapel</th>           <td>$s[namamatapelajaran]</td></tr>
                    <tr><th scope='row'>Jurusan</th>              <td>$s[nama_jurusan]</td></tr>
                    <tr><th scope='row'>Guru Pengampu</th>        <td>$s[nama_guru]</td></tr>
                    <tr><th scope='row'>Tingkat</th>              <td>$s[tingkat]</td></tr>
                    <tr><th scope='row'>Jumlah Jam</th>           <td>$s[jumlah_jam]</td></tr>
                    <tr><th scope='row'>Urutan</th>               <td>$s[urutan]</td></tr>
                    <tr><th scope='row'>Sesi</th>                 <td>$s[sesi]</td></tr>
                    <tr><th scope='row'>Kelompok</th>             <td>$s[nama_kelompok_mata_pelajaran]</td></tr>
                    <tr><th scope='row'>Aktif</th>                <td>$s[aktif]</td></tr>
                  </tbody>
                  </table>
                </div>
              </div>
              <div class='box-footer'>
                    <a href='index.php?view=matapelajaran'><button type='button' class='btn btn-default pull-right'>Kembali</button></a>
                    
                  </div>
              </form>
            </div>";
}
?>