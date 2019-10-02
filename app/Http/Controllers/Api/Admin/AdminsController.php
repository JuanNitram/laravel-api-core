<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Services\AdminsService;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use App\Admin;

use Validator;

class AdminsController extends BaseController
{
    /**
     * @var AdminsService $adminsService
     */
    private $adminsService;

    /**
     * AdminsController constructor.
     * @param AdminsService $adminsService
     */
    public function __construct(AdminsService $adminsService)
    {
        $this->adminsService = $adminsService;
    }

    public function admins()
    {
        return $this->sendResponse(['admins' => $this->adminsService->all(['sections'])], 'Admins');
    }

    public function search(int $id)
    {
        if($admin = $this->adminsService->get($id, ['sections'])){
            return $this->sendResponse(['admin' => $admin], 'Admin founded successfully.');
        }

        return $this->sendResponse([], 'Admin not found.');
    }

    public function remove(int $id)
    {
        if($removed = $this->adminsService->remove($id)){
            return $this->sendResponse([], 'Admin deleted successfully.');
        }

        return $this->sendResponse([], 'A problem was ocurred.');
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'types_id' => 'required',
            'sections' => 'required',
            'parent' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $result = $this->adminsService->save($request->all());
        if($result['success'] === true){
            return $this->sendResponse($result['data'], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            // 'password' => 'required',
            // 'c_password' => 'required|same:password',
            'types_id' => 'required',
            'sections' => 'required',
            'parent' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors(), 200);
        }

        $data = [];
        foreach($request->all() as $key => $value){
            if($key != 'email')
                $data[$key] = $value;
        }

        $result = $this->adminsService->update($id, $data);
        if($result['success'] === true){
            return $this->sendResponse($result['data'], $result['message']);
        }

        return $this->sendResponse([], $result['message']);
    }

}
