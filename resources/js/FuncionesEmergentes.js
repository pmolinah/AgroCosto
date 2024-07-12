//eliminar rol
alert("343543t34");
function EliminarRole(id)
{
  Swal.fire({
  title: "Eliminar Rol",
  text: "¿ Desea Borrar el Rol y su Perfil ?",
  type: 'warning',
  showCancelButton: true,
  allowOutsideClick: false,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, borrar'
    }).then((result) => {
       
        if (result.value) {
        //         Swal.fire(
        //         'Deleted!',
        //         'Your file has been deleted.',
        //         'success'
        //         )
           
        //         // location.reload();
        // }
//         $.get('/api/eliminar/'+id+'/Role/',function(retorno){
            
//             Swal.fire({
//             title: 'Rol Borrado',
//             text: 'Puede Continuar...',
//             type: 'success',
//             confirmButtonText: 'Ok',
//             showConfirmButton: false,
//             timer: 1500,
            
// })
//                  setTimeout ("location.reload();", 1500); 
               
//         });
       
        } 
       
    })
}
//fin eliminar rol