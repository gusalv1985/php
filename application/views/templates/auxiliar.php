<link rel="StyleSheet" href="<? echo base_url();?>css/stylesAux.css" type="text/css" media="screen">
<div id='main'>
<div id='encabezado'>Encabezado</div>
<?php
	$paneles=array("Uno","Tres","Dos","Cuatro","Seis","Cinco","Siete","Nueve","Ocho");
	$contador=1;
	foreach($paneles as $panel){
		echo "\t\t<div  id='id_$contador' class='caja'>".$panel."</div>\n\r";
        $contador++;
	}
?>
<div id='pie'>Pie</div>
</div>