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



require 'config/fungsi.php';

// Ambil semua data dari tabel 'barang'
// mengambil id_barang dair url

$id_barang = (int) $_GET['id_barang'];
if ($id_barang > 0) {
    $barang = query("SELECT * FROM barang WHERE id_barang = '$id_barang'")[0];
} else {
    echo "id_barang tidak ada yang terdeteksi";
    exit();
}




// cek apaka tombol edit di tekan
if (isset($_POST['ubah'])) {
    if (edit($_POST) > 0) {
        echo "<script>
                alert('Data berhasil di update !');
                document.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
                alert('Data berhasil di update !');
                document.location.href = 'index.php';
              </script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
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
                    <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 2): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php"><i class="fa-solid fa-cart-shopping"></i>&nbsp;Barang</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="pelanggan.php"><i
                                class="fa-solid fa-person-military-pointing"></i>&nbsp;Pelanggan</a>
                    </li>

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
        <h2>Inventory Management Dashboard</h2>
        <blockquote class="blockquote">
            <p>Pembaruan Data</p>
        </blockquote>

        <a href="index.php" class="btn btn-dark mb-1">Kembali Ke Halaman Utama</a>

        <hr>

        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama"
                    value="<?php echo htmlspecialchars($barang["nama"]); ?>" placeholder="Nama Barang" required>
                <label for="nama">Nama Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="jumlah" name="jumlah"
                    value="<?php echo htmlspecialchars($barang["jumlah"]); ?>" placeholder="Jumlah Barang" required>
                <label for="jumlah">Jumlah Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="harga" name="harga"
                    value="<?php echo htmlspecialchars($barang["harga"]); ?>" placeholder="Harga Barang" required>
                <label for="harga">Harga Barang</label>
            </div>

            <button type="submit" name="ubah" id="kirimButton" class="btn btn-primary mt-3 mb-4 w-25">ubah</button>
        </form>
    </div>


    <!-- contol panel addmin select * from db bgbagian data  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script src="js/query.js"></script>
    <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>
</body>

</html>