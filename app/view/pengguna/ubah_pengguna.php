<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Ubah Data Pengguna</h4>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form class="form-validate is-alter" autocomplete="off" id="formUbah">
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="nama_lengkap">Nama Lengkap</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?= $pengguna->nama_lengkap ?>" placeholder="Nama Lengkap" id="nama_lengkap" name="nama_lengkap" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="email">Username</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" placeholder="Username" id="email" value="<?= $pengguna->username ?>" readonly name="email" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="tipe">Tipe</label>
                                            <div class="form-control-wrap ">
                                                <select class="form-control form-select" id="tipe" name="tipe" data-placeholder="Pilih Tipe" required>
                                                    <option label="empty" value=""></option>
                                                    <?php foreach($role as $row) : ?>
                                                        <option <?= $pengguna->tipe == $row['id_role'] ? 'selected' : null ?> value="<?= $row['id_role'] ?>"><?= $row['role'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="password">Password</label>
                                            <div class="form-control-wrap">
                                                <input type="password" class="form-control" placeholder="Masukan Password" id="password" name="password">
                                                <small class="text-info">*Kosongkan password apabila tidak akan mengubahnya</small>                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                                            <a href="javascript:history.back()" class="btn btn-lg btn-warning">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#formUbah').submit(function(e) {
            e.preventDefault();
            var nama_lengkap = $('#nama_lengkap').val();
            var email = $('#email').val();
            var tipe = $('#tipe').val();
            // validate input
            if(nama_lengkap == '' || email == '' || tipe == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua form harus diisi!'
                });
                return false;
            }
            var data = new FormData(this);
            $.ajax({
                url: '<?= url(); ?>Pengguna/prosesUbahPengguna',
                type: "post",
                data: data,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function(response) {
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.msg,
                        }).then(function() {
                            window.location = "<?= url() ?>" + response.page;
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.msg,
                        })
                    }
                }
            });
        });
    });
</script>