<?php

// Koneksi ke database
$db = mysqli_connect(
    "localhost",
    "root",
    "",
    "db_peker"
);

if (!$db) {
    die
    ("Koneksi ke database gagal: "
        . mysqli_connect_error()
    );
}


// Fungsi untuk menjalankan query dan mengembalikan hasil sebagai array
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







// Fungsi untuk menambahkan barang barang ke database

function tanggal($post)
{
    global $db;
    $nama = mysqli_real_escape_string($db, $post['nama']);
    $jumlah = mysqli_real_escape_string($db, $post['jumlah']);
    $harga = mysqli_real_escape_string($db, $post['harga']);

    // Query INSERT
    $query = "INSERT INTO barang (nama, jumlah, harga, tanggal) 
              VALUES ('$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP)";

    if (!mysqli_query($db, $query)) {
        die("Error: " . mysqli_error($db));
    }

    return mysqli_affected_rows($db);
}

// Pastikan untuk menutup koneksi setelah selesai
// mysqli_close($db); // Un-comment this line if needed

function edit($post)
{

    global $db;

    $id_barang = $post['id_barang'];
    $nama = mysqli_real_escape_string($db, $post['nama']);
    $jumlah = mysqli_real_escape_string($db, $post['jumlah']);
    $harga = mysqli_real_escape_string($db, $post['harga']);

    // query Insert/Update
    $query = "UPDATE barang SET 
    nama = '$nama', 
    jumlah ='$jumlah',
    harga = '$harga' 
    WHERE id_barang = '$id_barang'";

    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}
