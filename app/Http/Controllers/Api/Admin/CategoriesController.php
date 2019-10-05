<?php

namespace App\Http\Controllers\Api\Admin;

use App\Services\CategoriesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use App\Models\Categories;

use Validator;


class CategoriesController extends BaseController
{

    /**
     * @var CategoriesService
     */
    private $service;

    /**
     * CategoriesController constructor.
     * @var CategoriesService $service
     */
    public function __construct(CategoriesService $service)
    {
        $this->service = $service;
    }

    public function categories()
    {
        return $this->sendResponse(['categories' => $this->service->all()], 'Categories');
    }

    public function search($id)
    {
        if($category = $this->service->get($id)){
            return $this->sendResponse(['category' => $category], 'Category founded successfully.');
        }

        return $this->sendResponse([], 'Category not found.');
    }

    public function remove($id)
    {
        if($removed = $this->service->remove($id)){
            return $this->sendResponse([], 'Category deleted successfully.');
        }

        return $this->sendResponse([], 'A problem was ocurred.');
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
