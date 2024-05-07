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
$query = "SELECT `no_ktp`,`nama_nasabah`,`tgl_lahir`,`jenis_kelamin`,`pekerjaan`,`alamat`,`email`, `status` FROM `tb_nasabah`";
$result = mysqli_query($koneksi, $query);

// Membuat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('A1:H1')->getFont()->setBold(true);

// Auto-fit width untuk semua kolom
foreach(range('A','H') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menulis header kolom
$sheet->setCellValue('A1', 'No KTP');
$sheet->setCellValue('B1', 'Nama Nasabah');
$sheet->setCellValue('C1', 'Tanggal Lahir');
$sheet->setCellValue('D1', 'Jenis Kelamin');
$sheet->setCellValue('E1', 'Pekerjaan');
$sheet->setCellValue('F1', 'Alamat');
$sheet->setCellValue('G1', 'Email');
$sheet->setCellValue('H1', 'Status');

// Menulis data dari database
$row = 2;
while ($data = mysqli_fetch_array($result)) {
    $sheet->setCellValue('A' . $row, $data['no_ktp']);
    $sheet->setCellValue('B' . $row, $data['nama_nasabah']);
    $sheet->setCellValue('C' . $row, $data['tgl_lahir']);
    $sheet->setCellValue('D' . $row, $data['jenis_kelamin']);
    $sheet->setCellValue('E' . $row, $data['pekerjaan']);
    $sheet->setCellValue('F' . $row, $data['alamat']);
    $sheet->setCellValue('G' . $row, $data['email']);
    $sheet->setCellValue('H' . $row, $data['status']);
    $row++;
}

// Menambahkan border ke seluruh data
$sheet->getStyle('A1:H'.($row-1))->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
]);

$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=laporan_nasabah.xlsx');
header('Cache-Control: max-age=0');

// Menyimpan file Excel ke output
$writer->save('php://output');

// Tutup koneksi database
mysqli_close($koneksi);
?>
