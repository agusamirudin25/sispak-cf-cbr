<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Data Solusi</h4>
                            <a href="<?= base_url('Solusi/tambahSolusi') ?>" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Solusi</th>
                                        <th>Solusi</th>
                                        <th>Nilai Pakar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($solusi as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['kode_solusi'] ?></td>
                                        <td><?= $row['solusi'] ?></td>
                                        <td><?= $row['alat'] ?></td>
                                        <td>
                                            <a href="<?= base_url('Solusi/ubahSolusi/' . $row['kode_solusi']) ?>" class="btn btn-warning">Edit</a>
                                            <a href="#" onclick="delete_data('<?= $row['kode_solusi'] ?>', 'Solusi/hapusSolusi')" role="button" class="btn btn-danger">Delete</a>
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