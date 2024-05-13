<?php
require('fpdf/fpdf.php');

// Fungsi untuk membuat tabel dari hasil query SQL
function createTableFromSQL($sql) {
    // Lakukan koneksi ke database sesuai kebutuhan Anda
    $conn = new mysqli("localhost", "root", "", "db_peminjaman");

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi Gagal: " . $conn->connect_error);
    }

    // Eksekusi query SQL
    $result = $conn->query($sql);

    // Buat objek PDF
    $pdf = new FPDF('L', 'mm', 'A4');
    $pdf->AddPage();

    // Judul tabel
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Nama Pengguna', 1);
    $pdf->Cell(60, 10, 'Username', 1);
    $pdf->Cell(60, 10, 'Level', 1);
    $pdf->Ln();

    // Isi tabel dari hasil query
    $pdf->SetFont('Arial', '', 10);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(60, 10, $row['nama_pengguna'], 1);
        $pdf->Cell(60, 10, $row['username'], 1);
        $pdf->Cell(60, 10, $row['level'], 1);
        $pdf->Ln();
    }

    // Output file PDF
    $pdf->Output('example.pdf', 'I');

    // Tutup koneksi
    $conn->close();
}

// Panggil fungsi untuk membuat tabel dari query SQL
$sql = "SELECT nama_pengguna, username, level FROM `tb_pengguna`";
createTableFromSQL($sql);
?>
