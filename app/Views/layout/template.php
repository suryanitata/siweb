<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="<?= base_url() ?>/css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.11/jquery.min.js"></script>
    <?php if (!empty($result->css_files)) : ?>
        <?php
        foreach ($css_files as $file) : ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>

<body class="sb-nav-fixed">

    <!-- load Topbar modul 5 -->
    <?= $this->include('layout/topbar') ?>
    <!-- load Topbar modul 5 -->

    <div id="layoutSidenav">
        <!-- load Sidebar modul 5 -->
        <?= $this->include('layout/sidebar') ?>
        <!-- load Sidebar modul 5 -->
        <div id="layoutSidenav_content">

            <!-- Halaman Dashboard -->
            <?= $this->renderSection('content') ?>
            <!-- End Of Main Aka COntent -->

            <footer class="py-4 bg-light mt-auto">
                <!-- Footer -->
                <?= $this->renderSection('layout/footer') ?>
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#"> Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
                <!-- End Footer -->
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/js/datatables-simple-demo.js"></script>

    <script>
        function previewImage() {
            const sampul = document.querySelector('#cover');
            const imgPreview = document.querySelector('.img-preview');
            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);
            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
    <?php if (!empty($result->css_files)) : ?>
        <?php foreach ($js_files as $file) : ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
    <?php endif ?>
</body>

</html>