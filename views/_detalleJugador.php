<?php
$jugador = $vars['jugador'];

foreach ($jugador as $key ) {
?>
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h3 class="modal-title"><?php echo $key['nombre']." ".$key['apellido']?></h3>
    </div>
    <div class="modal-body">
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
        
      </div>
      <div class="col-md-4">
        
      </div>
    </div>
    <div class="modal-footer">
      
    </div>
  </div>
</div>
<?php
}
?>