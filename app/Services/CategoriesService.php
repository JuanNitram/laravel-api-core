<?php

namespace App\Services;

use App\Models\Categories;
use App\Services\Base\BaseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoriesService extends BaseService
{
    /**
     * CategoriesService constructor.
     * @param Categories $model
     */
    public function __construct(Categories $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return array
     */
    public function save(array $data = []): array
    {
        $category = $this->model->create($data);

        return [
            'success' => true,
            'data' => [
                'category' => $category
            ],
            'message' => 'Category register successfully.'
        ];
    }

    /**
     * @param int   $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data = []): array
    {
        if($category = $this->model->where('id', $id)->first()){
            $category->update($data);

            $success['category'] = $category;

            return [
                'success' => true,
                'data' => [
                    'category' => $category
                ],
                'message' => 'Category updated successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Category not found.'
        ];
    }
}
