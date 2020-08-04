<?php

namespace App\Controllers;

use App\Models\M_komik;

class Komik extends BaseController
{
    protected $M_komik;
    public function __construct()
    {
        $this->M_komik = new M_komik();
    }

    public function index()
    {
        $data = [
            'judul' => 'Daftar Komik',
            'komik' => $this->M_komik->getKomik()
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'judul' => 'Detail Komik',
            'komik' => $this->M_komik->getKomik($slug)
        ];

        // jika komik tidak ada di tabel
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' tidak ditemukan.');
        }

        return view('/komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'judul' => 'Tambah Data Komik',
            'validation' => \Config\Services::validation()
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => 'Judul komik harus diisi !',
                    'is_unique' => 'Judul komik sudah terdaftar !'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->M_komik->save([
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan.');
        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $this->M_komik->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'judul' => 'Edit Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->M_komik->getKomik($slug)
        ];
        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // cek judul
        $komikLama = $this->M_komik->getKomik($this->request->getVar('slug'));
        if ($komikLama->judul == $this->request->getVar('judul')) {
            $rule_judul = 'required';
        } else {
            $rule_judul = 'required|is_unique[komik.judul]';
        }

        if (!$this->validate([
            'judul' => [
                'rules' => $rule_judul,
                'errors' => [
                    'required' => 'Judul komik harus diisi !',
                    'is_unique' => 'Judul komik sudah terdaftar !'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
        }

        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->M_komik->save([
            'id' => $id,
            'judul' => $this->request->getVar('judul'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diupdate.');
        return redirect()->to('/komik');
    }
}
