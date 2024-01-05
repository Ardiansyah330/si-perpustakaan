<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBuku;
use App\Models\ModelKategori;
use App\Models\ModelRak;
use App\Models\ModelPenerbit;
use App\Models\ModelPenulis;

class Buku extends BaseController
{
    private $ModelBuku;
    private $ModelKategori;
    private $ModelRak;
    private $ModelPenerbit;
    private $ModelPenulis;
    public function __construct()
    {
        helper('form');
        $this->ModelBuku = new ModelBuku;
        $this->ModelKategori = new ModelKategori;
        $this->ModelRak = new ModelRak;
        $this->ModelPenerbit = new ModelPenerbit;
        $this->ModelPenulis = new ModelPenulis;
    }
    public function index()
    {
        $data = [
            'menu' => 'masterbuku',
            'submenu' => 'buku',
            'judul' => 'Buku',
            'page'  => 'buku/v_index',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'menu' => 'masterbuku',
            'submenu' => 'buku',
            'judul' => 'Tambah Buku',
            'page'  => 'buku/v_adddata',
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
            'rak' => $this->ModelRak->AllData(),
        ];
        return view('v_template_admin', $data);
    }
    public function SimpanData()
    {
        if ($this->validate([
            'kode_buku' => [
                'label' => 'Kode Buku / Barcode',
                'rules' => 'required|is_unique[tbl_buku.kode_buku]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                    'is_unique' => '{field} Sudah Ada !',
                ]
            ],
            'isbn' => [
                'label' => 'ISBN',
                'rules' => 'required|is_unique[tbl_buku.isbn]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                    'is_unique' => '{field} Sudah Ada !',
                ]
            ],
            'judul_buku' => [
                'label' => 'Judul Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_penulis' => [
                'label' => 'Penulis',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_rak' => [
                'label' => 'Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_penerbit' => [
                'label' => 'Penerbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'tahun' => [
                'label' => 'Tahun Terbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'bahasa' => [
                'label' => 'Bahasa',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'halaman' => [
                'label' => 'Halaman',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'jumlah' => [
                'label' => 'Jumlah Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'cover' => [
                'label' => 'Cover Buku',
                'rules' => 'uploaded[cover]|max_size[cover,2048]|mime_in[cover,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !',
                    'max_size' => '{field} Max 2048Kb !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,JPEG !',
                ]
            ],
            'deskripsi' => [
                'label' => 'Deskripsi/Sinopsis',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
        ])) {
            //jika lolos validasi data
            $cover = $this->request->getFile('cover');
            $nama_file = $cover->getRandomName();
            $data = [
                'kode_buku' => $this->request->getPost('kode_buku'),
                'judul_buku' => $this->request->getPost('judul_buku'),
                'isbn' => $this->request->getPost('isbn'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'id_penerbit' => $this->request->getPost('id_penerbit'),
                'id_penulis' => $this->request->getPost('id_penulis'),
                'id_rak' => $this->request->getPost('id_rak'),
                'tahun' => $this->request->getPost('tahun'),
                'bahasa' => $this->request->getPost('bahasa'),
                'halaman' => $this->request->getPost('halaman'),
                'jumlah' => $this->request->getPost('jumlah'),
                'jml_tersedia' => $this->request->getPost('jumlah'),
                'jml_dipinjam' => '0',
                'deskripsi' => $this->request->getPost('deskripsi'),
                'cover' => $nama_file,
            ];
            //memindahkan/upload file foto ke dlm folder foto
            $cover->move('cover', $nama_file);
            $this->ModelBuku->AddData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
            return redirect()->to(base_url('Buku'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Buku/AddData'))->withInput()->with('validation', \Config\Services::validation()->getErrors());
        }
    }

    public function EditData($id_buku)
    {
        $data = [
            'menu' => 'masterbuku',
            'submenu' => 'buku',
            'judul' => 'Edit Buku',
            'page'  => 'buku/v_editdata',
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
            'rak' => $this->ModelRak->AllData(),
            'buku' => $this->ModelBuku->DetailData($id_buku),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_buku)
    {
        if ($this->validate([
            'kode_buku' => [
                'label' => 'Kode Buku / Barcode',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'isbn' => [
                'label' => 'ISBN',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'judul_buku' => [
                'label' => 'Judul Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_kategori' => [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_penulis' => [
                'label' => 'Penulis',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_rak' => [
                'label' => 'Lokasi',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'id_penerbit' => [
                'label' => 'Penerbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'tahun' => [
                'label' => 'Tahun Terbit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'bahasa' => [
                'label' => 'Bahasa',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'halaman' => [
                'label' => 'Halaman',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'jumlah' => [
                'label' => 'Jumlah Buku',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                ]
            ],
            'cover' => [
                'label' => 'Cover Buku',
                'rules' => 'max_size[cover,2048]|mime_in[cover,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} Max 2048Kb !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,JPEG !',
                ]
            ],
        ])) {
            //jika lolos validasi data
            $cover = $this->request->getFile('cover');
            if ($cover->getError() == 4) {
                //tanpa upload cover
                $data = [
                    'id_buku' => $id_buku,
                    'kode_buku' => $this->request->getPost('kode_buku'),
                    'judul_buku' => $this->request->getPost('judul_buku'),
                    'isbn' => $this->request->getPost('isbn'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'id_rak' => $this->request->getPost('id_rak'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'jumlah' => $this->request->getPost('jumlah'),
                ];
                $this->ModelBuku->EditData($data);
            } else {
                //hapus foto lama
                $buku = $this->ModelBuku->DetailData($id_buku);
                if ($buku['cover'] <> '') {
                    unlink('cover/' .  $buku['cover']);
                }

                $nama_file = $cover->getRandomName();
                $data = [
                    'id_buku' => $id_buku,
                    'kode_buku' => $this->request->getPost('kode_buku'),
                    'judul_buku' => $this->request->getPost('judul_buku'),
                    'isbn' => $this->request->getPost('isbn'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'id_rak' => $this->request->getPost('id_rak'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'jumlah' => $this->request->getPost('jumlah'),
                    'cover' => $nama_file,
                ];
                //memindahkan/upload file foto ke dlm folder foto
                $cover->move('cover', $nama_file);
                $this->ModelBuku->EditDataData($data);
                //memindahkan/upload file foto ke dlm folder foto
                $cover->move('cover', $nama_file);
                $this->ModelBuku->EditData($data);
            }
            session()->setFlashdata('pesan', 'Data Berhasil Di Update!');
            return redirect()->to(base_url('Buku'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Buku/EditData/' . $id_buku))->withInput()->with('validation', \Config\Services::validation()->getErrors());
        }
    }
    public function DeleteData($id_buku)
    {
        //hapus foto lama
        $buku = $this->ModelBuku->DetailData($id_buku);
        if ($buku['cover'] <> '') {
            unlink('cover/' .  $buku['cover']);
        }

        $data = ['id_buku' => $id_buku];
        $this->ModelBuku->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('Buku'));
    }
}
