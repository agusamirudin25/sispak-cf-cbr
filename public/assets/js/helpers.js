function success_alert(title, msg, page) {
    Swal.fire({
        icon: 'success',
        title: title,
        text: msg,
        timer: 1500,
        footer: '',
        showCancelButton: false,
        showConfirmButton: false
    }).then(function() {
        window.location = page;
    })
}

function error_alert(title, msg) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: msg,
        footer: ''
    })
}