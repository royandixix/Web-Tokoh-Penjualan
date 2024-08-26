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
                            document.location.href = 'index.php';
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
                                document.location.href = 'crudmodal.php';
                            </script>";
    } else {
        echo "<script>
                                alert('Data akun gagal ditambahkan!');
                                document.location.href = 'crudmodal.php';
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
                document.location.href = 'crudmodal.php';
              </script>";
    } else {
        echo "<script>
                alert('Data akun gagal diedit!');
                document.location.href = 'crudmodal.php';
              </script>";
    }
}

// Jika tombol 'hapus' ditekan
if (isset($_POST['hapus'])) {
    $id_akun = $_POST['id_akun'];

    if (delet_akun($id_akun) > 0) {
        echo "<script>
                        alert('Data akun berhasil dihapus!');
                        document.location.href = 'crudmodal.php';
                    </script>";
    } else {
        echo "<script>
                        alert('Data akun gagal dihapus!');
                        document.location.href = 'crudmodal.php';
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
                    <?php if ($_SESSION['level'] == 1 or $_SESSION['level'] == 3): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="pelanggan.php"><i
                                    class="fa-solid fa-person-military-pointing"></i>&nbsp;Pelanggan</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="crudmodal.php"><i class="fa-solid fa-user"></i>&nbsp;Data Akun</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hai
                            <?php echo htmlspecialchars($_SESSION['nama'], ENT_QUOTES, 'UTF-8'); ?></a>
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
            <p>Data Akun</p>
        </blockquote>
        <?php if ($_SESSION['level'] == 1): ?>
            <button type="button" class="btn btn-dark mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                    class="fa-solid fa-person-circle-plus"></i>&nbsp;Tambahkan</button>
           


        <?php endif; ?>
        <hr class="">

        <div class="table-responsive">
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


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.14.1/dist/umd/popper.min.js"
        integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+0vJuvQ3xG9nG7dttRKnQ5L+Z7f3U58ZTl1Bejt6V"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-GLhlTQ8x2L8vXJ0IO6Pb0cW2oM2XMxso4fGkeAs8ryyIQ9zIKN1D3KdVfsdXbg8F"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/query.js"></script>
    <script src="js/hiddenPaswsord.js"></script>
</body>

</html>