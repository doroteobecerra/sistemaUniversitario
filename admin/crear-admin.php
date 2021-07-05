<?php 
  require_once 'funciones/sesiones.php';
  require_once 'funciones/funciones.php';
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
            <h1>Crear administrador</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Añadir nuevo administrador</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
            <form method="post" action="modelo-admin.php" name="crear-admin" id="crear-admin">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre-admin">Nombre</label>
                    <input type="text" class="form-control" id="nombre-admin" name="nombre" placeholder="Ingresa el nombre" required>
                  </div>
                  <div class="form-group">
                    <label for="email-admin">Email</label>
                    <input type="email" class="form-control" id="email-admin1" name="correo" placeholder="Ingresa el email" required>
                  </div>
                  <div class="form-group">
                    <label for="password-admin">Password</label>
                    <input type="password" class="form-control" id="password-admin" name="password" placeholder="Password" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="hidden" name="registro" value="nuevo">
                  <button type="submit" class="btn btn-primary">Añadir</button>
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

 
