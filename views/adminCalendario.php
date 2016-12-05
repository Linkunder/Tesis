

<?php
include('layout/headerAdmin.php');





?>


<!--MODAL -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cargando información</h4>
      </div>
      <div class="modal-body">
        <div class="progress">
            <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!--Modal-->
<!--Contenido de la pagina-->

      <style>
      #calendar1 {
        max-width: 800px;
        margin: 0 auto;
      }
      </style>
      <br/>

      <div id="calendar1" class="progress">
          
           
               <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                </div>
          
      </div>
<!--Contenido de la pagina-->




<?php
include('layout/footerAdmin.php');

?>

<!--Calendario-->
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />

<script src='assets/js/moment.min.js'></script>
<script src="assets/js/es.js"></script>
<script src="assets/lang-all.js"></script>
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
      locale: 'es',

      // Partidos
      events: [
      <?php foreach ($vars['partidosSistema'] as $key ) {
        ?>
        {
          title: '<?php echo $key['idPartido']?>',
          url: 'http://google.com/',
          start: '<?php echo $key['fecha']?>',
          color: '<?php
                //activo naranjo
                if($key['estado']==1)
                    echo "#ff9500"; 
                //jugado Verde
                if($key['estado']==2)
                    echo "#257e4a";
                //cancelado Rojo
                if($key['estado']==3)
                    echo "#c10000";
                //pendiente Azul
                if($key['estado']==4)
                    echo "#00b7ff";
                //matchday Amarillo
                if($key['estado']==5)
                    echo "#fffb00";

           ?>',
        },
        <?php }?>
        ]
      });

    document.getElementById('calendar1').setAttribute("class","fc fc-ltr fc-unthemed");
  });
</script>

<!--/Calendario -->

   