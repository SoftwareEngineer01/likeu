<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
* @OA\Server(url="http://127.0.0.1:8000")
*/

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['unauthorized','login']]);
    }

/**
 * Get a JWT via given credentials.
 *
 * @return \Illuminate\Http\JsonResponse
 */

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
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
