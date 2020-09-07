<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Agenda;
use Illuminate\Support\Facades\Validator;

/**
* @OA\Server(url="http://127.0.0.1:8000")
*/

class AgendaController extends ResponseController
{

/**
 * @OA\Post(
 *     path="/api/addAgenda",
 *     tags={"Agregar agenda"},
 *     @OA\Parameter(
 *         name="id_client",
 *         in="query",
 *         description="Id del cliente",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="affair",
 *         in="query",
 *         description="Asunto de la agenda",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Parameter(
 *         name="date",
 *         in="query",
 *         description="Fecha agenda Y-m-d H:i",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Estado de la Agenda : Programada - Realizada - Cancelada - No asistida ",
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
 *          required={"id_client","affair","date","status"},
 *          @OA\Property(property="id_client", type="integer", format="id_client", example="1"),
 *          @OA\Property(property="affair", type="string", format="affair", example="Reunión"),
 *          @OA\Property(property="date", type="date", example="2020-09-10 10:06"),
 *          @OA\Property(property="status", type="string", example="Programada"),
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

    public function addAgenda(Request $request){

        $message = null;

        $validator = Validator::make($request->all(),[
            'id_client' => 'required',
            'affair' => 'required',
            'date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:Programada,programada,Realizada,realizada,Cancelada,cancelada,No Asistida,no asistida'
        ]);

        $client = Client::where('id', '=', $request->get('id_client'))->first();

        if($validator->fails()){
            $message = $this->sendError('Error en los datos', [$validator->errors(), 422]);
        }elseif($client === null){
            $message = $this->sendError('Error en la consulta', ['El id cliente ingresado no existe'], 404);
        }else{
            $agenda = new Agenda();
            $agenda->id_client = $request->get('id_client');
            $agenda->affair = $request->get('affair');
            $agenda->date = $request->get('date');
            $agenda->status = $request->get('status');
            $agenda->save();

            $message = $this->sendResponse($agenda, 'Agenda creada correctamente');
        }

        return $message;
    }


/**
 * @OA\Put(
 *     path="/api/editAgenda",
 *     tags={"Modificar agenda"},
 *     @OA\Parameter(
 *         name="id",
 *         in="query",
 *         description="Id de la agenda",
 *         required=true,
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Parameter(
 *         name="affair",
 *         in="query",
 *         description="Asunto de la agenda",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Parameter(
 *         name="date",
 *         in="query",
 *         description="Fecha agenda Y-m-d H:i",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *      @OA\Parameter(
 *         name="status",
 *         in="query",
 *         description="Estado de la Agenda : Programada - Realizada - Cancelada - No asistida ",
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
 *          required={"id","affair","date","status"},
 *          @OA\Property(property="id", type="integer", format="id", example="1"),
 *          @OA\Property(property="id_client", type="integer", format="id", example="2"),
 *          @OA\Property(property="affair", type="string", format="affair", example="Reunión"),
 *          @OA\Property(property="date", type="date", example="2020-09-10 10:06"),
 *          @OA\Property(property="status", type="string", example="Cancelada"), *
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

    public function editAgenda(Request $request){

        $message = null;

        $validator = Validator::make($request->all(),[
            'affair' => 'required',
            'date' => 'required|date_format:Y-m-d H:i',
            'status' => 'required|in:Programada,programada,Realizada,realizada,Cancelada,cancelada,No Asistida,no asistida'
        ]);

        $agenda = Agenda::where([
            ['id', '=', $request->get('id')],
            ['status', '=','Programada']
        ])->first();

        if($validator->fails()){
            $message = $this->sendError('Error en la validación', [$validator->errors()], 422);
        }elseif($agenda === null){
            $message = $this->sendError('Error al actualizar el registro', ['El registro no existe o no se encuentra en estado Programada'], 422);
        }else{
            $agenda->affair = $request->get('affair');
            $agenda->date = $request->get('date');
            $agenda->status = $request->get('status');
            $agenda->save();

            $message = $this->sendResponse($agenda, 'Agenda actualizada correctamente');
        }

        return $message;
    }
}
