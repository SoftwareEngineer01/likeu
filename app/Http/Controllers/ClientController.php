<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientController extends ResponseController
{

    public function create(Request $request){

        $message = null;

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'identification' => 'required|unique:clients',
            'date_birth' => 'required|date'
        ]);

        if($validator->fails()){
            $message = $this->sendError('Error de validación', [$validator->errors()], 422);
        }else{
            $client = new Client();
            $client->name = $request->get('name');
            $client->identification = $request->get('identification');
            $client->date_birth = $request->get('date_birth');
            $client->save();

            $message = $this->sendResponse($client, 'Cliente creado correctamente');
        }

        return $message;
    }
}
