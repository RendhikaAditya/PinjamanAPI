<?php namespace App\Models;

use CodeIgniter\Model;

class PengajuanPeminjamanModel extends Model
{
    protected $table      = 'tb_pengajuan_peminjaman';
    protected $primaryKey = 'kode_pp';

    protected $allowedFields = ['kode_nasabah', 'tgl_pengajuan', 'foto_ktp', 'foto_kk', 'foto_unit', 'dana_pinjaman_diajukan', 'dana_pinjaman_diterima', 'lama_ansuran', 'status_pengajuan', 'keterangan'];

    protected $returnType     = 'array';
}
