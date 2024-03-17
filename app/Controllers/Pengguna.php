<?php 

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\PenggunaModel;

class Pengguna extends ResourceController
{
    use ResponseTrait;

    // Mendapatkan semua data pengguna
    public function index()
    {
        $model = new PenggunaModel();
        $data = $model->findAll();

        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data pengguna berhasil diambil',
            'data' => $data
        ];

        return $this->respond($response);
    }

    // Menambahkan data pengguna baru
    public function create()
    {
        $model = new PenggunaModel();
        $data = $this->request->getPost();
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data['password'] = $hashedPassword;

        if ($model->insert($data)) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengguna berhasil ditambahkan',
            ];
            return $this->respondCreated($response);
        } else {
            return $this->fail($model->errors());
        }
    }

    // Mengupdate data pengguna berdasarkan kode_pengguna
    public function update($id = null)
    {
        $model = new PenggunaModel();
        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengguna berhasil diupdate'
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data pengguna tidak ditemukan');
        }
    }

    // Menghapus data pengguna berdasarkan kode_pengguna
    public function delete($id = null)
    {
        $model = new PenggunaModel();
        $data = $model->find($id);

        if ($data) {
            $model->delete($id);
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data pengguna berhasil dihapus'
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data pengguna tidak ditemukan');
        }
    }
}
