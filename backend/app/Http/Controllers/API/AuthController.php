<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ViewModels\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    private $response;
    public function __construct(){
        $this->response = new Response();
    }
    
    public function test_api(){
        $this->response->status_code = 1;
        $this->response->message = "test";
        $this->response->data = "this is a data";
        return response()->json($this->response);
    }

    public function api_authenticate($request)
    {
        $credentials = $request->validate([
            'email_address' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) { 
            return true;
        }
        return false;
    }

    public function login(Request $request){
        $auth = $this->api_authenticate($request);
        
        if(Auth::check()){
            $user = Auth::user();
            $token = $user->createToken("token");

            $this->response->status_code = 1;
            $this->response->message = "success";
            $this->response->data = [
                "user" => $user,
                "token" => $token->plainTextToken
            ];

            return response()->json($this->response);
        }else{
            $this->response->status_code = 0;
            $this->response->message = "error";
            $this->response->data = "Error Logging In";

            return response()->json($this->response);
        }
    }

    public function logout(){
        $user = Auth::user();
        $user->tokens()->delete();
        $this->response->status_code = 1;
        $this->response->message = "success";
        $this->response->data = "Logged Out";
        
        return response()->json($this->response);
    }
}
