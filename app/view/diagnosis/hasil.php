<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Hasil Diagnosis</h4>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <h6>Gejala</h6>
                            <hr>
                            <table class="nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gejala</th>
                                        <th>Bobot Pakar</th>
                                        <th>Bobot Customer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($gejala as $Key => $value) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $value['gejala'] ?></td>
                                            <td><?= $value['bobot'] ?></td>
                                            <td><?= $input[$value['id_gejala']] ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                            <div class="nk-divider divider md"></div>
                            <div class="nk-block">
                                <div class="nk-block-head nk-block-head-sm nk-block-between">
                                    <h6 class="title">Kerusakan</h6>
                                </div><!-- .nk-block-head -->
                                <div class="bq-note">
                                    <div class="bq-note-item">
                                        <div class="bq-note-meta">
                                            <h4>
                                                <span class="bq-note-added"><?= $kerusakan->kerusakan ?></span>
                                            </h4>
                                        </div>
                                        <div class="bq-note-text">
                                            <p>Solusi:</p>
                                            <p><?= $kerusakan->solusi ?></p>
                                            <p>Alat:</p>
                                            <p><?= $kerusakan->alat ?></p>
                                        </div>
                                    </div><!-- .bq-note-item -->
                                </div><!-- .bq-note -->
                            </div>
                            <div class="nk-divider divider md"></div>
                            <h6>Perhitungan CF</h6>
                            <p>1. Perkalian nilai bobot pakar dengan nilai bobot customer CF (H ; E) = CF [H] * CF [E]</p>
                            <?php foreach($keterangan_perkalian_cf as $key => $row) : ?>
                                <p>CF[H,E]<?= $key + 1 ?> = CF[H]<?= $key + 1 ?> * CF[E]<?= $key + 1 ?></p>
                                <p> = <?= $row . ' = ' . $nilai_perkalian_cf[$key]['nilai'] ?> </p>
                            <?php endforeach; ?>
                            <p>2. Menentukan CF Combine CFcombine =  CF[H,E]1,2 = CF[H,E]1 + CF[H,E]2 * (1 – CF[H,E]1)</p>
                            <?php foreach($keterangan_cf_combine as $key => $row) : ?>
                                <p> <?= $row ?> = <?= $nilai_cf_combine[$key] ?></p>
                            <?php endforeach; ?>
                            <h5>Hasil perhitungan dari kerusakan <?= $kerusakan->kerusakan ?> mempunyai nilai <?= $hasil_cf ?> di presentase kan menjadi <?= $persentase_hasil_cf ?></h5>
                            <div class="nk-divider divider md"></div>
                            <h6>Perhitungan CBR</h6>
                            <p>Menentukan nilai similirity Similarity = S1 * W1 + W2 +… … + Sn * Wn / W1 + W2 +… … + Wn</p>
                            <?php 
                            $perkalian_cbr = '';
                            foreach($keterangan_cbr as $key => $row) : ?>
                            <?php if($key == 0) : ?>
                                <?php $perkalian_cbr = "((${row})" ?>
                            <?php else : ?>
                                <?php $perkalian_cbr .= " + (${row})" ?>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <p><?= $perkalian_cbr . ') / ' . $total_similarity ?></p>
                            <p> = <?= $keterangan_perhitungan_cbr ?></p>
                            <h5>Hasil similarity dari kode kerusakan <?= $kerusakan->kerusakan ?> mempunyai nilai <?= $hasil_cbr ?> di presentasekan menjadi <?= $persentase_hasil_cbr ?>.</h5>
                        </div>
                    </div><!-- .card-preview -->
                </div> <!-- nk-block -->
            </div>
        </div>
    </div>
</div>
<!-- content @e -->