<script src="<?echo base_url();?>js/compo_inicio_art.js" defer></script>
<div id="aplicacion">
<peticion-asincronica inline-template>
<div>
<div  v-if='!enviado'>
	<?
	//$errorRegistro = TRUE;
	echo validation_errors();
	echo form_open('articulos/procesar_ok',"v-on:submit.prevent='mostrar' v-if='!enviado' ref='form'");
		echo	"<h2 style='color:beige'>Direccion:</h2>";
		echo"<div class='form-group'><label for='nombre'>Calle: </label> ";
		$data=array(
			'type'=> 'text',
			'name' => 'calle',
			'v-model'=> 'calle',
			'class'=> 'form-control medioInput',
		);
		echo form_input($data);
		echo "</div>";
		echo"<div class='form-group'><label for='nombre'>Altura: </label> ";
		$data=array(
			'type'=> 'text',
			'name' => 'altura',
			'v-model'=> 'altura',
			'class'=> 'form-control medioInput',
		);
		echo form_input($data);
		echo "</div>";

	echo form_fieldset("nuestro articulos"); ?>
		<table  id="tabla" class="table table-hover " border="1">
		<thead  class="thead-dark">
		<th></th>
		<th>descripcion</th>
		<th>precio $</th>
		<th>cantidad</th>
		</thead>
		<?$i=0;?>
		<?php foreach ($articulos as $articulo) : ?>	
			<tr>
				<?
				echo "<td>"."<input type=checkbox name=valores[] value='$articulo[id]' v-model='valores' >"."</td>";
				echo "<td>".$articulo['descripcion']."</td>";
				echo "<td>".$articulo['precio']."</td>";
				echo "<td>"."<input className='numero' id='$articulo[id]' type='number' name=number[] value='' v-model='numero[$i]' >"."</td>";
				?>
			</tr>
			<?$i = $i+1;?>
		<?php endforeach ?>
	</table>
	<div style="color:white" ref="error"></div>
	<?php echo"<div class='btn'>";
		echo "<BR>";
		$data=array(
			'type'=> 'submit',
			'class'=> 'btn btn-primary',
		);
		echo form_submit($data,'Enviar');
		echo "<BR>";
	echo "</div>";
	echo form_close("<BR>");?>

	<?php echo form_fieldset_close();
		echo "<BR>";
			$destino = 'usuarios/salir';
			$atributo="class='btn btn-secondary'";
			echo anchor($destino,'Salir',$atributo);
			echo "<BR>";
			?>
	
	
  </div>
  <div ref="mensaje"></div>
</div>  
</peticion-asincronica>
</div>