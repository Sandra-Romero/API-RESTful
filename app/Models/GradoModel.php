<?php namespace App\Models;

//utilizar el codeigniter
use CodeIgniter\Model;


//va dar una herencia de la clase model por defecto
class GradoModel extends Model 
{
    //standar para que fucione con la calse model
    // con variable protegida
    protected $table = 'grado'; 

    //id de la tabla 
    protected $primaryKey = 'id';

    //necesitamos que el modelo me duuelva los resultados de la tabla como arreglo
    protected $returnType = 'array';

    //arreglo de variables que seran permitidos para que sean manejados por codeigniter
    protected $allowedFields = ['grado', 'seccion', 'profesor_id'];

    //metodo para gestionar las fechas (si quiero llevar el control de fechas de auditoria)
    protected $useTimestamps = true;

    //las columnas de fechas
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    //validacion del modelo, dentro de un arreglo
    protected $validationRules = [
    
        //reglas cumplir embase al tipo de campo en la bd
        'grado'       => 'required|alpha_numeric_space|min_length[3]|max_length[60]',
        'seccion'     => 'required|alpha_numeric_space|min_length[1]|max_length[2]',
        'profesor_id' => 'required'
    ];
        //mensajes especiales
        protected $validationMessages = [
            'grado' => [
                'required'            => 'Por favor rellene el campo Grado',
                'alpha_numeric_space' => 'Se permiten numeros',
                'min_length'          => 'Minimo de letras es 3',
                'max_length'          => 'Maximo de letras es 60'
            ],

            'seccion' => [
                'required'    => 'Por favor rellene el campo Seccion',
                'alpha_space' => 'No se permiten numeros',
                'min_length'  => 'Minimo de letras es 1',
                'max_length'  => 'Maximo de letras es 2'
            ],

            'profesor_id' => [
                'required' => 'Por favor rellene el campo profesor_id'
            ]
        ];
     
        //no se puede saltar ninguna validacion de mi modelo
        protected $skipValidation = false;

}
?>

