<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wifi";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Pastikan nama tabel di query ini sudah benar sesuai di database Anda
$sql = "SELECT * FROM sebaranwifi"; 
$result = $conn->query($sql);

echo "<a href='input/index.html'>Input</a>";

if ($result->num_rows > 0) {
    echo "<table border='1px'><tr>
            <th>Wilayah</th>
            <th>Kecamatan</th>
            <th>Nama</th>
            <th>Jenis</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th colspan='2'>Aksi</th>
        </tr>";
                
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>".$row["wilayah"]."</td>
            <td>".$row["kecamatan"]."</td>
            <td>".$row["nama"]."</td>
            <td>".$row["jenis"]."</td>
            <td>".$row["longitude"]."</td>
            <td>".$row["latitude"]."</td>
            <td>
                <a href='delete.php?id=".$row["id"]."' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">hapus</a> | 
                <a href='edit/index.php?id=".$row["id"]."'>edit</a>
            </td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>