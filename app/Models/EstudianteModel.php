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
        'dui'        => 'required|alpha_numeric_space|min_length[10]|max_length[10]',
        'genero'     => 'required|alpha_space|min_length[1]|max_length[1]',
        'carnet'     => 'required|min_length[9]|max_length[9]',
        'grado_id'   => 'required'
    ];
        //mensajes especiales
        protected $validationMessages = [
            'nombre' => [
                'required'    => 'Por favor rellene el campo Nombre',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Nombre Minimo 3 caracteres',
                'max_length'  => 'Nombre Maximo 75 caracteres'
            ],

            'apellido' => [
                'required'    => 'Por favor rellene el campo Apellido',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Apellido Minimo 3 caracteres',
                'max_length'  => 'Apellido Maximo 75 caracteres'
            ],

            'dui' => [
                'required'            => 'Por favor rellene el campo Dui',
                'alpha_numeric_space' => 'DUI Solo se permiten numeros',
                'min_length'          => 'DUI Minimo 10 caracteres',
                'max_length'          => 'DUI Maximo 10 caracteres'
            ],

            'genero' => [
                'required'    => 'Por favor rellene el campo Genero',
                'alpha_space' => 'Genero No se permiten numeros',
                'min_length'  => 'Genero Minimo 1 caracter',
                'max_length'  => 'Genero Maximo 1 caracter'
            ],

            'carnet' => [
                'required'   => 'Por favor rellene el campo Carnet',
                'min_length' => 'Carnet Minimo 11 caracteres',
                'max_length' => 'Carnet Maximo 11 caracteres',
                'regex_match' => 'Carnet no tiene el formato correcto'
            ],

            'grado_id' => [
                'required'    => 'Por favor rellene este campo grado_id'
            ]
        ];
     
        //no se puede saltar ninguna validacion de mi modelo
        protected $skipValidation = false;

}
?>

