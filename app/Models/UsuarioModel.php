<?php namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table          = 'usuario';
    protected $primarykey     ='id';

    protected $returnType     ='array';
    protected $allowedFields  =['nombre', 'username','password','id_rol'];

    protected $userTimestamps   =true;
    protected $createdFields    ='created_at';
    protected $updatedFields    ='updated_at';
    
    protected $foreignkey     ='rol_id';

    protected $validationRules  = [
   'nombre' => 'required|alpha_space|min_length[3]|max_length[65]',
   'username' => 'required|alpha_space|min_length[10]|max_length[10]',
   'password' => 'required|alpha_space|min_length[75]|max_length[75]| ',
   'id_rol' => 'required|alpha_space|min_length[11]|max_length[11]',

    ];

    protected $validationMessages = [

                 'nombre' => [
                            'required'                =>'conplementar campo Nombre',
                            'alpha_space'             =>'no se permiten numeros',
                            'min_length[3]'           =>'minimo 3 caracteres',
                            'max_length[65]'          =>'maximo 65 caracteres'
        ],
        
                'username' => [
                           'required'                =>'conplementar campo Nombre',
                           'alpha_space'             =>'no se permiten numeros',
                          'min_length[10]'           =>'minimo 10 caracteres',
                          'max_length[10]'          =>'maximo 10 caracteres'
                    ],

                    
                 'password' => [
                         'required'                =>'conplementar campo Nombre',
                         'alpha_space'             =>'no se permiten numeros',
                         'min_length[75]'           =>'minimo 75 caracteres',
                         'max_length[75]'          =>'maximo 75 caracteres'
                         
                    ],


                    'id_rol' => [
                        'required'                =>'conplementar campo Nombre',
                        'alpha_space'             =>'no se permiten numeros',
                        'min_length[11]'           =>'minimo 11 caracteres',
                        'max_length[11]'          =>'maximo 11 caracteres'
                   ],


                   ];


    protected $sipValidation = false;

}