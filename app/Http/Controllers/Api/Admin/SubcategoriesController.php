<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use Illuminate\Support\Facades\Storage;

use Validator;

use App\Models\Subcategories;

class SubcategoriesController extends BaseController
{
    /**
    * Register api
    *
    * @return \Illuminate\Http\Response
    */

    public function subcategories(Request $request){
        $category = $request->categories;

        if($category){
            $subcategories = Subcategories::where('categories_id', $category)->get();

            if(count($subcategories) > 0){
                $success['subcategories'] = $subcategories;
                return $this->sendResponse($success, 'Subcategories');
            }

            return $this->sendError('No registered subcategories.', [], 200);
        }
        $subcategories = Subcategories::orderBy('pos', 'asc')->with('categories')->get();

        if(count($subcategories) > 0){
            $success['subcategories'] = $subcategories;
            return $this->sendResponse($success, 'Subcategories');
        }

        return $this->sendError('No registered subcategories.', [], 200);
    }

    public function search($id){
        $subcategory = Subcategories::where('id', $id)->first();
        if($subcategory){
            $success['subcategory'] = $subcategory;
            return $this->sendResponse($success, 'Subcategory');
        }
        return $this->sendError('Subcategory not found.', [], 200);
    }

    public function remove($id){
        $subcategory = Subcategories::where('id', $id)->first();
        if($subcategory){
            $subcategory->delete();
            return $this->sendResponse([], 'Success');
        }
        return $this->sendError('Subcategory not found.', [], 200);
    }

    public function save(Request $request){
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'categories_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $subcategory = Subcategories::create($data);

        $success['subcategory'] = $subcategory;

        return $this->sendResponse($success, 'Subcategory registered successfully.');
    }

    public function update($id, Request $request){
        $subcategory = Subcategories::where('id', $id)->first();
        if($subcategory){
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                'categories_id' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(), 200);
            }

            $subcategory->update($data);

            if(isset($data['medias'])){
                $this->store_medias($category, $data['medias']);
            }

            $success['subcategory'] = $subcategory;

            return $this->sendResponse($success, 'Subcategory register successfully.');
        }
        return $this->sendError('The subcategory doesnt exists.', $validator->errors(), 200);
    }

}
