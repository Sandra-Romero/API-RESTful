<?php namespace App\Controllers\API;

//Clase GradoModel 
use App\Models\GradoModel;
//Clase EstudianteModel 
use App\Models\EstudianteModel;
use CodeIgniter\RESTful\ResourceController;


class Grados extends ResourceController
{

    //setear el modelo
	//crear un constructor
	public function __construct() {
		$this->model = $this->setModel(new GradoModel());
	}

//LISTAR todos los datos
	public function index()
	{
		//que encuentre todos los Grados
		$Grados = $this->model->findAll();

		//metodo respond
		return $this->respond($Grados);

		/*$this->model->select('*');
		$this->model->from('profesor');
		$this->model->join('grado', 'grado.profesor_id = profesor.id');
		$consulta = $this->model->get();
		$resultado = $consulta->result();
		*/
	}

//INSERTAR
	//metodo que permita inserar info dentro de la tabla a traves de rest con codeigniter
	public function create()
	{
		try {
			//recibir info en nuestra rest 
			//this (por estar heredando de ResourceController) y el request que permite manejar todas las peticiones http agarrando todo el json
			$grado = $this->request->getJSON();

	   //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
			if($this->model->insert($grado)):

				//el grado que acabo de insertar retornarle un id (devolver el id que se inserta)
				$grado->id = $this->model->insertID();

				//SI recibe correstamente la data
				return $this->respondCreated($grado);
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
			$grado = $this->model->find($id);

			//validar si grado es nulo
			if($grado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un grado con el id: '.$id);

			
			$estudianteModel = new EstudianteModel();
			$grado["estudiante"] = $estudianteModel->where('grado_id', $grado['id'])->findAll();

		
			//si encontro el id retornar con respond
			return $this->respond($grado);


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
			$gradoVerificado = $this->model->find($id);

			//validar si grado es nulo
			if($gradoVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un grado con el id: '.$id);

			//obtener el grado con la peticion
			$grado = $this->request->getJSON();

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->update($id, $grado)):
		//recuperar el id
        $grado->$id = $id;


		//SI recibe correstamente la data
		return $this->respondUpdated($grado);
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
			$gradoVerificado = $this->model->find($id);

			//validar si grado es nulo
			if($gradoVerificado == null )
			//error porque el id no es valido
			return $this->failNotFound('No se ha encontrado un grado con el id: '.$id);

			 //codeigniter trae funciones para base de datos, usando el metodo insert 
	   //el metodo insert devuelve un booleano y se puede ver si se inserto o no
	   if($this->model->delete($id)):

		//SI recibe correstamente la data
		return $this->respondDeleted($gradoVerificado);
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
