<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="title nk-block-title">Tambah Data Pengetahuan</h4>
                        </div>
                    </div>
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <form class="form-validate is-alter" autocomplete="off" id="formTambah">
                                <div class="row g-gs">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="gejala">Gejala</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="gejala" id="gejala" required>
                                                    <option value="">Pilih Gejala</option>
                                                    <?php foreach ($gejala as $g) : ?>
                                                        <option value="<?= $g['id_gejala'] ?>"><?= $g['gejala'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="kerusakan">Kerusakan</label>
                                            <div class="form-control-wrap">
                                                <select class="form-control" name="kerusakan" id="kerusakan" required>
                                                    <option value="">Pilih Kerusakan</option>
                                                    <?php foreach ($kerusakan as $row) : ?>
                                                        <option value="<?= $row['id_kerusakan'] ?>"><?= $row['kerusakan'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label" for="bobot">Nilai Pakar</label>
                                            <div class="form-control-wrap">
                                                <select id="bobot" class="form-control" name="bobot" required>
                                                <?php foreach ($bobot as $row) : ?>
                                                    <option value="<?= $row['nilai'] ?>"><?= $row['keterangan'] ?></option>
                                                <?php endforeach; ?>
                                                </select>
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
        $('#formTambah').submit(function(e) {
            e.preventDefault();
            var gejala = $('#gejala').val();
            var kerusakan = $('#kerusakan').val();
            var bobot = $('#bobot').val();
            // validasi form
            if(gejala == '' || kerusakan == '' || bobot == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Semua form harus diisi!'
                });
                return false;
            }
            var data = new FormData(this);
            $.ajax({
                url: '<?= url(); ?>Pengetahuan/prosesTambahPengetahuan',
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