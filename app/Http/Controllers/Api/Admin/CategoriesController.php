<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use App\Models\Categories;

use Validator;


class CategoriesController extends BaseController
{
    public function __construct()
    {
        parent::__construct(Categories::class, 'Categories');
    }

    public function categories()
    {
        $categories = Categories::orderBy('pos', 'asc')->get();

        if(count($categories) > 0){
            $success['categories'] = $categories;
            return $this->sendResponse($success, 'Categories');
        }

        return $this->sendError('No registered categories.', [], 200);
    }

    public function search($id)
    {
        $category = Categories::where('id', $id)->first();
        if($category){
            $success['category'] = $category;
            return $this->sendResponse($success, 'Category');
        }
        return $this->sendError('Category not found.', [], 200);
    }

    public function remove($id)
    {
        $category = Categories::where('id', $id)->first();
        if($category){
            $category->delete();
            return $this->sendResponse([], 'Success');
        }
        return $this->sendError('Category not found.', [], 200);
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $category = Categories::create($data);

        $success['category'] = $category;

        return $this->sendResponse($success, 'Category registered successfully.');
    }

    public function update($id, Request $request)
    {
        $category = Categories::where('id', $id)->first();

        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        if($category){
            $category->update($data);

            if(isset($data['medias'])){
                $this->store_medias($category, $data['medias']);
            }

            $success['category'] = $category;

            return $this->sendResponse($success, 'Category register successfully.');
        }
        return $this->sendError('The category doesnt exists.', $validator->errors(), 200);
    }

}
