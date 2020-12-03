<?php namespace App\Controllers\API;


use App\Models\ProfesorModel;
use App\Models\GradoModel;
use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;


class Roles extends ResourceController
{

    //setear el modelo
	//crear un constructor
	public function __construct() {
		$this->model = $this->setModel(new RolModel());
	}

//LISTAR todos los datos
	public function index()
	{
		//que encuentre todos los roles
		$Roles = $this->model->findAll();

		//metodo respond
		return $this->respond($Roles);
	}

//INSERTAR
	//metodo que permita inserar info dentro de la tabla a traves de rest con codeigniter
	public function create()
	{
		try {
			//recibir info en nuestra rest 
			//this (por estar heredando de ResourceController) y el request que permite manejar todas las peticiones http agarrando todo el json
			$rol = $this->request->getJSON();

	   //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
			if($this->model->insert($rol)):

				//el prosefor que acabo de insertar retornarle un id (devolver el id que se inserta)
				$rol->id = $this->model->insertID();

				//SI recibe correstamente la data
				return $this->respondCreated($rol);
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
			$rol = $this->model->find($id);

			//validar si rol es nulo
			if($rol == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un rol con el id: '.$id);

			//$usuarioModel = new UsuarioModel();
			//$rol["usuario"] = $usuarioModel->where('rol_id', $rol['id'])->findAll();

			//si encontro el id retornar con respond
			return $this->respond($rol);


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
			$rolVerificado = $this->model->find($id);

			//validar si rol es nulo
			if($rolVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un rol con el id: '.$id);

			//obtener el rol con la peticion
			$rol = $this->request->getJSON();

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->update($id, $rol)):
		//recuperar el id
		$rol->$id = $id;


		//SI recibe correstamente la data
		return $this->respondUpdated($rol);
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
			$rolVerificado = $this->model->find($id);

			//validar si rol es nulo
			if($rolVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un rol con el id: '.$id);

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->delete($id)):

		//SI recibe correstamente la data
		return $this->respondDeleted($rolVerificado);
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
