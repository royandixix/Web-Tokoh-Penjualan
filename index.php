<?php
include 'function.php';

function select($query)
{
  // pangil cokensi databasa nyha
  global $db;
  $result = mysqli_query($db, $query);
  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

$dataBarang = select("SELECT * FROM pekerja");

?>










<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap demo</title>
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









  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Dashboard</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Barang</a>
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










  <div class="container mt-5">
    <h2>Inventory Management Dashboard</h2>
    <blockquote class="blockquote">
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
          <?php foreach ($dataBarang as $bar) : ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $bar["nama"]; ?></td>
              <td><?php echo $bar["jumlah"]; ?></td>
              <td>Rp. <?php echo number_format($bar["harga"], 0, ',', '.'); ?></td>
              <td><?php echo date('d/m/y | H::i:s', strtotime($bar["tanggal"])); ?></td>

              <td class="text-center">
                <a href="#" class="btn btn-dark">
                  <img src="img/315164_add_note_icon.png" alt="" width="20px">
                  Edit</a>

                  <a href="#" class="btn btn-warning text-white ">
                  <img src="img/8665971_trash_can_arrow_up_icon.png" alt="" width="20px">
                  Edit</a>
              </td>
            </tr>
          <?php endforeach; ?>







        </tbody>
      </table>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <script src=""></script>
</body>

</html>