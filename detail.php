<?php

require 'config/fungsi.php';

$id_pelanggan = (int) $_GET['id_pelanggan'];
if ($id_pelanggan > 0) {
    $pelanggan = query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'")[0];
} else {
    echo "id_pelanggan tidak ada yang terdeteksi";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Pelanggan</title>
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
        <h2>Detail Pelanggan</h2>
        <blockquote class="blockquote">

        </blockquote>

        <div class="table-responsive">
            <table id="pelangganTable" class="table table-striped">
                <tbody>
                    <tr>
                        <td>Nama</td>
                        <td><?php echo htmlspecialchars($pelanggan['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo htmlspecialchars($pelanggan['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td>Jenis_kelamin</td>
                        <td><?php echo htmlspecialchars($pelanggan['jenis_kelamin'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td>Telepon</td>
                        <td><?php echo htmlspecialchars($pelanggan['telepon'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo htmlspecialchars($pelanggan['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                    <tr>
                        <td>Foto</td>
                        <td><?php echo htmlspecialchars($pelanggan['foto'], ENT_QUOTES, 'UTF-8'); ?></td>
                    </tr>
                </tbody>
            </table>

            <a href="pelanggan.php" class="btn btn-primary btn-sm mx-1 text-white">Kembali </a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/query.js"></script>
</body>

</html>