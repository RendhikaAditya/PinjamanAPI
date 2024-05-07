<?php
// Mengimpor namespace PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

// Memuat autoloader Composer
require 'vendor/autoload.php';

// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_peminjaman");

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

// Query SQL
$query = "SELECT nama_pengguna, username, level FROM `tb_pengguna`";
$result = mysqli_query($koneksi, $query);

// Membuat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('A1:C1')->getFont()->setBold(true);

// Auto-fit width untuk semua kolom
foreach(range('A','C') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menulis header kolom
$sheet->setCellValue('A1', 'Nama Pengguna');
$sheet->setCellValue('B1', 'Username');
$sheet->setCellValue('C1', 'Level');

// Menulis data dari database
$row = 2;
while ($data = mysqli_fetch_array($result)) {
    $sheet->setCellValue('A' . $row, $data['nama_pengguna']);
    $sheet->setCellValue('B' . $row, $data['username']);
    $sheet->setCellValue('C' . $row, $data['level']);
    $row++;
}

// Menambahkan border ke seluruh data
$sheet->getStyle('A1:C'.($row-1))->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
]);

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=laporan_pengguna.xlsx');
header('Cache-Control: max-age=0');

// Menyimpan file Excel ke output
$writer->save('php://output');

// Tutup koneksi database
mysqli_close($koneksi);
?>
