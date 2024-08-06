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
    global $db; // Pastikan variabel koneksi database global
    $nama = htmlspecialchars($post["nama"]);
    $status = htmlspecialchars($post["status"]);
    $jenis_kelamin = htmlspecialchars($post["jenis_kelamin"]);
    $telepon = htmlspecialchars($post["telepon"]);
    $email = htmlspecialchars($post["email"]);
    $foto = uploaded_file();

    $query = "INSERT INTO pelanggan (nama, status, jenis_kelamin, telepon, email, foto) VALUES ('$nama', '$status', '$jenis_kelamin', '$telepon', '$email', '$foto')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


// ini fungsi buat mengupload file

function uploaded_file()
{
    $namaFile = $_FILES['foto']['foto'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // cek file yang di upload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $exstensifile = strtolower(end($exstensifile));

    // check format/exstensi file
    if (!in_array($exstensifile, $extensifileValid)) {
        // pesan gagal 
        echo "<script>
                    alert('Format File Tidak Vilded');
                    document.location.href = 'addpelanggan.php';        
              </script>";
        die();
    }

    // check ukura file  2MB
    if ($ukuranFile > 5000000) {
        echo "<script>
        alert('Ukuran File Terlalu Besar');
              </script>";
        return false;
    }
    // LOLOS pengecekan dan, gambar siap di upload 
    // generate nama gambar baru 
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;
    // pindaj kan ke folde baru 
    // move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
    // return $namaFileBaru;

    move_uploaded_file($tmpName, 'assets/img/'. $namaFileBaru);

    




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





// function pelanggan($id_pelanggan) {
//     $id_pelanggan = (int)$id_pelanggan;
//     $result = query("SELECT * FROM pelanggan WHERE id_pelanggan = $id_pelanggan");

//     if (isset($result[0])) {
//         return $result[0];
//     } else {
//         return [
//             'nama' => '',
//             'status' => '',
//             'jenis_kelamin' => '',
//             'telepon' => '',
//             'email' => '',
//             'foto' => 'default.jpg'
//         ];
//     }
// }









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


