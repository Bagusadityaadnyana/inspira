<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'ukm';

$conn = new mysqli($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil id pengguna yang akan dihapus dari parameter GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus pengguna berdasarkan id
    $sql = "DELETE FROM users WHERE nim = '$id'";

    if ($conn->query($sql) === TRUE) {
        // Jika penghapusan berhasil
        $response = [
            'status' => 'success',
            'message' => 'Data pengguna berhasil dihapus.'
        ];
    } else {
        // Jika terjadi kesalahan saat menghapus
        $response = [
            'status' => 'error',
            'message' => 'Gagal menghapus data pengguna: ' . $conn->error
        ];
    }

    // Mengirim respons JSON kembali ke JavaScript
    header('Content-Type: application/json');
    echo json_encode($response);

} else {
    // Jika id tidak ditemukan
    $response = [
        'status' => 'error',
        'message' => 'ID pengguna tidak ditemukan.'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>
