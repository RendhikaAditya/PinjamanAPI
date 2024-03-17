<?php namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table      = 'tb_pengguna';
    protected $primaryKey = 'kode_pengguna';

    protected $allowedFields = ['nama_pengguna', 'username', 'password', 'level'];

    protected $returnType     = 'array';
}
