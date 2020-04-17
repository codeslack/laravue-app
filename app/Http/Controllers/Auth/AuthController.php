<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use Lcobucci\JWT\Parser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        $user = auth('api')->user();

        return response()->json([
            'authenticated' => $user ? true : false,
            'data' => $user
        ], 200);
    }

    public function emailExist(Request $request)
    {
        if (User::whereEmail($request->email)->first()) {
            return 'false';
        } else {
            return 'true';
        }
    }

    public function login(Request $request)
    {

        $user = User::where('email', $request->email)->first();


        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $token = $user->createToken('Laravel Password Grant Client')->accessToken;


                return response()->json([
                    'authenticated' => true,
                    'token' => $token,
                    'data' => $user
                ], 200);

            } else {

                $response = "Password mismatch";


                return response($response, 401);
            }
        } else {

            $response = 'User does not exist';


            return response($response, 422);
        }
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'mobile' => 'required|string|max:10|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($v->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $v->errors()
            ], 422);
        }


        $count = User::count();

        $user = new User;
        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->mobile    = $request->mobile;

        if (!$count) {
            $user->type     = 'admin';
        }

        $user->password = Hash::make($request->password);
        $user->verified = User::UNVERIFIED_USER;
        $user->verification_token = User::generateVerificationCode();
        $user->admin = User::REGULAR_USER;

        $user->save();

        return response()->json(['status' => 'success'], 200);
    }


    public function logout(Request $request)
    {
        $value = $request->bearerToken();
        $id = (new Parser())->parse($value)->getHeader('jti');
        $token = $request->user()->tokens->find($id);

        $token->revoke();

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out Successfully.'
        ], 200);
    }
}
