<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'username'; // Asumsikan 'username' adalah primary key
    protected $useAutoIncrement = false; // Karena primary key bukan integer auto-increment

    protected $allowedFields = [
        'username',
        'nama',
        'kode_unit',
        'nm_unit',
        'nm_unit_singkat',
        'status_peg',
        'status',
        'tmt_masuk_kerja',
        'tmt_pensiun'
    ];

    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[20]',
        'nama' => 'required|max_length[100]',
        'kode_unit' => 'required|max_length[45]',
        'nm_unit' => 'required|max_length[45]',
        'nm_unit_singkat' => 'required|max_length[45]',
        'status_peg' => 'required|in_list[1,2,3]',
        'status' => 'required|in_list[A,N,L]',
        'tmt_masuk_kerja' => 'permit_empty|valid_date[Y-m-d H:i:s]',
        'tmt_pensiun' => 'permit_empty|valid_date[Y-m-d H:i:s]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi.',
            'min_length' => 'Username harus terdiri dari setidaknya 3 karakter.',
            'max_length' => 'Username tidak boleh lebih dari 20 karakter.'
        ],
        'nama' => [
            'required' => 'Nama harus diisi.',
            'max_length' => 'Nama tidak boleh lebih dari 100 karakter.'
        ],
        'kode_unit' => [
            'required' => 'Kode unit harus diisi.',
            'max_length' => 'Kode unit tidak boleh lebih dari 45 karakter.'
        ],
        'nm_unit' => [
            'required' => 'Nama unit harus diisi.',
            'max_length' => 'Nama unit tidak boleh lebih dari 45 karakter.'
        ],
        'nm_unit_singkat' => [
            'required' => 'Nama unit singkat harus diisi.',
            'max_length' => 'Nama unit singkat tidak boleh lebih dari 45 karakter.'
        ],
        'status_peg' => [
            'required' => 'Status pegawai harus diisi.',
            'in_list' => 'Status pegawai harus berupa salah satu dari: 1 (PNS), 2 (NON PNS), 3 (PPPK).'
        ],
        'status' => [
            'required' => 'Status harus diisi.',
            'in_list' => 'Status harus berupa salah satu dari: A (Aktif), N (Non Aktif), L (Logout).'
        ],
        'tmt_masuk_kerja' => [
            'valid_date' => 'Tanggal masuk kerja harus berupa tanggal yang valid dengan format Y-m-d H:i:s.'
        ],
        'tmt_pensiun' => [
            'valid_date' => 'Tanggal pensiun harus berupa tanggal yang valid dengan format Y-m-d H:i:s.'
        ]
    ];
}
