<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'ukm'; // Nama database yang baru

$conn = new mysqli($host, $user, $pass, $db_name);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil nilai yang dikirimkan melalui formulir
$nama_kegiatan = $_POST['nama_kegiatan'];
$rincian_kegiatan = $_POST['rincian_kegiatan'];

// Query untuk menyimpan kegiatan ke dalam tabel kegiatan_ukm_gradasi
$sql = "INSERT INTO kegiatan_ukm_gradasi (nama_kegiatan, rincian_kegiatan) VALUES ('$nama_kegiatan', '$rincian_kegiatan')";

if ($conn->query($sql) === TRUE) {
    $response = array(
        'status' => 'success',
        'message' => 'Kegiatan berhasil diupload!'
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Gagal mengupload kegiatan: ' . $conn->error
    );
}

// Tutup koneksi ke database
$conn->close();

// Kembalikan respons ke halaman sebelumnya (form upload)
header('Content-Type: application/json');
echo json_encode($response);
?>
