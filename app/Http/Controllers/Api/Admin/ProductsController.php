<?php

namespace App\Http\Controllers\Api\Admin;

use App\Services\ProductsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use App\Models\Products;
use App\Models\Categories;

use Validator;


class ProductsController extends BaseController
{
    /**
     * @var ProductsService
     */
    private $service;

    /**
     * ProductsController constructor.
     * @param ProductsService $service
     */
    public function __construct(ProductsService $service)
    {
        $this->service = $service;
    }

    public function products()
    {
        return $this->sendResponse(['products' => $this->service->all()], 'Products');
    }

    public function search($id)
    {
        if($product = $this->service->get($id, ['subcategories'])){
            return $this->sendResponse(['product' => $product], 'Product founded successfully.');
        }

        return $this->sendResponse([], 'Product not found.');
    }

    public function remove($id)
    {
        if($removed = $this->service->remove($id)){
            return $this->sendResponse([], 'Product deleted successfully.');
        }

        return $this->sendResponse([], 'A problem was ocurred.', false);
    }

    public function removeMedia(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'media_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        if($result = $this->service->removeMedia($request->media_id)){
            return $this->sendResponse([], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'categories_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $result = $this->service->save($data);
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
