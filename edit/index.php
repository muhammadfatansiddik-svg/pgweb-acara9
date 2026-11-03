<!DOCTYPE html>
<html>
<head>
    <title>Form Edit Data Kecamatan</title>
</head>
<body>
    <h2>Form Edit Data</h2>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "wifi"; // Disesuaikan dengan db sebelumnya

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Mengambil ID dari URL dengan aman
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Gunakan prepared statement untuk mengambil data (pastikan nama tabel sesuai)
        $stmt = $conn->prepare("SELECT * FROM sebaranwifi WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<form action='edit.php' onsubmit='return validateForm()' method='post'>";
            
            while($row = $result->fetch_assoc()) {
                echo "<input type='hidden' name='id' value='".$row['id']."'><br>";
                
                echo "<label for='wilayah'>Wilayah: </label><br>";
                echo "<input type='text' id='wilayah' name='wilayah' value='".$row['wilayah']."' required><br>";

                echo "<label for='kecamatan'>Kecamatan: </label><br>";
                echo "<input type='text' id='kec' name='kecamatan' value='".$row['kecamatan']."' required><br>";
                
                echo "<label for='nama'>Nama: </label><br>";
                echo "<input type='text' id='nama' name='nama' value='".$row['nama']."' required><br>";

                echo "<label for='jenis'>Jenis: </label><br>";
                echo "<input type='text' id='jenis' name='jenis' value='".$row['jenis']."' required><br>";

                echo "<label for='longitude'>Longitude: </label><br>";
                echo "<input type='text' id='longitude' name='longitude' value='".$row['longitude']."' required><br>";
                
                echo "<label for='latitude'>Latitude: </label><br>";
                echo "<input type='text' id='latitude' name='latitude' value='".$row['latitude']."' required><br><br>";
                
                echo "<input type='submit' value='Simpan Perubahan'>";
            }
            echo "</form>";
        } else {
            echo "Data tidak ditemukan.";
        }
        $stmt->close();
    }
    $conn->close();
    ?>
    
    <p id="informasi" style="color:red; font-weight:bold;"></p>
    
    <script>
    // Validasi JavaScript disesuaikan untuk longitude dan latitude (karena luas sudah dihapus)
    function validateForm() {
        let lon = document.getElementById("longitude").value;
        let lat = document.getElementById("latitude").value;
        let text = "";
        
        // Memastikan koordinat adalah angka
        if (isNaN(lon) || isNaN(lat)) {
            text = "Data longitude dan latitude harus berupa angka!";
            document.getElementById("informasi").innerHTML = text;
            event.preventDefault(); // Menghentikan form agar tidak terkirim
            return false;
        }
        return true;
    }
    </script>
</body>
</html>