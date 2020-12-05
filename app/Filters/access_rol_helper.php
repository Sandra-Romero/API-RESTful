<?php
use Config\Services;
use Firebase\JWT\JWT;
use App\Model\RolModel;


function validateAccess($roles,  $authHeader)
{


    if(!is_array($roles))
      return false;

       
           $key = Services::getSecretKey();
           $arry = explode(' ', $authHeader);
           $jwt = $arry[1];
           $jwt = jwt::decode($jwt, $key, ['HS256']);

      

      $rolModel = new RolModel();
      $rol = $rolModel->find($jwt->date->rol);
 
     if($rol == null)
     return false;

     if(in_array($rol["nombre"],$roles))

     return false;

     return true;



}