<html>
<head>
	<title>prueba</title>
</head>
<body>
	<?php
	$usuarios = $vars['listaUsuarios'];
	foreach ($usuarios as $item) {
		echo $item['nombre'];
	}
	?>
</body>
</html>