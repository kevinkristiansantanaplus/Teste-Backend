<?php

namespace App\Http\Services;

use App\Helpers\CepValidate;
use Illuminate\Support\Facades\Http;

class ViaCepService
{

    public function getAddressByCep($ceps)
    {

        $cepsArray = explode(',', $ceps);
        $addressArray = [];

        foreach($cepsArray as $cep)
        {

            $validatedCep = CepValidate::validarCep($cep);

            if ($validatedCep) 
            {

                $request = Http::get("https://viacep.com.br/ws/{$validatedCep}/json/");

                if ($request->successful()) 
                {

                    $address = $request->json();

                    $addressArray[] = 
                    [

                        'cep'         => $address['cep'],
                        'label'       => $address['logradouro'] . ', ' . $address['localidade'],
                        'logradouro'  => $address['logradouro'],
                        'complemento' => $address['complemento'],
                        'unidade'     => $address['unidade'],
                        'bairro'      => $address['bairro'],
                        'localidade'  => $address['localidade'],
                        'uf'          => $address['uf'],
                        'ibge'        => $address['ibge'],
                        'gia'         => $address['gia'],
                        'ddd'         => $address['ddd'],
                        'siafi'       => $address['siafi'],

                    ];

                } 
                else 
                {

                    $addressArray[] =
                    [

                        'cep'   => $validatedCep,
                        'error' => 'CEP não encontrado ou houve um erro na requisição da API'

                    ];

                }

            } 
            else 
            {

                $addressArray[] = 
                [

                    'cep'   => $cep,
                    'error' => 'CEP inválido'

                ];

            }

        }

        return $addressArray;

    }

}