<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Custom CSS for adjustments */
        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0; /* Background color for the page */
        }
        .form-container {
            border-radius: 10px; /* Rounded corners */
            width: 550px;
            background-color: white;
            padding: 30px; /* Padding inside the form container */
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1); /* Soft shadow */
            margin-top: 50px;
            margin-bottom: 50px; /* Added margin at the bottom */
        }

        .form-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 20px; /* Spacing below the logo */
            border: 3px solid #000;
            display: block; /* Ensures the image is centered properly */
            margin: 0 auto 20px; /* Centers the image horizontally and adds margin below */
        }
        .form-group {
            margin-bottom: 20px; /* Adds space between form groups */
        }
        .form-group label {
            text-align: left; /* Aligns the label text to the left */
            display: block; /* Ensures labels are on a new line */
            margin-bottom: 7px; /* Adds space below labels */
        }
        .form-group .form-control {
            width: 100%; /* Makes sure input fields take up full width */
        }
        .btn-maroon {
            background-color: #800000; /* Maroon background color for button */
            color: #fff; /* White text color for button */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            width: 100%;
            margin-top: 10px; /* Spacing above the button */
        }
        .btn-maroon:hover {
            background-color: #5a0000; /* Darker maroon color on hover */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <img src="img/logo-gradasi.jpg" alt="logo">
        <h2 class="text-center">Login</h2>
        <form id="loginForm" action="login_process.php" method="post">
            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-maroon">Login</button>
        </form>
        <p class="text-center mt-3">Belum punya akun? <a class="text-center" href="register.php" class="register-link">Daftar disini sekarang!</a></p>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- SweetAlert -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('loginForm');
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting
            
            // Ambil data dari form
            var nim = document.getElementById('nim').value;
            var password = document.getElementById('password').value;
            
            // Kirim data menggunakan AJAX atau biarkan form submit secara normal
            var formData = new FormData();
            formData.append('nim', nim);
            formData.append('password', password);
            
            // Kirim form data menggunakan AJAX
            fetch('login_process.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Tanggapan dari server
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil!',
                        text: 'Selamat Datang!',
                        showConfirmButton: true // Menampilkan tombol OK

                    }).then(function() {
                        window.location.href = '../homepage_gradasi.php'; // Ganti dengan halaman setelah login berhasil
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Gagal!',
                        text: data.message || 'Terjadi kesalahan. Silakan coba lagi.',
                        confirmButtonText: 'Ok'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal!',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'Ok'
                });
            });
        });
    });
    </script>
</body>
</html>
