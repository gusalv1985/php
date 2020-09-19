<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">-->
		<title>
			Ejemplos parte 6!!!
		</title>
	</head>
	<body>
		<div class="galeria">
		Galeria<BR>
		<?php
		print_dump($archivos);
		echo form_open_multipart('Usuarios/do_upload');// param1= action param2=atributos. Si no paso at	ributo 2 => usa method=post
		echo "<input type='file' name='userfile' size='20' /><br /><br />";
		echo form_submit('','Enviar');//param1 atributo name, param2 atributo value
		echo form_close("<BR>");
		print_dump(session_get('error_upload'));
		foreach ($archivos as $archivo) {
			echo anchor($archivo,
			"<div>
				<img src='$archivo' alt='imagen' height='50%' width='50%'>
			</div>");
		}
		?>

	</body>
</html>