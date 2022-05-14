<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Ubah Data Solusi</h4>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form class="form-validate is-alter" autocomplete="off" id="formUbah">
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="kode_solusi">Kode Gejala</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" placeholder="Kode Gejala" value="<?= $solusi->kode_solusi ?>" readonly id="kode_solusi" name="kode_solusi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="solusi">Nama Solusi</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?= $solusi->solusi ?>" placeholder="Nama solusi" id="solusi" name="solusi" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="alat">Alat</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?= $solusi->alat ?>" placeholder="Alat yang digunakan" id="alat" name="alat" required>
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
            var data = new FormData(this);
            $.ajax({
                url: '<?= url(); ?>Solusi/prosesUbahSolusi',
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