<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukm";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil ID kegiatan yang akan dihapus dari parameter URL
$id = $_GET['id'];

// Query untuk menghapus kegiatan berdasarkan ID
$sql = "DELETE FROM kegiatan_ukm_gradasi WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'Kegiatan berhasil dihapus!'
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Gagal menghapus kegiatan: ' . $conn->error
    );
}

// Tutup koneksi ke database
$conn->close();

// Kembalikan respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
