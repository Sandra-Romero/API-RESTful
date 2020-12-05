<?php namespace App\Controllers\API;

use App\Models\UsuarioModel;
use App\Models\RolModel;
use CodeIgniter\RESTful\ResourceController;


class Usuarios extends ResourceController
{

    //setear el modelo
	//crear un constructor
	public function __construct() {
		$this->model = $this->setModel(new UsuarioModel());
	}

//LISTAR todos los datos
	public function index()
	{


		if(!validateAccess(array('admin'),	$this->$request->getServer('HTTP_AUTHORIZATION')));
		return $this->failServerError('el rol no tiene acceso a este recurso');
 
          try {
			  //code...
			  $Usuarios = $this->model->findAll();
			  return $this->respond($Usuarios);

		  } catch (\Exception $e) {
			  //throw $th;
			  return $this->failServerError('Ocurrio un error en el servidor');

		  }


	

	}

//INSERTAR
	//metodo que permita inserar info dentro de la tabla a traves de rest con codeigniter
	public function create()
	{
		try {
			//recibir info en nuestra rest 
			//this (por estar heredando de ResourceController) y el request que permite manejar todas las peticiones http agarrando todo el json
			$usuario = $this->request->getJSON();

	   //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
			if($this->model->insert($usuario)):

				//el usuario que acabo de insertar retornarle un id (devolver el id que se inserta)
				$usuario->id = $this->model->insertID();

				//SI recibe correstamente la data
				return $this->respondCreated($usuario);
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
			$usuario = $this->model->find($id);

			//validar si usuario es nulo
			if($usuario == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un usuario con el id: '.$id);

					
			//si encontro el id retornar con respond
			return $this->respond($usuario);


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
			$usuarioVerificado = $this->model->find($id);

			//validar si usuario es nulo
			if($usuarioVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un usuario con el id: '.$id);

			//obtener el usuario con la peticion
			$usuario = $this->request->getJSON();

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->update($id, $usuario)):
		//recuperar el id
        $usuario->$id = $id;


		//SI recibe correstamente la data
		return $this->respondUpdated($usuario);
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
			$usuarioVerificado = $this->model->find($id);

			//validar si usuario es nulo
			if($usuarioVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un usuario con el id: '.$id);

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->delete($id)):

		//SI recibe correstamente la data
		return $this->respondDeleted($usuarioVerificado);
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
