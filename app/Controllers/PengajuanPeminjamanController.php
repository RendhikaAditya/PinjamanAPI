<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PengajuanPeminjamanModel;
use App\Models\NasabahModel;

class PengajuanPeminjamanController extends ResourceController
{
    protected $format = 'json';

    public function __construct()
    {
        $this->model = new PengajuanPeminjamanModel();
        $this->nasabahModel = new NasabahModel();
    }

    // GET Method
    public function index()
    {
        $data = $this->model->findAll();
        foreach ($data as &$item) {
            $nasabah = $this->nasabahModel->find($item['kode_nasabah']);
            $item['nasabah'] = $nasabah;
        }

        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data pengajuan pinjaman berhasil diambil',
            'data' => $data
        ];
        return $this->respond($response);
    }

    // GET Method by Kode Nasabah
    public function getByKodeNasabah($kode_nasabah)
    {
        $data = $this->model->where('tb_pengajuan_peminjaman.kode_nasabah', $kode_nasabah)->findAll();
      
        foreach ($data as &$item) {
            $nasabah = $this->nasabahModel->find($item['kode_nasabah']);
            $item['nasabah'] = $nasabah;
        }

        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data pengajuan pinjaman berhasil diambil berdasarkan kode nasabah',
            'data' => $data
        ];
        return $this->respond($response);
    }


    // POST Method
    public function create()
    {
        $data = $this->request->getJSON();
        $inserted = $this->model->insert($data);
        if ($inserted) {
            $response = [
                'sukses' => true,
                'status' => 201,
                'pesan' => 'Data pengajuan pinjaman berhasil ditambahkan',
                'data' => $data
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'sukses' => false,
                'status' => 400,
                'pesan' => 'Gagal menambahkan data pengajuan pinjaman'
            ];
            return $this->respond($response, 400);
        }
    }

    // GET Method
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if ($data) {
            $nasabah = $this->nasabahModel->find($data['kode_nasabah']);
            $data['nasabah'] = $nasabah;
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengajuan pinjaman berhasil ditemukan',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'sukses' => false,
                'status' => 404,
                'pesan' => 'Data pengajuan pinjaman tidak ditemukan'
            ];
            return $this->respond($response, 404);
        }
    }

    // POST Method
    public function update($id = null)
    {
        $data = $this->request->getJSON();
        $updated = $this->model->update($id, $data);
        if ($updated) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengajuan pinjaman berhasil diperbarui',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'sukses' => false,
                'status' => 400,
                'pesan' => 'Gagal memperbarui data pengajuan pinjaman'
            ];
            return $this->respond($response, 400);
        }
    }

    // POST Method
    public function delete($id = null)
    {
        $deleted = $this->model->delete($id);
        if ($deleted) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengajuan pinjaman berhasil dihapus'
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'sukses' => false,
                'status' => 400,
                'pesan' => 'Gagal menghapus data pengajuan pinjaman'
            ];
            return $this->respond($response, 400);
        }
    }

    public function updateStatus($kode_pp)
    {
        // Validasi input dari request
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'status_pengajuan' => 'required|in_list[Di terima, Di tolak]',
            'keterangan' => 'required|max_length[255]',
            'dana_pinjaman_diterima' => 'required|numeric'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->failValidationErrors($validation->getErrors());
        }

        // Mengambil data dari request
        $status_pengajuan = $this->request->getVar('status_pengajuan');
        $keterangan = $this->request->getVar('keterangan');
        $dana_pinjaman_diterima = $this->request->getVar('dana_pinjaman_diterima');

        // Mencoba mencari data dengan kode_pp yang diberikan
        $model = new PengajuanPeminjamanModel();
        $data = $model->find($kode_pp);

        // Jika data tidak ditemukan
        if (!$data) {
            return $this->failNotFound("Data pengajuan dengan kode_pp $kode_pp tidak ditemukan.");
        }

        // Memperbarui data
        $data['status_pengajuan'] = $status_pengajuan;
        $data['keterangan'] = $keterangan;
        $data['dana_pinjaman_diterima'] = $dana_pinjaman_diterima;

        // Menyimpan perubahan ke database
        if ($model->update($kode_pp, $data)) {
            // Jika perubahan berhasil disimpan
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengajuan berhasil diperbarui'
            ];
            return $this->respond($response);
        } else {
            // Jika terjadi kesalahan saat menyimpan perubahan
            $response = [
                'sukses' => false,
                'status' => 202,
                'pesan' => 'Data pengajuan gagal diperbarui'
            ];
            return $this->respond($response);
        }
    }
}
