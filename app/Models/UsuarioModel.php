<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table          = 'usuario';
    protected $primaryKey     = 'id';

    protected $returnType     ='array';
    protected $allowedFields  =['nombre', 'username', 'password', 'rol_id'];

    protected $useTimestamps   = true;
    protected $createdFields    ='created_at';
    protected $updatedFields    ='updated_at';
    

    protected $validationRules  = [
   'nombre' => 'required|alpha_space|min_length[3]|max_length[65]',
   'username' => 'required|alpha_space|min_length[5]|max_length[10]',
   'password' => 'required',
   'rol_id' => 'required|is_valid_rol'

    ];

    protected $validationMessages = [

                 'nombre' => [
                            'required'                =>'conplementar campo Nombre',
                            'alpha_space'             =>'no se permiten numeros',
                            'min_length[3]'           =>'minimo 3 caracteres',
                            'max_length[65]'          =>'maximo 65 caracteres'
                    ],
        
                'username' => [
                           'required'                =>'complementar campo Nombre',
                           'alpha_space'             =>'no se permiten numeros',
                          'min_length[10]'           =>'minimo 10 caracteres',
                          'max_length[10]'          =>'maximo 10 caracteres'
                    ],

                    
                 'password' => [
                         'required'                =>'complementar campo Nombre'
                         
                    ],


                'rol_id' => [
                    'required'       => 'Por favor rellene este campo grado_id',
                    'is_valid_rol'   => 'Debe de ingresar un rol valido'
                    ]

                   ];


    protected $sipValidation = false;

}