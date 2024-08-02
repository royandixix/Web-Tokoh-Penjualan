<?php
require 'function.php';

if (isset($_POST['kirim'])) {
    header("Location: index.php");
    exit(); // Jangan lupa untuk meng
    if (create_barang($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan!');
                document.location.href='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambahkan!');
                document.location.href='index.php';
            </script>";
    }
}



$pekerja = query("SELECT * FROM pekerja");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />

    <style>
        * {
            font-family: "Poppins", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .loading {
            display: none;
        }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Online Mamuju</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Barang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pekerja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Modal</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container mt-3 pt-5">
        <h2>Inventory Management Dashboard</h2>
        <blockquote class="blockquote">
            <p class="">Tambah Barang</p>
        </blockquote>

        <a href="index.php" class="btn btn-dark mb-1">Kembali</a>

        <!-- loading -->
        
        <hr>



        <!-- label form data  -->
        <form action="" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Barang">
                <label for="nama">Nama Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="jumlah Barang">
                <label for="jumlah">jumlah Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="harga" name="harga" placeholder="Harga Barang">
                <label for="harga">Harga Barang</label>
            </div>



            <!-- button -->
            <button type="submit" name="kirim" id="kirimButton" class="btn btn-primary mt-3 mb-4 w-25">Kirim</button>
        </form>





    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/main.js">
    </script>
</body>

</html>