<?php
require 'config/fungsi.php';

$data_akun = query("SELECT * FROM akun");

// jika tombol 'simpan' ditekan jalankan script berikut
if (isset($_POST['simpan'])) {
    if (add_modal($_POST) > 0) {
        echo "<script>
                alert('Data Akun berhasil ditambahkan!');
                document.location.href = 'crudmodal.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Akun gagal ditambahkan!');
                document.location.href = 'crudmodal.php';
            </script>";
    }
}

// jika tombol 'edit' ditekan jalankan script berikut
if (isset($_POST['edit'])) {
    if (edit_modal($_POST) > 0) {
        echo "<script>
                alert('Data Akun berhasil diedit!');
                document.location.href = 'crudmodal.php';
            </script>";
    } else {
        echo "<script>
                alert('Data Akun gagal diedit!');
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
    <title>Daftar Akun</title>
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
        <h2><i class="fa-solid fa-folder-open"></i>&nbspInventory Management Dashboard</h2>
        <blockquote class="blockquote">
            <p>Data Akun</p>
        </blockquote>

        <button type="button" class="btn btn-dark mb-1" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                class="fa-solid fa-person-circle-plus"></i>&nbspTambahkan</button>
        <hr>

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
                                <button type="button" class="btn btn-dark btn-sm mx-1" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit-<?php echo $akun['id_akun']; ?>">
                                    <img src="img/315164_add_note_icon.png" alt="Edit" width="20px" class="mr-1"> Edit
                                </button>
                                <button type="button" class="btn btn-warning btn-sm mx-1 text-white" data-bs-toggle="modal"
                                    data-bs-target="#modalHapus-<?php echo htmlspecialchars($akun['id_akun']); ?>">
                                    <img src="img/8665971_trash_can_arrow_up_icon.png" alt="Hapus" width="20px"
                                        class="mr-1"> Hapus
                                </button>
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
                            <input type="password" name="password" id="password" class="form-control" required
                                minlength="6">
                        </div>

                        <div class="mb-3">
                            <label for="level">Level</label>
                            <select name="level" id="level" class="form-control" required>
                                <option value="">Pilih Level</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark text-white" data-bs-dismiss="modal">Keluar</button>
                    <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <?php foreach ($data_akun as $akun): ?>
        <div class="modal fade" id="modalEdit-<?php echo $akun['id_akun']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Edit Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">
                            <input type="hidden" name="id_akun" value="<?php echo $akun['id_akun']; ?>">
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="<?php echo $akun['nama']; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required=""
                                    value="<?php echo $akun['username']; ?>">
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required=""
                                    value="<?php echo $akun['email'] ?>">
                            </div>

                            <div class="mb-3">
                                <label for="password">Password <small>(Masukan password Baru/Lama)</small></label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password-<?php echo $akun['id_akun']; ?>"
                                        class="form-control" required minlength="6" value="">
                                    <button type="button" class="btn btn-outline-secondary"
                                        onclick="togglePasswordVisibility(<?php echo $akun['id_akun']; ?>)">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="level">Level</label>
                                <select name="level" id="level" class="form-control" required>
                                    <?php $level = $akun['level']; ?>
                                    <option value="1" <?php echo $level == '1' ? 'selected' : null ?>>Admin</option>
                                    <option value="2" <?php echo $level == '2' ? 'selected' : null ?>>User</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark text-white" data-bs-dismiss="modal">Keluar</button>
                        <button type="submit" name="edit" class="btn btn-primary">Edit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <!-- Modal Hapus -->
    <?php foreach ($data_akun as $akun): ?>
        <div class="modal fade" id="modalHapus-<?php echo htmlspecialchars($akun['id_akun']); ?>" tabindex="-1"
            role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Yakin ingin menghapus akun: <?php echo htmlspecialchars($akun['nama']); ?>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark text-white" data-bs-dismiss="modal">Batal</button>
                        <a href="deleteakun.php?id_akun=<?php echo htmlspecialchars($akun['id_akun']); ?>"
                            class="btn btn-warning">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc"
        crossorigin="anonymous"></script>
    <script src="js/jquery.js"></script>
    <script src="hiddenPasword.js"></script>
</body>

</html>