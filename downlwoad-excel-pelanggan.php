<?php

session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION["login"])) {
    echo "<script>
    alert('Kamu harus login dulu');
    document.location.href = 'login.php';
  </script>";
    exit;
}

// Cek apakah pengguna memiliki level yang sesuai
if ($_SESSION['level'] != 1 && $_SESSION['level'] != 3) {
    echo "<script>
    alert('Perhatian Halaman Ini hanya dapat diakses oleh Pelanggan.');
    document.location.href = 'index.php';
  </script>";
    exit;
}

require 'config/fungsi.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set header kolom
$sheet->setCellValue('A2', 'No');
$sheet->setCellValue('B2', 'Nama');
$sheet->setCellValue('C2', 'Status');
$sheet->setCellValue('D2', 'Jenis Kelamin');
$sheet->setCellValue('E2', 'Nomor Telepon');
$sheet->setCellValue('F2', 'Email');
$sheet->setCellValue('G2', 'Foto');

$data_pelanggan = query("SELECT * FROM pelanggan");
$no = 1;
$start = 3;

foreach ($data_pelanggan as $pelanggan) {
    $sheet->setCellValue('A' . $start, $no);
    $sheet->setCellValue('B' . $start, $pelanggan['nama']);
    $sheet->setCellValue('C' . $start, $pelanggan['status']);
    $sheet->setCellValue('D' . $start, $pelanggan['jenis_kelamin']);
    $sheet->setCellValue('E' . $start, $pelanggan['telepon']);
    $sheet->setCellValue('F' . $start, $pelanggan['email']);

    $link = 'http://localhost/web/img/' . $pelanggan['foto'];
    $sheet->setCellValue('G' . $start, $link);
    $sheet->getCell('G' . $start)->getHyperlink()->setUrl($link);

    $no++;
    $start++;
}

// Mengatur AutoSize untuk kolom
foreach (range('A', 'G') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menambahkan border pada tabel
$styleArray = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$border = $start - 1;
$sheet->getStyle('A2:G' . $border)->applyFromArray($styleArray);

// Menyimpan file Excel ke server sementara
$writer = new Xlsx($spreadsheet);
$filename = 'Data_Pelanggan.xlsx';
$writer->save($filename);

// Mengirim file ke browser
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
readfile($filename);

// Menghapus file setelah diunduh
unlink($filename);
exit;

?>