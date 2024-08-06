<?php
require 'config/fungsi.php';



if (!$db) {
    die("Koneksi ke database gagal: 
    " . mysqli_connect_error());
}

$jenis_kelamin = $_POST['jenis_kelamin'];

if ($jenis_kelamin == '1') {
    $jenis_kelamin = 'Laki-Laki';
} elseif ($jenis_kelamin == '2') {
    $jenis_kelamin = 'Perempuan';
}


if (isset($_POST['kirim'])) {

    if (addPelanggan($_POST) > 0) {
        echo "<script>
                alert('Data Pelanggan berhasil ditambahkan!');
                document.location.href = 'pelanggan.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Pelanggan gagal ditambahkan!');
                document.location.href = 'pelanggan.php';
              </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Online Mamuju</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pelanggan.php">Pelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Modal</a>
                    </li>
                </ul>
                <div class="user-info">
                    <!-- Foto pengguna -->
                    <img src="img/WhatsApp Image 2024-02-06 at 16.48.39_6827bc60.jpg" alt="User Photo"
                        class="user-photo">
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-4 pt-5">
        <h2>Inventory Management Dashboard</h2>
        <blockquote class="blockquote">
            <p>Tambah Pelanggan</p>
        </blockquote>

        <a href="pelanggan.php" class="btn btn-dark mb-1">Kembali</a>

        <hr>

        <form action="addpelanggan.php" method="post" enctype=" multipart/form-data ">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pelanggan" required>
                <label for="nama">Nama Pelanggan</label>
            </div>

            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="status" name="status" placeholder="status" required>
                        <label for="status">Status / Pekerjaan</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="Jenis_Kelamin"
                            required>
                            <option value="" selected disabled>Jenis Kelamin Anda</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>

                        <label for="jenis_kelamin">Jenis Kelamin</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="telepon"
                            required>
                        <label for="telepon">Nomor Telepon</label>
                    </div>
                </div>
            </div>

            <div class="row g-2 mt-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="email" required>
                        <label for="email">Email</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="file" class="form-control" id="foto" name="foto" placeholder="foto" required>
                        <label for="foto">Foto</label>
                    </div>
                </div>
            </div>

            <button type="submit" name="kirim" id="kirimButton" class="btn btn-primary mt-3 mb-4 w-25">Kirim</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="js/query.js"></script>
</body>

</html>