<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{

    use  ResponseTrait;

	public function login()
	{

      
        try {
           $username = $this->request->getPost('username');
           $password = $this->request->getPost('password');
		



		   $usuarioModel = new UsuarioModel();
		   
	
           $where = ['username' => $username, 'password' => $password];
	
           $validateUsuario = $usuarioModel->where($where)->find();
	
           if($validateUsuario == null)
           return $this->failNotFound('Usuario o contraseña invalido');

           return $this->respond('Usuario encontrado');

        }catch (\Exception $e){

			log_message('error', '[ CUSTOM ERROR ] {exception}', ['exception' => $e]);
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
        

	}

	

}
