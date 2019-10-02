<?php

namespace App\Services;

use App\Models\Sections;
use App\Services\Base\BaseService;

class SectionsService extends BaseService
{
    /**
     * SectionsService constructor.
     * @var Sections       $model
     */
    public function __construct(Sections $model)
    {
        parent::__construct($model);
    }

    /**
     * @return array
     * @var array $data
     */
    public function save(array $data = []): array
    {
        $section = $this->model->create($data);

        return [
            'success' => true,
            'data' => [
                'section' => $section
            ],
            'message' => 'Section register successfully.'
        ];
    }

    /**
     * @return array
     * @var int   $id
     * @var array $data
     */
    public function update(int $id, array $data = []): array
    {
        // TO-DO
    }
}
