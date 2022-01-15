window.onload = function(){
    let hollyc = document.getElementById('hollym');
    hollyc.addEventListener('click', function(e){
        e.preventDefault();
         Swal.fire({
            title: 'Go to app to watch free hollywood movies',
            showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            window.location.href="https://play.google.com/store/apps/details?id=com.ini.niiflicks";
            }
            // } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            // }
        })
    })
}