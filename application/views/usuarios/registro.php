<?
echo validation_errors();
echo form_open('usuarios/validarregistro');// param1= action param2=atributos. Si no paso atributo 2 => usa method=post
		echo form_fieldset("Formulario de registro");
			echo "<h5>Usuario</h5>".form_input('usuario');//param1 atributo name, param2 atributo value
			$errorRegistro=session_get('errorRegistro');
			echo $errorRegistro['usuario'];
			echo "<h5>Contraseña</h5>".form_password('password');
			echo $errorRegistro['password'];
			echo "<h5>Confirmar contraseña</h5>".form_password('passconf');
			echo $errorRegistro['passconf'];
			echo "<h5>Email</h5><input type='email' name='email' value=''/><BR>";
			echo $errorRegistro['email'];
			echo form_submit('','Enviar');//param1 atributo name, param2 atributo value
		echo form_fieldset_close();
echo form_close("<BR>");
?>
<p><?php echo anchor('usuarios/', 'Inicio');
//print_dump($_SESSION);
?></p>