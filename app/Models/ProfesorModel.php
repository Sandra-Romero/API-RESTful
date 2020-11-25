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
    protected $userTimestamps = true;
    //las columnas de fechas
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    //validacion del modelo, dentro de un arreglo
    protected $validationRules = [
    
        //reglas cumplir embase al tipo de campo en la bd
        'nombre' => 'required|alpla_sapce|min_length[3]|min_length[75]',
        'apellido' => 'required|alpla_sapce|min_length[3]|min_length[75]',
        'profesion' => 'required|alpla_sapce|min_length[3]|min_length[75]',
        'telefono' => 'required|alpla_sapce|min_length[9]|min_length[9]',
        'dui' => 'required|alpla_sapce|min_length[10]|min_length[10]'
    ];
        //mensajes especiales
     
        //no se puede saltar ninguna validacion de mi modelo
        protected $skipValidation = false;

}
?>

