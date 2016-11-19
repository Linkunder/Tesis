
<?php

include('layout/headerJugador.php');



?>


<link href="assets/css/profile.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/slider.css">



<?php

// Recibir información de los partidos Pendientes como organizador
$partidosPendientes = $vars['partidosPendientes'];
$nroPartidosPendientes = count($partidosPendientes);

$partidosSistema = $vars['partidosSistema'];
$nroPartidosSistema = count($partidosSistema);


?>







<!--Calendario-->
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='assets/js/moment.min.js'></script>
<script src="assets/js/es.js"></script>
<script src='assets/lang-all.js'></script>
<script src='assets/js/fullcalendar.min.js'></script>


<script>
  $(document).ready(function() {
    var hoy = new Date();
    var dd = hoy.getDate();
    var mm = hoy.getMonth()+1; //hoy es 0!
    var yyyy = hoy.getFullYear();

    if(dd<10) {
      dd='0'+dd
    }

    if(mm<10) {
      mm='0'+mm
    }

    hoy = mm+'-'+dd+'-'+yyyy;

    $('#calendar1').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: hoy,
      editable: false,
      eventLimit: true, // allow "more" link when too many events

      // Partidos
      events: [
      <?php foreach ($partidosPendientes as $key ) {
        ?>
        {
          title: '<?php echo $key['idPartido']?>',
          url: 'http://google.com/',
          start: '<?php echo $key['fecha']."T".$key['hora'];?>',
        },
        <?php }?>
        ]
      });
  });
</script>

<!--/Calendario -->









<!-- DATATABLE -->
<link href="assets/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>

<link href="assets/css/responsive.dataTables.min.css" rel="stylesheet">
<script type="text/javascript" src="assets/js/dataTables.responsive.min.js"></script>






<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cargando ...</h4>
      </div>
      <div class="modal-body">
        <div class="preloader"> <i class="fa fa-circle-o-notch fa-spin"></i></div>
      </div>
      <div class="modal-footer">
            <h4>Espere por favor ... </h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->





<!-- Inicio Pagina -->


<div id="contact-us" class="parallax">
  <div class="container">

    <br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
      <li class="breadcrumb-item active">Partidos</li>
    </ol>

    <div class="page-header">
      <h2> Partidos <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
    </div>

  
    <div class="well">
      <p id="texto-input-black">Para jugar un partido disponible en el sistema, debes ingresar a la opción "Partidos MatchDay". Si quieres
        publicar uno de tus partidos en los cuales faltan jugadores, publícalo en el sistema mediante la opción "Mis Partidos". 
      </p>

    </div>




<div class="container">
  
  <ul class="nav nav-tabs nav-justified">
    <li><a data-toggle="tab" href="#menu1">Partidos Matchday <span class="label label-success"><?php echo $nroPartidosSistema?></span></a></li>
    <li><a data-toggle="tab" href="#menu2">Mis partidos <span class="label label-danger"><?php echo $nroPartidosPendientes?></span></a></li>
    <li><a data-toggle="tab" href="#menu3">Calendario <i class="fa fa-calendar-o" aria-hidden="true"></i></a></li>
  </ul>

  <div class="tab-content">







    <div id="menu1" class="tab-pane fade">

      <?php
      if ( $nroPartidosSistema == 0){
        ?>
        <br>
        <div class="alert alert-warning">
          <strong>Lo sentimos!</strong> Actualmente no hay partidos disponibles en MatchDay. Inténtalo más tarde.
        </div>
        <?php
      } else {
        if ($nroPartidosSistema == 1){
          $msg1 = "partido disponible";
        } else {
          $msg1 = "partidos disponibles";
        }
        ?>
        <!-- TABLA DE Partidos Sistema -->
        <br>
        <div class="alert alert-success">
          <strong>Atención!</strong> Hay <?php echo $nroPartidosSistema." ".$msg1 ?> para ti.
          Puedes enviar una solicitud para unirte a un partido haciendo click en el botón
          <button type="button" class="btn btn-primary btn-xs">Unirse <i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>.
        </div>
          <div class="col-md-12">
            <!--div class="table-responsive"-->
              <table id="example2" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">Fecha</th>
                    <th id="encabezado-especial">Hora</th>
                    <th id="encabezado-especial">Recinto</th>
                    <th id="encabezado-especial">Participantes</th>
                    <th id="encabezado-especial"></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($partidosSistema as $item) {
                  ?>
                  <tr>
                    <td>
                      <?php 
                      echo $item['fecha']?>
                    </td>
                    <td>
                      <?php echo $item['hora']?>
                    </td>
                    <td>
                      <?php echo $item['nombre']?>
                    </td>
                    <td>
                      5/10
                    </td>
                    <td>
                      <button type="button" class="btn btn-primary" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                      onclick="carga_ajax('modal','<?php echo $item['idPartido']?>','resumen');">
                      Unirse 
                        <i class="fa fa-paper-plane" aria-hidden="true"></i>
                    </button>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            <!--/div-->
          </div>
        <!-- /TABLA DE PARTIDOS Sistema -->


        
        <script type="text/javascript">
          $(document).ready(function() {
            $('#example2').DataTable({
              responsive: true
            });
        } );


        </script>
        <?php
      }
      ?>
    </div>







    <div id="menu2" class="tab-pane fade">

      <?php
      if ($nroPartidosPendientes == 0){
        ?>
        <br>
        <div class="alert alert-success">
          <strong>Atención!</strong> Actualmente no tienes partidos pedientes en MatchDay.
        </div>
        <?php
      } else {
        if ($nroPartidosPendientes == 1){
          $msg2 = "partido pendiente";
        } else {
          $msg2 = "partidos pendientes";
        }
        ?>
        <!-- TABLA DE Partidos Pendientes -->
        <br>
        <div class="alert alert-danger">
          <strong>Atención!</strong> Tienes <?php echo $nroPartidosPendientes." ".$msg2?>. Si quieres realizar el partido, puedes
          enviar una noticicación a los demás jugadores de MatchDay haciendo click en el botón 
          <button type="button" class="btn btn-success btn-xs">Notificar <i class="fa fa-exclamation-circle" aria-hidden="true"></i></button>. 
          De lo contrario, cancela el partido haciendo click en el botón 
          <button type="button" class="btn btn-danger btn-xs">Cancelar <i class="fa fa-times-circle" aria-hidden="true"></i>
          </button>.
        </div>
          <div class="col-md-12">
            <!--div class="table-responsive"-->
              <table id="example" class="table table-striped table-hover display responsive nowrap"  cellspacing="0" width="100%">
                <thead id ="position-table">
                  <tr id="color-encabezado">
                    <th id="encabezado-especial">Fecha</th>
                    <th id="encabezado-especial">Hora</th>
                    <th id="encabezado-especial">Recinto</th>
                    <th id="encabezado-especial">Participantes</th>
                    <th id="encabezado-especial"></th>
                    <th id="encabezado-especial"></th>
                  </tr>
                </thead>
                <tbody id="texto-contactos" class="center">
                  <?php
                  foreach ($partidosPendientes as $item) {
                  ?>
                  <tr>
                    <td>
                      <?php 
                      echo $item['fecha']?>
                    </td>
                    <td>
                      <?php echo $item['hora']?>
                    </td>
                    <td>
                      <?php echo $item['nombre']?>
                    </td>
                    <td>
                      5/10
                    </td>
                    <td>
                      <button type="button" class="btn btn-danger" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                      onclick="carga_ajax('modal','<?php echo $item['idPartido']?>','cancelar');">
                      Cancelar 
                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                      </button>
                    </td>
                    <td>
                      <button type="button" class="btn btn-success" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  
                      onclick="carga_ajax('modal','<?php echo $item['idPartido']?>','notificar');">
                      Notificar 
                        <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                    </button>
                    </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            <!--/div-->
          </div>
        <!-- /TABLA DE PARTIDOS Pendientes -->


        
        <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable({
              responsive: true
            });
        } );


        </script>
        <?php
      }
      ?>


    </div>


    <div id="menu3" class="tab-pane fade">
      <p>Calendario de partidos: partidos activos, jugados y cancelados.</p>

      <style>
      #calendar1 {
        max-width: 800px;
        margin: 0 auto;
      }
      </style>
      <br/>

      <div id='calendar1' ></div>


    </div>





  </div>
</div>


       



  </div>
</div>


<!-- Fin Pagina -->


<!-- DATEPICKER-->
<script>
$(document).ready(function(){
var date_input=$('input[name="date"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
var options={
  format: 'dd-mm-yyyy',
  container: container,
  todayHighlight: true,
  autoclose: true,
  startDate: "<?php echo "d-m-Y"?>",
};
date_input.datepicker(options);
})
</script>

<?php
include('layout/footer.php'); 
?>
  




<script>
 
function carga_ajax(div, id, tipo){

  /* Acceder al resumen de un partido disponible en el sistema */
  if (tipo == 'resumen'){
    $.post(
      '?controlador=Partido&accion=detallePartido&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }
  /* Acceder al resumen de un partido pendiente y cancelarlo */
  if (tipo == 'cancelar'){
    $.post(
      '?controlador=Partido&accion=cancelarPartido&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }
  /* Acceder al resumen de un partido pendiente y notificarlo */
  if (tipo == 'notificar'){
    $.post(
      '?controlador=Partido&accion=notificarPartido&idPartido='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }



  
}
</script>   




