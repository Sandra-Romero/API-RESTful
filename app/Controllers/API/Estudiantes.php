<?php namespace App\Controllers\API;

//Clase EstudianteModel 
use App\Models\EstudianteModel;
use CodeIgniter\RESTful\ResourceController;


class Estudiantes extends ResourceController
{

     //setear el modelo
	//crear un constructor
	public function __construct() {
		$this->model = $this->setModel(new EstudianteModel());
	}

//LISTAR todos los datos
	public function index()
	{
		//que encuentre todos los Estudiantes
		$Estudiantes = $this->model->findAll();

		//metodo respond
		return $this->respond($Estudiantes);
	}

//INSERTAR
	//metodo que permita inserar info dentro de la tabla a traves de rest con codeigniter
	public function create()
	{
		try {
			//recibir info en nuestra rest 
			//this (por estar heredando de ResourceController) y el request que permite manejar todas las peticiones http agarrando todo el json
			$estudiante = $this->request->getJSON();

	   //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
			if($this->model->insert($estudiante)):

				//el estudiante que acabo de insertar retornarle un id (devolver el id que se inserta)
				$estudiante->id = $this->model->insertID();

				//SI recibe correstamente la data
				return $this->respondCreated($estudiante);
			else: 
				//si hay error en las reglas definidas en el modelo
				return $this->failValidationError($this->model->validation->listErrors());
			endif;

		} catch (\Exception  $e) {
			//retornar un mensaje

			log_message('error', '[ CUSTOM ERROR ] {exception}', ['exception' => $e]);
			return $this->failServerError('Ha ocurrido un error en el servidor');
		}
	}

//EDITAR

public function edit($id = null)
	{
		try {
			//validacion del id
			if($id == null)
			//error de validacion
			return $this->failValidationError('No se ha pasado un ID valido');


			//que el id sea igual que el id de la funcion y va traer el cliente que necesito
			$estudiante = $this->model->find($id);

			//validar si estudiante es nulo
			if($estudiante == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un estudiante con el id: '.$id);

			//si encontro el id retornar con respond
			return $this->respond($estudiante);


		} catch (\Exception  $e) {
			//retornar un mensaje
			return $this->failServerError('Ha ocurrido un error en el servidor');
		}
	}

//actualizar
	public function update($id = null)
	{
		try {
			//validacion del id
			if($id == null)
			//error de validacion
			return $this->failValidationError('No se ha pasado un ID valido');


			//que el id sea igual que el id de la funcion y va traer el cliente que necesito
			$estudianteVerificado = $this->model->find($id);

			//validar si estudiante es nulo
			if($estudianteVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un estudiante con el id: '.$id);

			//obtener el estudiante con la peticion
			$estudiante = $this->request->getJSON();

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->update($id, $estudiante)):
		//recuperar el id
		$estudiante->$id = $id;


		//SI recibe correstamente la data
		return $this->respondUpdated($estudiante);
	else: 
		//si hay error en las reglas definidas en el modelo
		return $this->failValidationError($this->model->validation->listErrors());
	endif;

	
		} catch (\Exception  $e) {
			//retornar un mensaje
			return $this->failServerError('Ha ocurrido un error en el servidor');
		}
	}

//ELIMINAR
	public function delete($id = null)
	{
		try {
			//validacion del id
			if($id == null)
			//error de validacion
			return $this->failValidationError('No se ha pasado un ID valido');


			//que el id sea igual que el id de la funcion y va traer el cliente que necesito
			$estudianteVerificado = $this->model->find($id);

			//validar si estudiante es nulo
			if($estudianteVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un estudiante con el id: '.$id);

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->delete($id)):

		//SI recibe correstamente la data
		return $this->respondDeleted($estudianteVerificado);
	else: 
		//retornar un mensaje
		return $this->failServerError('No se ha podido eliminar el registro');
	endif;

	
		} catch (\Exception  $e) {
			//retornar un mensaje
			return $this->failServerError('Ha ocurrido un error en el servidor');
		}
	}

}
