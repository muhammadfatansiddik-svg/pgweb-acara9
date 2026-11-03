<?php
// 1. Cek apakah ada parameter 'id' di URL terlebih dahulu
if (isset($_GET['id']) && !empty($_GET['id'])) {
    
    $id = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wifi"; // Nama database disesuaikan

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 2. Gunakan Prepared Statement agar aman dan terhindar dari SQL error
    // Pastikan "nama_tabel_anda" diganti dengan nama tabel yang benar di database
    $stmt = $conn->prepare("DELETE FROM sebaranwifi WHERE id = ?");
    $stmt->bind_param("i", $id); 
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        // Redirect kembali ke halaman tabel
        header("Location: index.php");
        exit(); // Wajib memanggil exit setelah header location
    } else {
        echo "Error menghapus data: " . $conn->error;
    }

} else {
    // 3. Menangani kasus jika delete.php dibuka langsung (tanpa ?id=...)
    echo "Peringatan: Tidak ada ID yang dipilih untuk dihapus.";
    echo "<br><br><a href='index.php'>Kembali ke Halaman Utama</a>";
}
?>