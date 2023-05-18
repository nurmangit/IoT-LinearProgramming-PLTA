<?php 
$conn = mysqli_connect($servername, $username, $password, $database);

//data nodemcu
$nilai_h = $_GET["h"];
$nilai_n = $_GET["n"];
$nilai_q = $_GET["q"];
$nilai_egi = $_GET["egi"];



mysqli_query($conn, "ALTER TABLE datasensor AUTO_INCREMENT=1");

//
$simpan = mysqli_query($conn, "insert into datasensor(evalasi,efisensi,arus,egi)values('$nilai_h','$nilai_n','$nilai_q,'$nilai_egi')")

//uji

if($simpan)
    echo "Berhasil"
else
    echo "gagal"
?>