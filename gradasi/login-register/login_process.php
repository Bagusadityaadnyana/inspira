<?php
session_start();

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
$nim = $_POST['nim'];
$password = $_POST['password'];

// Query untuk mencari user berdasarkan NIM
$sql = "SELECT * FROM users WHERE nim=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $nim);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // User ditemukan, verifikasi password
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password benar, buat session
        $_SESSION['nim'] = $nim;
        echo json_encode(array('success' => true));
    } else {
        // Password salah
        echo json_encode(array('success' => false, 'message' => 'Password salah'));
    }
} else {
    // User tidak ditemukan
    echo json_encode(array('success' => false, 'message' => 'User tidak ditemukan'));
}

$stmt->close();
$conn->close();
?>
