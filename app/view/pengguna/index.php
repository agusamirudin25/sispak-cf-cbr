<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Data Pengguna</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                            <h4 class="mt-0 header-title m-b-30">Data Pengguna</h4>
                            <a href="<?= url('Pengguna/tambahPengguna') ?>" class="btn btn-primary float-right">Tambah Data</a>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengguna as $row) :
                                        $tipe = ($row['tipe'] == 1) ? 'Admin' : 'Kepala Pelaksana';
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $row['nama_pengguna'] ?></td>
                                            <td><?= $row['nama_lengkap'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $tipe ?></td>
                                            <td>
                                                <a class="btn btn-primary waves-effect waves-light" href="<?= url('Pengguna/ubahPengguna/' . $row['nama_pengguna']) ?>" role="button">Ubah</a>
                                                <a class="btn btn-danger waves-effect waves-light" href="#" onclick="delete_data('<?= $row['nama_pengguna'] ?>', 'Pengguna/hapusPengguna')" role="button">Hapus</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div> <!-- content -->

    <script src="<?= base_url() ?>assets/js/sweetalert2.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });
    </script>