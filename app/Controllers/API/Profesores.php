<?php namespace App\Controllers\API;

//Clase ProfesorModel 
use App\Models\ProfesorModel;
use App\Models\GradoModel;
use CodeIgniter\RESTful\ResourceController;


class Profesores extends ResourceController
{

    //setear el modelo
	//crear un constructor
	public function __construct() {
		$this->model = $this->setModel(new ProfesorModel());
	}

//LISTAR todos los datos
	public function index()
	{
		//que encuentre todos los profesores
		$Profesores = $this->model->findAll();

		//metodo respond
		return $this->respond($Profesores);
	}

//INSERTAR
	//metodo que permita inserar info dentro de la tabla a traves de rest con codeigniter
	public function create()
	{
		try {
			//recibir info en nuestra rest 
			//this (por estar heredando de ResourceController) y el request que permite manejar todas las peticiones http agarrando todo el json
			$profesor = $this->request->getJSON();

	   //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
			if($this->model->insert($profesor)):

				//el prosefor que acabo de insertar retornarle un id (devolver el id que se inserta)
				$profesor->id = $this->model->insertID();

				//SI recibe correstamente la data
				return $this->respondCreated($profesor);
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
			$profesor = $this->model->find($id);

			//validar si profesor es nulo
			if($profesor == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un profesor con el id: '.$id);

			$gradoModel = new GradoModel();
			$profesor["grado"] = $gradoModel->where('profesor_id', $profesor['id'])->findAll();

			//si encontro el id retornar con respond
			return $this->respond($profesor);


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
			$profesorVerificado = $this->model->find($id);

			//validar si profesor es nulo
			if($profesorVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un profesor con el id: '.$id);

			//obtener el profesor con la peticion
			$profesor = $this->request->getJSON();

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->update($id, $profesor)):
		//recuperar el id
		$profesor->$id = $id;


		//SI recibe correstamente la data
		return $this->respondUpdated($profesor);
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
			$profesorVerificado = $this->model->find($id);

			//validar si profesor es nulo
			if($profesorVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un profesor con el id: '.$id);

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->delete($id)):

		//SI recibe correstamente la data
		return $this->respondDeleted($profesorVerificado);
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
