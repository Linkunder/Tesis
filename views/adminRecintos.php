


<?php
include('layout/headerAdmin.php');


$recintos = $vars['recintos'];

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
                    <h1 class="page-header">Recintos 

                        <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#myModal">
                            Nuevo recinto
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </button>

                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

                <?php
                if (isset($vars['recintoAdmin'])){
                  if ($vars['recintoAdmin'] == 1){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El recinto ha sido dessactivado.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 2){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> El recinto ha sido activado.
                    </div>
                    <?php
                  }
                  if ($vars['recintoAdmin'] == 3){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Listo!</strong> La información del recinto ha sido actualizada.
                    </div>
                    <?php
                  }
                } 
                ?>

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
                                        $idRecinto = $key['idRecinto'];
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
                                                <form action="?controlador=Recinto&accion=cambiarEstadoRecinto" method="post">
                                                    <input name="idRecinto" value="<?php echo $idRecinto?>" hidden>
                                                    <input name="estado" value="2" hidden>
                                                    <button type="submit" class="btn btn-warning btn-sm col-xs-12">Desactivar 
                                                        <i class="fa fa-ban" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            if ($key['estado'] == 2){
                                                ?>
                                                <form action="?controlador=Recinto&accion=cambiarEstadoRecinto" method="post">
                                                    <input name="idRecinto" value="<?php echo $idRecinto?>" hidden>
                                                    <input name="estado" value="1" hidden>
                                                    <button type="submit" class="btn btn-success btn-sm col-xs-12">Activar 
                                                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                                                    </button>    
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td class="centrado">
                                            <button type="button" class="btn btn-primary btn-sm col-xs-12" href="javascript:void(0);" 
                                            data-toggle="modal" data-target="#modal" onclick="carga_ajax('modal','<?php echo $idRecinto?>','editar');">
                                            Editar
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





<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agrega un nuevo recinto</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-primary">Agregar <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>












<script>
 
function carga_ajax(div, id, tipo){

  if (tipo == 'editar'){
    $.post(
      '?controlador=Recinto&accion=editarRecinto&idRecinto='+id,
      function(resp){
        $("#"+div+"").html(resp);
      }
      ); 
  }
}
</script>