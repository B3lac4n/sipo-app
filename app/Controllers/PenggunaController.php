<?php

namespace App\Controllers;

use \Myth\Auth\Models\UserModel;
use \Myth\Auth\Password;

use App\Models\KetenagaanModel;

class PenggunaController extends BaseController
{
    protected $ketenagaanModel;

    public function __construct()
    {
        $this->ketenagaanModel = new KetenagaanModel();
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, username, email, fullname, auth_groups.name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();
        $pengguna = $query->getResult();

        $data = [
            'title' => 'Pengguna',
            'menu' => 'pengguna',
            'submenu' => false,
            'pengguna' => $pengguna
        ];
        
        return view('pengguna/pengguna', $data);
    }

    public function tambah()
    {
      $ketenagaan = $this->ketenagaanModel->getKetenagaan();

      $data = [
            'title' => 'Tambah Pengguna',
            'menu' => 'pengguna',
            'submenu' => false,
            'ketenagaan' => $ketenagaan
        ];
        
        return view('pengguna/tambah', $data);
    }

    public function gantiPassword()
    {
        $id = $this->request->getVar('id');

        $rules = [
			'password'     => [
                'rules' => 'required|strong_password',
                'errors' => [
                    'required' => 'Kata sandi harus diisi.'
                ]
            ],
			'pass_confirm' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'Konfirmasi kata sandi harus diisi.',
					'matches' => 'Konfirmasi kata sandi tidak sesuai.'
				]
			]
		];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }

        $userModel = new UserModel();
        $data = [            
            'password_hash' => Password::hash($this->request->getVar('password')),
            'reset_hash' => null,
            'reset_at' => null,
            'reset_expires' => null,
        ];

        $userModel->update($this->request->getVar('id'), $data);
        session()->setFlashdata('success', 'Kata sandi berhasil diganti.');

        return redirect()->back();
    }

    public function  profil($id = 0)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id, username, email, fullname, auth_groups.name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $builder->where('users.id', $id);
        $query = $builder->get();
        $pengguna = $query->getRow();

        $data = [            
            'title' => 'Profil Saya',
            'menu' => false,
            'submenu' => false,
            'pengguna' => $pengguna
        ];

        return view('pengguna/profil', $data);
    }
}
