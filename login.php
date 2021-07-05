<?php

/* session_start();
$cerrar_sesion = $_GET['cerrar_sesion'];
if($cerrar_sesion){
  session_destroy();
}
  */
  include_once 'conexion.php';
  include_once 'includes/head.php';
  include_once 'includes/header.php';
  
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../index.php"><b>U</b>niversidad</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Inicia Sesión</p>
      <form role="form" action="modelo-login.php" method="post" name="login-admin-form" id="login-alumno">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="matricula" placeholder="Matricula">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <input type="hidden" name="login-alumno" value="1">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    <!-- /.login-card-body -->
  </div>
</div>
<script src="js/jquery.min.js"></script>
<script src="js/login-ajax.js"></script>
<script src="js/sweetalert2.min.js"></script>
</body>
</html>
  

 
