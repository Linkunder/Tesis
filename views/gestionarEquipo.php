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
    <script src="assets/js/jquery.bootstrap-duallistbox.js"></script>

<link href="assets/css/profile.css" rel="stylesheet">

<div id="contact-us" class="parallax">
    <div class="container">


        <?php 
        foreach ($equipo as $key) {
            $partidosDisputados = $key['partidosDisputados'];
            $partidosCancelados = $key['partidosCancelados'];
            $idEquipo = $key['idEquipo'];
            $_SESSION['idEquipo'] = $idEquipo;
        ?>
    </br>
    <ol class="breadcrumb transparent">
      <li class="breadcrumb-item"><a href="?controlador=Equipo&accion=listaEquipos"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Equipos</a></li>
      <li class="breadcrumb-item active"><?php echo $key['nombre']?></li>
    </ol>

        <div class="page-header">
          <h2> Gestión <?php echo $key['nombre']?> <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
        </div>

        






        <div class="row">
            <p class="centered">En esta sección puedes agregar jugadores desde tu lista de contactos a <?php echo $key['nombre']?>
            </p>
            <form id="demoform" action="?controlador=Equipo&accion=updateEquipo" method="post">
                <select multiple="multiple" size="<?php count($listaContactos)?>" name="arrayContactos[]" class="demo2">
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


            <br/>

            <div class="row">
            <div class="page-header">
              <h3> Estadísticas <i class="fa fa-bar-chart" aria-hidden="true"></i> </h3>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center"><strong>Número de partidos</strong></h3>
                        </div>
                        <div class="panel-equipo">
                            <div class="panel-body">
                                <div class="sample-chart-wrapper">
                                    <canvas id="pie-chart-sample4" ></canvas>
                                </div>
                            </div> 
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Partidos Disputados</th>
                                    <td><?php echo $partidosDisputados?></td>
                                </tr>
                                <tr>
                                    <th>Partidos Cancelados</th>
                                    <td><?php echo $partidosCancelados?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel-heading">
                            <h3 class="panel-title" align="center"><strong>Horario de partidos</strong></h3>
                        </div>
                        <div class="panel-equipo">
                            <div class="panel-body">
                                <div class="sample-chart-wrapper">
                                    <canvas  ></canvas>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>


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