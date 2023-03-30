<?= $this->extend('layout/template')  ?>
<?= $this->section('content') ?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">DATA KOMIK</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Pengelolaan Data Komik</li>
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
                <a class="btn btn-primary mb-3" type="button" href="/komik/create"> Tambah Komik</a>
                <a class="btn btn-dark mb-3" type="button" href="#modalImport" data-bs-toggle="modal">IMPORT KOMIK</a>
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
                                    <a class="btn btn-primary" href="<?= base_url('/komik/' . $value['slug'])  ?>" role="button">Detail</a>
                                    <a class="btn btn-warning" href="<?= base_url('/komik/edit/' . $value['slug'])  ?>" role="button">Ubah</a>
                                    <form action="<?= base_url('komik/' . $value['komik_id']) ?>" method="post" class="d-inline">
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