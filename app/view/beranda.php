<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Integrasi k-means clustering dan Sistem Informasi Geografis Daerah Rawan Bencana Alam</title>
    <meta content="" name="description">

    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= asset() ?>assets/beranda/img/horizon.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= asset() ?>assets/beranda/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= asset() ?>assets/beranda/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= asset() ?>assets/beranda/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= asset() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= asset() ?>assets/beranda/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= asset() ?>assets/beranda/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <style>
        .pdfobject-container {
            height: 30rem;
            /* width: 50rem; */
        }
    </style>
    <!-- Template Main CSS File -->
    <link href="<?= asset() ?>assets/beranda/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

            <a href="index.html" class="logo d-flex align-items-center">
                <img src="<?= asset() ?>assets/beranda/img/horizon.png" alt="Logo horizon" id="logo-horizon">
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                    <li><a class="nav-link scrollto" href="#features">Tentang</a></li>
                    <li><a class="nav-link scrollto" href="#footer">Panduan</a></li>
                    <li><a class="getstarted scrollto" href="<?= url('Auth/login') ?>">Login</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">Implementasi <i>k-means clustering</i> dan Sistem Informasi Geografis Daerah Rawan
                        Bencana Alam</h1>
                    </h2>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="<?= asset() ?>assets/beranda/img/login-new.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <!-- ======= Features Section ======= -->
        <section id="features" class="features">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Data Mining</h2>
                    <p>proses yang menggunakan teknik statistik, matematika, kecerdasan buatan, <i>machine learning</i> untuk
                        mengekstraksi dan mengidentifikasi informasi yang bermanfaat dan pengetahuan yang terkait dari berbagai
                        <i>database</i> besar
                    </p>
                </header>

                <div class="row">

                    <div class="col-lg-6">
                        <img src="<?= asset() ?>assets/beranda/img/features.png" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
                        <div class="row align-self-center gy-4">

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Data Selection</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Pre-processing / Cleaning</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Data Transformation</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Data Mining</h3>
                                </div>
                            </div>

                            <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                                <div class="feature-box d-flex align-items-center">
                                    <i class="bi bi-check"></i>
                                    <h3>Interpretation / evalution</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> <!-- / row -->

                <!-- Feature Tabs -->
                <div class="row feture-tabs" data-aos="fade-up">
                    <div class="col-lg-6">
                        <h3>Sistem Informasi Geografis</h3>

                        <!-- Tabs -->
                        <ul class="nav nav-pills mb-3">
                            <li>
                                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">SIG</a>
                            </li>
                        </ul><!-- End Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content">

                            <div class="tab-pane fade show active" id="tab1">
                                <p>Sistem informasi berbasis komputer untuk mengelola, menganalisis dan menyimpan, serta memanggil data bereferensi geografis yang berkembang pesat</p>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Dapat digunakan dalam visualisasi dan pemetaan daerah atau geografi</h4>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="bi bi-check2"></i>
                                    <h4>Proses pengolahan data yang ditujukan untuk menghasilkan informasi dalam bentuk peta</h4>
                                </div>
                            </div><!-- End Tab 1 Content -->
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <img src="<?= asset() ?>assets/beranda/img/web-1.png" class="img-fluid" alt="">
                    </div>

                </div><!-- End Feature Tabs -->

            </div>

        </section><!-- End Features Section -->

        <!-- ======= Team Section ======= -->
        <section id="team" class="team">

            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Team</h2>
                </header>

                <div class="row gy-4">
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="<?= asset() ?>assets/beranda/img/agus.png" class="img-fluid" alt="foto agus" style="width: 85%;">
                            </div>
                            <div class="member-info">
                                <h4>Agus Amirudin</h4>
                                <span>Mahasiswa</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="member-img">
                                <img src="<?= asset() ?>assets/beranda/img/pak-supri.jpg" class="img-fluid" alt="foto pak supri" style="width: 60%;">
                            </div>
                            <div class="member-info">
                                <h4>Supriyadi, S.T., M.Kom.</h4>
                                <span>Dosen Pembimbing 1</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="member-img">
                                <img src="<?= asset() ?>assets/beranda/img/bu-yessy.jpg" class="img-fluid" alt="foto bu yessy" style="width: 50%;">
                            </div>
                            <div class="member-info">
                                <h4>Yessy Yanitasari, S.T., M.Kom.</h4>
                                <span>Dosen Pembimbing 2</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- End Team Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <h4>Panduan Penggunaan</h4>
                    </div>
                    <div class="col-lg-6 text-center">
                        <form action="">
                            <a href="#" class="btn btn-primary ms-2" data-bs-toggle="modal" data-bs-target="#panduanModal">Lihat Panduan</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <img src="<?= asset() ?>assets/beranda/img/horizon.png" alt="Logo STMIK Horizon" id="" style="width: 50%;">
                        </a>
                        <h4>Alamat</h4>
                        <p>
                            Jl. Pangkal Perjuangan Km.1 By Pass Karawang
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                © <?= date('Y') ?> STMIK HORIZON - <span class="d-none d-sm-inline-block"> Dibuat dengan <i class="mdi mdi-heart text-danger"></i> oleh Amirudin</span>.
            </div>
        </div>
        </div>
    </footer><!-- End Footer -->
    <!-- Modal -->
    <div class="modal fade" id="panduanModal" tabindex="-1" aria-labelledby="panduanModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="panduanModalLabel">Panduan Penggunaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="pdfPanduan"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= asset() ?>assets/beranda/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?= asset() ?>assets/beranda/vendor/aos/aos.js"></script>
    <script src="<?= asset() ?>assets/beranda/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= asset() ?>assets/beranda/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= asset() ?>assets/beranda/js/pdfobject.min.js"></script>
    <script>
        PDFObject.embed("<?= asset() ?>assets/beranda/panduan_penggunaan.pdf", "#pdfPanduan");
    </script>
    <script src="<?= asset() ?>assets/beranda/js/main.js"></script>

</body>

</html>