<?php namespace App\Controllers;

use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;


class Auth extends BaseController
{
//para errores de failServerError
    use  ResponseTrait;

    //llamar el helper en el constructor
    public function __construct() {
        helper('secure_password');
    }

	public function login()
	{

        try {
           $username = $this->request->getPost('username');
           $password = $this->request->getPost('password');
        
           
		   $usuarioModel = new UsuarioModel();
		   
	
           $validateUsuario = $usuarioModel->where('username', $username)->first();
	
           if($validateUsuario == null)
           return $this->failNotFound('Usuario no encontrado');

           if(verifyPassword($password, $validateUsuario["password"])) :
            //imlementar jwt
           $jwt = $this->generateJWT($validateUsuario);

           return $this->respond(['Token' => $jwt], 201);


           else :
            return $this->failValidationError('Contraseña invalida');
           endif;
    
           
        }catch (\Exception $e){

			log_message('error', '[ CUSTOM ERROR ] {exception}', ['exception' => $e]);
            return $this->failServerError('ha ocurrido un error en el servidor');
        }
        

    }
    
    //agregar metodo
    protected function generateJWT($usuario)
    {
        //CUERPO DEL TOKEN 
        $time = time();//devuelve la fecha actual en enteros
        $key = services::getSecretKey();
        $payload = [
            'aud' => base_url(),
            'iat' => $time, //como entero el tiempo
            'exp' => $time + 60, //como entero el tiempo cuando exira el token 
        ];

        //CREAR EL TOKEN 
        $jwt = JWT::encode($payload, $key);
        return $jwt;

    }

	

}
