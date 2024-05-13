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
    $pdf->Cell(30, 10, 'No KTP', 1);
    $pdf->Cell(30, 10, 'Nama', 1);
    $pdf->Cell(30, 10, 'Tanggal Lahir', 1);
    $pdf->Cell(30, 10, 'Jenis Kelamin', 1);
    $pdf->Cell(40, 10, 'Pekerjaan', 1);
    $pdf->Cell(60, 10, 'Alamat', 1);
    $pdf->Cell(40, 10, 'Email', 1);
    $pdf->Cell(20, 10, 'Status', 1);
    $pdf->Ln();

    // Isi tabel dari hasil query
    $pdf->SetFont('Arial', '', 10);
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(30, 10, $row['no_ktp'], 1);
        $pdf->Cell(30, 10, $row['nama_nasabah'], 1);
        $pdf->Cell(30, 10, $row['tgl_lahir'], 1);
        $pdf->Cell(30, 10, $row['jenis_kelamin'], 1);
        $pdf->Cell(40, 10, $row['pekerjaan'], 1);
        $pdf->Cell(60, 10, $row['alamat'], 1);
        $pdf->Cell(40, 10, $row['email'], 1);
        $pdf->Cell(20, 10, $row['status'], 1);
        $pdf->Ln();
    }

    // Output file PDF
    $pdf->Output('example.pdf', 'I');

    // Tutup koneksi
    $conn->close();
}

// Panggil fungsi untuk membuat tabel dari query SQL
$sql = "SELECT `no_ktp`,`nama_nasabah`,`tgl_lahir`,`jenis_kelamin`,`pekerjaan`,`alamat`,`email`, `status` FROM `tb_nasabah`";
createTableFromSQL($sql);
?>
