<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="library/sweetalert2/dist/sweetalert2.all.min.js" ></script>
<script>
    'use strict';
    if(document.getElementById("btnlogin")!=null){
        document.getElementById("btnlogin").addEventListener("click",function(){
        Swal.fire({
        title: 'Enter Password',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Login',
        showLoaderOnConfirm: true,
        preConfirm: (login) => {
            return fetch(`login?data=${login}`)
            .then(response => {
                if (!response.ok) {
                throw new Error(response.statusText)
                }
                return response
            })
            .catch(error => {
                Swal.showValidationMessage(
                `Access Denied`
                )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
                Swal.fire({
                    title: 'Redirecting',
                    html: 'Please Wait...',
                    allowOutsideClick:false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                })
            }
        })
    })
    }
    
</script>