<?php

    //LOGIN Alumnos
if (isset($_POST['login-alumno'])) {
    $matricula = $_POST['matricula'];
    $password = $_POST['password'];

    try{
        include_once 'conexion.php';
        $stmt = $conn->prepare("SELECT * FROM alumnos WHERE matricula = ?");
        $stmt->bind_param("s", $matricula);
        $stmt->execute();
        $stmt->bind_result($id_alumnos, $nombre_alumnos, $carrera_alumnos, $grupo_alumnos, $correo_alumnos, $matricula_alumnos, $password_alumnos, $beca_alumnos, $saldo_alumnos);
        if($stmt->affected_rows){
            $existe = $stmt->fetch();
            if($existe){
                if(password_verify($password, $password_alumnos)){
                    session_start();
                    $_SESSION['nombre'] = $nombre_alumnos;
                    $_SESSION['id_alumnos'] = $id_alumnos;
                    $respuesta = array(
                        'respuesta' => 'exito',
                        'nombre' => $nombre_alumnos
                    );
                }else{
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            }else{
                $respuesta = array(
                    'respuesta' => 'no'
                );
            }
        }
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        echo "Error: " . $e->getMessage();
    }
    die(json_encode($respuesta));
}