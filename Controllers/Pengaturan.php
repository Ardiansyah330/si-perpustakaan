<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengaturan;

class Pengaturan extends BaseController
{
    private $ModelPengaturan;
    public function __construct()
    {
        helper("form");
        $this->ModelPengaturan = new ModelPengaturan();
    }
    public function web()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'web',
            'judul' => 'Pengaturan WEB',
            'page'  => 'v_pengaturan_web',
            'web'   => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template_admin', $data);
    }
    public function UpdateWeb()
    {
        if ($this->validate([
            'nama_universitas' => [
                'label' => 'Nama Universitas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'kecamatan' => [
                'label' => 'Kecamatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'kab_kota' => [
                'label' => 'Kabupaten/Kota',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'pos' => [
                'label' => 'Pos',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'no_telp' => [
                'label' => 'No Telp',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'sejarah' => [
                'label' => 'Sejarah',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'visi' => [
                'label' => 'Visi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'misi' => [
                'label' => 'Misi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'logo' => [
                'label' => 'Logo',
                'rules' => 'max_size[logo,1024]|mime_in[logo,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} Max 1024Kb !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,JPEG !',
                ]
            ],
        ])) {
            //jika lolos validasi data
            $logo = $this->request->getFile('logo');

            if ($logo->getError() == 4) {
                //jika tdk ganti gmbar/foto
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_web' => '1',
                    'nama_universitas' => $this->request->getPost('nama_universitas'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'pos' => $this->request->getPost('pos'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                ];
                $this->ModelPengaturan->UpdateWeb($data);
            } else {
                //hapus foto lama
                $web = $this->ModelPengaturan->DetailWeb();
                if ($web['logo'] <> '') {
                    unlink('logo/' .  $web['logo']);
                }
                //jika ganti gambar/foto
                $nama_file = $logo->getRandomName();
                $data = [
                    'id_web' => '1',
                    'nama_universitas' => $this->request->getPost('nama_universitas'),
                    'alamat' => $this->request->getPost('alamat'),
                    'kecamatan' => $this->request->getPost('kecamatan'),
                    'kab_kota' => $this->request->getPost('kab_kota'),
                    'pos' => $this->request->getPost('pos'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'sejarah' => $this->request->getPost('sejarah'),
                    'visi' => $this->request->getPost('visi'),
                    'misi' => $this->request->getPost('misi'),
                    'logo' => $nama_file,
                ];
                //memindahkan/upload file foto ke dlm folder foto
                $logo->move('logo', $nama_file);
                $this->ModelPengaturan->UpdateWeb($data);
            }
            session()->setFlashdata('pesan', 'Data Web Berhasil Diupdate!');
            return redirect()->to(base_url('Pengaturan/web'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/web'));
        }
    }

    public function Slider()
    {
        $data = [
            'menu' => 'pengaturan',
            'submenu' => 'slider',
            'judul' => 'Data Slider',
            'page'  => 'v_slider',
            'slider' => $this->ModelPengaturan->Slider(),
        ];
        return view('v_template_admin', $data);
    }

    public function EditSlider($id_slider)
    {
        if ($this->validate([
            'slider' => [
                'label' => 'Gambar Slider',
                'rules' => 'uploaded[slider]|max_size[slider,2048]|mime_in[slider,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} Max 2048Kb !',
                    'mime_in' => 'Format{field} Harus PNG,JPG,JPEG !',
                ]
            ],
        ])) {
            //jika lolos validasi data
            $slider = $this->request->getFile('slider');

            //hapus foto lama
            $file = $this->ModelPengaturan->DetailSlider($id_slider);
            if ($file['slider'] <> '') {
                unlink('slider/' .  $file['slider']);
            }
            //jika ganti gambar/foto
            $nama_file = $slider->getRandomName();
            $data = [
                'id_slider' => $id_slider,
                'slider' => $nama_file,
            ];
            //memindahkan/upload file foto ke dlm folder foto
            $slider->move('slider', $nama_file);
            $this->ModelPengaturan->UpdateSlider($data);

            session()->setFlashdata('pesan', 'Slider Berhasil Diganti!');
            return redirect()->to(base_url('Pengaturan/Slider'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Pengaturan/Slider'))->withInput()->with('validation', \Config\Services::validation()->getErrors());
        }
    }
}
