<?php
// Konfigurasi koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukm";

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);
// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil id kegiatan dari URL
$id = $_GET['id'];

// Query untuk mengambil data kegiatan berdasarkan id
$sql = "SELECT * FROM kegiatan_ukm_gradasi WHERE id=$id";
$result = $conn->query($sql);

// Jika ada hasil dari query
if ($result->num_rows > 0) {
    // Ambil data kegiatan
    $row = $result->fetch_assoc();
} else {
    echo "Kegiatan tidak ditemukan.";
    exit;
}

// Tutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kegiatan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for adjustments */
        body {
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto; /* Centering the form horizontally */
            margin-top:5%;
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
        <h2 class="text-center">Edit Kegiatan</h2>
        <p class="text-center">Anda bisa mengedit kegiatan yang sudah anda upload disini!</p>
        <form action="update_kegiatan.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="nama_kegiatan">Nama Kegiatan:</label>
                <input type="text" id="nama_kegiatan" name="nama_kegiatan" value="<?php echo $row['nama_kegiatan']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="rincian_kegiatan">Rincian Kegiatan:</label>
                <textarea id="rincian_kegiatan" name="rincian_kegiatan" class="form-control" rows="4" required><?php echo $row['rincian_kegiatan']; ?></textarea>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Simpan Perubahan" class="btn btn-submit">
            </div>
        </form>
        <br>
        <p class="text-center"><a href="kelola_kegiatan.php">Kembali ke Kelola Kegiatan</a></p>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<!-- Script untuk proses update kegiatan -->
<script>
    // Menangkap form submit event
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('form');

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Menghentikan submit form secara default

            var formData = new FormData(form); // Membuat objek FormData dari form

            // Mengirimkan request AJAX
            fetch('update_kegiatan.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Menampilkan SweetAlert berdasarkan status dari response
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: data.message,
                        showConfirmButton: true
                    }).then(function() {
                        window.location.href = 'kelola_kegiatan.php'; // Redirect ke halaman kelola_kegiatan.php
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat melakukan update.'
                });
            });
        });
    });
</script>
</body>
</html>
