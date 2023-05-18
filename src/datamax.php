<?php

// Buat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "datanurman";

$conn = mysqli_connect ($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Buat kueri SQL untuk mengambil nilai terbesar dari kolom referensi
$sql = "SELECT MAX(Egi) AS max_value, DATE_FORMAT(waktu, '%Y-%m-%d %H:00:00') AS waktu_jam FROM datasensor GROUP BY DATE_FORMAT(waktu, '%Y-%m-%d %H:00:00')";

// Jalankan kueri SQL
$result = $conn->query($sql);

// Periksa apakah kueri berhasil dijalankan
if ($result) {
    // Loop melalui setiap jam untuk mengambil semua kolom dengan nilai referensi terbesar
    while($row = $result->fetch_assoc()) {
        // Ambil nilai terbesar dari kolom referensi dalam jam tertentu
        $max_value = $row['max_value'];
        // Ambil waktu/jam dari kolom waktu_kolom dalam format Y-m-d H:00:00
        $waktu_jam = $row['waktu_jam'];
    
    // Buat kueri SQL untuk mengambil semua kolom dengan nilai referensi terbesar
    $sql = "SELECT * FROM datasensor WHERE Egi = $max_value AND waktu >= '$waktu_jam' AND waktu< DATE_ADD('$waktu_jam', INTERVAL 1 HOUR)";
    
    // Jalankan kueri SQL
    $result2 = $conn->query($sql);

    if ($result2->num_rows > 0) {
        // Output data dari setiap baris hasil kueri dalam bentuk tabel HTML
        echo "<h2> <strong>Nilai Terbesar untuk Jam $waktu_jam</strong> </h2>";

        echo "<table cellpadding='10' cellspacing='5'>
        <tr><th>Efisensi   </th><th>   Evalasi</th><th>Arus    </th><th>   Egi</th><th>    Jam</th></tr>";
        while($row2 = $result2->fetch_assoc()) {
            echo "<tr><td>" . $row2["efisensi"]. "</td><td>" . $row2["evalasi"]. "</td><td>" . $row2["arus"]. "</td><td>" . $row2["Egi"]. "</td><td>" . $row2["waktu"]. "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>Tidak ada hasil untuk Jam $waktu_jam</h2>";
    }
}
} else {
echo "Kueri gagal: " . $conn->error;
}

// Tutup koneksi database
$conn->close();
?>






