<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\NasabahModel;
use App\Models\PenggunaModel;
use CodeIgniter\API\ResponseTrait;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login()
    {
        $usernameOrEmail = $this->request->getPost('username_or_email');
        $password = $this->request->getPost('password');
        // $isNasabah = filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL);

        $isNasabah = !!strpos($usernameOrEmail, '@');

        // Check if the input is an email address
        if ($isNasabah) {
            $nasabahModel = new NasabahModel();
            $user = $nasabahModel->where('email', $usernameOrEmail)->first();
            $level = "nasabah"; // Jika login sebagai nasabah, level diisi null
        } else {
            $penggunaModel = new PenggunaModel();
            $user = $penggunaModel->where('username', $usernameOrEmail)->first();
            $level = $user ? $user['level'] : null; // Jika tidak ditemukan pengguna, level diisi null
        }

        // If user found
        if ($user && password_verify($password, $user['password'])) {
            // Mendapatkan id, nama, dan level sesuai dengan kondisi
            $id = $isNasabah ? $user['kode_nasabah'] : $user['kode_pengguna'];
            $nama = $isNasabah ? $user['nama_nasabah'] : $user['nama_pengguna'];

            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Login berhasil',
                'data' => [
                    'id' => $id,
                    'nama' => $nama,
                    'level' => $level
                ]
            ];
            return $this->respond($response);
        } else {
            $response = [
                'sukses' => false,
                'status' => 401,
                'pesan' => 'Login gagal. Username/email atau password salah.'
            ];
            return $this->respond($response, 401);
        }
    }

}
