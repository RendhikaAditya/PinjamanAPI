<?php

namespace App\Models;

use CodeIgniter\Model;

class BayarModel extends Model
{
    protected $table = 'tb_bayar';
    protected $primaryKey = 'id_bayar';
    protected $allowedFields = ['kode_pp', 'bulan_pembayaran', 'nominal_bayaran', 'status'];

    // Fungsi untuk mengupdate status berdasarkan ID pembayaran
    public function updateStatus($id_bayar, $status)
    {
        $data = [
            'status' => $status
        ];

        return $this->update($id_bayar, $data);
    }

    // Mendapatkan data pembayaran berdasarkan kode_pp
    public function getByKodePP($kode_pp)
    {
        return $this->where('kode_pp', $kode_pp)->findAll();
    }
    
    // Tambahkan method lain sesuai kebutuhan, misalnya untuk validasi atau query khusus.
}
