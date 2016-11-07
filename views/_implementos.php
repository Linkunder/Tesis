
<table id="implementos" class="display" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<th>Nombre</th>
			<th>Precio</th>
		</tr>
	</tfoot>
	<tbody>
	<?php foreach($vars['implementos'] as $implemento){?>
		<tr>
			<td><?php echo $implemento['nombre'];?></td>
			<td><?php echo $implemento['precio'];?></td>
		</tr>
	<?php } ?>
	</tbody>
</table>

<script>
//Script para inicializar el datatable

</script>
