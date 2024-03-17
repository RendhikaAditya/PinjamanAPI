<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\NasabahModel;
use App\Models\PenggunaModel;
use App\Models\PengajuanPeminjamanModel;

class ApiController extends ResourceController
{
    use ResponseTrait;
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function getSummaryData()
    {
       // Hitung jumlah pengguna
       $totalPengguna = $this->db->query('SELECT COUNT(*) as total FROM tb_pengguna')->getRow()->total;

       // Hitung jumlah nasabah
       $totalNasabah = $this->db->query('SELECT COUNT(*) as total FROM tb_nasabah')->getRow()->total;

       // Hitung jumlah pinjaman yang diterima
       $totalPinjamanDiterima = $this->db->query('SELECT SUM(dana_pinjaman_diterima) as total FROM tb_pengajuan_peminjaman')->getRow()->total;

       // Hitung jumlah nasabah yang melakukan pinjaman
       $totalNasabahPinjaman = $this->db->query('SELECT COUNT(DISTINCT kode_nasabah) as total FROM tb_pengajuan_peminjaman')->getRow()->total;


        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data nasabah berhasil diambil',
            'total_pengguna'=> $totalPengguna,
            'total_nasabah' => $totalNasabah,
            'total_pinjaman_diterima' => $totalPinjamanDiterima,
            'total_nasabah_pinjaman' => $totalNasabahPinjaman
        ];

        return $this->respond($response);
    }
}
