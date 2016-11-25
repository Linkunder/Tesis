


<?php
include('layout/headerAdmin.php');


$equipos = $vars['equipos'];


?>


<!-- DataTables CSS -->
<link href="assets/assetsAdmin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="assets/assetsAdmin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">


        <div id="page-wrapper">

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Equipos 
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
                                        <th>Puntuacion</th>
                                        <th>PJ</th>
                                        <th>PC</th>
                                        <th>Capitán</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($equipos as $key) {
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']?></td>
                                        <td><?php echo $key['puntuacion']?></td>
                                        <td><?php echo $key['partidosDisputados']?></td>
                                        <td><?php echo $key['partidosCancelados']?></td>
                                        <td><?php echo $key['idCapitan']?></td>
                                        <td class="center">
                                            <button type="button" class="btn btn-primary btn-md">Modificar</button>
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