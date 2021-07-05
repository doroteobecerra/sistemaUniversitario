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
            <h1>Lista de Alumnos</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Lista de todos los Alumnos Registrados</h3>
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
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Grupo</th>
                    <th>Correo</th>
                    <th>Matricula</th>
                    <th>Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      try{
                        $sql = "SELECT id_alumnos, nombre, carrera, grupo, correo, matricula FROM alumnos";
                        $resultado = $conn->query($sql);
                      }catch(Exception $e){
                        $error->$e->getMessage();
                        echo $error;
                      }
                      while($alumno = $resultado->fetch_assoc()){ ?>
                        <tr>
                          <td><?php echo $alumno['nombre'] ?></td>
                          <td><?php echo $alumno['carrera'] ?></td>
                          <td><?php echo $alumno['grupo'] ?></td>
                          <td><?php echo $alumno['correo'] ?></td>
                          <td><?php echo $alumno['matricula'] ?></td>
                          <td>
                            <a href="editar-alumno.php?id=<?php echo $alumno['id_alumnos'] ?>" class="btn bg-orange btn-flat margin">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="#" data-id="<?php echo $alumno['id_alumnos']; ?>" data-tipo="alumno" class="btn bg-maroon btn-flat margin borrar_alumno">
                              <i class="fas fa-trash-alt"></i>
                            </a>
                          </td>
                        </tr>

                    <?php  } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Nombre</th>
                    <th>Carrera</th>
                    <th>Grupo</th>
                    <th>Correo</th>
                    <th>Matricula</th>
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

 
