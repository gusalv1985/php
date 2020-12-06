<?php

class Articulos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('session');
		$this->load->model('usuarios_model');
		$this->load->model('articulos_model');
		$this->load->helper('funciones');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
	}
	
	//------------------------------------------------- para el parcial----------------------


	
	public function articulosTodos(){
		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
		}
		$data['articulos'] = $this->articulos_model->get_articulos();
		$data['title']='articulos';
		$this->load->view('templates/encabezado', $data);
		$this->load->view('articulos/inicio', $data);
		$this->load->view('templates/pie');
	}


	
	public function procesar_ok()
	{

		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
		}

		//print_dump($_POST);
		if ($this->form_validation->run() == FALSE) {
			$errorRegistro['calle']=form_error('calle').'<BR>';
            $errorRegistro['altura']=form_error('altura').'<BR>';
			print_dump($errorRegistro);
			
			if($this->input->is_ajax_request()){
				$response_array['mensaje'] ='Error';
				$response_array['respuesta'] =$errorRegistro; 
				header('Content-type: application/json');
				echo json_encode($response_array);					
				return;//Return evita que PHP dibuje el resto de la salida
			}
			$this->load->view('articulos/error');
			

		} else {

			
	
			$data["calle"]=($_POST['calle']);
			$data["altura"]=($_POST['altura']);
			$id["ids"]=($_POST['valores']);
			$da["cantidad"]=($_POST['number']);
			//print_dump($id);
			//print_dump($da);
									
			$art['articulos'] = $this->articulos_model->get_articulos();
			//print_dump( count($art['articulos']));
			//print_dump($id["ids"]);
			  for ($i=0; $i < count($art['articulos'])  ; $i++) { 
			  	for ($j=0; $j < count($id['ids']) ; $j++) { 
					if ($art["articulos"][$i]["id"] == $id["ids"][$j] ) {
						$data["articulos"][$i] = $art["articulos"][$i];
					}
			 	 }
			  }

			//para probar si va y deuelve un objeto json
			//   if($this->input->is_ajax_request())
			//   {	
				
			// 	  print_dump($_POST);
			// 	  print_dump($id);
			// 	  print_dump($da);
			// 	  print_dump($data);
			// 	  die();
			// 	  $response_array['respuesta'] =$_POST; 
			// 	  header('Content-type: application/json');
			// 	  echo json_encode($response_array);					
			// 	  return;//Return evita que PHP dibuje el resto de la salida
			//   }
			
			   for ($i=0; $i < count($id['ids']) ; $i++) {
				
					$posicion = ($id['ids'][$i] - 1);
						$data["articulos"][$posicion]["cantidad"] = $da["cantidad"][$posicion];
					 	
						
			   }

	
	        
        $ubicacion="./archivos/pedido.php";
		$archivo = fopen($ubicacion, "w")  or die("No pude crear el archivo");
		$txt ="<div class='borde'>";
		fwrite($archivo, $txt);
		$txt = "<h3 style='color:white'>Direccion: ".$data["calle"]." &nbsp" .$data["altura"]."</h3>";
		fwrite($archivo, $txt);
		$txt = "<table id='tabla' class='table table-hover' border='1'>
		<thead  class='thead-dark'>
		<th>tipo</th><th>cantidad</th><th>precio</th><th>subtota</th>
		</thead>";
		fwrite($archivo, $txt);
		foreach ($data["articulos"] as $articulo){
			$descripcion = $articulo["descripcion"];
			$cantidad = $articulo["cantidad"];
			$precio = $articulo["precio"];
			$calc = $articulo["precio"]*$articulo["cantidad"];
		$txt = "<tr>

		<td>".$descripcion."</td>
		<td>".$cantidad ."</td>
		<td>".$precio."</td>
		<td>".$calc."</td>

		</tr>";
		fwrite($archivo, $txt);
		} 
		$total = 0;
		foreach ($data["articulos"] as $articulo){
		$total += $articulo["precio"]*$articulo["cantidad"];
		}
		 
		$txt=" </table> <h3 style='color:white'>total: ".$total." </h3>";
		fwrite($archivo, $txt);
		if($total > 3000){ 
			$descuento = ($total * 0.05); 
			$result = ($total - $descuento);
		$txt= "<h3 style='color: white'>total con 5% de descuento: ".$result."</h3>";
		fwrite($archivo, $txt);
		}
		$txt= "<div class='botones'><a href='http://localhost/2020/parcial2-2020/articulos/articulosTodos' class='btn btn-primary'>Volver</a>";
		fwrite($archivo, $txt);
        $txt= "<a href='http://localhost/2020/parcial2-2020/' class='btn btn-info'>Salir</a></div>";
		fwrite($archivo, $txt);
		$txt= "</div>";
		fwrite($archivo, $txt);
			
		fclose($archivo);

		if($this->input->is_ajax_request()){
			$response_array['mensaje'] = $this->load->view('articulos/procesar_ok');;
			header('Content-type: application/json');
			echo json_encode($response_array);					
			return;//Return evita que PHP dibuje el resto de la salida
		}

		 $data['title']='pedido';
		
		 $this->load->view('templates/encabezado',$data);
		 $this->load->view('articulos/procesar_ok');
		 $this->load->view('templates/pie');
		
		}
	}	

	public function verPedido()
	{
	
		
		//$this->load->view('templates/encabezado');
		$ubicacion="./archivos/pedido.php";
		$archivo = fopen($ubicacion, "r") or die("No puedo abrir el archivo!");
		
		
			if($this->input->is_ajax_request())
			{
				$generado = fread($archivo,filesize($ubicacion));
				$response_array['respuesta'] = 	$generado;
				header('Content-type: application/json');
				echo json_encode($response_array);					
				return;//Return evita que PHP dibuje el resto de la salida
			}

			echo fread($archivo,filesize($ubicacion));
			$data['title']='pedido';
			$this->load->view('templates/encabezado',$data);
			
			$this->load->view('templates/pie');	
		
		fclose($archivo);
		//echo "<p>".anchor('usuarios/','salir')."</p>";

	}
			
}
?> 