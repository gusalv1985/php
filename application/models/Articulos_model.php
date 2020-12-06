<?
class Articulos_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_articulos()
	{
		$consulta="
				SELECT *
				FROM articulos
		";
		$resultado=$this->db->query($consulta);
		$resultado=$resultado->result_array();
		if (isset($resultado))
			return $resultado;
		else
			return FALSE;;
	}
	
	public function get_articulo($i)
	{
		
		
		$consulta="
		SELECT * FROM articulos WHERE id = '$i'
		";
		$resultado=$this->db->query($consulta);
		$resultado=$resultado->row_array();
		if (isset($resultado))
			return $resultado;
		else
			return FALSE;;
	}

	public function update_articulo($producto,$precio,$id){
	
		$consulta="
				UPDATE articulos SET descripcion = '$producto', 
				precio = $precio
				WHERE id = '$id' ";
				$resultado=$this->db->query($consulta);
		return $resultado;
	}
	
}
?>