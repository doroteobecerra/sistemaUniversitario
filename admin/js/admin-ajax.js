$(document).ready(function(){
    $('#crear-admin').on('submit',function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                var resultado = data;
                if(resultado.respuesta == 'exito'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Administrador guardado con exito',
                        timer: 1000,
                    })
                }else{
                    Swal.fire(
                        '!Error!',
                        'Ocurrio un error, intenta de nuevo',
                        'error'
                      )
                }
            }
        })
    });

   // Eliminar Registro //     
   $('.borrar_registro').on('click', function(e) {
        e.preventDefault();
        var id = $(this).attr('data-id');         
        var tipo = $(this).attr('data-tipo');         
        swal.fire({title: '¿Estás Seguro?',             
        text: "¡Un registro eliminado no se puede recuperar!",             
        icon: 'warning',             
        showCancelButton: true,             
        confirmButtonColor: '#d33',             
        cancelButtonColor: '#3085d6',             
        confirmButtonText: 'Si, Eliminar',             
        cancelButtonText: 'Cancelar'         
    }).then((result) => {             
        if (result.value) {                 
            $.ajax({                     
                type: 'post',                     
                data: {                         
                    'id': id,                         
                    'registro': 'eliminar'                     
                },                     
                url: 'modelo-' + tipo + '.php',                     
                success: function(data) {                         
                    var resultado = JSON.parse(data);                         
                    if (resultado.respuesta == 'exito') {                             
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            text: 'Registro Eliminado con exito',
                            timer: 500
                        })                            
                        jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();                     
                    }                     
                }                 
            })             
        }else if (result.dismiss === 'cancel'){                 
            Swal.fire({
                icon: 'error',
                title: 'Cancelado',
                text: 'No se elimino el registro',
                timer: 500
            })            
        }         
    })
});

//LOGIN ADMINISTRADOR
    $('#login-admin').on('submit',function(e){
        e.preventDefault();
        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data){
                var resultado = data;
                console.log(data);
                var resultado = data;
                if(resultado.respuesta == 'exito'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Correcto',
                        text: 'Bienvenid@ '+resultado.correo+'',
                        timer: 1000,
                        showConfirmButton: false
                    })
                    setTimeout(function(){
                        window.location.href = 'index.php';
                    },1000);
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Datos Incorrectos',
                        timer: 1100,
                        showConfirmButton: false
                    })
                }
            }
        })
    });
});
