<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
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
            width: 500px;
            padding: 20px;
            background-color: #ffffff; /* Form background color */
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-maroon {
            background-color: #800000; /* Maroon background color for button */
            color: #fff; /* White text color for button */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .btn-maroon:hover {
            background-color: #5a0000; /* Darker maroon color on hover */
        }
        .back-to-login {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Lupa Password?</h2>
        <p class="text-center">Silahkan masukan email anda disini!</p>
        <form id="resetForm" action="send_reset_link.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-maroon btn-block">Kirim Link Reset Password</button>
        </form>

        <p class="back-to-login"><a href="login.php">Kembali ke Login</a></p>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Script untuk SweetAlert -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var resetForm = document.getElementById('resetForm');
        resetForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form untuk submit

            // Kirim data menggunakan fetch API
            var formData = new FormData(resetForm);
            fetch('send_reset_link.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Tanggapan dari server
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Reset Password Behasil!',
                        text: 'Kami akan segera mengirimkan link reset password ke email Anda.',
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = 'login.php'; // Redirect ke halaman login setelah berhasil
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Reset Password Gagal!',
                        text: data.message || 'Terjadi kesalahan. Silakan coba lagi.',
                        confirmButtonText: 'Ok'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Reset Password Gagal!',
                    text: 'Terjadi kesalahan. Silakan coba lagi.',
                    confirmButtonText: 'Ok'
                });
            });
        });
    });
    </script>
</body>
</html>
