<h1><? echo $principal." a la página principal del sitio" ?></h1>

<?
echo form_open('usuarios/validar');//,$stributos=array(
		//'method'=>'get'
	//));// param1= action param2=atributos. Si no paso atributo 2 => usa method=post
		echo form_input ('usuario');
		echo form_password('password');
		echo form_submit('','Enviar');
	echo form_close();
?>
<p><?php echo anchor('usuarios/registrar', 'Registrarse'); ?></p>