<?php

namespace App\Http\Controllers\Api\Admin;

use App\Services\Base\BaseService;
use App\Services\SlidersService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;

use Validator;

class SlidersController extends BaseController
{
    /**
     * @var SlidersService
     */
    private $slidersService;

    /**
     * SlidersController constructor.
     * @param SlidersService $slidersService
     */
    public function __construct(SlidersService $slidersService)
    {
        $this->slidersService = $slidersService;
    }

    public function sliders()
    {
        return $this->sendResponse(['sliders' => $this->slidersService->all()], 'Sliders');
    }

    public function search(int $id)
    {
        if($slider = $this->slidersService->get($id)){
            return $this->sendResponse(['slider' => $slider], 'Slider founded successfully.');
        }

        return $this->sendResponse([], 'Slider not found.');
    }

    public function remove(int $id)
    {
        if($removed = $this->slidersService->remove($id)){
            return $this->sendResponse([], 'Slider deleted successfully.');
        }

        return $this->sendResponse([], 'A problem was ocurred.');
    }

    public function removeMedia(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'media_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        if($result = $this->slidersService->removeMedia($request->media_id)){
            return $this->sendResponse([], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $result = $this->slidersService->save($request->all());
        if($result['success'] === true){
            return $this->sendResponse($result['data'], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

    public function update(int $id, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $result = $this->slidersService->update($id, $data);
        if($result['success'] === true){
            return $this->sendResponse($result['data'], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

    public function saveOrder(Request $request){
        $items = $request->items;

        if($result = $this->slidersService->saveOrder($items)){
            return $this->sendResponse($result['data'], $result['message']);
        };

        return $this->sendResponse([], $result['message']);
    }

    public function activeMany(Request $request){
        $items = $request->items;
        $active = $request->active;

        if($result = $this->slidersService->activeMany($items, $active)){
            return $this->sendResponse($result['data'], $result['message']);
        };

        return $this->sendResponse([], $result['message']);
    }

    public function removeMany(Request $request){
        $items = $request->items;

        if($result = $this->slidersService->removeMany($items)){
            return $this->sendResponse($result['data'], $result['message']);
        };

        return $this->sendResponse([], $result['message']);
    }

}
