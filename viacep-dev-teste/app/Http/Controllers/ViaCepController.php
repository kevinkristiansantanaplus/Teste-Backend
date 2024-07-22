<?php

namespace App\Http\Controllers;

use App\Http\Services\ViaCepService;
use Illuminate\Http\Request;

class ViaCepController extends Controller
{

    private $viaCepService;

    public function __construct(ViaCepService $viaCepService) {

        $this->viaCepService = $viaCepService;

    }
 
    public function getAddressByCep(Request $request)
    {

        try
        {

            return $this->viaCepService->getAddressByCep($request->ceps);

        }
        catch(\Exception $e)
        {

            return response()->json([

                'message' => 'Houve um erro no servidor, favor contate o suporte'

            ]);

        }

    }

}