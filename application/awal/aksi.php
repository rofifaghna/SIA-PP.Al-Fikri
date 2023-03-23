<?php 
// koneksi database
$koneksi = mysqli_connect("localhost","root","","siaka");	//mengkaitkan database sql dengan variabel koneksi
 
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();	// memastikan apakah berhasil mengkaitkan database
}
 
// menangkap data yang di kirim dari form pada file alumni.php
$email            = $_POST['email'];
$nama_pengirim    = $_POST['nama_pengirim'];
$kritik           = $_POST['kritik'];
$saran            = $_POST['saran'];


if($email=="")
{
  echo "<script>alert('Anda Belum Memasukkan Email Anda');history.go(-1);</script>";
}
if($nama_pengirim=="")
{
  echo "<script>alert('Anda Belum Memasukkan Nama Anda');history.go(-1);</script>";
}

  else
{

// menginput data ke database
$query="INSERT INTO rb_kritik_saran SET email='$email', nama_pengirim='$nama_pengirim', kritik='$kritik', saran='$saran'";
mysqli_query($koneksi, $query);

echo "<script>alert('Data yang anda Input sukses');window.location='kritik_saran.php'</script>";
 
// mengalihkan halaman kembali ke index.php
} 
?>