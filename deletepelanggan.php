<?php
require 'config/fungsi.php';
require 'js/confir.js';
$id_pelanggan = (int) $_GET['id_pelanggan'];

if (delet_pelanggan($id_pelanggan) > 0) {
    echo "<script>
                alert('Data Pelanggan berhasil dihapus!');
                document.location.href = 'pelanggan.php';
            </script>";
} else {
    echo "<script>
                alert('Data Pelanggan gagal dihapus!');
                document.location.href = 'pelanggan.php';
            </script>";
}