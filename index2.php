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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dhasboard/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
    <!-- Pastikan menggunakan versi yang sesuai -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

</head>
<style>
    /* Tambahkan CSS khusus jika perlu */
</style>

<body>
    <div class="wrapper">
        <aside id="sidebar" class="js-sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">Toko Online Mamuju</a>
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
                    <li class="sidebar">
                        <a href="#" class="sidebar-link"><i class="fa-solid fa-file-lines pe-2"></i>
                            Barang</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link"><i class="fa-solid fa-sliders pe-2"></i> Pelanggan</a>
                    </li>
                    <li class="sidebar-item">
                        <a href="data-akun.html" class="sidebar-link"><i class="fa-regular fa-user pe-2"></i> Data
                            akun</a>
                    </li>

                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link"><i class="fa-regular fa-user pe-2"></i>Logout</a>
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
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="dhasboard/dhasboar/image/profile.jpg" class="avatar img-fluid rounded" alt="">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a href="#" class="dropdown-item">Profile</a></li>
                                <li><a href="#" class="dropdown-item">Setting</a></li>
                                <li><a href="#" class="dropdown-item">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 d-flex">
                            <div class="card flex-fill border-0 illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-1">
                                                <h4>Welcome Back, Admin</h4>
                                                <p class="mb-0">Admin Dashboard, CodzSword</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-self-end text-end">
                                            <img src="dhasboar/image/customer-support.jpg"
                                                class="img-fluid illustration-img" alt="">
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
                            <h5 class="card-title">
                                Basic Table
                            </h5>
                            <h6 class="card-subtitle text-muted">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ducimus,
                                necessitatibus reprehenderit itaque!
                            </h6>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover" id="example">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Barcode</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($result as $br): ?>
                                        <tr>
                                            <td class="text-nowrap">
                                                <?php echo htmlspecialchars($no++, ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="text-nowrap">
                                                <?php echo htmlspecialchars($br["nama"], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="text-nowrap">
                                                <?php echo htmlspecialchars($br["jumlah"], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td class="text-nowrap">Rp.
                                                <?php echo number_format($br["harga"], 0, ',', '.'); ?></td>
                                            <td>

                                                <img alt="barcode"
                                                    src="barcode.php?codetype=Code128&size=10&text=<?php echo $br['barcode'] ?>&print=true&rand=<?php echo time(); ?>" />

                                            </td>

                                            <td class="text-nowrap">
                                                <?php echo date('d/m/y | H:i:s', strtotime($br["tanggal"])); ?></td>
                                            <td class="text-nowrap">
                                                <?php if ($_SESSION['level'] == 1 || $_SESSION['level'] == 2): ?>
                                                    <a href="edit.php?id_barang=<?php echo urlencode($br['id_barang']); ?>"
                                                        class="btn btn-dark btn-sm mx-1">
                                                        <i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit
                                                    </a>
                                       git             <?php if ($_SESSION['level'] == 1): ?>
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
                    <!--End of Table Element-->
                </div>
            </main>
        </div>
    </div>

    <!-- Link to Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="dhasboard/js/script.js">
</body>

</html>