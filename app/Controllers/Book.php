<?php

namespace App\Controllers;

use \App\Models\BookModel;
use \App\Models\CategoryModel;

class Book extends BaseController
{
    private $bookModel, $catModel;
    public function  __construct()
    {
        $this->bookModel = new BookModel();
        $this->catModel = new CategoryModel();
    }

    public function index()
    {

        $dataBook = $this->bookModel->getBook();
        $data = [
            'title' => 'Data Buku',
            'result' => $dataBook
        ];

        return view('book/index', $data);
    }

    public function detail($slug)
    {

        $dataBook = $this->bookModel->getBook($slug);
        $data = [
            'title' => 'Data Buku',
            'result' => $dataBook
        ];

        return view('book/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Buku',
            'category' => $this->catModel->findAll(),
            'validation' => \config\Services::validation()
        ];
        return view('book/create', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'title' => [
                'rules' => 'required|is_unique[book.title]',
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
            // 'stock' => 'required|integer',
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

            return redirect()->to('/book/create')->withInput();
        }

        $fileSampul = $this->request->getFile('cover');
        if ($fileSampul->getError() == 4) {
            $namaFile = $this->defaultImage;
        } else {
            $namaFile = $fileSampul->getRandomName();
            $fileSampul->move('img', $namaFile);
        }




        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->bookModel->save([
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'book_category_id' => $this->request->getVar('book_category_id'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil ditambahkan!");
        return redirect()->to('/book');
    }

    public function edit($slug)
    {
        $dataBook = $this->bookModel->getBook($slug);
        if (empty($dataBook)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul buku $slug tidak ditemukan!");
        }

        $data = [
            'title' => 'Ubah Buku',
            'category' => $this->catModel->findAll(),
            'validation' => \config\Services::validation(),
            'result' => $dataBook
        ];
        return view('book/edit', $data);
    }

    public function update($id)
    {
        $dataOld = $this->bookModel->getBook($this->request->getVar('slug'));
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
            'stock' => 'required|integer',
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

            return redirect()->to('/book/edit/' . $this->request->getVar('slug'))->withInput();
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
        $this->bookModel->save([
            'book_id' => $id,
            'title' => $this->request->getVar('title'),
            'author' => $this->request->getVar('author'),
            'release_year' => $this->request->getVar('release_year'),
            'price' => $this->request->getVar('price'),
            'discount' => $this->request->getVar('discount'),
            'stock' => $this->request->getVar('stock'),
            'book_category_id' => $this->request->getVar('book_category_id'),
            'slug' => $slug,
            'cover' => $namaFile
        ]);

        session()->setFlashdata("msg", "Data berhasil diubah!");

        return redirect()->to('/book');
    }

    public function delete($id)
    {
        $dataBook = $this->bookModel->find($id);
        $this->bookModel->delete($id);

        if ($dataBook['cover'] != $this->defaultImage) {
            unlink('img/' . $dataBook['cover']);
        }
        session()->setFlashdata("msg", "Data berhasil dihapus!");
        return redirect()->to('/book');
        // return view('book/delete', $id);
    }
}