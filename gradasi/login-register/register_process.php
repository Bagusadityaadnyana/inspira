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

// Ambil data dari form
$nama_lengkap = $_POST['nama_lengkap'];
$nim = $_POST['nim'];
$jurusan = $_POST['jurusan'];
$email = $_POST['email'];
$no_telepon = $_POST['no_telepon'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$password = $_POST['password'];
$konfirmasi_password = $_POST['konfirmasi_password'];

// Validasi data (contoh sederhana, sesuaikan dengan kebutuhan)
if ($password != $konfirmasi_password) {
    echo json_encode(array('success' => false, 'message' => 'Konfirmasi password tidak sesuai'));
    exit;
}

// Cek apakah NIM sudah terdaftar
$sql_check_nim = "SELECT * FROM users WHERE nim = ?";
$stmt_check_nim = $conn->prepare($sql_check_nim);
$stmt_check_nim->bind_param('s', $nim);
$stmt_check_nim->execute();
$result_check_nim = $stmt_check_nim->get_result();

if ($result_check_nim->num_rows > 0) {
    echo json_encode(array('success' => false, 'message' => 'Maaf, NIM sudah terdaftar'));
    exit;
}

// Hash password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Query untuk menyimpan data user baru ke database
$sql = "INSERT INTO users (nama_lengkap, nim, jurusan, email, no_telepon, jenis_kelamin, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sssssss', $nama_lengkap, $nim, $jurusan, $email, $no_telepon, $jenis_kelamin, $hashed_password);

if ($stmt->execute()) {
    // Jika registrasi berhasil
    echo json_encode(array('success' => true, 'message' => 'Silahkan login!'));
} else {
    // Jika terjadi kesalahan saat menyimpan data
    echo json_encode(array('success' => false, 'message' => 'Terjadi kesalahan. Silakan coba lagi.'));
}

$stmt->close();
$stmt_check_nim->close();
$conn->close();
?>