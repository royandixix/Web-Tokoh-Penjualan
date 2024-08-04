<?php 
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

