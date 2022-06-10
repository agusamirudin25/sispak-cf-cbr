<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Verifikasi Data Kerusakan</h4>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kerusakan (Kode)</th>
                                        <th>Solusi</th>
                                        <th>Alat</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach($kerusakan as $row):
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
                                        <td style="white-space: normal;"><?= "({$row['id_kerusakan']}) {$row['kerusakan']}" ?></td>
                                        <td style="white-space: normal;"><?= $row['solusi'] ?></td>
                                        <td style="white-space: normal;"><?= $row['alat'] ?></td>
                                        <td>
                                            <a href="<?= asset("assets/gambar") . "/" . $row['gambar'] ?>" target="_blank" class="btn btn-icon btn-sm btn-primary"><em class="icon ni ni-camera"></em></a>
                                        </td>
                                        <td><?= $statusVerif ?></td>
                                        <td>
                                            <?php if($row['status'] == 0) : ?>
                                            <a href="#" onclick="verif_data('<?= $row['id_kerusakan'] ?>', 'Kerusakan/prosesVerifKerusakan', 'Apakah Anda yakin verifikasi data ini?', '1')" role="button" class="btn btn-warning">Verifikasi</a>
                                            <a href="#" onclick="verif_data('<?= $row['id_kerusakan'] ?>', 'Kerusakan/prosesVerifKerusakan', 'Apakah Anda yakin menolak data ini?', '-1')" role="button" class="btn btn-danger">Tolak</a>
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