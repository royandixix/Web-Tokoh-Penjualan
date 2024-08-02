<?php

include'function.php';


// pangil kondeksi database


// query data pekerja
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />

  <style>
    * {
      font-family: "Poppins", sans-serif;
      font-weight: 300;
      font-style: normal;
    }
  </style>
</head>

<body>







  </div>
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
        <div class="ms-auto">
          <img src="img/8666609_user_icon.png" alt="Logo" width="40" height="40" class="d-inline-block align-top">
        </div>
      </div>
    </div>
  </nav>
  <div>


    <!-- penambahan data barang pada dhasboard  -->


    <div class="container mt-3 pt-5">
      <h2>Inventory Management Dashboard</h2>
      <blockquote class="blockquote">git 
        <p>Berisi Daftar Semua Barang</p>
      </blockquote>

      <a href="add.php" class=" btn btn-dark mb-1">Tambahkan</a>
      <hr>

      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Tanggal</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>



            <?php $no = 1; ?>
            <?php foreach ($pekerja as $br) : ?>
              <tr>
                <td class="text-nowrap"><?php echo $no++; ?></td>
                <td class="text-nowrap"><?php echo $br["nama"]; ?></td>
                <td class="text-nowrap"><?php echo $br
                ["jumlah"]; ?></td>
                <td class="text-nowrap">Rp. <?php echo number_format($br["harga"], 0, ',', '.'); ?></td>
                <td class="text-nowrap"><?php echo date('d/m/y | H:i:s', strtotime($br["tanggal"])); ?></td>
                <td class="text-nowrap">
                  <a href="#" class="btn btn-dark btn-sm mx-1">
                    <img src="img/315164_add_note_icon.png" alt="" width="20px" class="mr-1">
                    Edit
                  </a>
                  <a href="#" class="btn btn-warning btn-sm mx-1 text-white">
                    <img src="img/8665971_trash_can_arrow_up_icon.png" alt="" width="20px" class="mr-1">
                    Hapus
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>




          </tbody>
        </table>
      </div>




      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script>

      </script>

</body>

</html>