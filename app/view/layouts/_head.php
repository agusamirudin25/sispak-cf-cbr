<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>STMIK HORIZON KARAWANG</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Agus Amirudin" name="author" />
    <link rel="shortcut icon" href="<?= asset() ?>assets/images/kharisma.png">

    <link href="<?= asset() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?= asset() ?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
    <link href="<?= asset() ?>assets/css/icons.css" rel="stylesheet" type="text/css">
    <link href="<?= asset() ?>assets/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?= asset() ?>assets/css/sweetalert2.css" rel="stylesheet" type="text/css">
    <link href="<?= asset() ?>assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= asset() ?>assets/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <script src="<?= asset() ?>assets/js/jquery.min.js"></script>
    <script src="<?= asset() ?>assets/js/apexchart.min.js"></script>

</head>

<body>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Top Bar Start -->
        <div class="topbar">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="<?= base_url() ?>" class="logo">
                    <span>
                        <img src="<?= asset() ?>assets/images/kharisma.png" alt="" height="50">
                    </span>
                    <i>
                        <img src="<?= asset() ?>assets/images/kharisma.png" alt="" height="22">
                    </i>
                </a>
            </div>

            <nav class="navbar-custom">

                <ul class="navbar-right d-flex list-inline float-right mb-0">

                    <li class="dropdown notification-list">
                        <div class="dropdown notification-list nav-pro-img">
                            <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?= asset() ?>assets/images/directory-bg.jpg" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <a class="dropdown-item text-danger" href="<?= base_url() ?>/Auth/logout"><i class="mdi mdi-power text-danger"></i> Logout</a>
                            </div>
                        </div>
                    </li>

                </ul>

                <ul class="list-inline menu-left mb-0">
                    <li class="float-left">
                        <button class="button-menu-mobile open-left waves-effect">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>
                </ul>

            </nav>

        </div>
        <!-- Top Bar End -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left side-menu">
            <div class="slimscroll-menu" id="remove-scroll">

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu" id="side-menu">
                        <li class="menu-title">Main</li>
                        <li>
                            <a href="<?= base_url() ?>Dashboard" class="waves-effect">
                                <i class="mdi mdi-view-dashboard"></i><span> Dashboard </span>
                            </a>
                        </li>
                        <?php if (session_get('type') == 1) : ?>
                            <li>
                                <a href="<?= base_url() ?>Pengguna" class="waves-effect">
                                    <i class="mdi mdi-account-settings-variant"></i><span> Pengguna </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-areaspline"></i><span> Data Bencana <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span></a>
                                <ul class="submenu">
                                    <li><a href="<?= base_url() ?>banjir">Banjir</a></li>
                                    <li><a href="<?= base_url() ?>GempaBumi">Gempa Bumi</a></li>
                                    <li><a href="<?= base_url() ?>TanahLongsor">Tanah Longsor</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <li>
                            <a href="<?= base_url() ?>Wilayah" class="waves-effect"><i class="mdi mdi-map-marker"></i><span> Wilayah </span></a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Dataset" class="waves-effect"><i class="mdi mdi-calendar-check"></i><span> Dataset Bencana </span></a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Clustering" class="waves-effect"><i class="mdi mdi-apps"></i><span> Clustering </span></a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>Auth/logout" class="waves-effect"><i class="mdi mdi-logout"></i><span> Logout </span></a>
                        </li>

                    </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>