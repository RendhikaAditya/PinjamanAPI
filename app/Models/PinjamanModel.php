<?php namespace App\Models;

use CodeIgniter\Model;

class PinjamanModel extends Model
{
    protected $table      = 'tb_pinjaman';
    protected $primaryKey = 'kode_pinjaman';

    protected $allowedFields = ['kode_pp', 'kode_nasabah', 'dana_pinjaman', 'lama_ansuran'];

    protected $returnType     = 'array';
}
