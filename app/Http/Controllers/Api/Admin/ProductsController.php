<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use App\Models\Products;
use App\Models\Categories;

use Validator;


class ProductsController extends BaseController
{

    public function __construct()
    {
        parent::__construct(Products::class, 'Products');
    }

    public function products()
    {
        $products = Products::orderBy('pos', 'asc')->get();

        if(count($products) > 0){
            $success['products'] = $products;
            return $this->sendResponse($success, 'Products');
        }

        return $this->sendError('No registered products.', [], 200);
    }

    public function search($id)
    {
        $product = Products::where('id', $id)->with('subcategories')->first();

        if($product){
            $success['product'] = $product;
            return $this->sendResponse($success, 'Product');
        }
        return $this->sendError('Product not found.', [], 200);
    }

    public function remove($id)
    {
        $product = Products::with('media')->where('id', $id)->first();
        if($product){
            foreach($product->media as $media)
                $media->delete();
            $product->delete();
            return $this->sendResponse([], 'Success');
        }
        return $this->sendError('Product not found.', [], 200);
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

        $category = Categories::where('id', $data['categories_id'])
            ->with('subcategories')->first();

        if($category){
            $product = Products::create($data);

            if(isset($data['medias'])){
                $this->store_medias($product, $data['medias']);
            }

            if(isset($data['subcategories'])){
                if(count($category->subcategories)){
                    foreach($data['subcategories'] as $data_sub){
                        $exist = false;
                        foreach($category->subcategories as $sub){
                            if($data_sub == $sub->id){
                                $exists = true;
                                break;
                            }
                        }
                    }

                    if(!$exists){
                        return $this->sendError('There is a invalid subcategory.', [], 200);
                    }

                    $product->subcategories()->attach($data['subcategories']);
                }
            }

            $success['product'] = $product;

            return $this->sendResponse($success, 'Product register successfully.');
        }

        return $this->sendError('The category doesnt exists.', [], 200);
    }

    public function update($id, Request $request)
    {
        $product = Products::where('id', $id)->first();
        if($product){
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => 'required',
                'categories_id' => 'required'
            ]);

            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors(), 200);
            }

            $category = Categories::where('id', $data['categories_id'])
                ->with('subcategories')->first();

            if($category){
                $product->update($data);

                if(isset($data['medias'])){
                    $this->store_medias($product, $data['medias']);
                }

                if(isset($data['subcategories'])){

                    if(count($category->subcategories)){
                        foreach($data['subcategories'] as $data_sub){
                            $exist = false;
                            foreach($category->subcategories as $sub){
                                if($data_sub == $sub->id){
                                    $exist = true;
                                    break;
                                }
                            }
                        }

                        if(!$exist){
                            return $this->sendError('There is a invalid subcategory.', [], 200);
                        }

                        $product->subcategories()->detach();
                        $product->subcategories()->attach($data['subcategories']);
                    }
                } else {
                    $product->subcategories()->detach();
                    $product->subcategories()->attach([]);
                }

                $success['product'] = $product;

                return $this->sendResponse($success, 'Product register successfully.');
            }

            return $this->sendError('The category doesnt exists.', [], 200);
        }
        return $this->sendError('The product doesnt exists.', [], 200);
    }

}
