<?php
session_start();

// Cek apakah pengguna belum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Kamu Harus Login Dulu');
            document.location.href = 'login.php';
          </script>";
    exit; // Menghentikan eksekusi script selanjutnya
}

// Batasi akses berdasarkan level
if ($_SESSION["level"] != 1 && $_SESSION["level"] != 2) {
    echo "<script>
            alert('Perhatian Halaman Ini hanya dapat diakses oleh Admin dan Operator Barang.');
            document.location.href = 'crudmodal.php';
          </script>";
    exit; // Menghentikan eksekusi script selanjutnya
}

require 'config/fungsi.php';

// Ambil semua data dari tabel 'barang'
$result = query("SELECT * FROM barang ORDER BY id_barang DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Barang</title>
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
                    <?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Barang</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($_SESSION['level'] == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="pelanggan.php"><i
                                    class="fa-solid fa-person-military-pointing"></i>&nbsp;Pelanggan</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="crudmodal.php"><i class="fa-solid fa-user"></i>&nbsp;Data Akun</a>
                    </li>
                </ul>

                <!-- Tambahkan ms-auto untuk memindahkan elemen berikut ke kanan -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            Hai <?php echo htmlspecialchars($_SESSION['nama'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"
                            onclick="return confirm('Apakah Anda yakin ingin keluar?')">
                            <i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout
                        </a>

                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 pt-5">
        <h2><i class="fa-solid fa-folder-open"></i>&nbsp;Inventory Management Dashboard</h2>
        <blockquote class="blockquote">
            <p>Berisi Daftar Semua Barang</p>
        </blockquote>

        <?php if ($_SESSION['level'] == 1): ?>
            <a href="addbarang.php" class="btn btn-dark mb-1"><i
                    class="fa-solid fa-person-circle-plus"></i>&nbsp;Tambahkan</a>
        <?php endif; ?>
        <hr>

        <div class="table-responsive">
            <table class="table table-striped" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($result as $br): ?>
                        <tr>
                            <td class="text-nowrap"><?php echo htmlspecialchars($no++, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-nowrap"><?php echo htmlspecialchars($br["nama"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-nowrap"><?php echo htmlspecialchars($br["jumlah"], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="text-nowrap">Rp. <?php echo number_format($br["harga"], 0, ',', '.'); ?></td>
                            <td class="text-nowrap"><?php echo date('d/m/y | H:i:s', strtotime($br["tanggal"])); ?></td>
                            <td class="text-nowrap">
                                <?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
                                    <a href="edit.php?id_barang=<?php echo urlencode($br['id_barang']); ?>"
                                        class="btn btn-dark btn-sm mx-1">
                                        <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit
                                    </a>
                                    <?php if ($_SESSION['level'] == 1): ?>
                                        <a href="delete.php?id_barang=<?php echo urlencode($br['id_barang']); ?>"
                                            class="btn btn-warning btn-sm mx-1 text-dark"
                                            onclick="return confirm('Yakin Data Di Hapus?')">
                                            <i class="fa-solid fa-trash-can"></i>&nbsp;Hapus
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script src="js/query.js"></script>
</body>

</html>