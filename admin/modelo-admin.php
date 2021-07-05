<?php
if (isset($_POST['registro'])) {


    //REGISTROS NUEVOS
 if ($_POST['registro'] == 'nuevo') {
     include_once 'funciones/funciones.php';
     $correo = $_POST['correo'];
     $nombre = $_POST['nombre'];
     $password = $_POST['password'];


     //die(json_encode($_POST));//para ver como se está enviando y detiene la ejecucuón de todo lo que está por denajo
     $opciones = array(
         'cost' => 12
     );

     $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

     try {

         $stmt = $conn->prepare("INSERT INTO admin (correo, nombre, password) VALUES (?, ?, ?)");
         $stmt->bind_param("sss", $correo, $nombre, $password_hashed);
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

    //ACTUALIZAR ADMIN
 if ($_POST['registro'] == 'actualizar') {
     include_once 'funciones/funciones.php';
     $correo = $_POST['correo'];
     $nombre = $_POST['nombre'];
     $password = $_POST['password'];
     $id_registro = $_POST['id_registro'];


     try {
         if (empty($_POST['password'])) {
             $stmt = $conn->prepare("UPDATE admin SET correo = ?, nombre = ? WHERE id_admin = ?");
             $stmt->bind_param("ssi", $correo, $nombre, $id_registro);
         } else {
             $opciones = array(
                 'cost' => 12
             );
             $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
             $stmt = $conn->prepare('UPDATE admin SET correo = ?, nombre = ?, password = ? WHERE id_admin = ?');
             $stmt->bind_param("sssi", $correo, $nombre, $hash_password, $id_registro);
         }

         $stmt->execute();
         if ($stmt->affected_rows) {
             $respuesta = array(
                 'respuesta' => 'exito',
                 'nombre' => $nombre,
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

    //Eliminar Admin
 if ($_POST['registro'] == 'eliminar'){
    $id_borrar = $_POST['id'];

    try{
        include_once 'funciones/funciones.php';
        $stmt = $conn->prepare("DELETE FROM admin WHERE id_admin = ?");
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

    //LOGIN ADMIN
if (isset($_POST['login-admin'])) {
 $correo = $_POST['correo'];
 $password = $_POST['password'];

 try {
     include_once 'funciones/funciones.php';
     $stmt = $conn->prepare("SELECT * FROM admin WHERE correo = ?;");
     $stmt->bind_param("s", $correo);
     $stmt->execute();
     $stmt->bind_result($id_admin, $correo_admin, $nombre_admin, $password_admin); //para filtrar cuando se hace un SELECT
     if ($stmt->affected_rows) {
         $existe = $stmt->fetch(); //fetch imprime los datos que obtiene de la base de datos
         if ($existe) {
             if (password_verify($password, $password_admin)) {
                 session_start(); //para iniciar sesiones, cada página que va a estar dentro de la sesión debe tner esta línea de código
                 $_SESSION['correo'] = $correo_admin;
                 $_SESSION['nombre'] = $nombre_admin;
                 $respuesta = array(
                     'respuesta' => 'exito',
                     'correo' => $nombre_admin
                 );
             } else {
                 $respuesta = array(
                     'respuesta' => 'error'
                 );
             }
         } else {
             $respuesta = array(
                 'respuesta' => 'error'
             );
         }
     }
     $stmt->close();
     $conn->close();
 } catch (Exception $e) {
     echo "Error: " . $e->getMessage();
 }
 die(json_encode($respuesta));
}



