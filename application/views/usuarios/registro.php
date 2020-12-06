
<script src="<?echo base_url();?>js/compo_registro.js" defer></script>
<div id="aplicacion">
	<peticion-asincronica inline-template>
		<div class="container row justify-content-center">
		<?
		echo validation_errors();
		echo form_open('usuarios/validarregistro',"v-on:submit.prevent='mostrar' v-if='!enviado' ref='form'");// param1= action param2=atributos
			echo form_fieldset("Formulario de registro");
			echo "<h5>Usuario</h5>";
			$data=array(
				'type'=> 'text',
				'name' => 'usuario',
				'v-model'=> 'usuario',
				'class'=>"form-control"
			);
			echo form_input($data);
			echo "<BR>";
			$errorRegistro=session_get('errorRegistro');
			//echo $errorRegistro['usuario'];
			echo "<h5>Contraseña</h5>";
			$data=array(
				'type'=> 'password',
				'name' => 'password',
				'v-model'=> 'password',
				'class'=>"form-control"
			);
			echo form_input($data);
			echo "<BR>";
		//	echo $errorRegistro['password'];
			echo "<h5>Confirmar contraseña</h5>";
			$data=array(
				'type'=> 'password',
				'name' => 'passconf',
				'v-model'=> 'passconf',
				'class'=>"form-control"
			);
			echo form_input($data);
		//	echo $errorRegistro['passconf'];
			echo "<BR>";
			echo "<h5>Email</h5>";
			$data=array(
				'type'=> 'email',
				'name' => 'email',
				'v-model'=> 'email',
				'class'=>"form-control"
			);
			echo form_input($data);
			echo "<div style=' background-color: burlywood;' ref='error'></div>";
		//	echo $errorRegistro['email'];
			echo "<BR>";
			$data=array(
				'type'=> 'submit',
				'class'=> 'btn btn-primary btn-block',
			);
			echo form_submit($data,'Enviar');
			echo "<BR>";
			$destino = 'usuarios/inicio';
			$event='$event';
			$atributo="class='btn btn-danger btn-block'";
			echo anchor($destino,'Salir',$atributo);
			
			echo form_fieldset_close();
			echo form_close("<BR>");
			?>
			
			<div  ref='mensaje'>

			</div>
	
		</div>
	</peticion-asincronica>
</div>