<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
* @var $config contiene el set de reglas para validar formularios. Las mismas son
* cargadas cada ves que ejecutemos $this->form_validation->run()
* Cada set se compone de un juego de reglas para aplicar a cada campo del formulario.
* Si no hay regla en un campo, el mismo no se valida.
* Cada juego se compone del campo afectado, una etiqueta para mostrar y las reglas
* propiamente dichas
*/
$config = array(
//Reglas para el registro de usuario
	'usuarios/validarregistro' => array(//nombre del metodo que las utiliza
		array(
		'field' => 'usuario',
		'label' => 'usuario',
		'rules' => 'required|alpha_dash|min_length[4]|max_length[12]'
		),
		array(
		'field' => 'password',
		'label' => 'contraseña',
		'rules' => 'required|alpha_numeric|min_length[4]|max_length[12]'
		),
		array(
		'field' => 'passconf',
		'label' => 'confirmar',
		'rules' => 'required|alpha_numeric|min_length[4]|max_length[12]|matches[password]'
		),
		array(
		'field' => 'email',
		'label' => 'email',
		'rules' => 'required|valid_email|max_length[20]'
		)
	),
	//reglas para el log in
	'usuarios/validar' => array(//nombre del metodo que las utiliza
		array(
		'field' => 'usuario',
		'label' => 'usuario',
		'rules' => 'required'
		),
		array(
		'field' => 'password',
		'label' => 'contraseña',
		'rules' => 'required'
		)
	)
);
?>