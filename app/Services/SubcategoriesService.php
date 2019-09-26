<?php


namespace App\Services;


use App\Models\Subcategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SubcategoriesService
{
    /**
     * @var Subcategories
     */
    private $model;

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * SubcategoriesService constructor.
     * @var Subcategories       $model
     * @param CategoriesService $categoriesService
     */
    public function __construct(Subcategories $model, CategoriesService $categoriesService)
    {
        $this->model = $model;
        $this->categoriesService = $categoriesService;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Model
     * @var int $id
     */
    public function get(int $id): ?Model
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @return bool
     * @var int $id
     */
    public function remove(int $id): bool
    {
        if($subcategory = $this->model->where('id', $id)->first()){
            return $subcategory->delete();
        }

        return false;
    }

    /**
     * @return array
     * @var array $data
     */
    public function save(array $data = []): array
    {
        if(($category = $this->categoriesService->get($data['categories_id']) !== null)){
            $subcategory = $this->model->create($data);

            return [
                'success' => true,
                'data' => [
                    'subcategory' => $subcategory
                ],
                'message' => 'Subcategory register successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Category not found.'
        ];
    }

    /**
     * @return array
     * @var int   $id
     * @var array $data
     */
    public function update(int $id, array $data = []): array
    {
        if($subcategory = $this->model->where('id', $id)->first()){
            if(isset($data['categories_id']) !== null && $this->categoriesService->get($data['categories_id']) === null){
                return [
                    'success' => false,
                    'message' => 'Category not found.'
                ];
            }

            $subcategory->update($data);

            return [
                'success' => true,
                'data' => [
                    'subcategory' => $subcategory
                ],
                'message' => 'Subcategory updated successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Subcategory not found.'
        ];
    }
}
