<?php
$wilayah   = $_POST['wilayah'];
$kecamatan = $_POST['kecamatan'];
$nama      = $_POST['nama'];
$jenis     = $_POST['jenis'];
$longitude = $_POST['longitude'];
$latitude  = $_POST['latitude'];

// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wifi"; // Database disesuaikan

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// PERHATIKAN: Ganti "nama_tabel_anda" dengan nama tabel di phpMyAdmin Anda
// Menggunakan Prepared Statement agar lebih aman
$stmt = $conn->prepare("INSERT INTO sebaranwifi (wilayah, kecamatan, nama, jenis, longitude, latitude) VALUES (?, ?, ?, ?, ?, ?)");

// "ssssss" menandakan 6 parameter string
$stmt->bind_param("ssssss", $wilayah, $kecamatan, $nama, $jenis, $longitude, $latitude);

if ($stmt->execute()) {
    echo "New record created successfully";
    
    // Hapus tanda komentar (//) pada dua baris di bawah ini 
    // jika ingin otomatis pindah ke tabel.php setelah berhasil input
    
    // header("Location: ../tabel.php");
    // exit();
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>