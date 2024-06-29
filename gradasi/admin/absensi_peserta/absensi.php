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
        $users = array();
        $kegiatan = array();

        // mengambil dari tabel user
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        // var_dump($users);
        while($row = $result->fetch_assoc()) {
                $users[] = [
                'nama_lengkap' => $row['nama_lengkap'],
                'id' => $row['id']
            ];
        // var_dump($row);
        }

        // mengambil dari tabel kegiatan
        $sql = "SELECT * FROM kegiatan_ukm_gradasi";
        $result = $conn->query($sql);
        // var_dump($users);
        while($row = $result->fetch_assoc()) {
                $kegiatan[] = [
                'nama_kegiatan' => $row['nama_kegiatan'],
                'id' => $row['id']
            ];
        // var_dump($row);
        }


        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $user_id=$_POST['user_id'];
            $kegiatan_id=$_POST['kegiatan_id'];
            $hadir=$_POST['hadir'];

            $sql="insert into absensi (user_id,kegiatan_id, hadir) values ('$user_id','$kegiatan_id','$hadir')";
            
            $hasil=mysqli_query($conn,$sql);

            // var_dump($_POST);
            // var_dump($sql);
        }


        // Tutup koneksi ke database
        $conn->close();
        ?>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group">
                <label for="user_id">User:</label>
                <select name="user_id" id="user_id">
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['id']; ?>"><?php echo $user['nama_lengkap']; ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>
            <div class="form-group">
                <label for="kegiatan_id">Pilih Kegiatan:</label>
                <select name="kegiatan_id" id="kegiatan_id">
                    <?php foreach ($kegiatan as $pertemuan): ?>
                        <option value="<?php echo $pertemuan['id']; ?>"><?php echo $pertemuan['nama_kegiatan']; ?></option>
                    <?php endforeach; ?>    
                </select>
            </div>
            <div class="form-group">
                  <label for="absensi">Kehadiran</label>
                  <p>
                      <input type="radio" id="hadir" name="hadir" value="1">
                      <label for="html">Hadir</label><br>
                      <input type="radio" id="hadir" name="hadir" value="0">
                      <label for="css">Tidak Hadir</label><br>
                  </p>
            </div>      
            <div class="form-group text-center">
                <input type="submit" value="Absen" class="btn btn-submit">
            </div>
        </form>
        <br>
        <p class="text-center"><a href="../homepage_admin_gradasi.html">Kembali</a></p>
        <p class="text-center"><a href="rekapan.php">Lihat Rekapan</a></p>
    </div>

    <!-- Bootstrap JS and Popper.js (if needed) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>