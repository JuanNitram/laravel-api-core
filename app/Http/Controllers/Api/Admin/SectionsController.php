<?php

namespace App\Http\Controllers\Api\Admin;

use App\Services\AdminsService;
use App\Services\SectionsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Admin\Base\BaseController as BaseController;
use Validator;

use App\Models\Sections;

class SectionsController extends BaseController
{

    /**
     * @var SectionsService
     */
    private $service;

    /**
     * @var AdminsService
     */
    private $adminsService;

    /**
     * SectionsController constructor.
     * @param AdminsService $adminsService
     */
    public function __construct(SectionsService $service, AdminsService $adminsService)
    {
        $this->service = $service;
        $this->adminsService = $adminsService;
    }

    public function sections(Request $request)
    {
        $parent = $request->parent;

        if($parent !== null){
            $admin = $this->adminsService->getByEmail($parent);
            if($admin !== null){
                return $this->sendResponse([
                    'sections' => $this->adminsService->getAdminSections($admin)
                ],'Sections');
            }

            return $this->sendResponse([], 'Admin not found.');
        }

        return $this->sendResponse([], 'No param parent founded.');
    }

    public function search($id)
    {
        if($section = $this->service->get($id)){
            return $this->sendResponse(['section' => $section], 'Section founded successfully.');
        }

        return $this->sendResponse([], 'Section not found.');
    }
}
