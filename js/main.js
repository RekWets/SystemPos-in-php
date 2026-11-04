function advertencia(e) {
    
    e.preventDefault();
    var url=e.currentTarget.getAttribute('href');
    swal.fire({
        title: '¿Estas seguro?',
        text: "Esto es irrevertible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar!',
        confirmButtonText: 'Si, borrar!',
        allowEscapeKey:true,
        allowEnterKey:false,
        position:'center',
    }).then((result)=> {
        if (result.isConfirmed){
           window.location.href=url;
        }
    })
}
