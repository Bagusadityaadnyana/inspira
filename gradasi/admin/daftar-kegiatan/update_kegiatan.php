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

// Ambil data dari form
$id = $_POST['id'];
$nama_kegiatan = $_POST['nama_kegiatan'];
$rincian_kegiatan = $_POST['rincian_kegiatan'];

// Query untuk memperbarui data kegiatan berdasarkan id
$sql = "UPDATE kegiatan_ukm_gradasi SET nama_kegiatan='$nama_kegiatan', rincian_kegiatan='$rincian_kegiatan' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Jika update berhasil, kirimkan response JSON ke JavaScript
    $response = array(
        'status' => 'success',
        'message' => 'Perubahan berhasil dilakukan!'
    );
} else {
    // Jika update gagal, kirimkan response JSON ke JavaScript
    $response = array(
        'status' => 'error',
        'message' => 'Error: ' . $conn->error
    );
}

// Tutup koneksi ke database
$conn->close();

// Mengirimkan response JSON ke JavaScript
header('Content-Type: application/json');
echo json_encode($response);
?>