<?php
require 'config/fungsi.php';

// Ambil semua data dari tabel 'barang'
// mengambil id_barang dair url

$id_barang = (int)$_GET['id_barang'];
if($id_barang > 0) {
    $barang = query("SELECT * FROM barang WHERE id_barang = '$id_barang'")[0];
}else {
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
    <title>Daftar Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Online Mamuju</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Barang</a>
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
                    <img src="img/WhatsApp Image 2024-02-06 at 16.48.39_6827bc60.jpg" alt="User Photo" class="user-photo">
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <h2>Inventory Management Dashboard</h2>
        <blockquote class="blockquote">
            <p>Pembaruan Data</p>
        </blockquote>

        <a href="index.php" class="btn btn-dark mb-1">Kembali Ke Halaman Utama</a>

        <hr>

        <form action="" method="post" enctype="multipart/form-data">

            <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($barang["nama"]); ?>" placeholder="Nama Barang" required>
                <label for="nama">Nama Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($barang["jumlah"]); ?>" placeholder="Jumlah Barang" required>
                <label for="jumlah">Jumlah Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($barang["harga"]); ?>" placeholder="Harga Barang" required>
                <label for="harga">Harga Barang</label>
            </div>

            <button type="submit" name="ubah" id="kirimButton" class="btn btn-primary mt-3 mb-4 w-25">ubah</button>
        </form>
    </div>


    <!-- contol panel addmin select * from db bgbagian data  -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="js/query.js"></script>
</body>

</html>