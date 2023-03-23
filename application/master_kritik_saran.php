<?php if ($_GET['act']==''){ ?> 
            <div class="col-xs-12">  
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Data Informasi Kritik dan Saran </h3>
                  <?php if($_SESSION['level']!='kepala'){ ?>
                  <?php } ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th style='width:40px'>No</th>
                        <th>Email</th>
                        <th>Nama</th>
                        <th>Kritik</th>
                        <th>Saran</th>
                        <?php if($_SESSION['level']!='kepala'){ ?>
                        <th style='width:70px'>Action</th>
                        <?php } ?>
                      </tr>
                    </thead>
                    <tbody>
                  <?php 
                    $tampil = mysql_query("SELECT * FROM rb_kritik_saran ORDER BY kode_kritik_saran DESC");
                    $no = 1;
                    while($r=mysql_fetch_array($tampil)){
                    echo "<tr><td>$no</td>
                              <td>$r[email]</td>
                              <td>$r[nama_pengirim]</td>
                              <td>$r[kritik]</td>
                              <td>$r[saran]</td>";
                              if($_SESSION['level']!='kepala'){
                        echo "<td><center>
                                <a class='btn btn-danger btn-xs' title='Delete Data' href='index.php?view=kritik_saran&hapus=$r[kode_kritik_saran]' onclick=\"return confirm('Apa anda yakin untuk hapus Data ini?')\"><span class='glyphicon glyphicon-remove'></span></a>
                              </center></td>";
                              }
                            echo "</tr>";
                      $no++;
                      }
                      if (isset($_GET['hapus'])){
                          mysql_query("DELETE FROM rb_kritik_saran where kode_kritik_saran='$_GET[hapus]'");
                          echo "<script>document.location='index.php?view=kritik_saran';</script>";
                      }

                  ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <?php 
            }
        ?>