<?php 

include('layout/headerJugador.php'); 

//  Contactos que están en el equipo.
$listaMiembrosEquipo = $vars['listaMiembrosEquipo'];
$nroJugadores = count($listaMiembrosEquipo);

//  Contactos que no estan en el equipo.
$listaContactos = $vars['listaContactos'];

//  Información del equipo
$equipo = $vars['equipo'];



?>


    <!--link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"-->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-duallistbox.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/prettify/r298/run_prettify.min.js"></script>
    <script src="assets/js/jquery.bootstrap-duallistbox.js"></script>

<link href="assets/css/profile.css" rel="stylesheet">

<div class="section secondary-section" id="contact-us">
    <div class="container">


        <?php 
        foreach ($equipo as $key) {
            $partidosDisputados = $key['partidosDisputados'];
            $partidosCancelados = $key['partidosCancelados'];
            $idEquipo = $key['idEquipo'];
            $_SESSION['idEquipo'] = $idEquipo;
        ?>
            <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Equipo&accion=listaEquipos"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Equipos</a></li>
      <li class="breadcrumb-item active"><?php echo $key['nombre']?></li>
    </ol>
        <h2>Gestión <?php echo $key['nombre']?></h2>
        <hr/>

        <div class="row">
              <div class="col-xs-3 col-md-2">
                  
              </div>


              <div class="col-xs-12 col-md-8">
                <div class="col-xs-6">
                    <!-- FORMULARIO CAMBIAR NOMBRE Y COLOR E INDICAR NRO JUGADORES-->
                    <h4>Información del equipo</h4>
                    <form action="?controlador=Equipo&accion=actualizarInformacion" method="post" class="table-equipo">
                        <table class="table table-form">
                            <tr>
                                <th>Nombre: </th>
                                <th><input class="profile-form-control" name="nombre" id="nombre" value="<?php echo $key['nombre']?>"></th>
                            </tr>
                            <tr>
                                <th>Color: </th>
                                <th><input class="profile-form-control" name="color" id="color" value="<?php echo $key['color']?>"></th>
                            </tr>
                        </table>
                    </form>
                </div>
                <div class="col-xs-6">
                    <!-- GRAFICO CIRCULAR PARTIDOS DISPUTADOS VS CANCELADOS -->
                    <div class="panel-equipo">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center"><strong>Partidos del equipo</strong></h3>                                    
                        </div>
                        <div class="panel-body">
                            <div class="sample-chart-wrapper">
                                <canvas id="pie-chart-sample4" ></canvas>
                            </div>
                            <?php
                            // partidos disputados y canceladores
                            ?>
                            </hr>
                        </div> 
                    </div>
                </div>
              </div>


              <div class="col-xs-3 col-md-2">
                  
              </div>
        </div>
        <div class="row">
            <h4>Jugadores</h4>
            <p class="centered">En esta sección puedes agregar jugadores desde tu lista de contactos a <?php echo $key['nombre']?>
            </p>
            <form id="demoform" action="?controlador=Equipo&accion=updateEquipo" method="post">
                <select multiple="multiple" size="<?php count($listaContactos)?>" name="arrayContactos[]">
                    <?php
                    foreach($listaContactos as $contactos){
                    ?>
                    <option  value="<?php echo $contactos['idUsuario']?>">
                        <?php echo $contactos['idUsuario'].": ".$contactos['nombre']." ".$contactos['apellido']?>
                    </option>
                    <?php
                    }
                    foreach ($listaMiembrosEquipo as $miembros) {
                    ?>
                    <option value="<?php echo $miembros['idUsuario']?>" selected="selected"> <!-- Estos se van a la segunda lista -->
                        <?php echo $miembros['idUsuario'].": ".$miembros['nombre']." ".$miembros['apellido']?>
                    </option>
                    <?php
                    }
                    ?>
                </select>
                <br/>
                <button type="submit" class="btn btn-default btn-block">Actualizar equipo <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </form>

            <script>
            var demo1 = $('select[name="arrayContactos[]"]').bootstrapDualListbox();
            </script>


        </div>
        <?php
        }
        ?>
    </div>
</div>
      






<?php 
include('layout/footer.php'); 
?>


<script type="text/javascript" src="assets/js/chartjs/chart.min.js"></script>
<script type="text/javascript">
        var PieDoughnutChartSampleData4 = [
        {
            value: <?php echo $partidosDisputados?>,
            color:"#2196f3",
            highlight: "#82b1ff",
            label: "Partidos Disputados"
        },
        {
            value: <?php echo $partidosCancelados?>,
            color:"#f44336",
            highlight: "#ff8a80",
            label: "Partidos Cancelados"
        }
        ]

        window.onload = function() {

            window.PieChartSample = new Chart(document.getElementById("pie-chart-sample4").getContext("2d")).Pie(PieDoughnutChartSampleData4,{
                responsive:true
            });

        };
</script>