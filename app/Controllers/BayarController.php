<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\BayarModel;

class BayarController extends BaseController
{
    use ResponseTrait;

    // Mendapatkan semua data pembayaran
    public function index()
    {
        $model = new BayarModel();
        $data = $model->findAll();

        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data pembayaran berhasil diambil',
            'data' => $data
        ];

        return $this->respond($response);
    }

    // Mendapatkan data pembayaran berdasarkan kode_pp
    public function readByKodePP($kode_pp)
    {
        $model = new BayarModel();
        $data = $model->getByKodePP($kode_pp);

        if ($data) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pembayaran berhasil diambil berdasarkan kode_pp',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data pembayaran tidak ditemukan untuk kode_pp tersebut');
        }
    }

    public function create($jml=null)
    {
        $model = new BayarModel();
        $data = $this->request->getPost();
    
        $responses = []; // Array untuk menampung respons dari setiap insert
    
        $success = true; // Flag untuk menandai kesuksesan seluruh operasi insert
    
        for ($i = 0; $i < $jml; $i++) {
            $data['bulan_pembayaran'] = $i+1;
            // Tambahkan tanggal jatuh tempo
            $data['jatuh_tempo'] = date('Y-m-d', strtotime('+' . $i+1 . ' month'));

            // Lakukan insert data
            if (!$model->insert($data)) {
                $success = false; // Jika satu operasi insert gagal, set flag sukses menjadi false
                break; // Hentikan iterasi dan keluar dari loop
            }
        }
    
        if ($success) {
            return $this->respondCreated([
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Semua data pembayaran berhasil ditambahkan',
            ]);
        } else {
            return $this->fail('Gagal menambahkan data pembayaran');
        }
    }
    
    public function update($id = null)
    {
        $model = new BayarModel();
        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pembayaran berhasil diupdate'
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data pembayaran tidak ditemukan');
        }
    }

    // Menghapus data pembayaran berdasarkan id_bayar
    public function delete($id = null)
    {
        $model = new BayarModel();
        $data = $model->find($id);

        if ($data) {
            $model->delete($id);
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pembayaran berhasil dihapus'
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data pembayaran tidak ditemukan');
        }
    }

    public function updateStatus($id_bayar = null, $status = null)
    {
        // Periksa apakah ID pembayaran dan status diberikan
        if (!$id_bayar || !$status) {
            return $this->failValidationError('ID pembayaran dan status diperlukan');
        }

        // Buat instance model
        $model = new BayarModel();

        // Panggil fungsi updateStatus dari model untuk mengupdate status
        if ($model->updateStatus($id_bayar, $status)) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Status pembayaran berhasil diperbarui'
            ];
            return $this->respond($response);
        } else {
            return $this->fail('Gagal memperbarui status pembayaran');
        }
    }
}
