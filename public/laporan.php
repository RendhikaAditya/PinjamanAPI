<?php
// Mengimpor namespace PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
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
$query = "
    SELECT 
        tb_nasabah.nama_nasabah, 
        tb_pengajuan_peminjaman.dana_pinjaman_diterima,
        CAST(REPLACE(REPLACE(REPLACE(TRIM('Rp ' FROM (SELECT tb_bayar.nominal_bayaran FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp LIMIT 1)), '.', ''), ',00', ''), ' ', '') AS UNSIGNED) AS nominal_ansuran,
        (SELECT COUNT(*) FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp AND status = 'Diterima') AS ansuranke,
        ((SELECT COUNT(*) FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp) - (SELECT COUNT(*) FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp AND status = 'Diterima')) AS sisaansuran,
        (((SELECT COUNT(*) FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp) - (SELECT COUNT(*) FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp AND status = 'Diterima')) * CAST(REPLACE(REPLACE(REPLACE(TRIM('Rp ' FROM (SELECT tb_bayar.nominal_bayaran FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp LIMIT 1)), '.', ''), ',00', ''), ' ', '') AS UNSIGNED)) AS sisa_bayar,
        DATE_SUB((SELECT tb_bayar.jatuh_tempo FROM tb_bayar WHERE kode_pp = tb_pengajuan_peminjaman.kode_pp LIMIT 1), INTERVAL 1 MONTH) AS jatuh_tempo
    FROM 
        tb_pengajuan_peminjaman
    LEFT JOIN 
        tb_nasabah ON tb_nasabah.kode_nasabah = tb_pengajuan_peminjaman.kode_nasabah
    GROUP BY 
        tb_nasabah.nama_nasabah, 
        tb_pengajuan_peminjaman.dana_pinjaman_diterima;
";

$result = mysqli_query($koneksi, $query);

// Membuat objek Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->getStyle('A1:G1')->getFont()->setBold(true);

// Auto-fit width untuk semua kolom
foreach(range('A','G') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Menulis header kolom
$sheet->setCellValue('A1', 'Nama Nasabah');
$sheet->setCellValue('B1', 'Dana Pinjaman Diterima');
$sheet->setCellValue('C1', 'Nominal Angsuran');
$sheet->setCellValue('D1', 'Angsuran Ke');
$sheet->setCellValue('E1', 'Sisa Angsuran');
$sheet->setCellValue('F1', 'Sisa Bayar');
$sheet->setCellValue('G1', 'Jatuh Tempo');

// Menulis data dari database
$row = 2;
while ($data = mysqli_fetch_array($result)) {
    $sheet->setCellValue('A' . $row, $data['nama_nasabah']);
    $sheet->setCellValue('B' . $row, $data['dana_pinjaman_diterima']);
    $sheet->setCellValue('C' . $row, $data['nominal_ansuran']);
    $sheet->setCellValue('D' . $row, $data['ansuranke']);
    $sheet->setCellValue('E' . $row, $data['sisaansuran']);
    $sheet->setCellValue('F' . $row, $data['sisa_bayar']);
    $sheet->setCellValue('G' . $row, $data['jatuh_tempo']);
    $row++;
}

$sheet->getStyle('A1:G'.($row-1))->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
]);


$writer = new Xlsx($spreadsheet);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=laporan_pinjaman.xlsx');

header('Cache-Control: max-age=0');
// Menyimpan file Excel
$writer->save('php://output');
// Tutup koneksi database
mysqli_close($koneksi);
?>
