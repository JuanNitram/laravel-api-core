<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use Validator;

use App\Admin;
use App\Models\Sections;

class SectionsController extends BaseController
{
    public function sections(Request $request){
        $parent = $request->parent;

        if($parent){
            $admin = Admin::where('email', $parent)->first();
            if($admin){
                $sections = $admin->sections;
                if(count($sections) > 0){
                    $success['sections'] = $sections;
                    return $this->sendResponse($success, 'sections');
                }
                return $this->sendError('No registered sections.', [], 200);
            }
            return $this->sendError('No registered admin.', [], 200);
        }

        return $this->sendError('No param parent founded.', [], 200);
    }

    public function search($id){
        $section = Sections::where('id', $id)->first();
        if($section){
            $success['section'] = $section;
            return $this->sendResponse($success, 'Section');
        }
        return $this->sendError('Section not found.', [], 200);
    }
}
