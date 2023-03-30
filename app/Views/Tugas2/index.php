<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>
<main>
    <div class="container-1">
        <div class="jumbotron text-left">
            <h2>Container</h2>
        </div>
        <div class="row">
            <div class="text-center bg-warning">
                <h5>Container 1 - Gambar</h5>
            </div>
            <div class="col-sm-6 bg-primary">
                <div class="text-center">
                    <br>
                    <img src="<?= base_url('mixue.jpeg') ?>" alt="" width="300" height="300" class="rectangle">
                    <p style="font-weight: bold;">Gambar 1</p>
                </div>
            </div>
            <div class="col-sm-6 bg-success">
                <div class="text-center">
                    <br>
                    <img src='<?= base_url('cat.jpeg') ?>' alt="" width="300" height="300" class="rectangle">
                    <p style="font-weight: bold;">Hihi</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 bg-light">
        <h5></h5>
    </div>
    <div class="container-2">
        <div class="row">
            <div class="jumbotron text-center bg-warning">
                <h5>Container 2 - Pesan dan kesan</h5>
            </div>
            <div class="col-sm-7 text-center bg-info">
                <h5>Pengalaman Belajar Siweb :</h5>
                <p>Pesan dan kesan saya selama belajar SIWEB adalah seru, ribet</p>
            </div>
            <div class="col-sm-5 text-center bg-primary">
                <h5> Pesan dan kesan kepada Asdos :</h5>
                <p>Pesan : Gada </p>
                <p>Kesan : Best</p>
            </div>
        </div>
</main>
<?= $this->endSection() ?>