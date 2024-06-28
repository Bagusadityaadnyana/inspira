<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran INSPIRA</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Custom CSS untuk penyesuaian */
        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0; /* Warna latar belakang untuk halaman */
        }
        .form-container {
            border-radius: 10px; /* Sudut bulat */
            width: 750px;
            background-color: white;
            padding: 30px; /* Padding di dalam kontainer form */
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1); /* Bayangan lembut */
            margin-top: 50px;
            margin-bottom: 50px; /* Margin tambahan di bagian bawah */
        }
        .btn-maroon {
            background-color: #800000; /* Warna merah maroon */
            color: #fff; /* Teks warna putih */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-maroon:hover {
            background-color: #5a0000; /* Efek hover warna lebih gelap */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Pendaftaran UKM Gradasi</h2>
        <p class="text-center">Silahkan lengkapi data diri dibawah ini untuk membuat akun!</p><br>
        <form id="registrationForm" action="register_process.php" method="post">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap:</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>NIM:</label>
                        <input type="text" class="form-control" name="nim" required>
                    </div>
                    <div class="form-group">
                        <label>Jurusan:</label>
                        <select class="form-control" name="jurusan" required>
                            <option value="TI-MTI">TI-MTI</option>
                            <option value="TI-KAB">TI-KAB</option>
                            <option value="TI-PAR">TI-PAR</option>
                            <option value="RSK">RSK</option>
                            <option value="DKV">DKV</option>
                            <option value="Bisnis Digital">Bisnis Digital</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No Telepon:</label>
                        <input type="text" class="form-control" name="no_telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin:</label>
                        <select class="form-control" name="jenis_kelamin" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Buat Password:</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password:</label>
                        <input type="password" class="form-control" name="konfirmasi_password" required>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-maroon btn-block">Daftar</button>
        </form>

        <p class="mt-3 text-center">Sudah memiliki akun? <a href="login.php">Login disini!</a></p>
    </div>

    <!-- Bootstrap JS dan Popper.js (jika diperlukan) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Script untuk SweetAlert -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('registrationForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk submit

            // Kirim data menggunakan fetch API
            var formData = new FormData(form);
            fetch('register_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Tanggapan dari server
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Pendaftaran Berhasil!',
                        text: data.message,
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = 'login.php'; // Redirect ke halaman login setelah berhasil
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Pendaftaran Gagal!',
                        text: data.message,
                        confirmButtonText: 'Ok'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Pendaftaran Gagal!',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'Ok'
                });
            });
        });
    });
    </script>
</body>
</html>
