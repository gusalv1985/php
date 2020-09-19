<?php
//class Usuarios extends CI_Controller
//{
//	public function index()
//	{
//		//echo "Hola";
//		//die("linea 6 ok"); //para detener el codigo en una parte
//		$dato="hola";
//		$data['title'] = ucfirst($dato); // Capitaliza la primera letra
//		$data['principal'] = "Bienvenido";
//		$this->load->view('templates/encabezado', $data);
//		$this->load->view('usuarios/inicio', $data);
//		$this->load->view('templates/pie', $data);
//	}
//}
class Usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('session');
		$this->load->model('usuarios_model');
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

	//Si queremos listar un usuario en particular
	public function ver($numero=FALSE)
	{
		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
		}

		if ($numero===FALSE) {
			$data['usuarios'] = $this->usuarios_model->get_usuarios();
			$data['title'] = "Todos";
			//print_r($data);
			$this->load->view('templates/encabezado', $data);
			$this->load->view('usuarios/todos', $data);
			$this->load->view('templates/pie');
		} else {
			$data['usuario_item'] = $this->usuarios_model->get_usuario_by_id($numero);
			//print_r($data);
			if ($data['usuario_item']==FALSE) {
				show_404();
			}
			$data['title'] = $data['usuario_item']['nombre'];
			//print_r($data);
			$this->load->view('templates/encabezado', $data);
			$this->load->view('usuarios/uno', $data);
			$this->load->view('templates/pie');
		}
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
			print_dump($usuario);
			//die('Fin');
			if ($usuario!=FALSE&&$password==$usuario['password']) {
				session_set('usuario',$usuario['nombre']);
				redirect('usuarios/inicio');
			}
			redirect('usuarios/loginfail');
		}
	}
	
	public function inicio()
	{
		if (session_get('usuario')==FALSE) {
			redirect('usuarios');
		}
		$data['principal']=" principal de ";
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
	public function auxiliar(){
		$ubicacion="./archivos/abreviaturas.txt";
		echo $ubicacion."<BR>";
		echo "<p>".anchor($ubicacion,'Ver archivo')."</p>";
		$archivo = fopen($ubicacion, "r") or die("No puedo abrir el archivo!");
		echo fread($archivo,filesize($ubicacion));
		fclose($archivo);
		
		echo "<br><br>Lectura de 2 lineas<br>";
		$ubicacion="./archivos/abreviaturas.txt";
		$archivo = fopen($ubicacion, "r") or die("No pude abrir el archivo");
		echo fgets($archivo);
		echo "<br>";
		echo fgets($archivo);
		fclose($archivo);
		
		echo "<br><br>Lectura completa del archivo linea por linea<br>";
		$ubicacion="./archivos/abreviaturas.txt";
		$archivo = fopen($ubicacion, "r") or die("No pude abrir el archivo");
		while (!feof($archivo)) {
			echo fgets($archivo);
			echo "<br>";
		}
		fclose($archivo);
		
		echo "<br><br>Lectura caracter a caracter<br>";

		$ubicacion="./archivos/abreviaturas.txt";
		$archivo = fopen($ubicacion, "r") or die("No pude abrir el archivo");
		while (!feof($archivo)) {
			echo fgetc($archivo);
		}
		fclose($archivo);
		

		$ubicacion="./archivos/prueba.txt";
		echo "<p>".anchor($ubicacion,'Ver archivo escrito')."</p>";
		$archivo = fopen($ubicacion, "w")  or die("No pude crear el archivo");
		$txt = "Juan perez\n";
		fwrite($archivo, $txt);
		$txt = "Jose Lopez\n";
		fwrite($archivo, $txt);
		fclose($archivo);
		
		$ubicacion="./archivos/prueba.txt";
		$archivo = fopen($ubicacion, "w")  or die("No pude crear el archivo");
		$txt = "Juan perez II\n";
		fwrite($archivo, $txt);
		$txt = "Jose Lopez II\n";
		fwrite($archivo, $txt);
		fclose($archivo);
		
		$ubicacion="./archivos/prueba.txt";
		$archivo = fopen($ubicacion, "a")  or die("No pude crear el archivo");
		$txt = "Juan perez III\n";
		fwrite($archivo, $txt);
		$txt = "Jose Lopez III\n";
		fwrite($archivo, $txt);
		fclose($archivo);
		
		//------------------------------------ practica ----------------------------------------
				
		echo "<br><br>aca empieza el txt que no lo lee por que es codigo<br>";		
				
		$ubicacion="./archivos/encabezado.txt";
		$archivo = fopen($ubicacion, "r") or die("No pude abrir el archivo");
		while (!feof($archivo)) {
			echo fgets($archivo);
			echo "<br>";
		}
		fclose($archivo);
		
		// esto hizo algo pero no funca bien del todo
		//$fp = fopen($ubicacion, "r");
		//fseek($fp, 28);
		//while (!feof($fp)) {
		//	$linea = fgets($fp);
		//	echo $linea;
		//}
		//fclose($fp);
		
		$ubicacion="./archivos/pie.txt";
		$archivo = fopen($ubicacion, "r") or die("No pude abrir el archivo");
		while (!feof($archivo)) {
			echo fgets($archivo);
			echo "<br>";
		}
		fclose($archivo);
		
		echo "<br><br>aca termina el txt que no lo lee por que es codigo<br>";	
		
		$ubicacion="./archivos/todoJunto.html";
		$archivo = fopen($ubicacion, "w")  or die("No pude crear el archivo");
		$txt = file_get_contents("./archivos/encabezado.txt");
		fwrite($archivo, $txt);
		$txt =file_get_contents("./archivos/lineasHtml.txt");
		fwrite($archivo, $txt);
		$txt = file_get_contents("./archivos/pie.txt");
		fwrite($archivo, $txt);
		fclose($archivo);
		
		$ubicacion="./archivos/todoJunto.html";
		echo "<p>".anchor($ubicacion,'Ver archivo html')."</p>";
		$archivo = fopen($ubicacion, "r") or die("No puedo abrir el archivo!");
		//echo fread($archivo,filesize($ubicacion));
		fclose($archivo);
		
		$origen = "./archivos/todoJunto.html";	
		if (copy($origen,"./archivos/copiaTJ.html")) {
			echo "El fichero ha sido copiado\n";
		} else {
			echo "Se ha producido un error al intentar copiar el fichero\n";
		}
		
		
	}
	public function galeria(){
		$archivos=array();
			//$archivos[1]='';
			$dir="imagenes/"; //Seteamos carpeta a explorar
			$directorio = opendir($dir); //Abrimos carpeta para explorar archivos

			while($archivo = readdir($directorio)){ //leemos una a una las entradas del directorio
				if (!is_dir($archivo)){//si la entrada es un archivo, lo guardamos.
					$archivos[]=base_url().$dir.$archivo;
					/*Las ubicaciones reliativas son locales al servidor pero el framework nos obliga a especificar la ruta del 
					recurso por eso debemos incluir el base url en la ubicacion.*/
				}

			}	
			//cerramos el directorio | carpeta
			closedir($directorio);
			//print_dump($archivos);
			//el array de archivos lo pasamos a la vista para trabajar desde alli
			$data['archivos']=$archivos;
			$this->load->view('usuarios/galeria',$data);
	}
	
	public function do_upload()
	{
		$config['upload_path'] = 'imagenes/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = 2048;
		//$config['max_width'] = 1024;
		//$config['max_height'] = 768;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			session_set('error_upload',$error);
			redirect('Usuarios/galeria');
		} else {
			$data = array('upload_data' => $this->upload->data());
			session_set('error_upload','');
			$this->load->view('usuarios/upload_success', $data);
		}
	}
	
}
?> 