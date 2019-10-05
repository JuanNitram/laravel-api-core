<?php

namespace App\Http\Controllers\Api\Page;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Page\Base\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\User;

class AuthController extends BaseController
{
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */
    public function register(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $success['token'] =  $user->createToken('PageToken')->accessToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User register successfully.');
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        if($data['email'] && $data['password']){

            $user = User::where('email', $data['email'])->where('active', 1)->first();

            if($user && Hash::check($data['password'], $user->password)){
                $success['token'] = 'Bearer' . $user->createToken('PageToken')->accessToken;
                $success['user'] =  $user;

                return $this->sendResponse($success, 'User logged successfully.');
            }

            return $this->sendError('Error, wrong password or email.', [], 200);
        }
        return $this->sendError('Error, check the parameters.', [], 200);
    }

}
