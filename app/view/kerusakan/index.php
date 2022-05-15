<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Data Kerusakan</h4>
                            <a href="<?= base_url('Kerusakan/tambahKerusakan') ?>" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kerusakan</th>
                                        <th>Kerusakan</th>
                                        <th>Solusi</th>
                                        <th>Alat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($kerusakan as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['kode_kerusakan'] ?></td>
                                        <td><?= $row['kerusakan'] ?></td>
                                        <td><?= $row['solusi'] ?></td>
                                        <td><?= $row['alat'] ?></td>
                                        <td>
                                            <a href="<?= base_url('Kerusakan/ubahKerusakan/' . $row['kode_kerusakan']) ?>" class="btn btn-warning">Edit</a>
                                            <a href="#" onclick="delete_data('<?= $row['kode_kerusakan'] ?>', 'Kerusakan/hapusKerusakan')" role="button" class="btn btn-danger">Delete</a>
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