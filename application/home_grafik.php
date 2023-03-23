<script type="text/javascript" src="plugins/jQuery/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#container').highcharts({
            data: {
                table: 'datatable'
            },
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            yAxis: {
                allowDecimals: false,
                title: {
                    text: ''
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>Kunjungan ' + this.series.name + '</b><br/>' +
                        'Ada ' + this.point.y + ' Kali';
                }
            }
        });
    });
</script>

<div class="box box-success">
    <div class="box-header">
    <i class="fa fa-th-list"></i>
    <h3 class="box-title">Grafik Kunjungan Santri, Guru dan Superuser</h3>
        <div class="box-tools pull-right">
           <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
        </div>
        </div>

<div class="box-body chat" id="chat-box">
    <script src="plugins/highchart/highcharts.js"></script>
    <script src="plugins/highchart/modules/data.js"></script>
    <script src="plugins/highchart/modules/exporting.js"></script>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

<table id="datatable" style='display:none'>
    <thead>
        <tr>
            <th></th>
            <th>Santri</th>
            <th>Pengurus</th>
            <th>Superuser</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        $grafik = mysql_query("SELECT * FROM rb_users_aktivitas GROUP BY tanggal ORDER BY tanggal DESC LIMIT 7");
        while ($r = mysql_fetch_array($grafik)){
            $ale = tgl_grafik($r['tanggal']);
            $siswa = mysql_num_rows(mysql_query("SELECT * FROM rb_users_aktivitas where status='siswa' AND tanggal='$r[tanggal]'"));
            $guru = mysql_num_rows(mysql_query("SELECT * FROM rb_users_aktivitas where status='guru' AND tanggal='$r[tanggal]'"));
            $superuser = mysql_num_rows(mysql_query("SELECT * FROM rb_users_aktivitas where status='superuser' AND tanggal='$r[tanggal]'"));
            echo "<tr>
                    <th>$ale</th>
                    <td>$siswa</td>
                    <td>$guru</td>
                    <td>$superuser</td>
                  </tr>";
        }
    ?>
    </tbody>
</table>
</div><!-- /.chat -->
</div><!-- /.box (chat box) -->

