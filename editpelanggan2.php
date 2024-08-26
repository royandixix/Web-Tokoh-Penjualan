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
                document.location.href = 'pelanggan2.php';
              </script>";
    } else {
        echo "<script>
                alert('Data Pelanggan gagal diubah!');
                document.location.href = 'pelanggan2.php';
              </script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/dhasboard.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <!-- Content For Sidebar -->
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Tokoh online Mamuju</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="index2.php" class="sidebar-link"><i class="fa-solid fa-sliders pe-2"></i> Barang</a>
                    </li>
                    <li class="sidebar">
                        <a href="pelanggan2.php" class="sidebar-link"><i class="fa-solid fa-sliders pe-2"></i> Pelanggan</a>
                    </li>
                    <li class="sidebar">
                        <a href="crudmodal2.php" class="sidebar-link"><i class="fa-solid fa-sliders pe-2"></i> Akun</a>
                    </li>
                    <li class="sidebar-header">
                        Multi Level Menu
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-target="#multi" data-bs-toggle="collapse"
                            aria-expanded="false"><i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Dropdown
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-target="#level-1"
                                    data-bs-toggle="collapse" aria-expanded="false">Level 1</a>
                                <ul id="level-1" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Level 1.2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="#" class="dropdown-item">Profile</a>
                                <a href="#" class="dropdown-item">Setting</a>
                                <a href="#" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <li class="nav-item">

                        </li>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <a class="nav-link" href="#">
                                                    Hai <?php echo htmlspecialchars($_SESSION['nama'], ENT_QUOTES, 'UTF-8'); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="image/customer-support.jpg" class="img-fluid illustration-img"
                                                alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0">
                                <div class="card-body py-4">
                                    <div class="d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h4 class="mb-2">
                                                $ 78.00
                                            </h4>
                                            <p class="mb-2">
                                                Total Earnings
                                            </p>
                                            <div class="mb-0">
                                                <span class="badge text-success me-2">
                                                    +9.0%
                                                </span>
                                                <span class="text-muted">
                                                    Since Last Month
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Table Element -->
                    <div class="card border-0">
                        <div class="card-header">
                            <h2>Edit Pelanggan</h2>
                            <blockquote class="blockquote">
                                <!-- <p>Edit Data Pelanggan</p> -->
                            </blockquote>

                            <a href="pelanggan2.php" class="btn btn-dark mb-1">Kembali</a>
                        </div>
                        <div class="card-body">
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

                                    <div class="col-md">
                                        <div class="form-floating">
                                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" rows="3"
                                                required><?php echo htmlspecialchars($pelanggan['alamat'], ENT_QUOTES, 'UTF-8'); ?></textarea>
                                            <label for="alamat">Alamat</label>
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
                    </div>
                </div>
            </main>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                    <strong>Tokoh online Mamuju</strong>
                                </a>
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="" class="text-muted">Contact</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">About Us</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Terms</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="text-muted">Booking</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/dhasboard.js"></script>
</body>

</html>