
<table id="horarios" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Horas</th>
			<th>Dias</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Nombre</th>
			<th>Horas</th>
			<th>Dias</th>
			<th>Precio</th>
		</tr>
	</tfoot>
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

<script>
//Script para inicializar el datatable

</script>
