<?php

// Koneksi ke database
$db = mysqli_connect
(
    "localhost",
     "root",
      "",
       "db_peker"
    );

if (!$db) {
    die("Koneksi ke database gagal:
     " . mysqli_connect_error());
}

function query($query)
{
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function create_barang($post)
{
    global $db;
    $nama = mysqli_real_escape_string
    ($db, $post['nama']);
    $jumlah = mysqli_real_escape_string
    ($db, $post['jumlah']);
    $harga = mysqli_real_escape_string
    ($db, $post['harga']);
    
    // Query INSERT
    $query = "INSERT INTO barang (nama, jumlah, harga, created_at) 
              VALUES ('$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

    if (!mysqli_query($db, $query)) {
        die("Error: " . mysqli_error($db));
    }

    return mysqli_affected_rows($db);


}






?>


