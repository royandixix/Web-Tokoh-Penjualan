<?php
require 'config/fungsi.php';

if (!$db) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

function execute($query)
{
    global $db;

    if (mysqli_query($db, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($db);
        return false;
    }
}

$id_pelanggan = isset($_GET['id_pelanggan']) ? (int) $_GET['id_pelanggan'] : 0;
if ($id_pelanggan > 0) {
    $pelanggan = query("SELECT * FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'")[0];
} else {
    echo "ID pelanggan tidak ada yang terdeteksi";
    exit();
}

if (isset($_POST['kirim'])) {
    if (edit_pelanggan($_POST) > 0) {
        echo "<script>
                alert('Data Pelanggan berhasil diubah!');
                document.location.href = 'pelanggan.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Pelanggan gagal diubah!');
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
    <title>Edit Pelanggan</title>
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
</head>
<style>
</style>

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
                        <a class="nav-link" href="crudmodal.php">Data Akun</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 pt-5">
        <h2>Edit Pelanggan</h2>
        <blockquote class="blockquote">
            <p>Edit Data Pelanggan</p>
        </blockquote>

        <a href="pelanggan.php" class="btn btn-dark mb-1">Kembali</a>
        <hr>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_pelanggan"
                value="<?php echo htmlspecialchars($pelanggan['id_pelanggan'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="fotoLama"
                value="<?php echo htmlspecialchars($pelanggan['foto'], ENT_QUOTES, 'UTF-8'); ?>">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama pelanggan" required
                    pattern="[A-Za-z\s]+" title="Masukan Hanya huruf dan spasi"
                    value="<?php echo htmlspecialchars($pelanggan['nama'], ENT_QUOTES, 'UTF-8'); ?>">
                <label for="nama">Nama Pelanggan</label>
            </div>

            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="status" name="status" placeholder="Status" required
                            value="<?php echo htmlspecialchars($pelanggan['status'], ENT_QUOTES, 'UTF-8'); ?>">
                        <label for="status">Status / Pekerjaan</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="Jenis_Kelamin"
                            required>
                            <option value="" disabled selected>Jenis Kelamin Anda</option>
                            <option value="Laki-Laki" <?php echo isset($pelanggan['jenis_kelamin']) && $pelanggan['jenis_kelamin'] == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                            <option value="Perempuan" <?php echo isset($pelanggan['jenis_kelamin']) && $pelanggan['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                        </select>
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                    </div>
                </div>

                <div class="col-md">
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="telepon" name="telepon" placeholder="Telepon"
                            required pattern="\d{10,12}" title="Masukan Nomor Telepon Yang Valid (10-12 digit)"
                            value="<?php echo htmlspecialchars($pelanggan['telepon'], ENT_QUOTES, 'UTF-8'); ?>">
                        <label for="telepon">Nomor Telepon</label>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required
                                value="<?php echo htmlspecialchars($pelanggan['email'], ENT_QUOTES, 'UTF-8'); ?>">
                            <label for="email">Email</label>
                        </div>
                    </div>
                </div>

                <div class="row g-2 mt-2">
                    <div class="col-md">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <input type="file" class="form-control" id="foto" name="foto" placeholder="foto"
                                        onchange="previewImg()">
                                    <label for="foto">Foto</label>
                                    <img src="img/<?= $pelanggan['foto']; ?>" alt="" class="img-thumbnail img-preview"
                                        width="100px">
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" name="kirim"
                                    class="btn btn-primary mb-5 w-50 ml-custom">Kirim</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="js/query.js"></script>
    <script src="js/main.js"></script>
    <script src="js/telepon.js"></script>
    <script src="js/pelanggan.js"></script>
    <script src="js/foto.js"></script>
</body>

</html>