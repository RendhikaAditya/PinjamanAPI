<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PinjamanModel;
use App\Models\NasabahModel;
use App\Models\PengajuanPeminjamanModel;

class PinjamanController extends ResourceController
{
    protected $modelName = 'App\Models\PinjamanModel';

    public function index()
    {
        $model = new PinjamanModel();
        $data = $model->findAll();

        // Relasikan kode_nasabah dengan tabel nasabah
        $nasabahModel = new NasabahModel();
        foreach ($data as &$pinjaman) {
            $nasabah = $nasabahModel->find($pinjaman['kode_nasabah']);
            $pinjaman['nasabah'] = $nasabah;
        }

        // Relasikan kode_pp dengan tabel pengajuan pinjaman
        $pengajuanModel = new PengajuanPeminjamanModel();
        foreach ($data as &$pinjaman) {
            $pengajuan = $pengajuanModel->find($pinjaman['kode_pp']);
            $pinjaman['pengajuan'] = $pengajuan;
        }

        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data pinjaman berhasil ditemukan',
            'data' => $data
        ];
        return $this->respond($response);
    }

    public function create()
    {
        // Proses untuk membuat pinjaman baru
    }

    public function show($id = null)
    {
        // Proses untuk menampilkan detail pinjaman berdasarkan ID
    }

    public function update($id = null)
    {
        // Proses untuk memperbarui pinjaman berdasarkan ID
    }

    public function delete($id = null)
    {
        // Proses untuk menghapus pinjaman berdasarkan ID
    }
}
