


<?php
include('layout/headerAdmin.php');


$equipos = $vars['equipos'];


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
                                        <th>Capitán</th>
                                        <th width='15%'>Puntuacion</th>
                                        <th width='10%'>PJ</th>
                                        <th width='10%'>PC</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($equipos as $key) {
                                        $idEquipo = $key['idEquipo'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $key['nombre']?></td>
                                        <td><?php echo $key['nombreCap']." ".$key['apellidoCap']?></td>
                                        <td><?php echo $key['puntuacion']?></td>
                                        <td><?php echo $key['partidosDisputados']?></td>
                                        <td><?php echo $key['partidosCancelados']?></td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idEquipo?>','equipo');">
                                            Más información 
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
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

<script>
 
function carga_ajax(div, id, tipo){

  if (tipo == 'equipo'){
    $.post(
      '?controlador=Equipo&accion=detalleEquipo&idEquipo='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }
}
</script>