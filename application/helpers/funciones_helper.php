<? // ver el contenido de una variable
function print_dump($parametro, $modo="raw")
{
	echo "<pre>";
	if ($modo == "raw") {
		print_r($parametro);
	} else {
		var_dump($parametro);
	}
	echo "</pre>";
}
?>