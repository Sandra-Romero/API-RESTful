<?php namespace App\Models;

//utilizar el codeigniter
use CodeIgniter\Model;


//va dar una herencia de la clase model por defecto
class EstudianteModel extends Model 
{
    //standar para que fucione con la calse model
    // con variable protegida
    protected $table = 'estudiante'; 

    //id de la tabla 
    protected $primaryKey = 'id';

    //necesitamos que el modelo me duuelva los resultados de la tabla como arreglo
    protected $returnType = 'array';

    //arreglo de variables que seran permitidos para que sean manejados por codeigniter
    protected $allowedFields = ['nombre', 'apellido', 'dui', 'genero', 'carnet', 'grado_id'];

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
        'dui'        => 'required|min_length[10]|max_length[10]',
        'genero'     => 'required',
        'carnet'     => 'required|min_length[9]|max_length[9]',
        'grado_id'   => 'required'
    ];
        //mensajes especiales
        protected $validationMessages = [
            'nombre' => [
                'required'    => 'Por favor rellene este campo',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Minimo de letras es 3',
                'max_length'  => 'Maximo de letras es 75'
            ],

            'apellido' => [
                'required'    => 'Por favor rellene este campo',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Minimo de letras es 3',
                'max_length'  => 'Maximo de letras es 75'
            ],

            'dui' => [
                'required'            => 'Por favor rellene este campo',
                'alpha_numeric_space' => 'Solo se permiten numeros',
                'min_length'          => 'Minimo de letras es 10',
                'max_length'          => 'Maximo de letras es 10'
            ],

            'genero' => [
                'required' => 'Por favor rellene este campo'
            ],

            'carnet' => [
                'required'   => 'Por favor rellene este campo',
                'min_length' => 'Minimo de letras es 9',
                'max_length' => 'Maximo de letras es 9'
            ],

            'grado_id' => [
                'required'    => 'Por favor rellene este campo'
            ]
        ];
     
        //no se puede saltar ninguna validacion de mi modelo
        protected $skipValidation = false;

}
?>

