<?php

class Admin extends CI_Controller
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


	
	public function inicio(){
		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
        }
        $ubicacion="./archivos/descuento.txt";
		$archivo = fopen($ubicacion, "r") or die("No puedo abrir el archivo!");
	
        fclose($archivo);
        $data['archivo'] = file_get_contents($ubicacion);

		$data['articulos'] = $this->articulos_model->get_articulos();
		$data['title']='articulos';
		$this->load->view('templates/encabezado', $data);
		$this->load->view('admin/inicio', $data);
        $this->load->view('templates/pie');
        
    }
    
    public function actualizar_ok(){

		//para probar si va y deuelve un objeto json
			//   if($this->input->is_ajax_request())
			//   {	
				
			// 	  json_decode($_POST);
				 	
			// 	  die();
			// 	  $response_array['respuesta'] = $data;
			// 	  header('Content-type: application/json');
			// 	  echo json_encode($response_array);					
			// 	  return;//Return evita que PHP dibuje el resto de la salida
			//   }

		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
		}
		  if ($this->form_validation->run() == FALSE) {
		  	$errorRegistro['producto']=form_error('producto[]').'<BR>';
              $errorRegistro['precio']=form_error('precio[]').'<BR>';
              print_dump($errorRegistro);
		  	$this->load->view('admin/error');
		  } else {
			
			$data['producto']=json_decode($_POST['producto']);
			$data['precio']=json_decode($_POST['precio']);
			$data['id']=json_decode($_POST['valores']);
			
			// print_dump($data);

			// 	  if($this->input->is_ajax_request())
			//   {	
			// 	  print_dump($data['producto']);
			// 	  print_dump($data['precio']);
			// 	  print_dump($data['id']);
				 
			// 	  die();
			// 	  $response_array['respuesta'] ="";
			// 	  header('Content-type: application/json');
			// 	  echo json_encode($response_array);					
			// 	  return;//Return evita que PHP dibuje el resto de la salida
			//   }
		
             for ($i=0; $i < count($data['id']); $i++) { 
                    $id=$data['id'][$i];
                   $producto = $data['producto'][$id-1];
                   $precio = $data['precio'][$id-1];
                   $this->articulos_model->update_articulo($producto,$precio,$id);
             }
			
			redirect('admin/inicio');
		}
    }
    
    public function activar(){
        $ubicacion="./archivos/descuento.txt";
		$archivo = fopen($ubicacion, "w")  or die("No pude crear el archivo");
        $txt = "Descuento: Activado;";
 
        fwrite($archivo, $txt);
        fclose($archivo);
        $ubicacion="./archivos/descuento.txt";
		$archivo = fopen($ubicacion, "r") or die("No puedo abrir el archivo!");
		
        fclose($archivo);
        $data['archivo'] = file_get_contents($ubicacion);
        
        
        
        $data['articulos'] = $this->articulos_model->get_articulos();
		$data['title']='articulos';
		$this->load->view('templates/encabezado', $data);
		$this->load->view('admin/inicio', $data);
        $this->load->view('templates/pie');
        
   
    }
    public function desactivar(){
        $ubicacion="./archivos/descuento.txt";
		$archivo = fopen($ubicacion, "w")  or die("No pude crear el archivo");
        $txt = "Descuento: Inactivo;";
 
        fwrite($archivo, $txt);
        fclose($archivo);

        $ubicacion="./archivos/descuento.txt";
		$archivo = fopen($ubicacion, "r") or die("No puedo abrir el archivo!");
		
        fclose($archivo);
        $data['archivo'] = file_get_contents($ubicacion);
        	
        
        $data['articulos'] = $this->articulos_model->get_articulos();
		$data['title']='articulos';
		$this->load->view('templates/encabezado', $data);
		$this->load->view('admin/inicio', $data);
        $this->load->view('templates/pie');
        
       
    }
			
}
?> 