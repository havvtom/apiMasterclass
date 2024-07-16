<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponses;
    public function login(LoginUserRequest $request){

        $request->validated($request->all());

        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->error('Invalid credentials', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->ok('Authenticated',
            [
                'token' => $user->createToken(
                    'Api Token for '.$user->email,
                    ['*'],
                    now()->addMonth()
                )->plainTextToken
            ]
        );
    }

    public function register(){
        return $this->ok('Register successfully');
    }

    public function logout( Request $request ){
        $request->user()->currentAccessToken()->delete();
        return $this->ok('Logout successfully');
    }

}
