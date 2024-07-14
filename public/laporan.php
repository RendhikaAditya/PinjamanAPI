<?php
require('fpdf/fpdf.php');
function createTableFromSQL($sql) {
    $conn = new mysqli("localhost", "root", "", "db_pinjaman");

    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    $result = $conn->query($sql);

    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(45, 10, 'Nama Nasabah', 1);
    $pdf->Cell(45, 10, 'Pinjaman', 1);
    $pdf->Cell(45, 10, 'Angsuran', 1);
    $pdf->Cell(30, 10, 'Angsuran Ke', 1);
    $pdf->Cell(35, 10, 'Sisa Angsuran', 1);
    $pdf->Cell(30, 10, 'Sisa Bayar', 1);
    $pdf->Cell(45, 10, 'Tgl Approval', 1);
    $pdf->Ln();

    $pdf->SetFont('Arial', '', 10);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(45, 10, $row['nama_nasabah'], 1);
        $pdf->Cell(45, 10, $row['dana_pinjaman_diterima'], 1);
        $pdf->Cell(45, 10, $row['nominal_ansuran'], 1);
        $pdf->Cell(30, 10, $row['ansuranke'], 1);
        $pdf->Cell(35, 10, $row['sisaansuran'], 1);
        $pdf->Cell(30, 10, $row['sisa_bayar'], 1);
        $pdf->Cell(45, 10, $row['jatuh_tempo'], 1);
        $pdf->Ln();
    }

    $pdf->Output('example.pdf', 'I');

    $conn->close();
}
$sql = "SELECT 
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
            tb_pengajuan_peminjaman.dana_pinjaman_diterima";

createTableFromSQL($sql);
?>
