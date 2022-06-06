<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Data Konsultasi</h4>
                            <?php if(session_get('type') == 3) : ?>
                                <a href="<?= base_url('Konsultasi/tambahKonsultasi') ?>" class="btn btn-primary">Tambah Konsultasi</a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($konsultasi as $row): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['pertanyaan'] ?></td>
                                        <td><?= $row['nama_lengkap'] ?></td>
                                        <td>
                                            <a href="<?= base_url('Konsultasi/detailKonsultasi/' . $row['id_konsultasi']) ?>" class="btn btn-warning">Lihat</a>
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