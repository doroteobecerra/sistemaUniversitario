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
            <h1>Crear grupo</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Añadir nuevo grupo</h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-8">
            <form action="modelo-alumno.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nombre-admin">Nombre</label>
                    <input type="number" class="form-control" id="nombre-admin" 
                    name="nombre" placeholder="Ingresa el nombre" required>
                  </div>
                  <div class="form-group">
                  <label for="carrera">Licenciatura</label><br>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="idGrupo" required>
                      <option selected>Selecciona una opcion</option>
                          <?php
                            include_once 'funciones/funciones.php';
                            $sql = "SELECT * FROM licenciaturas";
                            $resultado = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($resultado)){ ?>
                               
                      <option value="<?php  echo $row['id_lic']; ?>"><?php  echo $row['nombre']; ?></option>
                           
                            <?php } ?>                      
                    </select>
                  </div>   
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                
                  <!-- <input type="hidden" name="registro" value="nuevo"> -->
                  <input type="submit" class="btn btn-primary" name="addGrupo" value="Agregar">
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

 
