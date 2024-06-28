<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GRADASI (Graphic Design & Multimedia INSTIKI)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Navbar */
        .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            margin-right: 10px;
        }

        /* Carousel */
        .carousel-inner img {
            height: 60vh;
            object-fit: cover;
        }

        .carousel-caption h1 {
            font-size: 3em;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        .carousel-caption p {
            font-size: 1.2em;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
            color: #fff;
        }

        /* UKM Section */
        h2 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #555;
            text-align: center;
        }

        p {
            font-size: 1.1em;
            margin-bottom: 40px;
            color: #555;
            text-align: center;
        }

        /* Card Grid */
        .container .row {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 15px;
            padding: 0 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .card {
            width: 300px; /* Atur lebar maksimum kartu di sini */
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .details {
            padding: 20px;
            text-align: center;
        }

        .details h3 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #555;
        }

        .details p {
            font-size: 1em;
            color: #666;
            margin-bottom: 15px;
            text-align: left;
        }

        .btn-admin {
            background-color: #007bff;
            color: white;
            margin-right: 10px;
            border: none;
        }

        .btn-admin:hover {
            background-color: #0069d9;
            color: white;
        }

        .btn-logout {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-logout:hover {
            background-color: #c82333;
            color: white;
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        footer p {
            color: #fff;
            margin: 0;
            font-size: 1em;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.2s ease-in-out;
        }

        footer a:hover {
            color: #800000;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="img/instiki_logo.png" alt="instiki_;" height="65" class="d-inline-block align-text-top me-2">
        </a>
        <div class="d-flex">
            <button class="btn btn-admin" id="adminButton">Admin</button>
            <button class="btn btn-logout" id="logoutButton">Logout</button>
        </div>
    </div>
</nav>

<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="10000">
            <img src="img/carousel1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>GRADASI<br>(Graphic Design & Multimedia INSTIKI)</h1>
            </div>
        </div>
        <div class="carousel-item" data-bs-interval="2000">
            <img src="img/carousel2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Ciptakan Seni!</h1>
                <p>Kehidupan adalah seni yang indah!</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/carousel3.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h1>Berkarya!</h1>
                <p>Tuangkan semua imajinasimu, dalam bentuk karya disini!</p>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container my-4">
    <h2 class="text-center">Tentang GRADASI</h2>
    <p class="text-center">GRADASI (Graphic Design & Multimedia INSTIKI) adalah komunitas mahasiswa yang berfokus pada pengembangan kreativitas di bidang desain grafis dan multimedia. Kami menyediakan platform untuk belajar, berkarya, dan berkolaborasi dalam berbagai proyek kreatif.</p>
</div>

<div class="container">
    <h2 class="text-center">Pengumuman</h2>
    <div class="row">
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
                echo '<div class="col-md-4">';
                echo '<div class="card">';
                echo '<div class="details">';
                echo '<h3>' . $row['nama_kegiatan'] . '</h3>';
                echo '<p>' . nl2br($row['rincian_kegiatan']) . '</p>'; // Menggunakan nl2br untuk menampilkan newline (\n) dari textarea
                echo '</div>'; // Tutup details
                echo '</div>'; // Tutup card
                echo '</div>'; // Tutup col-md-4
            }
        } else {
            echo "";
        }

        // Tutup koneksi ke database
        $conn->close();
        ?>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3">
    <div class="container">
        <p>&copy; 2024 GRADASI (Graphic Design & Multimedia INSTIKI). All rights reserved.</p>
        <p>Follow us on:
            <a href="#" class="text-white">Facebook</a> |
            <a href="#" class="text-white">Twitter</a> |
            <a href="#" class="text-white">Instagram</a>
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
    document.getElementById('adminButton').addEventListener('click', function() {
        Swal.fire({
            title: 'Masukkan Kode Akses',
            input: 'password',
            inputLabel: 'kode akses diperlukan untuk mengakses dashboard admin',
            inputPlaceholder: 'Masukkan kode akses',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Anda perlu memasukkan kode akses!'
                } else if (value === 'GRADASIINSTIKI') {
                    Swal.fire(
                        'Akses Diterima',
                        'Anda akan dialihkan ke halaman dashboard admin.',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'admin/homepage_admin_gradasi.html';
                        }
                    })
                } else {
                    Swal.fire(
                        'Akses Ditolak',
                        'Kode akses yang Anda masukkan salah.',
                        'error'
                    )
                }
            }
        })
    });

    document.getElementById('logoutButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Anda akan logout dari halaman ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'login-register/login.php';
                } 
            });
        });

        document.addEventListener('DOMContentLoaded', (event) => {
            const urlParams = new URLSearchParams(window.location.search);
            const logout = urlParams.get('logout');

            if (logout === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: 'Logged Out',
                    text: 'You have successfully logged out.',
                    confirmButtonText: 'OK'
                });
            } else if (logout === 'fail') {
                Swal.fire({
                    icon: 'error',
                    title: 'Logout Failed',
                    text: 'There was an issue logging out. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        });
</script>
</body>
</html>