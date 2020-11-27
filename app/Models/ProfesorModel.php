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
        'telefono'   => 'required|alpha_numeric_space|min_length[9]|max_length[9]',
        'dui'        => 'required|alpha_numeric_space|min_length[10]|max_length[10]'
    ];
        //mensajes especiales
        protected $validationMessages = [
            'nombre' => [
                'required'    => 'Por favor rellene el campo Nombre',
                'alpha_space' => 'Nombre No se permiten numeros',
                'min_length'  => 'Nombre Minimo 3 caracteres',
                'max_length'  => 'Nombre Maximo 75 caracteres'
            ],

            'apellido' => [
                'required'    => 'Por favor rellene el campo apellido',
                'alpha_space' => 'Apellido No se permiten numeros',
                'min_length'  => 'Apellido Minimo 3 caracteres',
                'max_length'  => 'Apellido Maximo 75 caracteres'
            ],

            'profesion' => [
                'required'    => 'Por favor rellene el campo Profesion',
                'alpha_space' => 'Profesion No se permiten numeros',
                'min_length'  => 'Profesion Minimo 3 caracteres',
                'max_length'  => 'Profesion Maximo 10 caracteres'
            ],

            'telefono' => [
                'required'            => 'Por favor rellene el campo Telefono',
                'alpha_numeric_space' => 'Telefono Solo se permiten numeros',
                'min_length'          => 'Telefono Minimo 9 caracteres',
                'max_length'          => 'Telefono Maximo 9 caracteres'
            ],

            'dui' => [
                'required'            => 'Por favor rellene el campo Dui',
                'alpha_numeric_space' => 'DUI Solo se permiten numeros',
                'min_length'          => 'DUI Minimo 10 caracteres',
                'max_length'          => 'DUI Maximo 10 caracteres'
            ]
        ];
     
        //no se puede saltar ninguna validacion de mi modelo
        protected $skipValidation = false;

}
?>

