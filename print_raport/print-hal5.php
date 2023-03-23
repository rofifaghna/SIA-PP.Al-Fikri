<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
// $frt = mysql_fetch_array(mysql_query("SELECT * FROM rb_header_print ORDER BY id_header_print DESC LIMIT 1")); 
// $frt = mysql_fetch_array(mysql_query("SELECT * FROM rb_nilai_sikap_semester where id_tahun_akademik='$_GET[tahun]' AND nisn='$_GET[id]' AND kode_kelas='$_GET[kelas]'"));
?>
<head>
<title>Hal 4 - Raport Santri</title>
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

echo "DESKRIPSI PENGETAHUAN
<table id='tablemodul1' width=100% style='margin-top:2px' border=1>
          <tr>
            <th width='20px' rowspan='2'>NO</th>
            <th width='100px' rowspan='2'>Mata Pelajaran</th>
            <th width='100px' rowspan='2'>Aspek</th>
            <th colspan='4'              >Nilai</th>    
            <th width='25px'  rowspan='2'>Grade</th>
            <th width='180px' rowspan='2'>Deskripsi</th>
          </tr>
          <tr>
          <th width='25px'><center>TU</center></th>
          <th width='25px'><center>UTS</center></th>
          <th width='25px'><center>UAS</center></th>
          <th width='25px'>Rata-Rata</th>
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
        $maxn = mysql_fetch_array(mysql_query("SELECT sum((nilai1+nilai2+nilai3)/3) as rata_rata, deskripsi FROM rb_nilai_pengetahuan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
        $n1 = mysql_fetch_array(mysql_query("SELECT * FROM rb_nilai_pengetahuan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]'ORDER BY nisn DESC LIMIT 1"));

        // $maxn = mysql_fetch_array(mysql_query("SELECT ((nilai1+nilai2+nilai3+nilai4+nilai5)/5) as rata_rata, deskripsi FROM rb_nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
        $cekpredikat1 = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[id]'"));
        if ($cekpredikat1 >= 1){
          $grade2 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($maxn['rata_rata'])." >=nilai_a) AND (".number_format($maxn['rata_rata'])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
        }else{
          $grade2 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($maxn['rata_rata'])." >=nilai_a) AND (".number_format($maxn['rata_rata'])." <= nilai_b) AND kode_kelas='0'"));
        }
        
        $rapn = mysql_fetch_array(mysql_query("SELECT sum((nilai1+nilai2+nilai3)/3)/count(nisn) as raport FROM rb_nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]'"));
        $cekpredikat2 = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[id]'"));
        if ($cekpredikat2 >= 1){
          $grade3 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
        }else{
          $grade3 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='0'"));
        }

        echo "<tr>
                <td width='30px' align=center>$no</td>
                <td width='160px'>$m[namamatapelajaran]</td>
                <td>Pengetahuan</td>
                <td align=center>$n1[nilai1] </td>
                <td align=center>$n1[nilai2]</td>
                <td align=center>$n1[nilai3]</td>
                <td align=center>".number_format($maxn['rata_rata'])."</td>
                <td align=center>$grade2[grade]
                <td>$maxn[deskripsi]</td>
              </tr>";
        $no++;
        }
      }      
        echo "</table><br/>";



        echo "DESKRIPSI KETERAMPILAN
        <table id='tablemodul1' width=100% style='margin-top:2px' border=1>
                  <tr>
                    <th width='20px' rowspan='2'>NO</th>
                    <th width='100px' rowspan='2'>Mata Pelajaran</th>
                    <th width='100px' rowspan='2'>Aspek</th>
                    <th colspan='4'              >Nilai</th>    
                    <th width='25px'  rowspan='2'>Grade</th>
                    <th width='180px' rowspan='2'>Deskripsi</th>
                  </tr>
                  <tr>
                  <th width='25px'><center>TU</center></th>
                  <th width='25px'><center>UTS</center></th>
                  <th width='25px'><center>UAS</center></th>
                  <th width='25px'>Rata-Rata</th>
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
                $maxnka = mysql_fetch_array(mysql_query("SELECT ((nilai1+nilai3+nilai5)/3) as rata_rata, deskripsi FROM rb_nilai_keterampilan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
                $n2 = mysql_fetch_array(mysql_query("SELECT * FROM rb_nilai_keterampilan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]'ORDER BY nisn DESC LIMIT 1"));
                // $maxnk = mysql_fetch_array(mysql_query("SELECT deskripsi, GREATEST(nilai1,nilai2,nilai3,nilai4,nilai5,nilai6) as tertinggi FROM rb_nilai_keterampilan where kodejdwl='$m[kodejdwl]' AND nisn='$s[nisn]' ORDER BY tertinggi DESC LIMIT 1"));
        
                // $maxn = mysql_fetch_array(mysql_query("SELECT ((nilai1+nilai2+nilai3+nilai4+nilai5)/5) as rata_rata, deskripsi FROM rb_nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]' ORDER BY rata_rata DESC LIMIT 1"));
                $cekpredikat1 = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[id]'"));
                if ($cekpredikat1 >= 1){
                  $grade2 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($maxn['rata_rata'])." >=nilai_a) AND (".number_format($maxn['rata_rata'])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
                }else{
                  $grade2 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($maxn['rata_rata'])." >=nilai_a) AND (".number_format($maxn['rata_rata'])." <= nilai_b) AND kode_kelas='0'"));
                }
                
                $rapn = mysql_fetch_array(mysql_query("SELECT sum((nilai1+nilai2+nilai3)/3)/count(nisn) as raport FROM rb_nilai_pengetahuan where kodejdwl='$_GET[jdwl]' AND nisn='$r[nisn]'"));
                $cekpredikat2 = mysql_num_rows(mysql_query("SELECT * FROM rb_predikat where kode_kelas='$_GET[id]'"));
                if ($cekpredikat2 >= 1){
                  $grade3 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='$_GET[id]'"));
                }else{
                  $grade3 = mysql_fetch_array(mysql_query("SELECT * FROM `rb_predikat` where (".number_format($rapn['raport'])." >=nilai_a) AND (".number_format($rapn['raport'])." <= nilai_b) AND kode_kelas='0'"));
                }
        
                echo "<tr>
                        <td width='30px' align=center>$no</td>
                        <td width='160px'>$m[namamatapelajaran]</td>
                        <td>Keterampilan</td>
                        <td align=center>$n2[nilai1] </td>
                        <td align=center>$n2[nilai3]</td>
                        <td align=center>$n2[nilai5]</td>
                        <td align=center>".number_format($maxnka['rata_rata'])."</td>
                        <td align=center>$grade2[grade]
                        <td>$maxnka[deskripsi]</td>
                      </tr>";
                $no++;
                }
              }      
                echo "</table><br/>";        

?>
</body>