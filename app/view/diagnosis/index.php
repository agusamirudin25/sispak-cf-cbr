<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Diagnosis</h4>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <form action="" id="formDiagnosis" method="post">
                                <p>Silakan pilih Gejala berikut:</p>
                                <?php foreach ($gejala as $row) : ?>
                                    <div class="row mt-2">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" name="gejala[]" value="<?= $row['kode_gejala'] ?>" class="custom-control-input form-control" id="gejala<?= $row['kode_gejala'] ?>" onchange="showHide(this)">
                                                    <label class="custom-control-label" for="gejala<?= $row['kode_gejala'] ?>"><?= $row['gejala'] ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select id="bobot<?= $row['kode_gejala'] ?>" class="form-control bobot" style="display: none;">
                                                <?php foreach ($bobot as $row) : ?>
                                                    <option value="<?= $row['nilai'] ?>"><?= $row['keterangan'] ?></option>
                                                <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="col-md-12 mt-4">
                                    <button type="submit" class="btn btn-success">Diagnosis</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->
<script>
    $(document).ready(function() {
        $('#formDiagnosis').submit(function(e) {
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: '<?= base_url('diagnosis/prosesDiagnosis') ?>',
                type: 'POST',
                data: data,
                success: function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.msg,
                        }).then(function() {
                            window.location.href = '<?= base_url('diagnosis/hasilDiagnosis') ?>';
                        })
                    } else {
                        alert(res.msg);
                    }
                }
            });
        });
    });

    function showHide(id){
        var id = id.id;
        var idBobot = id.replace('gejala', 'bobot');
        var bobot = $('#' + idBobot);
        if ($(`#${id}`).is(':checked')) {
            bobot.show();
            // add atribute name to select
            bobot.attr('name', 'bobot[]');
        } else {
            // remove attribute name to select
            bobot.removeAttr('name');
            bobot.hide();
        }
    }
</script>