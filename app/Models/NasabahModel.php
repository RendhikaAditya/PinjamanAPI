<?php namespace App\Models;

use CodeIgniter\Model;

class NasabahModel extends Model
{
    protected $table      = 'tb_nasabah';
    protected $primaryKey = 'kode_nasabah';

    protected $allowedFields = ['no_ktp', 'nama_nasabah', 'tgl_lahir', 'jenis_kelamin', 'pekerjaan', 'alamat', 'telpon', 'email', 'password', 'status'];

    protected $returnType     = 'array';
}
