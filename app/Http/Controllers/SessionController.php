<?php

namespace App\Http\Controllers;

use App\Http\Requests\Session\StoreSessionRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function store(StoreSessionRequest $request) {
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([   
                "message" => "Usuário ou senha inválidos"
            ], 401);
        }
     
        return $user->createToken($request->email)->plainTextToken;
    }

    public function destroy(Request $request) {     
        $request->user()->currentAccessToken()->delete();

        return response()->noContent();
    }
}
