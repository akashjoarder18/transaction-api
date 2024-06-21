<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiTokenRegisterRequest;
use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\ApiLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    private $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository){
        $this->authRepository = $authRepository;
    }
    // check user for login and get auth-token
    function login(ApiLoginRequest $request)
    {
        $user  = $this->authRepository->first($request->email);        
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
            $user->tokens()->where('name', $request->token_name)->delete();

            $token = $user->createToken($request->token_name);
        
            $response = [
                'user' => $user,
                'token' => $token->plainTextToken,
            ];
        
             return response($response, 201);
    }

    // logout auth-user
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response([
            'message' => ['User deleted successfully!!']
        ], 204);
    }

    // auth user registration
    public function register(ApiTokenRegisterRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => "User already register"], 409);
        }

        $user = $this->authRepository->store($request);

        $token = $user->createToken($request->token_name);

        return [
            'token' => $token->plainTextToken,
            'user' => $user
        ];
    }
}
