<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
* @OA\Info(title="API Clientes", version="1.0")
*
* @OA\Server(url="http://127.0.0.1:8000")
*/

class ClientController extends ResponseController
{

/**
 * @OA\Post(
 *     path="/api/addClient",
 *     tags={"Agregar cliente"},
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="Nombre del cliente",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="identification",
 *         in="query",
 *         description="Identificación del cliente",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Parameter(
 *         name="date_birth",
 *         in="query",
 *         description="Fecha nacimiento del cliente",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *          @OA\MediaType(mediaType="application/form-data",
 *         )
 *      ),
 *     @OA\Response(
 *         response="200",
 *         description="Creación de cliente",
 *         @OA\JsonContent(
 *          required={"name","identification","date_birth"},
 *          @OA\Property(property="name", type="string", format="name", example="pepe"),
 *          @OA\Property(property="identification", type="string", format="identification", example="123456789"),
 *          @OA\Property(property="date_birth", type="date", example="1989-08-14"),
 *          @OA\Property(property="id", type="integer", example="1"),
 *          )
 *     ),
 *     @OA\Response(
 *         response="422",
 *         description="Error de validación",
 *     ),
 *     security={
 *       {"api_key": {}}
 *     }
 * )
 */

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
