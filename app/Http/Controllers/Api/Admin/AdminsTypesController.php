<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use Validator;

use App\Models\AdminsTypes;
use App\Admin;

class AdminsTypesController extends BaseController
{
    public function adminsTypes(Request $request){
        $parent = $request->parent;

        if($parent){
            $admin = Admin::where('email', $parent)->first();
            if($admin){
                $adminsTypes = AdminsTypes::where('id', '>=', $admin->types()->first()->id)->get();
                if(count($adminsTypes) > 0){
                    $success['adminsTypes'] = $adminsTypes;
                    return $this->sendResponse($success, 'Admins Types');
                }
                return $this->sendError('No registered admins types.', [], 200);
            }
            return $this->sendError('No registered admin.', [], 200);
        }
        return $this->sendError('No param parent founded.', [], 200);
    }
}
