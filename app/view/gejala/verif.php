<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Verifikasi Data Gejala</h4>
                            <a href="<?= base_url('Gejala/tambahGejala') ?>" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Gejala</th>
                                        <th>Gejala</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($gejala as $row):
                                    $statusVerif = ""; 
                                    if($row['status'] == 0){
                                        $statusVerif = '<span class="badge badge-info">Belum verifikasi</span>';
                                    }elseif($row['status'] == 1){
                                        $statusVerif = '<span class="badge badge-success">Terverifikasi</span>';
                                    }else{
                                        $statusVerif = '<span class="badge badge-danger">Ditolak</span>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['id_gejala'] ?></td>
                                        <td><?= $row['gejala'] ?></td>
                                        <td><?= $statusVerif ?></td>
                                        <td>
                                            <?php if($row['status'] == 0) : ?>
                                            <a href="#" onclick="verif_data('<?= $row['id_gejala'] ?>', 'Gejala/prosesVerifGejala', 'Apakah Anda yakin verifikasi data ini?', '1')" role="button" class="btn btn-warning">Verifikasi</a>
                                            <a href="#" onclick="verif_data('<?= $row['id_gejala'] ?>', 'Gejala/prosesVerifGejala', 'Apakah Anda yakin verifikasi data ini?', '-1')" role="button" class="btn btn-danger">Tolak</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->