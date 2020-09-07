<?php

/**
* @OA\Info(title="API Clientes", version="1.0")
*
* @OA\Server(url="http://127.0.0.1:8000")
*/

/**
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     securityScheme="api_key",
 *     name="Authorization"
 * )
 */

//==== LOGIN ====
 /**
 * @OA\Post(
 *     path="/api/auth/login",
 *     tags={"Login"},
 *     @OA\Parameter(
 *         name="email",
 *         in="query",
 *         description="Email - admin@admin.com",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\Parameter(
 *         name="password",
 *         in="query",
 *         description="Contraseña - 123456",
 *         required=true,
 *         @OA\Schema(type="string")
 *     ),
 *     @OA\RequestBody(
 *          @OA\MediaType(mediaType="application/form-data",
 *         )
 *      ),
 *     @OA\Response(
 *         response="200",
 *         description="Login usuario",
 *         @OA\JsonContent(
 *          required={"email","password"},
 *          @OA\Property(property="access_token", type="string", format="access_token", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMFwvYXBp"),
 *          @OA\Property(property="token_type", type="string", format="token_type", example="bearer"),
 *          @OA\Property(property="expires_in", type="expires_in", example="3600"),
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


 //===== AGREGAR CLIENTE =====
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


 //==== AGREGAR AGENDA ====
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


//==== MODIFICAR AGENDA ====
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

