function eliminar(id){

    Swal.fire({
        title: 'Estas seguro?',
        text: "No podras deshacer los cambios!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '',
        confirmButtonText: 'Si, eliminar!',
        reverseButtons:true,
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                icon:'success',
                title: 'Eliminado',
                text: "El turno ha sido eliminado!",
                showConfirmButton: false,
                timer:120000
            })
            window.location.href = "/ingreso/eliminar/"+id
        }
    });
}