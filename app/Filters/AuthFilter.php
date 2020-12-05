<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;


class AuthFilter implements FilterInterface
{
    use  ResponseTrait;

public function before(RequestInterface $request, $arguments = null)
{
try {
    $key = Services::getSecretKey();
    $authHeader = $request->getServer('HTTP_AUTHORIZATION');

    if($authHeader == null)
    return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'NO SE A ENVIADO JWT');
       $arry = explode(' ', $authHeader);
       $jwt = $arry[1];

       jwt::decode($jwt, $key, ['HS256']);
    //code...
} catch (ExpiredException $ee){

    return Services::response()->setStatusCode(RequestInterface::HTTP_UNAUTHORIZED, 'su token jwt a expirado');

} catch (\Exception $e) {

    return Services::response()->setStatusCode(RequestInterface::HTTP_INTERNAL_SERVER_ERROR, 'Ocurrio un error en el servidor');
    //throw $th;
}

}

public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
{



}




}