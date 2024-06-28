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

// Memproses data yang dikirim dari form edit pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = $_POST['nim'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    // Query untuk melakukan update data pengguna
    $sql = "UPDATE users SET nama_lengkap='$nama_lengkap', jurusan='$jurusan', email='$email', no_telepon='$no_telepon', jenis_kelamin='$jenis_kelamin' WHERE nim='$nim'";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'success' => true,
            'message' => 'Data pengguna berhasil diperbarui.'
        ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Gagal memperbarui data pengguna: ' . $conn->error
        ];
    }

    // Mengirim respons dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}

$conn->close();
?>