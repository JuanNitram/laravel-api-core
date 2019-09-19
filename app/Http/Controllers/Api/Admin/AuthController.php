<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\Admin;

class AuthController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

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
        $admin = Admin::create($data);

        $success['token'] =  $admin->createToken('AdminToken')->accessToken;
        $success['name'] =  $admin->name;

        return $this->sendResponse($success, 'Admin register successfully.');
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

            $admin = Admin::where('email', $data['email'])
                ->where('active', 1)->with('sections')->first();

            if($admin && Hash::check($data['password'], $admin->password)){
                $success['token'] = 'Bearer ' . $admin->createToken('AdminToken')->accessToken;
                $success['admin'] =  $admin;
                return $this->sendResponse($success, 'Admin logged successfully.');
            }

            return $this->sendError('Error, wrong password or email.', [], 200);
        }
        return $this->sendError('Error, check the parameters.', [], 200);
    }

    public function check(){
        return $this->sendResponse([], 'The token is valid!');
    }
}
