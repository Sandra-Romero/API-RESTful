<?php namespace App\Controllers\API;

//Clase ProfesorModel 
use App\Models\ProfesorModel;
use CodeIgniter\RESTful\ResourceController;


class Profesores extends ResourceController
{

	//setear el modelo
	//crear un constructor
	public function __construct() {
		$this->model = $this->setModel(new ProfesorModel());
	}


	public function index()
	{
		//que encuentre todos los profesores
		$Profesores = $this->model->findAll();

		//metodo respond
		return $this->respond($Profesores);
	}

}
