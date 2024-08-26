<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    echo "<script>
                            alert('Kamu harus login dulu');
                            document.location.href = 'login.php';
                        </script>";
    exit;
}

// Cek apakah pengguna memiliki level 1, 2, atau 3
if ($_SESSION['level'] < 1 || $_SESSION['level'] > 3) {
    echo "<script>
                            alert('Akses ditolak! Halaman ini hanya dapat diakses oleh pengguna yang memiliki hak akses.');
                            document.location.href = 'index2.php';
                        </script>";
    exit;
}

require 'config/fungsi.php';

$data_akun = query("SELECT * FROM akun");

// Jika tombol 'simpan' ditekan
if (isset($_POST['simpan'])) {
    if (add_modal($_POST) > 0) {
        echo "<script>
                                alert('Data akun berhasil ditambahkan!');
                                document.location.href = 'crudmodal2.php';
                            </script>";
    } else {
        echo "<script>
                                alert('Data akun gagal ditambahkan!');
                                document.location.href = 'crudmodal2.php';
                            </script>";
    }
}

// Menampilkan data user berdasarkan login
$id_akun = $_SESSION['id_akun'];
$data_bylogin = query("SELECT * FROM akun WHERE id_akun = '$id_akun'");

// Jika tombol 'edit' ditekan
if (isset($_POST['edit'])) {
    var_dump($_POST); // Debugging
    if (edit_modal($_POST) > 0) {
        echo "<script>
                alert('Data akun berhasil diedit!');
                document.location.href = 'crudmodal2.php';
              </script>";
    } else {
        echo "<script>
                alert('Data akun gagal diedit!');
                document.location.href = 'crudmodal2.php';
              </script>";
    }
}

// Jika tombol 'hapus' ditekan
if (isset($_POST['hapus'])) {
    $id_akun = $_POST['id_akun'];

    if (delet_akun($id_akun) > 0) {
        echo "<script>
                        alert('Data akun berhasil dihapus!');
                        document.location.href = 'crudmodal2.php';
                    </script>";
    } else {
        echo "<script>
                        alert('Data akun gagal dihapus!');
                        document.location.href = 'crudmodal2.php';
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
                            <h2><i class="fa-solid fa-folder-open"></i>&nbsp;Inventory Management Dashboard</h2>
                            <blockquote class="blockquote">
                                <p>Data Akun</p>
                            </blockquote>
                            <?php if ($_SESSION['level'] == 1): ?>
                                <button type="button" class="btn btn-dark mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                                        class="fa-solid fa-person-circle-plus"></i>&nbsp;Tambahkan</button>

                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="example">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($data_akun as $akun): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($no++); ?></td>
                                            <td><?php echo htmlspecialchars($akun['nama']); ?></td>
                                            <td><?php echo htmlspecialchars($akun['username']); ?></td>
                                            <td><?php echo htmlspecialchars($akun['email']); ?></td>
                                            <td>Password Ter-enskripsi</td>
                                            <td class="text-center">
                                                <?php if ($_SESSION['level'] == 1): ?>
                                                    <!-- Tombol Edit dan Hapus untuk Admin -->
                                                    <button type="button" class="btn btn-dark btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit-<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                                        <i class="fa-solid fa-edit"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalHapus-<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                                        <i class="fa-solid fa-trash"></i> Hapus
                                                    </button>
                                                <?php elseif ($_SESSION['level'] == 2): ?>
                                                    <!-- Tombol Edit untuk Operator Barang -->
                                                    <button type="button" class="btn btn-dark btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit-<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                                        <i class="fa-solid fa-edit"></i> Edit
                                                    </button>
                                                <?php elseif ($_SESSION['level'] == 3 && $akun['id_akun'] == $_SESSION['id_akun']): ?>
                                                    <!-- Tombol Edit hanya untuk Pelanggan yang sedang login -->
                                                    <button type="button" class="btn btn-dark btn-sm mx-1" data-bs-toggle="modal"
                                                        data-bs-target="#modalEdit-<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                                        <i class="fa-solid fa-edit"></i> Edit
                                                    </button>
                                                <?php endif; ?>
                                            </td>


                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
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

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Tambahkan Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Kosongkan jika tidak ingin mengganti password">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                            </div>

                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <option value="1">1 (Admin)</option>
                                    <option value="2">2 (User)</option>
                                    <option value="3">3 (pelanggan)</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <?php foreach ($data_akun as $akun): ?>
            <div class="modal fade" id="modalEdit-<?php echo htmlspecialchars($akun['id_akun']); ?>" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-dark text-white">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Akun</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <input type="hidden" name="id_akun" value="<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                <div class="mb-3">
                                    <label for="nama">Nama</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        value="<?php echo htmlspecialchars($akun['nama']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        value="<?php echo htmlspecialchars($akun['username']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        value="<?php echo htmlspecialchars($akun['email']); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="Kosongkan jika tidak ingin mengganti password">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti password.</small>
                                </div>
                                <?php if ($_SESSION['level'] == 1): ?>
                                    <div class="mb-3">
                                        <label for="level">Level</label>
                                        <select name="level" id="level" class="form-control" required>
                                            <option value="1" <?php echo ($akun['level'] == 1) ? 'selected' : ''; ?>>1 (Admin)
                                            </option>
                                            <option value="2" <?php echo ($akun['level'] == 2) ? 'selected' : ''; ?>>2 (Operator
                                                Barang)</option>
                                            <option value="3" <?php echo ($akun['level'] == 3) ? 'selected' : ''; ?>>3 (Pelanggan)
                                            </option>
                                        </select>
                                    </div>
                                <?php else: ?>
                                    <input type="hidden" name="level" id="level"
                                        value="<?php echo htmlspecialchars($akun['level']); ?>">
                                <?php endif; ?>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>




        <!-- Modal Hapus -->
        <?php foreach ($data_akun as $akun): ?>
            <?php if ($_SESSION['level'] == 1): ?>
                <div class="modal fade" id="modalHapus-<?php echo htmlspecialchars($akun['id_akun']); ?>" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-dark text-white">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Akun</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id_akun" value="<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                    <p>Apakah Anda yakin ingin menghapus akun <?php echo htmlspecialchars($akun['nama']); ?>?</p>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/dhasboard.js"></script>
    <script src="js/main.js"></script>
    <script src="js/telepon.js"></script>
    <script src="js/pelanggan.js"></script>
    <script src="js/foto"></script>
    <script src="js/dhasboard.js"></script>
    <script src="js/login.js"></script>
</body>

</html>