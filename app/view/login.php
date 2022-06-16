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
    <title>Login | <?= $title ?></title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?= asset('assets/css/dashlite.css?ver=2.2.0') ?>">
    <link id="skin-default" rel="stylesheet" href="<?= asset('assets/css/theme.css?ver=2.2.0') ?>">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-split nk-split-page nk-split-md">
                        <div class="nk-split-content nk-block-area nk-block-area-column bg-white">
                            <div class="absolute-top-right d-lg-none p-3 p-sm-5">
                                <a href="#" class="toggle btn-white btn btn-icon btn-light" data-target="athPromo"><em class="icon ni ni-info"></em></a>
                            </div>
                            <div class="nk-block nk-block-middle nk-auth-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Login</h5>
                                        <div class="nk-block-des">
                                            <p>Silakan masukan email dan password kamu untuk menggunakan aplikasi ini.</p>
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <form method="post" id="formLogin" autocomplete="off">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="default-01">Username</label>
                                        </div>
                                        <input type="text" name="email" id="email" class="form-control form-control-lg" placeholder="Masukan username kamu">
                                    </div><!-- .foem-group -->
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch" data-target="password">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Masukan password kamu">
                                        </div>
                                    </div><!-- .foem-group -->
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Login</button>
                                    </div>
                                </form><!-- form -->
                                <div class="form-note-s2 pt-4"> Belum punya akun? <a href="<?= base_url('auth/register') ?>">Buat Akun</a>
                                </div>
                            </div><!-- .nk-block -->
                            <div class="nk-block nk-auth-footer">
                                <div class="mt-3">
                                    <p>&copy; <?= date('Y') ?> Sistem Pakar Mendiagnosa Kerusakan Pada Mesin Mobil Matic.</p>
                                </div>
                            </div><!-- .nk-block -->
                        </div><!-- .nk-split-content -->
                        
                    </div><!-- .nk-split -->
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="<?= asset('assets/js/bundle.js?ver=2.2.0') ?>"></script>
    <script src="<?= asset('assets/js/scripts.js?ver=2.2.0') ?>"></script>
    <script src="<?= asset('assets/js/helpers.js?ver=23') ?>"></script>
    <script>
        const BASE_URL = "<?= base_url() ?>";
        $('#formLogin').submit(function(e) {
            e.preventDefault();
            let user = $('#email').val();
            let pass = $('#password').val();
            if (user.length == 0) {
                error_alert('Error', 'Email tidak boleh kosong')
                $("#email").focus();
                return false;
            }
            if (pass.length == 0) {
                $("#password").focus();
                error_alert('Error', 'Password tidak boleh kosong')
                return false;
            }
            $.ajax({
                url: '<?= url() ?>Auth/cek_login',
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                dataType: "json",
                success: function(data) {
                    if (data.login_status == 1) {
                        success_alert("Berhasil", data.msg, BASE_URL + data.page);
                    } else {
                        error_alert("Gagal", data.msg);
                    }
                }
            });
        });
    </script>

</html>