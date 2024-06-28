<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_gradasi";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil kode akses dari form
$access_code = $_POST['access_code'];

// Query untuk memeriksa kode akses
$sql = "SELECT * FROM admin_access WHERE access_code = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $access_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Kode akses valid
    $response = array(
        'status' => 'success',
        'message' => 'Admin access granted!'
    );
} else {
    // Kode akses tidak valid
    $response = array(
        'status' => 'error',
        'message' => 'Invalid access code.'
    );
}

// Tutup koneksi ke database
$stmt->close();
$conn->close();

// Mengirimkan respons JSON ke JavaScript untuk menampilkan SweetAlert
echo json_encode($response);
?>