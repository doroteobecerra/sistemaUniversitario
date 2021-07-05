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
            <h1>Modificar Alumno</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Editar Alumno</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
              <?php
                $sql = "SELECT * FROM `alumnos` WHERE `id_alumnos` = $id";
                $resultado = $conn->query($sql);
                $alumno = $resultado->fetch_assoc();
                
              ?>
            <form method="post" action="modelo-alumno.php" name="guardar-alumno" id="guardar-alumno">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre-admin">Nombre</label>
                    <input type="text" class="form-control" id="nombre-admin" 
                    name="nombre" placeholder="Ingresa el nombre" value="<?php echo $alumno['nombre']; ?>">
                  </div>
                  <div class="form-group">
                  <label for="carrera">Licenciatura</label><br>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="carrera">
                      <option selected><?php echo $alumno['carrera']; ?></option>
                          <?php
                            include_once 'funciones/funciones.php';
                            $sql = "SELECT * FROM licenciaturas";
                            $resultado = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($resultado)){ ?>
                               
                      <option value="<?php  echo $row['nombre']; ?>"><?php  echo $row['nombre']; ?></option>
                           
                            <?php } ?>                      
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control" id="grupo" 
                    name="grupo" placeholder="Ingresa el grupo" value="<?php echo $alumno['grupo']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email-admin">Email</label>
                    <input type="email" class="form-control" id="email-admin1" 
                    name="correo" placeholder="Ingresa el email" value="<?php echo $alumno['correo']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="matricula">Matricula</label>
                    <input type="text" class="form-control" id="matricula" 
                    name="matricula" placeholder="Ingresa la matricula" value="<?php echo $alumno['matricula']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="password-alumno">Password</label>
                    <input type="password" class="form-control" id="password-admin" 
                    name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="beca-alumno">Porcentaje de beca</label><br>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="beca">
                        <option value="<?php echo $alumno['beca']; ?>"><?php echo $alumno['beca']; ?></option>
                        <option value="0">Sin beca</option>
                        <option value="0.4">40%</option>
                        <option value="0.5">50%</option>
                        <option value="0.6">60%</option>
                      </select>
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

 
