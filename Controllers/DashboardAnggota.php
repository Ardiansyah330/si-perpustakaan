<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelAnggota;
use App\Models\ModelProdi;

class DashboardAnggota extends BaseController
{
    private $ModelAnggota;
    private $ModelProdi;
    public function __construct()
    {
        helper('form');
        $this->ModelAnggota = new ModelAnggota;
        $this->ModelProdi = new ModelProdi;
    }
    public function index()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Profil Anggota',
            'page'  => 'v_dashboard_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
        ];
        return view('v_template_anggota', $data);
    }
    public function EditProfil()
    {
        $id_anggota = session()->get('id_anggota');
        $data = [
            'menu' => 'dashboard',
            'submenu' => '',
            'judul' => 'Edit Profil Anggota',
            'page'  => 'v_edit_profil_anggota',
            'anggota' => $this->ModelAnggota->ProfileAnggota($id_anggota),
            'prodi' => $this->ModelProdi->AllData(),
        ];
        return view('v_template_anggota', $data);
    }
    public function UpdateProfil()
    {
        $id_anggota = session()->get('id_anggota');
        if ($this->validate([
            'id_prodi' => [
                'label' => 'Prodi',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Belum Dipilih !',
                ]

            ],
            'nim' => [
                'label' => 'NIM',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'nama' => [
                'label' => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'jenis_kelamin' => [
                'label' => 'Jenis Kelamin',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'foto' => [
                'label' => 'Foto Anggota',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} Max 1024Kb !',
                    'mime_in' => 'Format{field} Harus PNG,JPG,JPEG !',
                ]
            ],
        ])) {
            //jika lolos validasi
            $foto = $this->request->getFile('foto');
            if ($foto->getError() == 4) {
                //jika tdk ganti gmbar/foto
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_prodi' => $this->request->getPost('id_prodi'),
                    'nim' => $this->request->getPost('nim'),
                    'nama' => $this->request->getPost('nama'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'password' => $this->request->getPost('password'),
                    'alamat' => $this->request->getPost('alamat'),
                    'verifikasi' => "1",
                ];
                //memindahkan/upload file foto ke dlm folder foto
                $this->ModelAnggota->EditData($data);
            } else {
                //hapus foto lama
                $anggota = $this->ModelAnggota->DetailData($id_anggota);
                if ($anggota['foto'] <> '' or $anggota['foto'] <> null) {
                    unlink('foto/' .  $anggota['foto']);
                }
                //jika ganti gmbar/foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_anggota' => $id_anggota,
                    'id_prodi' => $this->request->getPost('id_prodi'),
                    'nim' => $this->request->getPost('nim'),
                    'nama' => $this->request->getPost('nama'),
                    'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'password' => $this->request->getPost('password'),
                    'alamat' => $this->request->getPost('alamat'),
                    'verifikasi' => "1",
                    'foto' => $nama_file,
                ];
                //memindahkan/upload file foto ke dlm folder foto
                $foto->move('foto', $nama_file);
                $this->ModelAnggota->EditData($data);
            }
            session()->setFlashdata('pesan', 'Data Anggota Berhasil Diupdate !');
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        } else {
            //jika tdk lolos validasi
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('DashboardAnggota/EditProfil'));
        }
    }
}
