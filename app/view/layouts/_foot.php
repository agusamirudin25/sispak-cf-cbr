<!-- footer @s -->
<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> 
                &copy; 2022 Sistem Pakar Diagnosis Kerusakan
            </div>
        </div>
    </div>
</div>
<!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>
<!-- app-root @e -->
</body>
<script>
    function delete_data(id, ajax) {
         Swal.fire({
             title: "Sistem Pakar Diagnosis Kerusakan",
             text: "Apakah Anda Yakin menghapus data ini ?",
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
                                 "Sistem Pakar Diagnosis Kerusakan",
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
</html>