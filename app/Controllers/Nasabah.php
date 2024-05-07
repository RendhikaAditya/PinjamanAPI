<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\NasabahModel;
use App\Models\PengajuanPeminjamanModel;

class Nasabah extends ResourceController
{
    use ResponseTrait;

    // Mendapatkan semua data nasabah
    public function index()
    {
        $model = new NasabahModel();
        $data = $model->findAll();

        $response = [
            'sukses' => true,
            'status' => 200,
            'pesan' => 'Data nasabah berhasil diambil',
            'data' => $data
        ];

        return $this->respond($response);
    }

    // Menambahkan data nasabah baru
    public function create()
    {
        $model = new NasabahModel();
        $data = $this->request->getPost();
        
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $data['password'] = $hashedPassword;
        
        if ($model->insert($data)) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data nasabah berhasil ditambahkan',
                'data' => $data
            ];
            return $this->respondCreated($response);
        } else {
            return $this->fail($model->errors());
        }
    }

    // Mengupdate data nasabah berdasarkan kode_nasabah
    public function update($id = null)
    {
        $model = new NasabahModel();
        $data = $this->request->getRawInput();

        if ($model->update($id, $data)) {
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data nasabah berhasil diupdate'
            ];
            return $this->respond($response);
        } else {
            return $this->failNotFound('Data nasabah tidak ditemukan');
        }
    }

    // Menghapus data nasabah berdasarkan kode_nasabah
    public function delete($id = null)
    {
        $model = new NasabahModel();
        $data = $model->find($id);

        
        if ($data) {
            $model->delete($id);
            $response = [
                'sukses' => true,
                'status' => 200,
                'pesan' => 'Data nasabah berhasil dihapus'
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data nasabah tidak ditemukan');
        }
    }

    public function createPengajuan()
    {
        $kode_nasabah = $this->request->getVar('kode_nasabah');
        $foto_ktp_base64 = $this->request->getVar('foto_ktp');
        $foto_kk_base64 = $this->request->getVar('foto_kk');
        $foto_unit_base64 = $this->request->getVar('foto_unit');
        $foto_stnk_base64 = $this->request->getVar('foto_stnk');
        $foto_bpkp_base64 = $this->request->getVar('foto_bpkp');
        $dana_pinjaman_diajukan = $this->request->getVar('dana_pinjaman_diajukan');
        $lama_ansuran = $this->request->getVar('lama_ansuran');
        $file_pdf_base64 = $this->request->getVar('berkas');

        $tgl_pengajuan = date('Y-m-d');
        $dana_pinjaman_diterima = "0";
        $status_pengajuan = "konfirmasi";
        $keterangan = "Sedang Diproses";

        $rules = [
            'kode_nasabah' => 'required',
            'foto_ktp' => 'required',
            'foto_kk' => 'required',
            'foto_unit' => 'required',
            'foto_stnk' => 'required',
            'foto_bpkp' => 'required',
            'dana_pinjaman_diajukan' => 'required',
            'lama_ansuran' => 'required'
        ];
        
        $messages = [
            'kode_nasabah' => [
                'required' => 'Kode nasabah harus diisi.'
            ],
            'foto_ktp' => [
                'required' => 'Foto KTP harus diisi.'
            ],
            'foto_kk' => [
                'required' => 'Foto KK harus diisi.'
            ],
            'foto_unit' => [
                'required' => 'Foto unit harus diisi.'
            ],
            'foto_stnk' => [
                'required' => 'Foto stnk harus diisi.'
            ],
            'foto_bpkp' => [
                'required' => 'Foto bpkp harus diisi.'
            ],
            'dana_pinjaman_diajukan' => [
                'required' => 'Dana pinjaman yang diajukan harus diisi.'
            ],
            'lama_ansuran' => [
                'required' => 'Lama angsuran harus diisi.'
            ]
        ];


        // Jika validasi gagal
        if (!$this->validate($rules, $messages)) {
            $errors = $this->validator->getErrors();

            $response = [
                'sukses' => false,
                'status' => 400,
                'pesan' => $errors
            ];
        } else {
            // Decode BASE64 menjadi data gambar
            $decodedImage_ktp = base64_decode($foto_ktp_base64);
            $decodedImage_kk = base64_decode($foto_kk_base64);
            $decodedImage_unit = base64_decode($foto_unit_base64);
            $decodedImage_stnk = base64_decode($foto_stnk_base64);
            $decodedImage_bpkp = base64_decode($foto_bpkp_base64);

            $decodedFile_pdf = base64_decode($file_pdf_base64);

            // Simpan gambar di folder yang telah ditentukan
            $foto_ktp_name = time() . '_ktp.jpg';  // Nama gambar berdasarkan waktu
            $foto_kk_name = time() . '_kk.jpg';  // Nama gambar berdasarkan waktu
            $foto_unit_name = time() . '_unit.jpg';  // Nama gambar berdasarkan waktu
            $foto_stnk_name = time() . '_stnk.jpg';  // Nama gambar berdasarkan waktu
            $foto_bpkp_name = time() . '_bpkp.jpg';  // Nama gambar berdasarkan waktu

            $file_pdf_name = time() . '_file.pdf'; // Nama file berdasarkan waktu

            file_put_contents(ROOTPATH . 'public/uploads/' . $foto_ktp_name, $decodedImage_ktp);
            file_put_contents(ROOTPATH . 'public/uploads/' . $foto_kk_name, $decodedImage_kk);
            file_put_contents(ROOTPATH . 'public/uploads/' . $foto_unit_name, $decodedImage_unit);
            file_put_contents(ROOTPATH . 'public/uploads/' . $foto_stnk_name, $decodedImage_stnk);
            file_put_contents(ROOTPATH . 'public/uploads/' . $foto_bpkp_name, $decodedImage_bpkp);
            file_put_contents(ROOTPATH . 'public/uploads/' . $file_pdf_name, $decodedFile_pdf);
            
            // Data yang akan disimpan
            $data = [
                'kode_nasabah' => $kode_nasabah,
                'tgl_pengajuan' => $tgl_pengajuan,
                'foto_ktp' => $foto_ktp_name,
                'foto_kk' => $foto_kk_name,
                'foto_unit' => $foto_unit_name,
                'foto_stnk' => $foto_stnk_name,
                'foto_bpkp' => $foto_unit_name,
                'berkas_pinjaman' => $file_pdf_name,
                'dana_pinjaman_diajukan' => $dana_pinjaman_diajukan,
                'dana_pinjaman_diterima' => $dana_pinjaman_diterima,
                'lama_ansuran' => $lama_ansuran,
                'status_pengajuan' => $status_pengajuan,
                'keterangan' => $keterangan,
            ];
            
            // Coba menyimpan data
            $model = new PengajuanPeminjamanModel();
            if ($model->insert($data)) {
                $insertedId = $model->insertID();

                $response = [
                    'sukses' => true,
                    'status' => 200,
                    'pesan' => 'Data berhasil disimpan'
                ];
            } else {
                $response = [
                    'sukses' => false,
                    'status' => 400,
                    'pesan' => 'Gagal menyimpan data'
                ];
            }
        }

        return $this->respond($response);
    }

}
