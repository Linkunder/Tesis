


<?php
include('layout/headerAdmin.php');


$recintos = $vars['recintos'];


?>


<!-- DataTables CSS -->
<link href="assets/assetsAdmin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="assets/assetsAdmin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">


        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Recintos 
                        <button type="button" class="btn btn-success btn-md">
                            <strong>Nuevo recinto</strong> 
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>
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
                                        <th>Tipo</th>
                                        <th>Superficie</th>
                                        <th>Estado</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($recintos as $key) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']?></td>
                                        <td><?php echo $key['tipo']?></td>
                                        <td><?php echo $key['superficie']?></td>
                                        <td class="centrado">
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
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <?php 
                                            if ($key['estado'] == 1){
                                                ?>
                                                <button type="button" class="btn btn-warning btn-sm col-xs-12">Desactivar 
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </button>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <button type="button" class="btn btn-success btn-sm col-xs-12">Activar
                                                    <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                </button>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12">Editar 
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
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