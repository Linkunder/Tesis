<?php
$equipo = $vars['equipo'];

foreach ($equipo as $key ) {
?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title"><?php echo $key['nombre']?></h3>
    </div>
    <div class="modal-body">
      
    </div>
    <div class="modal-footer">
      
    </div>
  </div>
</div>
<?php
}
?>