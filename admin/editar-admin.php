<?php 
  require_once 'funciones/sesiones.php';
  require_once 'funciones/funciones.php';
  $id = $_GET['id'];
  if(!filter_var($id, FILTER_VALIDATE_INT)){
    dir("Error");
  }
  require_once 'templates/head.php';
  require_once 'templates/header.php';
  require_once 'templates/navegacion.php'; 
?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Modificar administrador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar administrador</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <?php
                $sql = "SELECT * FROM `admin` WHERE `id_admin` = $id";
                $resultado = $conn->query($sql);
                $admin = $resultado->fetch_assoc();
                
              ?>
            <form method="post" action="modelo-admin.php" name="crear-admin" id="crear-admin">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre-admin">Nombre</label>
                    <input type="text" class="form-control" id="nombre-admin" 
                    name="nombre" placeholder="Ingresa el nombre" value="<?php echo $admin['nombre']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email-admin">Email</label>
                    <input type="email" class="form-control" id=email-admin1" 
                    name="correo" placeholder="Ingresa el email" value="<?php echo $admin['correo']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="password-admin">Password</label>
                    <input type="password" class="form-control" id="password-admin" 
                    name="password" placeholder="Password">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="registro" value="actualizar">
                  <input type="hidden" name="id_registro" value="<?php echo $id;?>">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
       
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once 'templates/footer.php'; ?>

 
