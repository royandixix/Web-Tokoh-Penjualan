<?php 
 

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
    $id_barang = (int)$_GET['id_barang'];
    
    if(delet($id_barang) > 0) {
        echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
    }
?>

