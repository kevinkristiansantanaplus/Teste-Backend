<?php

namespace App\Helpers;

class CepValidate
{

    public static function validarCep($cep)
    {

        $cep = str_replace('-', '', $cep);

        if (preg_match('/^\d{8}$/', $cep)) {

            return $cep;

        }

    }

}