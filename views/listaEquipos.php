
<?php

include('layout/headerJugador.php'); 

// Se obtiene la lista de equipos del usuario.
//if (isset($vars['listaContactos'])){
$equipos = $vars['listaEquipos'];
//}
?>



<link href="assets/css/profile.css" rel="stylesheet">
<div class="row">
  <div id="contact-us" class="parallax">
    <div class="container">
      <?php
      if (count($equipos)==0){          // CASO 1: NO TENER EQUIPOS COMO CAPITAN
        ?>
      <h2> No tienes equipos <i class="fa fa-frown-o" aria-hidden="true"></i> </h2>
            <p class="centered">Para crear un equipo haz click
                <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >aquí 
                <i class="fa fa-plus-circle"></i>
              </button>
              
              
            </p>
    

      <?php
      } else {                        // CASO 2: TENER EQUIPOS COMO CAPITAN
        ?>
      <h2> Mis equipos al mando <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
            <p class="centered">Para crear un nuevo equipo haz click
                <button type="button" class="btn btn-md btn-primary" href="#" data-toggle="modal" data-target="#modal-1" >aquí 
                <i class="fa fa-plus-circle"></i>
              </button>
              . Puedes gestionar uno de tus equipos haciendo click en el botón "Modificar".
            </p>


            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead>
                  <tr id="color-encabezado">
                    <th></th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Partidos disputados</th>
                    <th>Partidos cancelados</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos">
                  <?php
                  foreach ($equipos as $item) {
                  ?>
                  <tr>
                  <td>
                    <div class="profile-userpic">
                      <!--img src="assets/images/usuarios/20.jpg" class="img-responsive" alt=""-->
                    </div>
                  </td>
                  <td>
                    <?php echo $item['nombre']?>
                  </td>
                  <td>
                    <?php echo $item['color']?>
                  </td>
                  <td>
                    <?php echo $item['partidosDisputados']?>
                  </td>
                  <td>
                    <?php echo $item['partidosCancelados']?>
                  </td>
                  <td class="centered">
                    <a href="?controlador=Equipo&accion=gestionarEquipo&idEquipo=<?php echo $item['idEquipo']?>">
                      <!--button type="button" class="btn btn-md btn-success" data-toggle="modal" data-target="#myModal"-->
                      <button type="button" class="btn btn-md btn-success">
                      Modificar 
                      <i class="fa fa-pencil-square-o"></i>
                      </button>
                    </a>
                  </td>
                </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>


      <?php
      }

      $equiposMiembro = $vars['listaEquiposMiembro'];
      
      if (count($equiposMiembro)==0){               // CASO 3: NO SER PARTE DE NINGÚN EQUIPO 
      ?>
      <h2> No te han agregado a ningún equipo. <i class="fa fa-frown-o" aria-hidden="true"></i> </h2>
          </div>
        </div>
      </div>

      <?php
      } else {                                      // CASO 4: SER PARTE DE ALGUN EQUIPO, COMO MIEMBRO
      ?>

      <!--h2> Mis equipos <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2-->
            <p class="centered">Además, perteneces a los siguientes equipos.</p>
            <?php
            foreach ($equiposMiembro as $item) {
            ?>
            <div class="panel-group">
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <a data-toggle="collapse" href="#collapse<?php echo $item['idEquipo']?>">
                  <h4 class="panel-title">
                    <?php echo $item['nombre']?>
                  </h4></a>
                </div>
                <div id="collapse<?php echo $item['idEquipo']?>" class="panel-collapse collapse">
                  <!-- MOSTRAR JUGADORES -->
                  <?php 
                  $miembrosEquipo = $vars['listaMiembrosEquipo'.$item['idEquipo']];
                  foreach($miembrosEquipo as $key){
                    echo $key['nombre']." ".$key['apellido'];
                  }
                   ?>
                </div>
              </div>
            </div>


            <?php
            }
            ?>







          </div>
        </div>
      </div>



      <?php
      }
      include('layout/footer.php'); 
      ?>
     

<!-- Script Graficos -->


<!-- Modal -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
    <script src="assets/js/jquery.bootstrap-duallistbox-modal.js"></script>

<div class="modal fade" id="modal-1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Crea tu equipo</h4>
      </div>
      <div class="modal-body">
        <h5 class="texto-modal-negro">Ingresa los datos de tu futuro equipo, del cual serás capitán.</h5>
        <form id="demoform" action="?controlador=Equipo&accion=crearEquipo" method="post">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="nombre">Nombre: </label>
                  <input type="text" name="nombre" placeholder="Ingresa un nombre para tu equipo..." class="form-control partido" required="required" >
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <label class="texto-modal-negro" for="color">Color: </label>
                  <input type="text" name="color" placeholder="Ingresa un color de vestimenta para tu equipo..." class="form-control partido" required="required" >
                </div>
              </div>
            </div>
            <!-- GESTION DEL NUEVO EQUIPO -->
            <?php
            $contactos = $vars['listaContactos'];
            ?>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <select multiple="multiple" size="<?php count($contactos)?>" name="arrayContactos[]" >
                        <?php
                        foreach($contactos as $item){
                        ?>
                        <option  value="<?php echo $item['idUsuario']?>" class="texto-modal-negro">
                            <?php echo $item['idUsuario'].": ".$item['nombre']." ".$item['apellido']?>
                        </option>
                        <?php
                        }
                        ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </div>
        </form>

        <script>
            var demo1 = $('select[name="arrayContactos[]"]').bootstrapDualListbox();
        </script>

      </div>
      
    </div>
  </div>
</div>



