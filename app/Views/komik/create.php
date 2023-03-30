[13.55, 30/3/2023] Cecil: <?= $this->extend('layout/template')  ?>
<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA BUKU</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data Buku</li>
        </ol>
        <!-- start Flash Data -->

        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg')  ?>
            </div>
        <?php endif; ?>
        <!-- End Flash Data -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>
            </div>
            <div class="card-body">
                <a class="btn btn-primary mb-3" type="button" href="/book/create"> Tambah Buku</a>
                <a class="btn btn-dark mb-3" type="button" href="#modalImport" data-bs-toggle="modal">IMPORT BUKU</a>
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($result as $value) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <img src="img/<?= $value['cover'] ?>" alt="" width="100">
                                </td>
                                <td><?= $value['title'] ?></td>
                                <td><?= $value['name_category'] ?></td>
                                <td><?= $value['price'] ?></td>
                                <td><?= $value['stock'] ?></td>
                                <td>
                                    <a class="btn btn-primary" href="/book/<?= $value['slug']  ?>" role="button">Detail</a>
                                    <a class="btn btn-warning" href="/book/edit/<?= $value['slug']  ?>" role="button">Ubah</a>

                                    <form action="<?= base_url('book/' . $value['book_id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" role="button" onclick="confirm('Apakah anda yakin?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection('') ?>
[13.55, 30/3/2023] Cecil: <?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA KOMIK </h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">
                Pengelolaan Data Komik
            </li>
        </ol>
        <?php if (session()->getFlashdata('msg')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('msg') ?>
            </div>
        <?php endif; ?>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                <?= $title ?>

            </div>
            <div class="card-body">
                <!--Tabel Buku-->
                <form action="<?= base_url('/komik/create') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('title') ?
                                                                        'is-invalid' : '' ?>" id="title" name="title" value="<?= old('title') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('title') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="author" class="col-sm-2 col-form-label">Penulis</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control <?= $validation->hasError('author') ?
                                                                        'is-invalid' : '' ?>" id="author" name="author" value="<?= old('author') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('author') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="release_year" class="col-sm-2 col-form-label">Tahun Terbit</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('release_year') ?
                                                                        'is-invalid' : '' ?>" id="release_year" name="release_year" value="<?= old('release_year') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('release_year') ?>
                            </div>
                        </div>
                        <label for="stock" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control <?= $validation->hasError('stock') ?
                                                                            'is-invalid' : '' ?>" id="stock" name="stock" value="<?= old('stock') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('stock') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control <?= $validation->hasError('price') ?
                                                                        'is-invalid' : '' ?>" id="price" name="price" value="<?= old('price') ?>">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('price') ?>
                            </div>
                        </div>
                        <label for="discount" class="col-sm-2 col-form-label">Diskon</label>
                        <div class="col-sm-3">
                            <input type="number" class="form-control" id="discount" name="discount">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="cover" class="col-sm-2 col-form-label">cover</label>
                        <div class="col-sm-5">
                            <input type="file" class="form-control <?= $validation->hasError('cover') ?
                                                                        'is-invalid' : '' ?>" id="cover" name="cover" value="<?= old('cover') ?> " onchange="previewImage()">
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                <?= $validation->getError('cover') ?>
                            </div>
                            <div class="col-sm-6 mt-2">
                                <img src="/img/default.png" alt="" class="img-thumbnail img-preview">
                            </div>
                        </div>
                        <label for="komik_category_id" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-3">
                            <select type="text" class="form-control" id="komik_category_id" name="komik_category_id">
                                <?php foreach ($category as $value) : ?>
                                    <option value="<?= $value['komik_category_id'] ?>">
                                        <?= $value['name_category'] ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit">Simpan</button>
                        <a class="btn btn-danger" type="button" href="/komik">Batal</a>

                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?= $this->endSection() ?>