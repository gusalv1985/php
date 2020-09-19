<?php
class Usuarios_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_usuario_by_id($elemento = FALSE)
	{
		$consulta="
				SELECT *
				FROM usuarios
				WHERE id = '$elemento'
		";
		$resultado=$this->db->query($consulta);
		//$resultado=$resultado->result_array();
		$resultado=$resultado->row_array();

		if (isset($resultado))
			return $resultado;
		else
			return FALSE;
	}

	public function get_usuarios()
	{
		$consulta="
				SELECT *
				FROM usuarios
		";
		$resultado=$this->db->query($consulta);
		$resultado=$resultado->result_array();
		if (isset($resultado))
			return $resultado;
		else
			return FALSE;
	}
	
	public function get_user_by_name($nombre)
	{
		$consulta="
				SELECT *
				FROM usuarios
				WHERE nombre = '$nombre'
		";
		$resultado=$this->db->query($consulta);
		//$resultado=$resultado->result_array();
		$resultado=$resultado->row_array();

		if (isset($resultado))
			return $resultado;
		else
			return FALSE;
	}
	public function get_user_log_in($nombre, $password){
		$consulta="
				SELECT *
				FROM usuarios
				WHERE nombre = '$nombre' AND password ='$password'
		";
		$resultado=$this->db->query($consulta);
		//$resultado=$resultado->result_array();
		$resultado=$resultado->row_array();

		if (isset($resultado))
			return $resultado;
		else
			return FALSE;
	}
	public function registrar($nombre, $password, $email, $rol='admin')
	{
		$consulta="
			INSERT INTO usuarios (nombre,email,password,rol)
			VALUES('$nombre','$email','$password','$rol')
		";
		$resultado=$this->db->query($consulta);
		return $resultado;
	}
}
?>