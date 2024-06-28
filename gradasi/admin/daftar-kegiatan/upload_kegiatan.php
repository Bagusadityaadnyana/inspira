<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Kegiatan</title>
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
            margin-top: 5%;
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
        .form-container form textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .form-container form textarea {
            resize: vertical; /* Allow vertical resizing of textarea */
        }
        .form-container form .btn-submit {
            background-color: #800000; /* Maroon color for submit button */
            color: #ffffff; /* Text color for submit button */
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .form-container form .btn-submit:hover {
            background-color: #660000; /* Darker maroon color on hover */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 class="text-center">Upload Kegiatan UKM</h2>
        <p class="text-center">Silahkan lengkapi form dibawah untuk membuat sebuah kegiatan!</p>

        <form id="uploadForm" action="upload.php" method="post">
            <div class="form-group">
                <label for="nama_kegiatan">Nama Kegiatan:</label>
                <input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rincian_kegiatan">Rincian Kegiatan:</label>
                <textarea id="rincian_kegiatan" name="rincian_kegiatan" class="form-control" rows="4" required></textarea>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Upload" class="btn btn-submit">
            </div>
        </form>
        <br>
        <p class="text-center"><a href="kelola_kegiatan.php">Kelola Kegiatan</a></p>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Script untuk SweetAlert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.getElementById('uploadForm');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form untuk melakukan submit default
                
                // Kirim data form menggunakan Fetch API
                fetch(this.action, {
                    method: 'POST',
                    body: new FormData(this)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        Swal.fire(
                            'Sukses!',
                            data.message,
                            'success'
                        ).then(() => {
                            // Setelah SweetAlert ditutup, reset form
                            form.reset();
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            data.message,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan saat menghubungi server.',
                        'error'
                    );
                });
            });
        });
    </script>
</body>
</html>