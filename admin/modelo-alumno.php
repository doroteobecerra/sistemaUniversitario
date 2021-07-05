<?php

if (isset($_POST['registro'])) {

    //REGISTROS NUEVOS
 if ($_POST['registro'] == 'nuevo') {
     include_once 'funciones/funciones.php';
     $nombre = $_POST['nombre'];
     $carrera = $_POST['carrera'];
     $grupo = $_POST['grupo'];
     $correo = $_POST['correo'];
     $matricula = $_POST['matricula'];
     $password = $_POST['password'];
     $beca = $_POST['beca'];
     

     //die(json_encode($_POST));//para ver como se está enviando y detiene la ejecucuón de todo lo que está por denajo
     $opciones = array(
         'cost' => 12
     );
   
     $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

     try {

         $stmt = $conn->prepare("INSERT INTO alumnos (nombre, carrera, grupo, correo, matricula, password, beca, saldo) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
         $stmt->bind_param("ssssssd", $nombre, $carrera, $grupo, $correo, $matricula, $password_hashed, $beca);
         $stmt->execute();
         $id_registro = $stmt->insert_id;
         if ($id_registro > 0) {
             $respuesta = array(
                 'respuesta' => 'exito',
                 'id_admin' => $id_registro
             );
         } else {
             $respuesta = array(
                 'respuesta' => 'error'
             );
         }
         $stmt->close();
         $conn->close();
     } catch (Exception $e) {
         $respuesta = array(
             'respuesta' => $e->getMessage()
         );
     }
     die(json_encode($respuesta));
 }

    //ACTUALIZAR ALUMNO
 if ($_POST['registro'] == 'actualizar') {
     include_once 'funciones/funciones.php';
     $nombre = $_POST['nombre'];
     $carrera = $_POST['carrera'];
     $grupo = $_POST['grupo'];
     $correo = $_POST['correo'];
     $matricula = $_POST['matricula'];
     $password = $_POST['password'];
     $beca = $_POST['beca'];
     $id_registro = $_POST['id_registro'];


     try {
         if (empty($_POST['password'])) {
             $stmt = $conn->prepare("UPDATE alumnos SET nombre = ?, carrera = ?, grupo = ?, correo = ?, matricula = ?, beca = ? WHERE id_alumnos = ?");
             $stmt->bind_param("sssssdi", $nombre, $carrera, $grupo, $correo, $matricula,  $beca, $id_registro,);
         } else {
             $opciones = array(
                 'cost' => 12
             );
             $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
             $stmt = $conn->prepare('UPDATE admin SET nombre = ?, carrera = ?, grupo = ?, correo = ?, matricula = ?, password = ?, beca = ? WHERE id_alumnos = ?');
             $stmt->bind_param("sssdi", $nombre, $carrera, $grupo, $correo, $matricula, $hash_password, $beca, $id_registro);
         }

         $stmt->execute();
         if ($stmt->affected_rows) {
             $respuesta = array(
                 'respuesta' => 'exito',
                 'id_actualizado' => $stmt->insert_id
             );
         } else {
             $respuesta = array(
                 'respuesta' => 'error'
             );
         }
         $stmt->close();
         $conn->close();
     } catch (Exception $e) {
         $respuesta = array(
             'respuesta' => $e->getMessage()
         );
     }
     die(json_encode($respuesta));
 }

    //Eliminar Alumno
 if ($_POST['registro'] == 'eliminar'){
    $id_borrar = $_POST['id'];

    try{
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare("DELETE FROM alumnos WHERE id_alumnos = ?");
        $stmt->bind_param("i", $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        }else{
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    }catch(Exception $e){
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
 }

}

//Modificar costo de colegiatura

if(isset($_POST['colegiatura'])){
    include_once 'funciones/funciones.php';
    $costo = $_POST['costo'];

    try{
        $stmt = $conn->prepare("UPDATE colegiatura SET costo = ?");
        $stmt->bind_param("i", $costo);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: index.php");
    }catch(Exception $e){
        $e->getMessage();
    }
}

//Agregar licenciatura

if(isset($_POST['addLic'])){
    include_once 'funciones/funciones.php';
    $nombre = $_POST['nombre'];
    
    try{
        $stmt = $conn->prepare("INSERT INTO licenciaturas (nombre) VALUES (?)");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        header("Location: index.php");
    }catch(Exception $e){
        $e->getMessage();
    }
}

//Agregar grupo

if(isset($_POST['addGrupo'])){
    
    include_once 'funciones/funciones.php';
    $nombre = $_POST['nombre'];
    $idGrupo = $_POST['idGrupo'];
    /* die(json_encode($_POST)); */
    try{
        $stmt = $conn->prepare("INSERT INTO grupos (nombre, lic_id) VALUES (?,?)");
        $stmt->bind_param("si", $nombre, $idGrupo);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header("Location: crear-grupo.php");
    }catch(Exception $e){
        $e->getMessage();
    }
}