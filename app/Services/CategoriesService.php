<?php


namespace App\Services;


use App\Admin;
use App\Models\Categories;
use App\Models\Sliders;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CategoriesService
{
    /**
     * @var Categories
     */
    private $model;

    /**
     * CategoriesService constructor.
     * @param Categories $model
     */
    public function __construct(Categories $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @var int $id
     * @return Model
     */
    public function get(int $id): ?Model
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @var int $id
     * @return bool
     */
    public function remove(int $id): bool
    {
        if($category = $this->model->where('id', $id)->first()){
            return $category->delete();
        }

        return false;
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
