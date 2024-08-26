<?php

session_start();
// Cek apakah pengguna belum login
if (!isset($_SESSION["login"])) {
    echo "<script>
            alert('Kamu Harus Login Dulu');
            document.location.href = 'login.php';
          </script>";
    exit; // Menghentikan eksekusi script selanjutnya
}

require 'config/fungsi.php';
require 'js/confir.js';
$id_pelanggan = (int) $_GET['id_pelanggan'];

if (delet_pelanggan($id_pelanggan) > 0) {
    echo "<script>
                alert('Data Pelanggan berhasil dihapus!');
                document.location.href = 'pelanggan2.php';
            </script>";
} else {
    echo "<script>
                alert('Data Pelanggan gagal dihapus!');
                document.location.href = 'pelanggan2.php';
            </script>";
}


