<?php namespace App\Models\CustomRules;

//Clase ProfesorModel 
use App\Models\ProfesorModel;
//Clase GradoModel 
use App\Models\GradoModel;


class MyCustomRules
{
 //regla para validar profesor_id en la tabla grado
    public function is_valid_profesor(int $id): bool
    {
        //llamar al modelo ProfesorModel
        $model = new ProfesorModel();

        //que encuentre el profesor con el id que se esta pasando
        $profesor = $model->find($id);

        return $profesor == null ? false : true;

    }

//regla para validar grado_id en la tabla estudiante
     public function is_valid_grado(int $id): bool
     {
         //llamar al modelo GradoModel
         $model = new GradoModel();
 
         //que encuentre el grado con el id que se esta pasando
         $grado = $model->find($id);
 
         return $grado == null ? false : true;
 
     }



}