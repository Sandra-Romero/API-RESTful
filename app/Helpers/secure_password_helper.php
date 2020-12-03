<?php

//encriptar contraseña
function hashPassword($plainText)
{
    return password_hash($plainText, PASSWORD_BCRYPT);
}

function verifyPassword($plainText, $hash)
{
    //retorna un booleano
   return password_verify($plainText, $hash);
}