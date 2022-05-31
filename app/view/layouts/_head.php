<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?= $title ?>">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?= asset('assets/images/favicon.png') ?>">
    <!-- Page Title  -->
    <title>Sistem Pakar Diagnosis Kerusakan</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= asset('assets/css/dashlite.css?ver=2.2.0') ?>">
    <link id="skin-default" rel="stylesheet" href="<?= asset('assets/css/theme.css?ver=2.2.0') ?>">

    <script src="<?= asset('assets/js/bundle.js?ver=2.2.0') ?>"></script>
    <script src="<?= asset('assets/js/scripts.js?ver=2.2.0') ?>"></script>
</head>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="<?= base_url('/') ?>" class="logo-link nk-sidebar-logo">
                            <h3 class="text-white">SISPAK</h3>
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <?php if(session_get('type') == 1) : ?>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Dashboard/index') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                        <span class="nk-menu-text">Dashboard</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Pengguna/index') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-user"></em></span>
                                        <span class="nk-menu-text">Data Pengguna</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Gejala') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-cpu"></em></span>
                                        <span class="nk-menu-text">Data Gejala</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Kerusakan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-virus"></em></span>
                                        <span class="nk-menu-text">Data Kerusakan</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Pengetahuan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                        <span class="nk-menu-text">Pengetahuan</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Diagnosis') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-cc-alt"></em></span>
                                        <span class="nk-menu-text">Diagnosis</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Konsultasi') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                        <span class="nk-menu-text">Konsultasi</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Laporan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-reports-alt"></em></span>
                                        <span class="nk-menu-text">Laporan</span>
                                    </a>
                                </li>
                                <?php endif; ?>

                                <?php if(session_get('type') == 2) : ?>
                                    <li class="nk-menu-item">
                                        <a href="<?= base_url('Dashboard/index') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-dashlite"></em></span>
                                            <span class="nk-menu-text">Dashboard</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="<?= base_url('Pengetahuan') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                            <span class="nk-menu-text">Pengetahuan</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="<?= base_url('Konsultasi') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                            <span class="nk-menu-text">Konsultasi</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="<?= base_url('Laporan') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt"></em></span>
                                            <span class="nk-menu-text">Laporan</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php if(session_get('type') == 3) : ?>
                                    <li class="nk-menu-item">
                                        <a href="<?= base_url('Diagnosis') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt"></em></span>
                                            <span class="nk-menu-text">Diagnosis</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="<?= base_url('Konsultasi') ?>" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-cc-alt2-fill"></em></span>
                                            <span class="nk-menu-text">Konsultasi</span>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Auth/logout') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                                        <span class="nk-menu-text">Logout</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Dashboard/bantuan') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon"><em class="icon ni ni-book-fill"></em></span>
                                        <span class="nk-menu-text">Bantuan</span>
                                    </a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?= base_url('Dashboard/tentang') ?>" class="nk-menu-link">
                                        <span class="nk-menu-icon">
                                            <em class="icon ni ni-template-fill"></em>
                                        </span>
                                        <span class="nk-menu-text">Tentang</span>
                                    </a>
                                </li>
                            </ul><!-- .nk-menu -->
                        </div><!-- .nk-sidebar-menu -->
                    </div><!-- .nk-sidebar-content -->
                </div><!-- .nk-sidebar-element -->
            </div>
            <!-- sidebar @e -->
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ml-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                           
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status"><?= session_get('nama') ?></div>
                                                    <div class="user-name dropdown-indicator"><?= session_get('nama') ?></div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="<?= base_url('Auth/logout') ?>"><em class="icon ni ni-signout"></em><span>Log out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li><!-- .dropdown -->
                                </ul><!-- .nk-quick-nav -->
                            </div><!-- .nk-header-tools -->
                        </div><!-- .nk-header-wrap -->
                    </div><!-- .container-fliud -->
                </div>
                <!-- main header @e -->
                