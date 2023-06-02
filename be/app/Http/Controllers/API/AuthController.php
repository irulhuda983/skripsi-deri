<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use App\Models\User;

class AuthController extends Controller
{
    
    public function issueToken(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = $user->createToken($request->username);
        return response()->json(['token' => $token->plainTextToken, 'userInfo' => new UserResource($user)]);
    }

    public function getMe(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }


    public function logout(Request $request) {
        $user = $request->user();

        if ($user->currentAccessToken()->delete())
            return response()->json(['error' => 'Terjadi kesalahan'], 500);

        return response()->json(['success' => true]);
    }


}
