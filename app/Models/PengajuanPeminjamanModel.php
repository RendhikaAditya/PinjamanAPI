<?php namespace App\Models;

use CodeIgniter\Model;

class PengajuanPeminjamanModel extends Model
{
    protected $table      = 'tb_pengajuan_peminjaman';
    protected $primaryKey = 'kode_pp';

    protected $allowedFields = [
        'kode_nasabah', 
        'tgl_pengajuan', 
        'foto_ktp', 
        'foto_kk', 
        'foto_unit', 
        'foto_stnk', 
        'foto_bpkp', 
        'berkas_pinjaman',
        'dana_pinjaman_diajukan', 
        'dana_pinjaman_diterima', 
        'lama_ansuran', 
        'status_pengajuan', 
        'keterangan',
        'nama_pasangan',
        'nik_pasangan',
        'no_hp_pasangan',
        'email_pasangan',
        'pekerjaan',
        'alamat_kantor',
        'no_telpon_kantor',
        'nama_keluarga',
        'hubungan_keluarga',
        'alamat_keluarga',
        'no_hp_keluarga',
        'penghasilan_bersih',
        'penghasilan_pasangan'
    ];

    protected $returnType     = 'array';
}
