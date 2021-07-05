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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/app.css">
	<title>Contenido</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Universidad</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
      </li>
      <li class="nav-item">
        <!-- <a class="nav-link" href="#">Link</a> -->
      </li>
      <li class="nav-item dropdown btn-dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $_SESSION['nombre']; //Imprimir nombre del usuario en la barra de navegacion?> 
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="cerrar.php">Cerrar Sesión</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li> -->
    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>
    </div>
  </div>

	<div class="pagar">
      <div class="contenido-pagar">
          <h1 class="titulo">Mensualidad de colegiatura</h1>
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
          //se insertara cada dia X el saldo a la base de datos automaticamente
          if(date('d') == 15){
            include_once 'conexion.php';
            try{
              $stmt = $conn->prepare("UPDATE alumnos SET saldo = ? WHERE id_alumnos = $id_user");
              $stmt->bind_param("i", $saldo);
              $stmt->execute();
              $stmt->close();
              $conn->close();
            }catch(Exception $e){

            }
          }
          
          ?>
          <div class="pago-info">
            <div class="name-data">
              <p>Nombre:</p>
              <p>Licenciatura:</p>
              <p>Subtotal:</p>
              <p>Descuento:</p>
              <p>Total:</p>
              
            </div>
            <div class="data">
              <?php
              
              $beca = $row2["beca"];

              switch($beca){
                case  0.5 : $descuento = "50%"; 
                break;
                case  0.4 : $descuento = "40%";
                break;
                case  0.6 : $descuento = "60%";
                break;
                case  0 : $descuento = "0%";
                break;
                default: $descuento = "Error";
              }
              
              echo '<p class="pago">';
              echo $row2["nombre"] . "<br>";
              echo $row2["carrera"] . "<br>";
              echo "$" . $row["costo"] . ".00" . "<br>";
              echo $descuento . "<br>";
              echo "$" . $row2["saldo"] . ".00";
              echo "</p>";

              ?>
            </div>
          </div>
          
         
          

          
          
          <form class="form-pagar" action="pagar.php" method="post">
            <div class="d-grid gap-2 col-6 mx-auto">
              <input type="hidden" class="btn btn-primary" name="precio" 
              value="<?php echo $saldo ?>">
              <input type="submit" class="btn btn-primary" value="PAGAR">
            </div>
          </form>
    
      </div>
		<!-- <a href="stripe/pago.php">pagar Stripe</a> -->

	</div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
  </body>
</html>