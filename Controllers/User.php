<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    private $ModelUser;
    public function __construct()
    {
        helper('form');
        $this->ModelUser = new ModelUser;
    }
    public function index()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'User',
            'page'  => 'user/v_index',
            'user' => $this->ModelUser->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function AddData()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'Tambah Data User',
            'page'  => 'user/v_adddata',
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                    'is_unique' => '{field} Ini Sudah Digunakan !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto]|max_size[foto,1024]|mime_in[foto,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !',
                    'max_size' => '{field} Max 1024Kb !',
                    'mime_in' => 'Format{field} Harus PNG,JPG,JPEG !',
                ]
            ],
        ])) {
            //jika lolos validasi data
            $foto = $this->request->getFile('foto');
            $nama_file = $foto->getRandomName();
            $data = [
                'nama_user' => $this->request->getPost('nama_user'),
                'email' => $this->request->getPost('email'),
                'password' => $this->request->getPost('password'),
                'no_hp' => $this->request->getPost('no_hp'),
                'level' => $this->request->getPost('level'),
                'foto' => $nama_file,
            ];
            //memindahkan/upload file foto ke dlm folder foto
            $foto->move('foto', $nama_file);
            $this->ModelUser->AddData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
            return redirect()->to(base_url('User'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/AddData'))->withInput()->with('validation', \Config\Services::validation()->getErrors());
        }
    }

    public function EditData($id_user)
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'user',
            'judul' => 'Edit Data User',
            'page'  => 'user/v_editdata',
            'user' => $this->ModelUser->DetailData($id_user),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_user)
    {
        if ($this->validate([
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !'
                ]
            ],
            'email' => [
                'label' => 'E-Mail',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'no_hp' => [
                'label' => 'No Handphone',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'foto' => [
                'label' => 'Foto User',
                'rules' => 'max_size[foto,1024]|mime_in[foto,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} Max 1024Kb !',
                    'mime_in' => 'Format{field} Harus PNG,JPG,JPEG !',
                ]
            ],
        ])) {
            //jika lolos validasi data
            $foto = $this->request->getFile('foto');

            if ($foto->getError() == 4) {
                //jika tdk ganti gmbar/foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                ];
                $this->ModelUser->EditData($data);
            } else {
                //hapus foto lama
                $user = $this->ModelUser->DetailData($id_user);
                if ($user['foto'] <> '') {
                    unlink('foto/' .  $user['foto']);
                }
                //jika ganti gambar/foto
                $nama_file = $foto->getRandomName();
                $data = [
                    'id_user' => $id_user,
                    'nama_user' => $this->request->getPost('nama_user'),
                    'email' => $this->request->getPost('email'),
                    'password' => $this->request->getPost('password'),
                    'no_hp' => $this->request->getPost('no_hp'),
                    'level' => $this->request->getPost('level'),
                    'foto' => $nama_file,
                ];
                //memindahkan/upload file foto ke dlm folder foto
                $foto->move('foto', $nama_file);
                $this->ModelUser->EditData($data);
            }
            session()->setFlashdata('pesan', 'Data Berhasil Diedit!');
            return redirect()->to(base_url('User'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('User/EditData/' . $id_user));
        }
    }

    public function DeleteData($id_user)
    {
        //hapus foto lama
        $user = $this->ModelUser->DetailData($id_user);
        if ($user['foto'] <> '') {
            unlink('foto/' .  $user['foto']);
        }

        $data = ['id_user' => $id_user];
        $this->ModelUser->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('User'));
    }
}
