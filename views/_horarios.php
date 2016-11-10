<div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Horarios y tarifas</h4>
      </div>
      <div class="modal-body">
      <?php     if(count($vars['horarios'])!=0){ ?>
      <table id="implementos" class="table bootstrap table-striped label-partido">
<thead>
		<tr>
			<th>Nombre</th>
			<th>Horas</th>
			<th>Dias</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($vars['horarios'] as $horario){?>
		<tr>
			<td><?php echo $horario['nombre']?></td>
			<td><?php echo $horario['horaInicio']."-".$horario['horaFin'];?></td>
			<!-- Para los dias hay que hacer una especie de if para que los vaya sumado y los vaya mostrando-->
			<td>Dias</td>
			<!-- Habria que ver la forma de mostrar el dinero el "formato"-->
			<td><?php echo $horario['precio']?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
	<?php }else{
	?>
	<h2 class="label-partido">No existen Horarios asociados</h2>
	<?php }

	?>
      </div>
      
    </div>
 </div>