<?php namespace App\Models;

//utilizar el codeigniter
use CodeIgniter\Model;


//va dar una herencia de la clase model por defecto
class ProfesorModel extends Model 
{
    //standar para que fucione con la calse model
    // con variable protegida

    protected $table = 'profesor'; 
    //id de la tabla 
    protected $primaryKey = 'id';

    //necesitamos que el modelo me duuelva los resultados de la tabla como arreglo
    protected $returnType = 'array';

    //arreglo de variables que seran permitidos para que sean manejados por codeigniter
    protected $allowedFields = ['nombre', 'apellido', 'profesion', 'telefono', 'dui'];

    //metodo para gestionar las fechas (si quiero llevar el control de fechas de auditoria)
    protected $useTimestamps = true;
    //las columnas de fechas
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    //validacion del modelo, dentro de un arreglo
    protected $validationRules = [
    
        //reglas cumplir embase al tipo de campo en la bd
        'nombre'     => 'required|alpha_space|min_length[3]|max_length[75]',
        'apellido'   => 'required|alpha_space|min_length[3]|max_length[75]',
        'profesion'  => 'required|alpha_space|min_length[3]|max_length[10]',
        'telefono'   => 'required|min_length[8]|max_length[8]',
        'dui'        => 'required|min_length[10]|max_length[10]'
    ];
        //mensajes especiales
        protected $validationMessages = [
            'nombre' => [
                'required'    => 'Por favor rellene este campo',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Minimo de letras es 3',
                'max_length'  => 'Maximo de letras es 75'
            ],

            'apellidos' => [
                'required'    => 'Por favor rellene este campo',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Minimo de letras es 3',
                'max_length'  => 'Maximo de letras es 75'
            ],

            'profesion' => [
                'required'    => 'Por favor rellene este campo',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Minimo de letras es 3',
                'max_length'  => 'Maximo de letras es 10'
            ],

            'telefono' => [
                'required'            => 'Por favor rellene este campo',
                'alpha_numeric_space' => 'Solo se permiten numeros',
                'min_length'          => 'Minimo de letras es 8',
                'max_length'          => 'Maximo de letras es 8'
            ],

            'dui' => [
                'required'            => 'Por favor rellene este campo',
                'alpha_numeric_space' => 'Solo se permiten numeros',
                'min_length'          => 'Minimo de letras es 10',
                'max_length'          => 'Maximo de letras es 10'
            ]
        ];
     
        //no se puede saltar ninguna validacion de mi modelo
        protected $skipValidation = false;

}
?>

