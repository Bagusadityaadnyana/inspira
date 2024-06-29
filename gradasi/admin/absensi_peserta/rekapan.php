<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Absensi UKM GRADASI</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        /* Custom CSS for adjustments */
        body {
            padding: 20px;
        }
        .table-container {
            max-width: 800px;
            margin: auto; /* Centering the table horizontally */
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table-container th, .table-container td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .table-container th {
            background-color: #f2f2f2; /* Header background color */
        }
        .table-container td a {
            color: #fff; /* Maroon color for links */
            text-decoration: none;
            margin-right: 10px;
        }
        .table-container td a:hover {
            text-decoration: underline;
        }
        .back-to-dashboard {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <h2 class="text-center">Daftar Absensi UKM GRADASI</h2>

        <?php
        // Koneksi ke database
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db_name = 'ukm'; // Ganti dengan nama database Anda

        $conn = new mysqli($host, $user, $pass, $db_name);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query untuk mengambil data dari view
        $sql = "SELECT * FROM absensi_view";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Mengelompokkan data berdasarkan nama kegiatan
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[$row['nama_kegiatan']][] = $row;
            }

            // Menampilkan data dalam tabel terpisah berdasarkan nama kegiatan
            foreach ($data as $nama_kegiatan => $rows) {
                echo "<h3 class='text-center'>" . htmlspecialchars($nama_kegiatan) . "</h3>";
                echo "<table class='table'>
                        <thead class='thead-light'>
                            <tr>
                                <th>Nama Lengkap</th>
                                <th>Hadir</th>
                            </tr>
                        </thead>
                        <tbody>";
                foreach ($rows as $row) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['nama_lengkap']) . "</td>";
                    echo "<td>" . ($row['hadir'] ? 'Hadir' : 'Tidak Hadir') . "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
            }
        } else {
            echo "<p class='text-center'>Tidak ada data absensi yang tersedia.</p>";
        }

        $conn->close();
        ?>
    </div>

    <div class="back-to-dashboard">
        <p><a href="../homepage_admin_gradasi.html">Kembali ke Dashboard</a></p>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Font Awesome JS for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <!-- Script untuk SweetAlert -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.delete-btn');
        var editButtons = document.querySelectorAll('.edit-btn');
        
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var nim = this.getAttribute('data-nim');
                var nama = this.getAttribute('data-nama');

                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data pengguna atas nama " + nama + " akan dihapus!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Menggunakan Fetch API untuk menghapus data dari server
                        fetch('delete_users.php?id=' + nim, {
                            method: 'DELETE'
                        })
                        .then(response => {
                            if (response.ok) {
                                return response.text();
                            }
                            throw new Error('Gagal menghapus pengguna');
                        })
                        .then(data => {
                            Swal.fire(
                                'Terhapus!',
                                'Peserta berhasil dihapus.',
                                'success'
                            ).then(() => {
                                // Refresh halaman setelah pengguna berhasil dihapus
                                location.reload();
                            });
                        })
                        .catch(error => {
                            Swal.fire(
                                'Gagal!',
                                error.message,
                                'error'
                            );
                        });
                    }
                });
            });
        });

        editButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah default action dari link
                var url = this.getAttribute('href');
                window.location.href = url; // Arahkan ke halaman edit
            });
        });
    });
    </script>
</body>
</html>
