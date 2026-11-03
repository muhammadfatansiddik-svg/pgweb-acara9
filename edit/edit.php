<?php
// Pastikan request menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $id = $_POST['id'];
    $wilayah = $_POST['wilayah'];
    $kecamatan = $_POST['kecamatan'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $longitude = $_POST['longitude']; 
    $latitude = $_POST['latitude'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wifi"; // Disesuaikan dengan database Anda

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Menggunakan Prepared Statement untuk proses UPDATE
    // Pastikan "nama_tabel_anda" diganti dengan nama tabel yang benar di database
    $stmt = $conn->prepare("UPDATE sebaranwifi SET wilayah=?, kecamatan=?, nama=?, jenis=?, longitude=?, latitude=? WHERE id=?");
    
    // Tipe data: "s" (string) untuk wilayah, kecamatan, nama, jenis, longitude, latitude dan "i" (integer) untuk id
    $stmt->bind_param("ssssssi", $wilayah, $kecamatan, $nama, $jenis, $longitude, $latitude, $id);

    if ($stmt->execute()) {
        // Redirect kembali ke halaman utama tabel. 
        // Pastikan path '../tabel.php' sudah sesuai dengan struktur folder Anda
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: Mengedit data gagal - " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>