<?php

$servername = "localhost";
$database = "datanurman";
$username = "root";
$password = "";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
$datasen = mysqli_query($conn,"select * from datasensor order by id desc limit 1");
$datamax = mysqli_query($conn,"SELECT MAX(data) as datamax FROM egi WHERE date_time >= DATE_SUB(NOW(), INTERVAL 1 HOUR)";
$s = mysqli_fetch_array($datasen);
$max = mysqli_fetch_array($datamax);
$daya = $s ['Egi'];
$max_egi = $max ['egi_max'];


if ($daya > $max_egi){
    echo "Nilai Max Berubah";
    $simpan = mysqli_query($conn, "insert into datamax(egi_max)values('$daya')");

    
if($simpan)
echo "Berhasil";
else
echo "gagal";

}

else {
    echo "nilai max tidak berubah";
}

var_dump($max_egi);

$jamsekarang = date('H');

echo ($jamsekarang);  
?>