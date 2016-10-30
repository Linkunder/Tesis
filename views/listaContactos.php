
<?php

include('layout/headerJugador.php'); 

// Se obtiene la lista de contactos del usuario.
//if (isset($vars['listaContactos'])){
$contactos = $vars['listaContactos'];
//}




?>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
<link href="assets/css/profile.css" rel="stylesheet">

  <div id="contact-us" class="parallax">
    <div class="container">

      <br/>
      <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Contactos</li>
      </ol>

      <?php 
      if (count($contactos)==0){ ?>
      <div class="page-header">
          <h2> No tienes contactos <i class="fa fa-frown-o" aria-hidden="true"></i>  </h2>
      </div>
      <p class="centered">Para agregar un nuevo contacto haz click 
        <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-plus-circle"></i></button>
        . Para agregar a uno de tus contactos a un equipo, haz click en el botón 
        <button type="button" class="btn btn-md btn-success" action="">Agregar <i class="fa fa-users"></i></button></p>

    </div>
  </div>






      <?php
      include('layout/footer.php'); 
      } else {
      ?>
      <div class="page-header">
          <h2> Mis contactos <i class="fa fa-users" aria-hidden="true"></i> </h2>
      </div>

      <p class="centered">Para agregar un nuevo contacto haz click 
        <button href="#" data-toggle="modal" data-target="#modal-1" type="button" class="btn btn-md btn-primary" action="">aquí <i class="fa fa-plus-circle"></i></button>
        . Para agregar a uno de tus contactos a un equipo, haz click en el botón 
        <button class="btn btn-success btn-sm fa fa-plus-circle"></a></button></p>


        <div class="jumbotron list-content">
          <ul class="list-group">
            <li href="#" class="list-group-item title">
              Listado de contactos
            </li>
            <?php
            foreach ($contactos as $item) {
              $idContacto = $item['idUsuario'];
              $nombreContacto = $item['nombre'];
            ?>
            <li href="#" class="list-group-item text-left">
              <img class="img-thumbnail" src="assets/images/usuarios/<?php echo $item['fotografia']?>">
              <label class="name">&nbsp;
                <?php echo $idContacto." ".$nombreContacto." ".$item['apellido']?><br>
              </label>
              <input type="text" id="idContacto" value="<?php echo $idContacto?>" hidden/>
              <label class="pull-right">
                <br/>
                <!--a href="#" class="btn btn-success btn-xs fa fa-plus-circle" data-toggle="modal" data-target="#myModal" data-id="<?php echo $idContacto?>" title="Agregar"></a-->
                <a href="#" class="btn btn-success btn-xs fa fa-plus-circle" onclick="setValue(<?php echo $idContacto.",'$nombreContacto'";?>)" title="Agregar">
                </a>
              </label>
              <div class="break"></div>
            </li>
            <?php
            }
            ?>
          </ul>
        </div>


    </div>
  </div>

</div>


<?php
include('layout/footer.php'); 
}

?>
<!-- /Aqui termina la pagina -->





<div class="container">
  <div class="modal fade" id="modal-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Búsqueda de jugadores</h4>
        </div>
        <div class="modal-body">
          <p id="texto-contactos">Para agregar un contacto, búscalo ingresando su nickname.</p>
          <form action="?controlador=Usuario&accion=busquedaJugador" method="POST">
            <input id="text-black" type="text" class="form-control partido" placeholder="Ingresa un nickname..." name="search" required="required"/>
              <div class="row">
                <div class="col-md-6 col-md-offset-4">
                  <div class="div-btn-a">
                    <button class="btn-busqueda" type="submit">Buscar</button>  
                  </div>
                </div>
              </div>          
          </form>
          <hr/>

          <?php
          $search = '';
          $cont = 0;
          if (isset($_GET['search'])){
            $search = $_GET['search'];
          }
          if ($search!=''){
            ?>
          
          <h3>Resultados</h3>
          <hr/>
          <?php 
          }
          foreach ($variable as $key => $value) {
            # code...
          }
          ?>

          <div class="col-sm-6">
            <div class="folio-item wow fadeInRightBig" data-wow-duration="1000ms" data-wow-delay="300ms">
              <div class="folio-image">
                <!--img class="img-responsive" src="images/usuarios/<?php //echo  $key->getRutaFotografia(); ?>" alt=""-->
              </div>
              <div class="overlay">
                <div class="overlay-content">
                  <div class="overlay-text">
                    <div class="folio-info">
                      <h3>Añadir a <?php //echo $nickname?></h3>
                      <p><?php //echo $nombre?> <?php //echo $apellido?></p>
                    </div>
                    <div class="folio-overview">
                      <!--span class="folio-link"><a class="folio-read-more" href="#" data-single_url="agregarContacto.php?id_contacto=<?php //echo $idUsuario ?>" ><i class="fa fa-plus"></i></a></span-->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>



<?php
$equipos = $vars['listaEquipos'];
$miembrosEquiposJugador = $vars['listaMiembrosEquiposJugador'];
$arrayEquipos = array();
$arrayEquipos2 = array();
$arrayEquiposMiembro = array();

foreach ($equipos as $equipo) {
  $arrayEquipos[] = "".$equipo['nombre'];
}


foreach ($equipos as $equipo ) {
  $arrayEquipos2[$equipo['idEquipo']] = $equipo['nombre'];
}



?>




<div class="container">
  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <?php $contactoActual = $_GET['idContact']; ?>
          <h4 class="modal-title" id="myModalLabelContact"></h4>
        </div>
        <div class="modal-body">
          <form  action="?controlador=Contacto&accion=agregarMiembro" method="POST">
              <select class="form-control" id="equipo" name="equipo" title="Selecciona uno de los equipos que administras..">
                <?php

                foreach ($miembrosEquiposJugador as $miembrosEquipos) {
                  if ($miembrosEquipos['idUsuario'] == $contactoActual){
                    $equipoUsuario = $miembrosEquipos['nombre'];
                    $arrayEquiposMiembro[$miembrosEquipos['idEquipo']] = $miembrosEquipos['nombre'];
                  }
                }
                $resultado = array_diff($arrayEquipos2, $arrayEquiposMiembro);
                if (count($resultado)==0){
                  ?>
                  <option id="text-black" ><?php echo "El jugador está en todos tus equipos."?></option>
                  <?php
                } else {


                foreach ($resultado as $key => $value ) {
                 
                ?>
                  <option id="text-black" value="<?php echo $key?>"><?php echo $value?></option>
                <?php
                }
                }
                ?>






                </select>   
                <input type="text" id="id_contacto" name="contacto" hidden/>
              <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
            <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
          </div>
          </form>
        </div>
      </div>

      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
var idContact="0";
var nombreContacto="";
function setValue(id,nombre){
  idContact= id;
  document.getElementById("id_contacto").value = idContact;
  nombreContacto = nombre;
  window.location.href="?controlador=Contacto&accion=listaContactos&idContact="+id+"&n="+nombreContacto;
}

  window.onload = function() {
          function getParameterByName(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
            results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
       var a = getParameterByName('idContact');
       var n = getParameterByName('n');
       if(a == ""){
       }else{
        document.getElementById("id_contacto").value = a;

        document.getElementById("myModalLabelContact").innerHTML="Selecciona el equipo al cual deseas incluir a "+n;
         $('#myModal').modal();
       }
};

</script>



