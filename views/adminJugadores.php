


<?php
include('layout/headerAdmin.php');


$jugadores = $vars['jugadores'];


?>


<!-- DataTables CSS -->
<link href="assets/assetsAdmin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="assets/assetsAdmin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">


        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Jugadores 
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nombre </th>
                                        <th>Mail</th>
                                        <th>Teléfono</th>
                                        <th>Edad</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($jugadores as $key) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']." ".$key['apellido']?></td>
                                        <td><?php echo $key['mail']?></td>
                                        <td><?php echo $key['telefono']?></td>
                                        <td>Edad</td>
                                        <td class="center-block">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <span class="label label-success">Activo</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <span class="label label-danger">Inactivo</span>
                                                <?php
                                            }
                                            if ($key['estado'] == 3){
                                                ?>
                                                <span class="label label-warning">Invitado</span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="center">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <button type="button" class="btn btn-warning btn-md">Inhabilitar</button>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <button type="button" class="btn btn-success btn-md">Habilitar</button>
                                                <?php
                                            }
                                            if ($key['estado'] == 3){
                                                ?>
                                                <button type="button" class="btn btn-success btn-md">Nose</button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="center">
                                            <button type="button" class="btn btn-primary btn-md">Ver información</button>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->



        </div>
        <!-- /#page-wrapper -->



<?php
include('layout/footerAdmin.php');

?>

    <!-- DataTables JavaScript -->
    <script src="assets/assetsAdmin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/assetsAdmin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="assets/assetsAdmin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>