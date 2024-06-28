<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kegiatan</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa; /* Background color untuk halaman */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin: 10px;
            width: 300px;
            float: left;
            background-color: #ffffff; /* Warna latar belakang card */
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);
            transition: transform 0.3s ease-in-out; /* Efek transisi */
        }
        .card:hover {
            transform: translateY(-5px); /* Efek naik sedikit saat hover */
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        .card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
        }
        .details {
            margin-top: 10px;
        }
        .action-buttons {
            margin-top: 10px;
            text-align: center;
        }
        .action-buttons a {
            text-decoration: none;
            margin-right: 10px;
            color: #800000; /* Maroon color for icon */
            transition: color 0.3s ease-in-out; /* Efek transisi warna */
        }
        .action-buttons a:hover {
            color: #660000; /* Warna lebih gelap saat hover */
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Kelola Kegiatan</h2>
    <p class="text-center">Anda bisa mengedit maupun menghapus kegiatan yang anda upload disini!</p>
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

    // Query untuk mengambil data kegiatan
    $sql = "SELECT * FROM kegiatan_ukm_gradasi";
    $result = $conn->query($sql);

    // Jika ada hasil dari query
    if ($result->num_rows > 0) {
        // Output data setiap kegiatan dalam bentuk card
        while($row = $result->fetch_assoc()) {
            echo '<div class="card">';
            echo '<div class="details">';
            echo '<h3>' . $row['nama_kegiatan'] . '</h3>';
            echo '<p>' . nl2br($row['rincian_kegiatan']) . '</p>'; // Menggunakan nl2br untuk menampilkan newline (\n) dari textarea
            echo '</div>'; // Tutup details

            // Menampilkan tombol edit dan hapus sebagai icon
            echo '<div class="action-buttons">';
            echo '<a href="edit_kegiatan.php?id=' . $row['id'] . '"><i class="fas fa-edit"></i></a>';
            echo '<a href="delete_kegiatan.php?id=' . $row['id'] . '" class="delete-btn"><i class="fas fa-trash-alt"></i></a>';
            echo '</div>'; // Tutup action-buttons

            echo '</div>'; // Tutup card
        }
    } else {
        echo "<p class='text-center'>Tidak ada kegiatan yang ditemukan.</p>";
    }

    // Tutup koneksi ke database
    $conn->close();
    ?>
</div>
<!-- Bootstrap JS and Popper.js (if needed) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Script untuk SweetAlert -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            var url = this.getAttribute('href');
            
            // Tampilkan SweetAlert untuk konfirmasi penghapusan
            Swal.fire({
                title: 'Anda yakin?',
                text: "Kegiatan ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, lakukan penghapusan
                    fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire(
                                'Sukses!',
                                data.message,
                                'success'
                            ).then(() => {
                                // Reload halaman setelah SweetAlert ditutup
                                location.reload();
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
                }
            });
        });
    });
});
</script>
</body>
</html>