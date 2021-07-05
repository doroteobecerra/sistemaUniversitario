$(document).ready(function(){
//LOGIN ALUMNOS
    $('#login-alumno').on('submit',function(e){
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
                        text: 'Bienvenid@ '+resultado.nombre+'',
                        timer: 1000,
                        showConfirmButton: false
                    })
                    setTimeout(function(){
                        window.location.href = 'sistema/index.php';
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
