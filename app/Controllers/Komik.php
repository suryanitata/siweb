<?php

namespace App\Controllers;

use \App\Models\KomikModel;
use \App\Models\CategoryKomikModel;

class Komik extends BaseController
{
    private $komikModel, $catModel;
    public function  __construct()
    {
        $this->komikModel = new KomikModel();
        $this->catModel = new CategoryKomikModel();
    }

    public function index()
    {

        $dataKomik = $this->komikModel->getKomik();
        $data = [
            'title' => 'Data Komik',
            'result' => $dataKomik
        ];

        return view('komik/index', $data);
    }

    public function detail($slug)
    {

        $dataKomik = $this->komikModel->getKomik($slug);
        $data = [
            'title' => 'Data Komik',
            'result' => $dataKomik
        ];

        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Komik',
            'category' => $this->catModel->findAll(),
            'validation' => \config\Services::validation()
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[komik.title]',
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'author' => 'required',
            'release_year' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'permit_empty|decimal',
            'stock' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'integer' => '{field} hanya boleh angka'
                ]
            ],
            'cover' =>
            [
                'rules' => 'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in' => 'Yang anda pilih bukan gambar!',
                ]
            ],
        ])) {

            return redirect()->to('/komik/create')->withInput();
        }

        $fileSampul = $this->request->getFile('cover');
        if ($fileSampul->getError() == 4) {
            $namaFile = $this->defaultImage;
        } else {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaFile);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->komikModel->save([
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'komik_category_id' => $this->request->getVar('komik_category_id'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan!");
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $dataKomik = $this->komikModel->getKomik($slug);
        if (empty($dataKomik)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul buku $slug tidak ditemukan!");
        }

        $data = [
            'title' => 'Ubah Komik',
            'category' => $this->catModel->findAll(),
            'validation' => \config\Services::validation(),
            'result' => $dataKomik
        ];
        return view('komik/edit', $data);
    }

    public function update($id)
    {
        $dataOld = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($dataOld['title'] == $this->request->getVar('title')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[book.title]';
        }
        if (!$this->validate([
            'title' => [
                'rules' => $rule_title,
                'label' => 'Judul',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'is_unique' => '{field} hanya sudah ada'
                ]
            ],
            'author' => 'required',
            'release_year' => 'required|integer',
            'price' => 'required|numeric',
            'discount' => 'permit_empty|decimal',
            'stock' => [
                'rules' => 'required|integer',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'integer' => '{field} hanya boleh angka'
                ]
            ],
            'cover' =>
            [
                'rules' => 'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB!',
                    'is_image' => 'Yang anda pilih bukan gambar!',
                    'mime_in' => 'Yang anda pilih bukan gambar!',
                ]
            ],
        ])) {

            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $fileSampul = $this->request->getFile('cover');
        $namaFileLama = $this->request->getVar('sampullama');

        if ($fileSampul->getError() == 4) {
            $namaFile = $namaFileLama;
        } else {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaFile);

            if ($namaFileLama != $this->defaultImage && $namaFileLama != "") {
                unlink('img/' . $namaFileLama);
            }
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->komikModel->save([
            'komik_id' => $id,
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'komik_category_id' => $this->request->getVar('komik_category_id'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        $dataKomik = $this->komikModel->find($id);
        $this->komikModel->delete($id);

        if ($dataKomik['cover'] != $this->defaultImage) {
            unlink('img/' . $dataKomik['cover']);
        }
        session()->setFlashdata("msg", "Data berhasil dihapus!");
        return redirect()->to('/komik');
        // return view('komik/delete', $id);
    }
}