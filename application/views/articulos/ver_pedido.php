
<h3>Direccion: <?php echo $calle;?>c <? echo $altura; ?> </h3>


<table border="1">
<th>tipo</th>
<th>cantidad</th>
<th>precio</th>
<th>subtotal</th>
<?php foreach ($articulos as $articulo):
	 									?>
<tr>
	<?
	echo "<td>".$articulo["descripcion"]."</td>";
	echo "<td>".$articulo["cantidad"]."</td>";
	echo "<td>".$articulo["precio"]."</td>";
	echo "<td>".$articulo["precio"]*$articulo["cantidad"]."</td>";
	?>
</tr>
<?php endforeach ?>
</table>
	
<?php 
$total = 0;
foreach ($articulos as $articulo)
	:
	$total += $articulo["precio"]*$articulo["cantidad"];
	
	endforeach;
 ?>
<h3>total: <?php echo $total ?> </h3>

<?php if($total > 3000) :
	$descuento = ($total * 0.05); ?>
	<h3>total con 5% de descuento: <?php echo $descuento ?> </h3>
	<?php endif; ?>




<p><?php echo anchor('usuarios/', 'Salir');



