<?php
session_start();
require 'config/fungsi.php';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $password_md5 = md5($password); // Hash password dengan MD5

    $result = mysqli_query($db, "SELECT * FROM akun WHERE username = '$username' AND password = '$password_md5'");

    if (mysqli_num_rows($result) == 1) {
        $hasil = mysqli_fetch_assoc($result);

        $_SESSION['login'] = true;
        $_SESSION['id_akun'] = $hasil['id_akun'];
        $_SESSION['nama'] = $hasil['nama'];
        $_SESSION['username'] = $hasil['username'];
        $_SESSION['email'] = $hasil['email'];
        $_SESSION['level'] = $hasil['level'];   
        header("location: index.php");
        exit;
    } else {
        $error = true;
    }
}

?>











<!doctype html>
<html lang="id" data-bs-theme="auto">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            background-image: url('asset/img/background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto text-center">
        <form action="" method="POST">
            <h1 class="h3 mb-3 fw-normal">Login Admin</h1>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger text-center">
                    <b>Username dan password salah</b>
                </div>
            <?php endif; ?>

            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="username" required>
                <label for="floatingInput">Username</label>
            </div>
                
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <button class="btn btn-dark w-100 py-2" type="submit" name="login">Login</button>
            <p class="mt-5 mb-3 text-body-secondary">&copy; Web Royandi 2023-20<?php echo date('y') ?></p>
        </form>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.1/js/bootstrap.bundle.min.js"
        integrity="sha384-OH68wM/WZj/JLUq9iN4h4W1TuEELnqWz6d9vcxgE6A/r8ioZ4ZON5zYo6ojF1J8C" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/4.25.0-lts/standard/ckeditor.js"></script>
</body>

</html>
