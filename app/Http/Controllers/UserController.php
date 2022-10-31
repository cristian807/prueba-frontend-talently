<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $has_errors= Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if ($has_errors->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$has_errors->errors(),
                'datas'=>null
            ],422);
        }

        $user=User::where('email',$request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password )) {
            throw ValidationException::withMessages([
                'email' => ['Tus credenciales no concuerdan con nuestros registros.'],
            ]);
        }

        return response()->json([
            'token'=>$user->createToken($user->email)->plainTextToken,
            'type'=>'Bearer',
            'datas'=>$user
        ],200);
    }

    public function register(Request $request)
    {
        $has_errors= Validator::make($request->all(),[
            'email'=>'required|email|unique:users,email',
            'name'=>'required|string|max:60|min:3',
            'password'=>'required|confirmed'
        ]);

        if ($has_errors->fails()) {
            return response()->json([
                'message'=>'Error de validacion.',
                'errors'=>$has_errors->errors(),
                'datas'=>null
            ],422);
        }

        try {
            $response=User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);

            if ($response) {
                return response()->json([
                    'message'=>'Usuario registrado exitosamente.',
                    'errors'=>null,
                    'datas'=>$response
                ],201);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'message'=>'Ha surgido un error al intentar agregar el usuario.',
                'errors'=>null,
                'datas'=>null
            ],500);
        }
    }

    public function logout()
    {
        Auth::user()->tokens()->delete();
    }
}
