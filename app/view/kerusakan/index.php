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
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($kerusakan as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['id_kerusakan'] ?></td>
                                        <td><?= $row['kerusakan'] ?></td>
                                        <td style="white-space: normal;"><?= $row['solusi'] ?></td>
                                        <td style="white-space: normal;"><?= $row['alat'] ?></td>
                                        <td>
                                            <a href="<?= asset("assets/gambar") . "/" . $row['gambar'] ?>" target="_blank" class="btn btn-icon btn-sm btn-primary"><em class="icon ni ni-camera"></em></a>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('Kerusakan/ubahKerusakan/' . $row['id_kerusakan']) ?>" class="btn btn-warning">Edit</a>
                                            <a href="#" onclick="delete_data('<?= $row['id_kerusakan'] ?>', 'Kerusakan/hapusKerusakan')" role="button" class="btn btn-danger">Delete</a>
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