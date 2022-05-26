<!-- content @s -->
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h4 class="nk-block-title">Laporan</h4>
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Filter</h6>
                                    <form action="" method="get">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label" for="bulan">Bulan</label>
                                                    <select class="form-control" name="bulan" id="bulan">
                                                        <?php
                                                        for ($i = 1; $i <= 12; $i++) {
                                                            $nama_bulan = bulan($i);
                                                            echo "<option value='$i' " . ">$nama_bulan</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label class="control-label">Tahun</label>
                                                    <select class="form-control" name="tahun">
                                                        <?php
                                                        $tahun = date('Y');
                                                        for ($i = $tahun; $i >= $tahun - 10; $i--) {
                                                            echo "<option value='$i'>$i</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div><!-- Row -->
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary submit">Filter</button>
                                                <a href="<?= base_url($link_cetak) ?>" class="btn btn-success text-white">Cetak</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div class="card-inner">
                            <table id="table" class="datatable-init nowrap table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Nama Penyakit</th>
                                        <th>Hasil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($diagnosis as $row) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['nama_lengkap'] ?></td>
                                            <td><?= $row['nama_kerusakan'] ?></td>
                                            <td><?= 'CF = ' . $row['nilai_cf'] . '<br>' . 'CBR = ' . $row['nilai_cbr'] ?></td>
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