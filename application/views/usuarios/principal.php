<script src="<?echo base_url();?>js/compo_login.js" defer></script>
<div id="aplicacion">
	<peticion-asincronica inline-template>
		<div class="container">
			<h1><? echo $principal." a la página principal del sitio" ?></h1>
		<div>
			
			<?
			echo form_open('usuarios/validar', "v-on:submit='mostrar' ref='form'");

			echo"<div class='form-group'><label class='centerLabel'>Ingrese su Usuario: </label> ";
			echo "<BR>";
			$data=array(
				'type'=> 'text',
				'name' => 'usuario',
				'v-model'=> 'usuario',
				'class'=> 'form-control center',
			);
			echo form_input($data);
			echo "</div>";
			$errorRegistro=session_get('errorRegistro');
			echo "<div class='form-group'><label class='centerLabel'>Ingrese su Clave: </label> ";
			echo "<BR>";
			$data=array(
				'type'=> 'password',
				'name' => 'password',
				'v-model'=> 'password',
				'class'=> 'form-control center',
			);
			echo form_input($data);
			echo "</div>";
			//echo "<BR> <BR>";
			$data=array(
				'type'=> 'submit',
				'class'=> 'btn btn-primary centrarBtn',
			);
			echo form_submit($data,'Enviar');
			echo form_close("<BR>");
			echo "<BR><BR>";
			$destino = 'usuarios/registrar';
			$atributo="class='btn btn-info'";
			echo anchor($destino,'Registrarse',$atributo);
			?>
			</div>
		</div>
	</peticion-asincronica>
</div>

