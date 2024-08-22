<?php

require __DIR__ . '/vendor/autoload.php';
require 'config/fungsi.php';

use Spipu\Html2Pdf\Html2Pdf;

$data_barang = query("SELECT * FROM pelanggan");

$content = '
<style type="text/css">
    body {
        font-family: Arial, sans-serif;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        text-align: center;
    }
    td {
        padding: 10px;
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .gambar {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #4CAF50;
    }
    h1 {
        text-align: center;
        color: #4CAF50;
        margin-bottom: 30px;
    }
</style>';

$content .= '
<page>
    <h1>Daftar Pelanggan</h1>
    <table border="1" align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>';

$no = 1;
foreach ($data_barang as $barang) {
    $content .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $barang['nama'] . '</td>
            <td>' . $barang['status'] . '</td>
            <td>' . $barang['jenis_kelamin'] . '</td>
            <td>' . $barang['telepon'] . '</td>
            <td>' . $barang['email'] . '</td>
            <td><img src="img/' . $barang['foto'] . '" class="gambar"></td>
        </tr>';
}

$content .= '
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
$html2pdf->output('pelanggan.pdf');

?>
