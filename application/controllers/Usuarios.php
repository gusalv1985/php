<?php

class Usuarios extends CI_Controller
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

		//$this->load->helper(array('funciones','url','form')); //otra forma de cargar todos los helper en una llamada
		
	}


	public function index()
	{
		$dato="hola";
		$data['title'] = ucfirst($dato); // Capitaliza la primera letra
		$data['principal'] = "Bienvenido";
		$this->load->view('templates/encabezado', $data);
		$this->load->view('usuarios/principal', $data);
		//$this->load->view('usuarios/inicio', $data);
		$this->load->view('templates/pie', $data);
		
	}


	public function validar()
	{
		
	
		$nombre=addslashes($_POST['usuario']);
		$password=sha1($_POST['password']);
		echo $nombre." ".$password;
		//die("fin");
		if ($this->form_validation->run() == FALSE) {
			redirect('usuarios/');//fuerza una redireccion hacia el metodo indicado como argumento. Es el equivalente de la funcion header() de PHP
		}// no usamos la llamada $this->registrar() porque no produce cambios en la barra de direcciones
		else {
			$usuario=$this->usuarios_model->get_user_by_name($nombre);
			echo $this->db->last_query();

			if ($usuario!=FALSE&&$password==$usuario['password']) {
				session_set('usuario',$usuario['nombre']);
				
				
				if($usuario['rol']=="user"){
					redirect('usuarios/inicio');
				}
				if($usuario['rol']=="admin"){
					redirect('admin/inicio');
				}
			}
			redirect('usuarios/loginfail');
		}
	}
	
	public function inicio()
	{
		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
		}
		$data['principal']="";
		$data['title']='';
		$this->load->view('templates/encabezado', $data);
		$this->load->view('usuarios/inicio', $data);
		$this->load->view('templates/pie');
	}
	
	public function loginfail()
	{
		$data['principal']=" Usuario y/o contraseña incorrecto ";
		$data['title']='';
		$this->load->view('templates/encabezado', $data);
		$this->load->view('usuarios/loginfail', $data);
		$this->load->view('templates/pie');
	}
	
	public function salir(){
		session_terminate();
		redirect('usuarios/');
	}
	
	public function registrar()
	{
		$data['title'] = "Registro";
		$this->load->view('templates/encabezado', $data);
		$this->load->view('usuarios/registro', $data);
		$this->load->view('templates/pie', $data);
	}
	
	public function validarregistro()
	{
		if ($this->form_validation->run() == FALSE) {
			$errorRegistro['usuario']=form_error('usuario').'<BR>';
			//form_label();
			$errorRegistro['password']=form_error('password').'<BR>';
			$errorRegistro['passconf']=form_error('passconf').'<BR>';
			$errorRegistro['email']=form_error('email').'<BR>';
			//die(form_error('usuario').form_error('password'));
			session_set('errorRegistro',$errorRegistro); 

			
			if($this->input->is_ajax_request()){
				$response_array['mensaje'] ='Error de registro';
				$response_array['respuesta'] =$errorRegistro; 
				header('Content-type: application/json');
				echo json_encode($response_array);					
				return;//Return evita que PHP dibuje el resto de la salida
			}


			redirect('usuarios/registrar');//fuerza una redireccion hacia el metodo indicado como argumento. Es el equivalente de la funcion header() de PHP
		}// no usamos la llamada $this->registrar() porque no produce cambios en la barra de direcciones
		else {
			$usuario=addslashes($_POST['usuario']);
			$password=sha1($_POST['password']);
			$email=addslashes($_POST['email']);
			$registro=$this->usuarios_model->registrar(
				$usuario,
				$password,
				$email,
				'user'
			);
			//print_dump($registro);
			//die(form_error('usuario').form_error('password'));
			if ($registro == TRUE) {
				session_terminate();

				if($this->input->is_ajax_request()){
					$response_array['mensaje'] ='Registro Exitoso';
					header('Content-type: application/json');
					echo json_encode($response_array);					
					return;//Return evita que PHP dibuje el resto de la salida
				}

				redirect('usuarios/registrarok');
			} else {
				die("No se pudo registrar!!!!"); //solo con proposito de debug.
			}
		}
	}
	
	public function registrarok()
	{
		$data['title'] = "Registro";
		$this->load->view('templates/encabezado', $data);
		$this->load->view('usuarios/formok', $data);
		$this->load->view('templates/pie', $data);
	}
	public function auxiliar()
	{
		$this->load->view('templates/auxiliar');
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
		$this->load->view('templates/encabezado', $data);
		$this->load->view('articulos/procesar_ok', $data);
		$this->load->view('templates/pie');
	}
	
	public function verPedido()
	{
		
		//print_dump($_POST);
		if ($this->form_validation->run() == FALSE) {
			$errorRegistro['calle']=form_error('calle').'<BR>';
			$errorRegistro['altura']=form_error('altura').'<BR>';
			redirect('usuarios/articulosTodos');
		} else {
			

			$data["calle"]=($_POST['calle']);
			$data["altura"]=($_POST['altura']);
			$id["ids"]=($_POST['valores']);
			$da["cantidad"]=($_POST['number']);
			//print_dump($id);
			
			
			//foreach ($id as $i) {

			//	$j = implode($i);	//implode es para convertir un array en string
			//	$data['articulos'] = $this->articulos_model->get_articulo($j);
			//	print_dump($data);
			//};

				//no es asincronico, si le mando varios trula
				
			$art['articulos'] = $this->articulos_model->get_articulos();
			//print_dump( count($art['articulos']));
			//print_dump($id["ids"]);
			  for ($i=0; $i < count($art['articulos'])  ; $i++) { 
			  	for ($j=0; $j < count($id['ids']) ; $j++) { 
					if ($art["articulos"][$i]["id"] == $id["ids"][$j] ) {
						$data["articulos"][$i] = $art["articulos"][$j];
					}
			 	 }
			  }
			
			   for ($i=0; $i < count($da["cantidad"]) ; $i++) {
				
					if($da["cantidad"][$i] != 0){
						$data["articulos"][$i]["cantidad"] = $da["cantidad"][$i];
					} 	
						
			   }

			    // for ($i=0; $i < count($id['ids']); $i++) { 
			 	//   if(empty($data["articulos"][$i]["cantidad"])){
			 	// 	$data["articulos"][$i]["cantidad"] = 0;
			 	//   }
			    // }
			  
			  //print_dump($data["articulos"]);

			//print_dump($data);
		
		$data['title']='pedido';
		$this->load->view('templates/encabezado',$data);
		$this->load->view('articulos/ver_pedido',$data);
		$this->load->view('templates/pie');
	
		}
	}	
			
}
?> 