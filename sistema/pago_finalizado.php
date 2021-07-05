<?php
	/* require '../includes/mysqli.php';
	session_start();
	if(!isset($_SESSION['usuario'])){
		header("Location: user.php");
	}
	$user = $_SESSION['usuario'];

	$sql = "SELECT id, usuario FROM usuarios WHERE usuario = '$user'";
	$resultado = $conexion -> query($sql);
  $row = $resultado -> fetch_assoc(); */
  
  include_once '../sesiones.php';
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="css/all.min.css"> -->
    <script src="https://kit.fontawesome.com/9714e158bb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/app.css">
    <title>Document</title>
</head>
<body>
    <div class="pagar">
      <div class="contenido-pagar">
        <h2>Pagado</h2>
        <div class="icon-succes">
          <i class="fas fa-check-circle"></i>
        </div>
        <a class="volver" href="index.php">Volver</a><br>
        <a class="volver" href="crearPDF.php">Descargar comprobante</a>
      </div>
    </div>
    <?php
        //Error corregido, imprimimos el saldo del alumno faltara insertar el saldo cada fecha
        include_once 'conexion.php';
    
        //id_user almacena el id del usuario logeado
        $id_user = $_SESSION['id_alumnos'];

        $sql = "SELECT costo FROM colegiatura";
        $resultado = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($resultado);
        
        $becado = "SELECT * FROM alumnos WHERE id_alumnos = $id_user";
        $becas = mysqli_query($conn, $becado);
        $row2 = mysqli_fetch_assoc($becas);

      /*  echo "<h1>";
            echo $row2['beca'] ;
          echo "</h1>"; */
        
        $descuento = $row["costo"]*$row2["beca"];
        if($row2["beca"] > 0){
            $saldo = $row["costo"]-$descuento;
            
        }else{
            $saldo = $row["costo"];
        }

        $nuevoSaldo =  $saldo - $saldo;
        $mensualidadPagada = true;

        //se insertara cada dia X el saldo a la base de datos automaticamente
        if($mensualidadPagada = true){
          include_once 'conexion.php';
          try{
            $stmt = $conn->prepare("UPDATE alumnos SET saldo = ? WHERE id_alumnos = $id_user");
            $stmt->bind_param("i", $nuevoSaldo);
            $stmt->execute();
            $stmt->close();
            $conn->close();
          }catch(Exception $e){

          }
        }
    ?>
</body>
</html>