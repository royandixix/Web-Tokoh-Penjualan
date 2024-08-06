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
function addbarang($post)
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






// fungsi menambahka data pelanggan
function addPelanggan($post)
{
    global $db; // Memastikan koneksi database tersedia dalam fungsi ini

    $nama = htmlspecialchars($post['nama'], ENT_QUOTES, 'UTF-8');
    $status = htmlspecialchars($post['status'], ENT_QUOTES, 'UTF-8');
    $jenis_kelamin = htmlspecialchars($post['jenis_kelamin'], ENT_QUOTES, 'UTF-8');
    $telepon = htmlspecialchars($post['telepon'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($post['email'], ENT_QUOTES, 'UTF-8');

    // Pastikan file upload berhasil
    $fileName = uploaded_file();
    if ($fileName === null) {
        echo "Error: Tidak ada file yang diupload atau terjadi kesalahan.";
        return false;
    }

    // Simpan informasi pelanggan ke database
    $pelanggan = "INSERT INTO pelanggan (nama, status, jenis_kelamin, telepon, email, foto) VALUES ('$nama', '$status', '$jenis_kelamin', '$telepon', '$email', '$fileName')";
    return execute($pelanggan);
}



function uploaded_file()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek apakah ada file yang diupload
    if ($error === 4) {
        echo "<script>
                alert('Tidak ada file yang diupload');
                document.location.href = 'addpelanggan.php';        
              </script>";
        die();
    }

    // cek ekstensi file
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    // check format/ekstensi file
    if (!in_array($extensifile, $extensifileValid)) {
        echo "<script>
                alert('Format file tidak valid');
                document.location.href = 'addpelanggan.php';        
              </script>";
        die();
    }

    // generate nama file baru untuk menghindari konflik
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // pindahkan file ke folder tujuan
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    // return nama file baru yang disimpan
    return $namaFileBaru;
}





function pelanggan($query)
{
    global $db;
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        // Mengambil semua hasil dalam bentuk array asosiatif
        $data = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $data = [];
    }

    $db->close();
    return $data;
}



// Fungsi untuk mengubah data barang berdasarkan id_barang
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


// Fungsi untuk menghapus barang berdasarkan id_barang
function delet($id_barang)
{
    global $db;
    $query = "DELETE FROM barang WHERE id_barang = '$id_barang'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


