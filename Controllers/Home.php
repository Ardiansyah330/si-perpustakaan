<?php

namespace App\Controllers;

use App\Models\ModelPengaturan;
use App\Models\ModelBuku;
use App\Models\ModelEbook;

class Home extends BaseController
{
    private $ModelPengaturan;
    private $ModelBuku;
    private $ModelEbook;
    public function __construct()
    {
        helper("form");
        $this->ModelPengaturan = new ModelPengaturan();
        $this->ModelBuku = new ModelBuku();
        $this->ModelEbook = new ModelEbook();
    }
    public function index(): string
    {
        $data = [
            'judul' => 'Home',
            'page'  => 'v_home',
            'slider' => $this->ModelPengaturan->Slider(),
            'buku' => $this->ModelBuku->BukuBaru(),
            'ebook' => $this->ModelEbook->EbookBaru(),
        ];
        return view('v_template', $data);
    }
    public function Sejarah()
    {
        $data = [
            'judul' => 'Sejarah',
            'page'  => 'v_sejarah',
            'profil' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template', $data);
    }
    public function VisiMisi()
    {
        $data = [
            'judul' => 'Visi & Misi',
            'page'  => 'v_visi_misi',
            'profil' => $this->ModelPengaturan->DetailWeb(),
        ];
        return view('v_template', $data);
    }
    public function GalleryBuku()
    {
        $data = [
            'judul' => 'Gallery Buku',
            'page'  => 'v_gallery_buku',
            'buku' => $this->ModelBuku->AllData(),
        ];
        return view('v_template', $data);
    }
    public function GalleryEbook()
    {
        $data = [
            'judul' => 'Gallery E-Book',
            'page'  => 'v_gallery_ebook',
            'ebook' => $this->ModelEbook->AllData(),
        ];
        return view('v_template', $data);
    }

    public function DetailBuku($id_buku)
    {
        $data = [
            'judul' => 'Detail Buku',
            'page'  => 'v_detail_buku',
            'buku' => $this->ModelBuku->DetailData($id_buku),
        ];
        return view('v_template', $data);
    }
    public function DetailEbook($id_ebook)
    {
        $data = [
            'judul' => 'Detail Ebook',
            'page'  => 'v_detail_ebook',
            'ebook' => $this->ModelEbook->DetailData($id_ebook),
        ];
        return view('v_template', $data);
    }
}
