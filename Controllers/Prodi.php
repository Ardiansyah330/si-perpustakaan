<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProdi;

class Prodi extends BaseController
{
    private $ModelProdi;
    public function __construct()
    {
        helper('form');
        $this->ModelProdi = new ModelProdi;
    }
    public function index()
    {
        $data = [
            'menu' => 'masteranggota',
            'submenu' => 'prodi',
            'judul' => 'Prodi',
            'page'  => 'v_prodi',
            'prodi' => $this->ModelProdi->AllData(),
        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'nama_prodi'=>$this->request->getPost('nama_prodi'),
        ];
        $this->ModelProdi->AddData($data);
        session()->setFlashdata('pesan','Data Berhasil Ditambahkan!');
        return redirect()->to(base_url('Prodi'));
    }
    public function EditData($id_prodi)
    {
        $data = [
            'id_prodi'=> $id_prodi,
            'nama_prodi'=>$this->request->getPost('nama_prodi'),
        ];
        $this->ModelProdi->EditData($data);
        session()->setFlashdata('pesan','Data Berhasil Diupdate!');
        return redirect()->to(base_url('Prodi'));
    }
    public function DeleteData($id_prodi)
    {
        $data = ['id_prodi'=> $id_prodi];
        $this->ModelProdi->DeleteData($data);
        session()->setFlashdata('pesan','Data Berhasil Dihapus!');
        return redirect()->to(base_url('Prodi'));
    }
}
