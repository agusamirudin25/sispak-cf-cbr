<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Ubah Data Kerusakan</h4>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form class="form-validate is-alter" autocomplete="off" id="formUbah" enctype="multipart/form-data">
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="kode_kerusakan">Kode Kerusakan</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" placeholder="Kode Kerusakan" value="<?= $kerusakan->id_kerusakan ?>" readonly id="kode_kerusakan" name="kode_kerusakan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="kerusakan">Nama Kerusakan</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" placeholder="Nama Kerusakan" value="<?= $kerusakan->kerusakan ?>" id="kerusakan" name="kerusakan" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="solusi">Solusi</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?= $kerusakan->solusi ?>" placeholder="Solusi" id="solusi" name="solusi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="alat">Alat</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?= $kerusakan->alat ?>" placeholder="Alat" id="alat" name="alat" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gambar">Gambar</label>
                                            <div class="form-control-wrap">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="gambar" name="gambar">
                                                    <label class="custom-file-label" for="gambar">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($kerusakan->gambar) : ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gambar">Gambar Sebelumnya</label>
                                            <div class="form-control-wrap">
                                                <img src="<?= base_url('assets/gambar/'.$kerusakan->gambar) ?>" width="100%">
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                                                       
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
            var kode_kerusakan = $('#kode_kerusakan').val();
            var kerusakan = $('#kerusakan').val();
            var solusi = $('#solusi').val();
            var alat = $('#alat').val();
            // validasi form
            if(kode_kerusakan == '' || kerusakan == '' || solusi == '' || alat == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua form harus diisi!'
                });
                return false;
            }
            var data = new FormData(this);
            $.ajax({
                url: '<?= url(); ?>Kerusakan/prosesUbahKerusakan',
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