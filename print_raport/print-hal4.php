<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
// $frt = mysql_fetch_array(mysql_query("SELECT * FROM rb_header_print ORDER BY id_header_print DESC LIMIT 1")); 
?>
<head>
<title>Hal 3 - Raport Santri</title>
<link rel="stylesheet" href="../bootstrap/css/printer.css">
</head>
<body onload="window.print()">
<?php
$t = mysql_fetch_array(mysql_query("SELECT * FROM rb_tahun_akademik where id_tahun_akademik='$_GET[tahun]'"));
$s = mysql_fetch_array(mysql_query("SELECT a.*, b.*, c.nama_guru as walikelas, c.nip FROM rb_siswa a 
                                      JOIN rb_kelas b ON a.kode_kelas=b.kode_kelas 
                                        LEFT JOIN rb_guru c ON b.nip=c.nip where a.nisn='$_GET[id]'"));
if (substr($_GET['tahun'],4,5)=='1'){ $semester = 'Ganjil'; }else{ $semester = 'Genap'; }
$iden = mysql_fetch_array(mysql_query("SELECT * FROM rb_identitas_sekolah ORDER BY id_identitas_sekolah DESC LIMIT 1"));
echo "<table width=100%>
        <tr><td width=140px>Nama Pondok</td>  <td> : $iden[nama_sekolah] </td>       <td width=140px>Kelas </td>   <td>: $s[kode_kelas]</td></tr>
        <tr><td>Alamat</td>                   <td> : $iden[alamat_sekolah] </td>     <td>Semester </td>            <td>: $semester</td></tr>
        <tr><td>Nama Santri</td>              <td> : <b>$s[nama]</b> </td>           <td>Tahun Pelajaran </td>     <td>: $t[keterangan]</td></tr>
        <tr><td>No Induk/NISN</td>            <td> : $s[nipd] / $s[nisn]</td>        <td></td></tr>
      </table><br>";

echo "<table id='tablemodul1' width=100% border=1>
          <tr>
            <th width='20px' rowspan='2'>NO</th>
            <th width='160px' rowspan='2'>Mata Pelajaran</th>
            <th rowspan='2'>KKM</th>
            <th colspan='2' style='text-align:center'>Pengetahuan</th>
            <th colspan='2' style='text-align:center'>Keterampilan</th>
          </tr>
          <tr>
            <th>Nilai</th>
            <th>Predikat</th>
            <th>Nilai</th>
            <th>Predikat</th>
          </tr>";
      $kelompok = mysql_query("SELECT * FROM rb_kelompok_mata_pelajaran");  
      while ($k = mysql_fetch_array($kelompok)){
      echo "<tr>
            <td colspan='7'><b>$k[nama_kelompok_mata_pelajaran]</b></td>
          </tr>";
        $mapel = mysql_query("SELECT * FROM  rb_jadwal_pelajaran a JOIN rb_mata_pelajaran b ON a.kode_pelajaran=b.kode_pelajaran 
                                  where a.kode_kelas='$_GET[kelas]' AND a.id_tahun_akademik='$_GET[tahun]' AND b.id_kelompok_mata_pelajaran='$k[id_kelompok_mata_pelajaran]'");
        $no = 1;
        while ($m = mysql_fetch_array($mapel)){                                
        $rapn = mysql_fetch_array(mysql_query("SELECT sum((nilai1+nilai2+nilai3)/3)/count(nisn) as raport FROM rb_nilai_pengetahuan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]'"));
        $cekpredikat = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[kelas]'"));
            if ($cekpredikat >= 1){
                $grade3 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='$_GET[kelas]'"));
            }else{
                $grade3 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='0'"));
            }
        $rapnk = mysql_fetch_array(mysql_query("SELECT ((nilai1+nilai3+nilai5)/3) as rata_rata, deskripsi FROM rb_nilai_keterampilan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
        // $rapnk = mysql_fetch_array(mysql_query("SELECT ((nilai1+nilai3+nilai5)/3)/count(nisn) as raport FROM rb_nilai_keterampilan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]'"));
        $cekpredikat2 = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[id]'"));
            if ($cekpredikat2 >= 1){
                $grade1 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
            }else{
                $grade1 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='0'"));
            }

        echo "<tr>
                <td align=center>$no</td>
                <td>$m[namamatapelajaran]</td>
                <td align=center>77</td>
                <td align=center>".number_format($rapn['raport'])."</td>
                <td align=center>$grade3[grade]</td>
                <td align=center>".number_format($rapnk['rata_rata'])."</td>
                <td align=center>$grade1[grade]</td>
            </tr>";
        $no++;
        }
      }

        echo "</table><br/>";
        $cekpredikat1 = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[kelas]'"));
        if ($cekpredikat1 >= 1){
          $grade = mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[kelas]'");
          $gradea = mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[kelas]'");
          $total = mysql_num_rows($grade);
        }else{
          $grade = mysql_query("SELECT * FROM rb_predikat where kode_kelas='0'");
          $gradea = mysql_query("SELECT * FROM rb_predikat where kode_kelas='0'");
          $total = mysql_num_rows($grade);
        }
          echo "<center><table width='90%' border=1 id='tablemodul1'>
              <tr>
                  <th rowspan='2'>KKM</th>
                  <th colspan='$total'>Predikat</th>
              </tr>
              <tr>";
                  while ($g = mysql_fetch_array($grade)){
                      echo "<th>$g[grade] = $g[keterangan]</th>";
                  }
              echo "</tr>
              <tr>
                  <th>77</th>";
                  while ($p = mysql_fetch_array($gradea)){
                      echo "<th>$p[nilai_a] - $p[nilai_b]</th>";
                  }
              echo "</tr>
          </table></center><br>";
?>

<table border=0 width=100%>
  <tr>
    <td width="260" align="left">Orang Tua / Wali</td>
    <td width="520"align="center">Mengetahui <br> Pengasuh Pondok Pesantren Al-Fikri</td>
    <td width="260" align="left">Wonosobo, <?php echo tgl_raport(date("Y-m-d")); ?> <br> Kepala Pondok</td>
  </tr>
  <tr>
    <td align="left"><br /><br /><br /><br /><br />
      ................................... <br /><br /></td>

    <td align="center" valign="top"><br /><br /><br /><br /><br />
      <b>Dr. K. H. Mahfudz Junaedi, M.H</b>
    </td>

    <td align="left" valign="top"><br /><br /><br /><br /><br />
      (Nama Kepala Pondok)
    </td>
  </tr>
</table> 
</body>