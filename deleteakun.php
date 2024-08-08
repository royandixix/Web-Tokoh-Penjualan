<?php
require 'config/fungsi.php';

$id_akun = (int) $_GET['id_akun'];

if (delet_akun($id_akun) > 0) {
    echo "<script>
                alert('Data akun berhasil dihapus!');
                document.location.href = 'crudmodal.php';
            </script>";
} else {
    echo "<script>
                alert('Data akun gagal dihapus!');
                document.location.href = 'crudmodal.php';
            </script>";
}
