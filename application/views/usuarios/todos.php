<table border="1">
	<th>id</th>
	<th>Nombre</th>
	<th>email</th>
	<?php foreach ($usuarios as $usuario) : ?>
		<tr>
			<?
			echo "<td>".$usuario['id']."</td>";
			echo "<td>".$usuario['nombre']."</td>";
			echo "<td>".$usuario['email']."</td>";
			$destino = 'usuarios/ver/'.$usuario['id'];
			echo "<td>".anchor($destino,'Ver')."</td>";
			//echo "<td><a href=./ver/".$usuario['id'].">Ver</a></td>";
			?>
		</tr>
	<?php endforeach ?>
</table>
<p><? echo anchor('usuarios/salir','Salir') ?></p>
<?
print_dump($_SESSION);
echo session_id().'<BR>';
echo session_name().'<BR>';
?>


