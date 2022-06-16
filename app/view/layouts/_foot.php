<!-- footer @s -->
<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> 
                &copy; 2022 Sistem Pakar Mendiagnosa Kerusakan Pada Mesin Mobil Matic
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
    $(document).ready(function() {
        setInterval(() => {
            setNotif()
        }, 1000);
    });
    function delete_data(id, ajax) {
         Swal.fire({
             title: "Sistem Pakar",
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
                                 "Sistem Pakar",
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

     function verif_data(id, ajax, message, status) {
         Swal.fire({
             title: "Sistem Pakar",
             text: message,
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yakin'
         }).then((result) => {
             if (result.value) {
                 var string = 'id=' + id + '&status=' + status;
                 $.ajax({
                     type: 'POST',
                     url: "<?= url() ?>" + ajax,
                     data: string,
                     cache: false,
                     dataType: 'json',
                     success: function(data) {
                         if (data.status == 1) {
                             Swal.fire(
                                 "Sistem Pakar",
                                 data.msg,
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

    function alertConfirm(route, message = null)
    {
        if(message == null || message == '' || !message){
            Swal.fire({
                title: "Sistem Pakar",
                text: `Apakah Anda yakin mengubah status ?`,
                showDenyButton: true,
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: `Yakin`,
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = route;
                } else if (result.isDenied) {
                    return false;
                }
            })
        }else{
            Swal.fire({
                text: message,
                title: "Sistem Pakar",
                showDenyButton: true,
                showCancelButton: true,
                allowOutsideClick: false,
                confirmButtonText: `Yakin`,
                denyButtonText: `Tidak`,
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = route;
                } else if (result.isDenied) {
                    return false;
                }
            })
        }
    }

    const setNotif = () => {
        $.ajax({
            type: 'POST',
            url: "<?= base_url('Dashboard/getNotif') ?>",
            data: '',
            cache: false,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('.total-konsul').html(`${data.total} Konsultasi`)
                $('.total-konsul-menu').html(`${data.total}`)
            }
        });
    }

</script>
</html>