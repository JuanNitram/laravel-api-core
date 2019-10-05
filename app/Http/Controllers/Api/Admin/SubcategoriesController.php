<?php

namespace App\Http\Controllers\Api\Admin;

use App\Services\SubcategoriesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;

use Validator;

class SubcategoriesController extends BaseController
{

    /**
     * @var SubcategoriesService
     */
    private $service;

    /**
     * SubcategoriesController constructor.
     * @param SubcategoriesService $service
     */
    public function __construct(SubcategoriesService $service)
    {
        $this->service = $service;
    }

    public function subcategories(Request $request)
    {
        $categoryId = $request->categories;

        if($categoryId !== null){
            return $this->sendResponse([
                'subcategories' => $this->service->getByCategory($categoryId)
            ],'Subcategories');
        }

        return $this->sendResponse([
            'subcategories' => $this->service->all(['categories'])
        ], 'Subcategories');
    }

    public function search($id)
    {
        if($subcategory = $this->service->get($id)){
            return $this->sendResponse(['subcategory' => $subcategory], 'Subcategory founded successfully.');
        }

        return $this->sendResponse([], 'Subcategory not found.');
    }

    public function remove($id)
    {
        if($removed = $this->service->remove($id)){
            return $this->sendResponse([], 'Subcategory deleted successfully.');
        }

        return $this->sendResponse([], 'A problem was ocurred.');
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'categories_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $result = $this->service->save($request->all());
        if($result['success'] === true){
            return $this->sendResponse($result['data'], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'categories_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $result = $this->service->update($id, $data);
        if($result['success'] === true){
            return $this->sendResponse($result['data'], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

}
