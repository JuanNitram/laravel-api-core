<?php


namespace App\Services;


use App\Models\Subcategories;
use App\Services\Base\BaseService;
use Illuminate\Support\Collection;

class SubcategoriesService extends BaseService
{
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
        parent::__construct($model);
        $this->categoriesService = $categoriesService;
    }

    /**
     * @param int $id
     * @return Collection
     */
    public function getByCategory(int $id): Collection
    {
        return $this->model->where('categories_id', $id)->get();
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
