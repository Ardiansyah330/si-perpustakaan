<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelEbook;
use App\Models\ModelKategori;
use App\Models\ModelPenerbit;
use App\Models\ModelPenulis;

class Ebook extends BaseController
{
    private $ModelEbook;
    private $ModelKategori;
    private $ModelPenerbit;
    private $ModelPenulis;
    public function __construct()
    {
        helper('form');
        $this->ModelEbook = new ModelEbook;
        $this->ModelKategori = new ModelKategori;
        $this->ModelPenerbit = new ModelPenerbit;
        $this->ModelPenulis = new ModelPenulis;
    }
    public function index()
    {
        $data = [
            'menu' => 'masterbuku',
            'submenu' => 'ebook',
            'judul' => 'E-Book',
            'page'  => 'ebook/v_index',
            'ebook' => $this->ModelEbook->AllData(),
        ];
        return view('v_template_admin', $data);
    }
    public function AddData()
    {
        $data = [
            'menu' => 'masterbuku',
            'submenu' => 'ebook',
            'judul' => 'Tambah E-Book',
            'page'  => 'ebook/v_adddata',
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
        ];
        return view('v_template_admin', $data);
    }

    public function SimpanData()
    {
        if ($this->validate([
            'isbn' => [
                'label' => 'ISBN',
                'rules' => 'required|is_unique[tbl_buku.isbn]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                    'is_unique' => '{field} Sudah Ada !',
                ]
            ],
            'judul_ebook' => [
                'label' => 'Judul E-Book',
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
            'cover' => [
                'label' => 'Cover Buku',
                'rules' => 'uploaded[cover]|max_size[cover,2048]|mime_in[cover,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !',
                    'max_size' => '{field} Max 2048Kb !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,JPEG !',
                ]
            ],
            'ebooks' => [
                'label' => 'File E-Book',
                'rules' => 'uploaded[ebooks]|max_size[ebooks,5000]|ext_in[ebooks,pdf]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !',
                    'max_size' => '{field} Max 5000Kb !',
                    'ext_in' => 'Format {field} Harus .PDF !',
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

            $ebook = $this->request->getFile('ebooks');
            $ebooks_file = $ebook->getRandomName();
            $data = [
                'judul_ebook' => $this->request->getPost('judul_ebook'),
                'isbn' => $this->request->getPost('isbn'),
                'id_kategori' => $this->request->getPost('id_kategori'),
                'id_penerbit' => $this->request->getPost('id_penerbit'),
                'id_penulis' => $this->request->getPost('id_penulis'),
                'tahun' => $this->request->getPost('tahun'),
                'bahasa' => $this->request->getPost('bahasa'),
                'halaman' => $this->request->getPost('halaman'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'cover' => $nama_file,
                'ebooks' => $ebooks_file,
            ];
            //memindahkan/upload file foto ke dlm folder foto
            $cover->move('cover', $nama_file);
            $ebook->move('ebooks', $ebooks_file);
            $this->ModelEbook->AddData($data);
            session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan!');
            return redirect()->to(base_url('Ebook'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Ebook/AddData'))->withInput()->with('validation', \Config\Services::validation()->getErrors());
        }
    }
    public function EditData($id_ebook)
    {
        $data = [
            'menu' => 'masterbuku',
            'submenu' => 'ebook',
            'judul' => 'Edit E-Book',
            'page'  => 'ebook/v_editdata',
            'kategori' => $this->ModelKategori->AllData(),
            'penulis' => $this->ModelPenulis->AllData(),
            'penerbit' => $this->ModelPenerbit->AllData(),
            'ebook' => $this->ModelEbook->DetailData($id_ebook),
        ];
        return view('v_template_admin', $data);
    }

    public function UpdateData($id_ebook)
    {
        if ($this->validate([
            'isbn' => [
                'label' => 'ISBN',
                'rules' => 'required|is_unique[tbl_buku.isbn]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !',
                    'is_unique' => '{field} Sudah Ada !',
                ]
            ],
            'judul_ebook' => [
                'label' => 'Judul E-Book',
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
            'cover' => [
                'label' => 'Cover Buku',
                'rules' => 'max_size[cover,2048]|mime_in[cover,image/png,image/jpeg,image/jpg]',
                'errors' => [
                    'max_size' => '{field} Max 2048Kb !',
                    'mime_in' => 'Format {field} Harus PNG,JPG,JPEG !',
                ]
            ],
            'ebooks' => [
                'label' => 'File E-Book',
                'rules' => 'max_size[ebooks,5000]|ext_in[ebooks,pdf]',
                'errors' => [
                    'max_size' => '{field} Max 5000Kb !',
                    'ext_in' => 'Format {field} Harus .PDF !',
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
            $ebook = $this->request->getFile('ebooks');


            if ($cover->getError() == 4 and $ebook->getError() == 4) {
                $data = [
                    'id_ebook' => $id_ebook,
                    'judul_ebook' => $this->request->getPost('judul_ebook'),
                    'isbn' => $this->request->getPost('isbn'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                ];
                $this->ModelEbook->EditData($data);
            } elseif ($ebook->getError() == 4) {
                //hapus cover lama
                $dataebook = $this->ModelEbook->DetailData($id_ebook);
                if ($dataebook['cover'] <> '') {
                    unlink('cover/' .  $dataebook['cover']);
                }

                $nama_file = $cover->getRandomName();
                $data = [
                    'id_ebook' => $id_ebook,
                    'judul_ebook' => $this->request->getPost('judul_ebook'),
                    'isbn' => $this->request->getPost('isbn'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'cover' => $nama_file,
                ];
                $cover->move('cover', $nama_file);
                $this->ModelEbook->EditData($data);
            } elseif ($cover->getError() == 4) {
                //hapus ebook lama
                $dataebook = $this->ModelEbook->DetailData($id_ebook);
                if ($dataebook['ebooks'] <> '') {
                    unlink('ebooks/' .  $dataebook['ebooks']);
                }
                $ebooks_file = $ebook->getRandomName();
                $data = [
                    'id_ebook' => $id_ebook,
                    'judul_ebook' => $this->request->getPost('judul_ebook'),
                    'isbn' => $this->request->getPost('isbn'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'ebooks' => $ebooks_file,
                ];

                $ebook->move('ebooks', $ebooks_file);
                $this->ModelEbook->EditData($data);
            } else {
                //hapus cover lama
                $dataebook = $this->ModelEbook->DetailData($id_ebook);
                if ($dataebook['cover'] <> '') {
                    unlink('cover/' .  $dataebook['cover']);
                }

                //hapus ebook lama
                $dataebook = $this->ModelEbook->DetailData($id_ebook);
                if ($dataebook['ebooks'] <> '') {
                    unlink('ebooks/' .  $dataebook['ebooks']);
                }

                $nama_file = $cover->getRandomName();
                $ebooks_file = $ebook->getRandomName();
                $data = [
                    'id_ebook' => $id_ebook,
                    'judul_ebook' => $this->request->getPost('judul_ebook'),
                    'isbn' => $this->request->getPost('isbn'),
                    'id_kategori' => $this->request->getPost('id_kategori'),
                    'id_penerbit' => $this->request->getPost('id_penerbit'),
                    'id_penulis' => $this->request->getPost('id_penulis'),
                    'tahun' => $this->request->getPost('tahun'),
                    'bahasa' => $this->request->getPost('bahasa'),
                    'halaman' => $this->request->getPost('halaman'),
                    'deskripsi' => $this->request->getPost('deskripsi'),
                    'cover' => $nama_file,
                    'ebooks' => $ebooks_file,
                ];
                //memindahkan/upload file foto ke dlm folder foto
                $cover->move('cover', $nama_file);
                $ebook->move('ebooks', $ebooks_file);
                $this->ModelEbook->EditData($data);
            }

            session()->setFlashdata('pesan', 'Data Berhasil Di Update!');
            return redirect()->to(base_url('Ebook'));
        } else {
            //jika tdk lolos validasi data
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('Ebook/EditData/' . $id_ebook));
        }
    }
    public function DeleteData($id_ebook)
    {
        //hapus cover lama
        $dataebook = $this->ModelEbook->DetailData($id_ebook);
        if ($dataebook['cover'] <> '') {
            unlink('cover/' .  $dataebook['cover']);
        }

        //hapus ebook lama
        $dataebook = $this->ModelEbook->DetailData($id_ebook);
        if ($dataebook['ebooks'] <> '') {
            unlink('ebooks/' .  $dataebook['ebooks']);
        }

        $data = ['id_ebook' => $id_ebook];
        $this->ModelEbook->DeleteData($data);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus!');
        return redirect()->to(base_url('Ebook'));
    }
}
