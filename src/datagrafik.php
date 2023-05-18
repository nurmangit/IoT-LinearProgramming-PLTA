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

// Buat array untuk menampung data
$data = array();

// Loop melalui setiap jam untuk mengambil semua kolom dengan nilai referensi terbesar
for ($i = 0; $i < 24; $i++) {
    // Buat kueri SQL untuk mengambil nilai terbesar dari kolom referensi dalam jam tertentu
    $sql = "SELECT MAX(Egi) AS max_value, DATE_FORMAT(waktu, '%Y-%m-%d %H:00:00') AS waktu_jam FROM datasensor WHERE HOUR(waktu) = $i GROUP BY DATE_FORMAT(waktu, '%Y-%m-%d %H:00:00')";
    
    // Jalankan kueri SQL
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ambil nilai terbesar dari kolom referensi dalam jam tertentu
        $row = $result->fetch_assoc();
        $max_value = $row['max_value'];
        // Ambil waktu/jam dari kolom waktu_kolom dalam format Y-m-d H:00:00
        $waktu_jam = $row['waktu_jam'];
    
        // Buat kueri SQL untuk mengambil semua kolom dengan nilai referensi terbesar
        $sql = "SELECT * FROM datasensor WHERE Egi = $max_value AND waktu >= '$waktu_jam' AND waktu< DATE_ADD('$waktu_jam', INTERVAL 1 HOUR)";
        
        // Jalankan kueri SQL
        $result2 = $conn->query($sql);

        if ($result2->num_rows > 0) {
            // Buat array untuk menampung data grafik
            $data[$i] = array(
                'jam' => $waktu_jam,
                'nilai' => $max_value
            );
        }
    }
}

// Buat label dan data untuk grafik
$labels = array();
$values = array();
foreach ($data as $item) {
    $labels[] = $item['jam'];
    $values[] = $item['nilai'];
}

// Tampilkan grafik menggunakan Chart.js
echo '<canvas id="grafik" width="800" height="400"></canvas>';
echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
echo '<script>
var ctx = document.getElementById("grafik").getContext("2d");
var chart = new Chart(ctx, {
    type: "line",
    data: {
        labels: ' . json_encode($labels) . ',
        datasets: [{
            label: "Nilai terbesar setiap jam",
            data: ' . json_encode($values) . ',
            fill: false,
            borderColor: "rgb(75, 192, 192)",
            tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>';

?>