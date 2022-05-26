<link rel="stylesheet" href="<?= asset('assets/css/dashlite.css?ver=2.2.0') ?>">
<body>
    <div class="container" style="margin-top: 15rem;">
        <h2 style="text-align: center;">Laporan Bulan <?= $bulan ?> Tahun <?= $tahun ?></h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Nama Kerusakan (Hasil)</th>
                    <th>Hasil Diagnosis</th>
                    <th>Tanggal Diagnosis</th>
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
                    <td><?= tgl_indo(date('Y-m-d', strtotime($row['created_at']))) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <script>
        window.print();
    </script>
</body>