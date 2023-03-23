<?php 
session_start();
error_reporting(0);
include "../config/koneksi.php"; 
include "../config/fungsi_indotgl.php"; 
$s = mysql_fetch_array(mysql_query("SELECT * FROM rb_siswa where nisn='$_GET[id]'"));
?>
<html>
<head>
<title>Cover Raport Santri</title>
<link rel="stylesheet" href="../bootstrap/css/printer.css">
</head>
<body onload="window.print()">
    <h1 align=center>RAPORT SANTRI <br>PONDOK PESANTREN AL-FIKRI <br></h1>
    <center>
        <img width='170px' src='../dist/img/omahngaji.jpeg'><br><br><br><br><br><br><br><br>
        Nama Santri :<br>
        <h3 style='border:1px solid #000; width:82%; padding:6px'><?php echo $s['nama']; ?></h3><br><br>

        NIS / NISN<br>
        <h3 style='border:1px solid #000; width:82%; padding:3px'><?php echo "$s[nipd] / $s[nisn]"; ?></h3><br><br><br><br><br><br>

        <p style='font-size:22px'>PONDOK PESANTREN AL-FIKRI <br>WONOSOBO - JAWA TENGAH</p>
    </center>
</body>
</html>