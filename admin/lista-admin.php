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
            <h1>Lista de administradores</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de todos los administradores Registrados</h3>
        </div>
        <div class="card-body">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Base de datos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      try{
                        $sql = "SELECT id_admin, correo, nombre FROM admin";
                        $resultado = $conn->query($sql);
                      }catch(Exception $e){
                        $error->$e->getMessage();
                        echo $error;
                      }
                      while($admin = $resultado->fetch_assoc()){ ?>
                        <tr>
                          <td><?php echo $admin['correo'] ?></td>
                          <td><?php echo $admin['nombre'] ?></td>
                          <td>
                            <a href="editar-admin.php?id=<?php echo $admin['id_admin'] ?>" class="btn bg-orange btn-flat margin">
                            <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="<?php echo $admin['id_admin']; ?>" data-tipo="admin" class="btn bg-maroon btn-flat margin borrar_registro">
                              <i class="fas fa-trash-alt"></i>
                            </a>
                          </td>
                        </tr>

                    <?php  } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Correo</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php require_once 'templates/footer.php'; ?>

 
