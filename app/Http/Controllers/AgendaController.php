<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Agenda;
use Illuminate\Support\Facades\Validator;

class AgendaController extends ResponseController
{
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
