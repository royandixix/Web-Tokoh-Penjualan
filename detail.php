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
    <link rel="stylesheet" href="css/main.css">
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
                        <a class="nav-link" href="index.php"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pelanggan.php"><i
                                class="fa-solid fa-person-military-pointing"></i>&nbspPelanggan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="crudmodal.php"><i class="fa-solid fa-user"></i>&nbspData Akun</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 pt-5">
        <h2>Detail Pelanggan</h2>
        <blockquote class="blockquote">

        </blockquote>

        <div class="table-responsive">
            <table id="pelangganTable" class="table">
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
                        <td><img src="img/<?php echo htmlspecialchars($pelanggan['foto'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="Foto Pelanggan" class="img-fuid" width="150"></td>
                    </tr>
                </tbody>
            </table>

            <a href="pelanggan.php" class="btn btn-primary btn-sm mx-1 text-white p-2 mt-4 ">Kembali </a>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/query.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
</body>

</html>