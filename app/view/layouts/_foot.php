 <footer class="footer">
     © <?= date('Y') ?> STMIK HORIZON - <span class="d-none d-sm-inline-block"> Crafted with <i class="mdi mdi-heart text-danger"></i> by Amirudin</span>.
 </footer>

 </div>


 </div>
 <!-- END wrapper -->
 <!-- jQuery  -->
 <script src="<?= asset() ?>assets/js/bootstrap.bundle.min.js"></script>
 <script src="<?= asset() ?>assets/js/metisMenu.min.js"></script>
 <script src="<?= asset() ?>assets/js/jquery.slimscroll.js"></script>
 <script src="<?= asset() ?>assets/js/waves.min.js"></script>

 <script src="<?= asset() ?>assets/js/jquery.sparkline.min.js"></script>
 <script src="<?= asset() ?>assets/js/bootstrap-filestyle.min.js"></script>
 <!-- App js -->
 <script src="<?= asset() ?>assets/js/app.js"></script>

 <script>
     function delete_data(id, ajax) {
         Swal.fire({
             title: "Skripsi k-means",
             text: "Apakah Anda Yakin ?",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Hapus'
         }).then((result) => {
             if (result.value) {
                 var string = 'id=' + id;
                 $.ajax({
                     type: 'POST',
                     url: "<?= url() ?>" + ajax,
                     data: string,
                     cache: false,
                     dataType: 'json',
                     success: function(data) {
                         if (data.status == 1) {
                             Swal.fire(
                                 "Skripsi k-means",
                                 'Berhasil dihapus.',
                                 'success'
                             ).then(function() {
                                 window.location = "<?= base_url() ?>" + data.page;
                             })
                         }
                     }
                 });

             }
         })
     }
 </script>

 </body>

 </html>