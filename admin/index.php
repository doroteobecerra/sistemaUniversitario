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
          <h1>Panel de Administrador</h1>
          <h4>colegiatura actual:</h4>
          <p class="colegiatura">
            <?php
            include_once "funciones/funciones.php";
            $resultado = mysqli_query($conn, "SELECT * FROM colegiatura");
            while ($consulta = mysqli_fetch_array($resultado)) {
              echo "$ " . $consulta['costo'];
            }
            ?>
          </p>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalColegiatura">
            Cambiar
          </button>

          <!-- Modal para modificar costo de la colegiatura -->
          <div class="modal fade" id="modalColegiatura" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Nueva Colegiatura</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <!--formulario para cambiar el costo de la colegiatura-->
                  <form action="modelo-alumno.php" method="post">
                    <input type="number" class="form-control" name="costo" id="costo" placeholder="Cambiar costo" required>
                    <input type="hidden" name="colegiatura" value="nuevo">
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                  <!--input type="hidden" name="colegiatura" value="nuevo"-->
                  <input type="submit" name="colegiatura" class="btn btn-primary" value="Guardar">
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>          
    <!-- CUERPO DEL INDEX -->
  <section class="content">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Licenciaturas y Grupos</h3>
        </div><!-- header del padre -->
        <div class="card-body">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Licenciaturas</h3>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAddLic">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
              </button>
              <!-- Modal para agregar licenciatura -->
              <div class="modal fade" id="modalAddLic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Agrega una Licenciatura</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="modelo-alumno.php" method="post">
                        <label for="nombre-lic">Nombre:</label>
                        <input type="text" class="form-control" id="nombre-lic" name="nombre">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <!-- <button type="button" class="btn btn-primary">Agregar</button> -->
                      <input type="submit" class="btn btn-primary" name="addLic" value="Agregar">
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div><!-- card-header hijo -->
            <div class="card-body">
              <?php
              try {
                $sql = "SELECT id_lic, nombre FROM licenciaturas";
                $resultado = $conn->query($sql);
              } catch (Exception $e) {
                $error->$e->getMessage();
                echo $error;
              }
              $i=0;
              while ($lic = $resultado->fetch_assoc()) {
              $i++;
              ?>
              <div class="accordion" id="accordionExample">
                <div class="card" data-toggle="collapse" data-target="#collapseThree<?php echo $i ?>" aria-expanded="false" aria-controls="collapseThree">
                  <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree<?php echo $i ?>" aria-expanded="false" aria-controls="collapseThree">
                        <?php echo $lic['nombre'] ?>
                      </button>
                    </h5>
                  </div>
                  <div id="collapseThree<?php echo $i ?>" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                    <!-- Dentro de la licenciatura -->
                    </div>
                  </div>
                </div>
              </div><!-- collapse Prueba -->
              <?php  } ?>
            </div><!-- card body hijo -->
          </div><!-- card hijo -->
        </div><!-- card body padre -->
      </div><!-- card padre -->
  </section>
  
</div>
<!-- /.content-wrapper -->

<?php require_once 'templates/footer.php'; ?>