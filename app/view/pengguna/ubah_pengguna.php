<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Ubah Data Pengguna</h4>
                    </div>
                </div>

            </div>
            <!-- end row -->
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <form autocomplete="off" id="formUbah">
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Pengguna</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukan nama pengguna" name="nama_pengguna" id="nama_pengguna" readonly required value="<?= $pengguna->nama_pengguna ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Masukan nama lengkap" name="nama_lengkap" id="nama_lengkap" required value="<?= $pengguna->nama_lengkap ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Alamat Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="email" placeholder="Masukan @email" name="email" id="email" required value="<?= $pengguna->email ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-search-input" class="col-sm-2 col-form-label">Tipe</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="tipe" id="tipe" required>
                                            <option value="">-Pilih Tipe-</option>
                                            <option <?= ($pengguna->tipe == 1) ? 'selected' : null ?> value="1">Admin</option>
                                            <option <?= ($pengguna->tipe == 2) ? 'selected' : null ?> value="2">Kepala Pelaksana</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Katasandi</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" placeholder="*************" name="katasandi" id="katasandi">
                                        <span class="text-danger">*Kosongkan katasandi apabila tidak diubah</span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success" name="submit">Ubah</button>
                                <a href="<?= url('banjir') ?>" class="btn btn-danger">Kembali</a>

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->

    <script src="<?= base_url() ?>assets/js/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#formUbah').submit(function(e) {
                e.preventDefault();
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