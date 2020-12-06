<h1>Home <? echo $principal ?></h1>
<?
$destino = 'articulos/articulosTodos';
			$atributo="class='btn btn-info'";
            echo anchor($destino,'Vayamos de compras 🛒',$atributo);
            echo "<BR>"
?>