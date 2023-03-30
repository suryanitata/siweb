<?= $this->extend('layout/template')  ?>
<?= $this->section('content') ?>
<main>
    <div class="container">
        <h1>Container</h1>
        <div class="row bg-warning" style="height: 60vh;">
            <div class="col-4 d-flex flex-column align-items-center justify-content-center gap-y-0">
                <img src="<?= base_url('aku.jpg') ?>" alt="" width="100" height="100" class="rounded-circle">
                <p></p>
                <strong class="font-weight-bold">Biodata</strong>
                <p class="mt-2 mb-0">Nama : Cecilia Aprillia Nathania</p>
                <p class="mb-0">TTL : Brebes, 25 April 2004</p>
                <p class="mb-0">NPM : 211711533</p>

            </div>
            <div class="col-8 p-3">
                <div class="bg-primary h-100 d-flex flex-column align-items-center justify-content-center GAP-y-0">
                    <img src='<?= base_url('UAJY2.png') ?>' alt="" width="200" height="200" style="object-fit: contain;">
                    <strong style="margin-top: 0px;">UAJY</strong>
                    <p class="mt-6" style="margin-top: 0px;">Seru, nyaman, dan fasilitasnya lengkap </p>
                </div>

            </div>
        </div>
</main>
<?= $this->endSection() ?>