<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Custom CSS for adjustments */
        body {
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto; /* Centering the form horizontally */
        }
        .form-container form {
            background-color: #ffffff; /* Form background color */
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin-top: 20px;
        }
        .form-container form label {
            font-weight: bold;
        }
        .form-container form input[type="text"],
        .form-container form input[type="email"],
        .form-container form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .form-container form input[type="submit"] {
            background-color: #800000; /* Maroon color for submit button */
            color: #ffffff; /* Text color for submit button */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-container form input[type="submit"]:hover {
            background-color: #660000; /* Darker maroon color on hover */
        }
        .center-btn {
            text-align: center; /* Centering the button horizontally */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Edit Informasi Peserta UKM GRADASI</h2>

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

        // Proses pengambilan data pengguna berdasarkan NIM
        if (isset($_GET['id'])) {
            $nim = $_GET['id'];

            // Query untuk mengambil data pengguna berdasarkan NIM
            $sql = "SELECT * FROM users WHERE nim = '$nim'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $nama_lengkap = $row['nama_lengkap'];
                $jurusan = $row['jurusan'];
                $email = $row['email'];
                $no_telepon = $row['no_telepon'];
                $jenis_kelamin = $row['jenis_kelamin'];
                // Anda bisa menambahkan lebih banyak field sesuai kebutuhan

                // Form untuk mengedit informasi pengguna
                echo "<form id='editForm' action='update_users.php' method='post'>
                        <input type='hidden' name='nim' value='$nim'>
                        <label>Nama Lengkap:</label><br>
                        <input type='text' name='nama_lengkap' value='$nama_lengkap' required><br><br>

                        <label>Jurusan:</label><br>
                        <select name='jurusan' required>
                            <option value='TI-MTI' ".($jurusan == 'TI-MTI' ? 'selected' : '').">TI-MTI</option>
                            <option value='TI-KAB' ".($jurusan == 'TI-KAB' ? 'selected' : '').">TI-KAB</option>
                            <option value='TI-PAR' ".($jurusan == 'TI-PAR' ? 'selected' : '').">TI-PAR</option>
                            <option value='RSK' ".($jurusan == 'RSK' ? 'selected' : '').">RSK</option>
                            <option value='DKV' ".($jurusan == 'DKV' ? 'selected' : '').">DKV</option>
                            <option value='Bisnis Digital' ".($jurusan == 'Bisnis Digital' ? 'selected' : '').">Bisnis Digital</option>
                        </select><br><br>

                        <label>Email:</label><br>
                        <input type='email' name='email' value='$email' required><br><br>

                        <label>No Telepon:</label><br>
                        <input type='text' name='no_telepon' value='$no_telepon' required><br><br>

                        <label>Jenis Kelamin:</label><br>
                        <select name='jenis_kelamin' required>
                            <option value='Laki-laki' ".($jenis_kelamin == 'Laki-laki' ? 'selected' : '').">Laki-laki</option>
                            <option value='Perempuan' ".($jenis_kelamin == 'Perempuan' ? 'selected' : '').">Perempuan</option>
                        </select><br><br>

                        <div class='center-btn'>
                            <input type='submit' value='Simpan Perubahan' class='btn btn-primary'>
                        </div>
                    </form>";
            } else {
                echo "<p class='text-center'>Pengguna dengan NIM $nim tidak ditemukan.</p>";
            }
        } else {
            echo "<p class='text-center'>NIM tidak diberikan untuk pengeditan.</p>";
        }

        $conn->close();
        ?>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Script untuk SweetAlert -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var editForm = document.getElementById('editForm');
        editForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk submit

            // Kirim data menggunakan fetch API
            var formData = new FormData(editForm);
            fetch('update_users.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Tanggapan dari server
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: 'Data pengguna berhasil diperbarui.',
                        showConfirmButton: true
                    })
                    .then(() => {
                        // Redirect atau refresh halaman setelah alert ditutup
                        window.location.href="list_users.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Gagal memperbarui data pengguna.',
                        showConfirmButton: true
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat memproses permintaan.',
                    showConfirmButton: true
                });
            });
        });
    });
    </script>
</body>
</html>