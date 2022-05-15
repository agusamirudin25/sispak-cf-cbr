<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Ubah Data Pengetahuan</h4>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form class="form-validate is-alter" autocomplete="off" id="formUbah">
                                <input type="hidden" name="id" value="<?= $pengetahuan->id ?>">
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gejala">Gejala</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="gejala" id="gejala">
                                                    <option value="">Pilih Gejala</option>
                                                    <?php foreach ($gejala as $g) : ?>
                                                        <option <?= $g['kode_gejala'] == $pengetahuan->kode_gejala ? 'selected' : null ?> value="<?= $g['kode_gejala'] ?>"><?= $g['gejala'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="kerusakan">Kerusakan</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="kerusakan" id="kerusakan">
                                                    <option value="">Pilih Kerusakan</option>
                                                    <?php foreach ($kerusakan as $row) : ?>
                                                        <option <?= $row['kode_kerusakan'] == $pengetahuan->kode_kerusakan ? 'selected' : null ?> value="<?= $row['kode_kerusakan'] ?>"><?= $row['kerusakan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="bobot">Nilai Pakar</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" value="<?= $pengetahuan->bobot ?>" placeholder="Nilai Pakar" id="bobot" name="bobot" required>
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
                url: '<?= url(); ?>Pengetahuan/prosesUbahPengetahuan',
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